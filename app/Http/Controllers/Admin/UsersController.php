<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $countries = Country::all();
        return view('Admin.users', compact('users', 'countries'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|unique:users,email',
                'role' => 'required|string|max:255',
                'country' => 'required|exists:country,id',
                'password' => 'required|string|min:6',
            ]);

            // Log before creating the user
            Log::info('Attempting to create a new user', $validatedData);

            // Get the country name
            $country = Country::findOrFail($validatedData['country']);

            // Create the user and save to the database
            $user = User::create([
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'role' => $validatedData['role'],
                'country_name' => $country->country_name,
                'password' => Hash::make($validatedData['password']),
            ]);

            Log::info('User created successfully with ID: ' . $user->id);

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'User created successfully.']);
            }

            return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
        } catch (ValidationException $e) {
            Log::error('Validation failed: ' . json_encode($e->errors()));

            if ($request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }

            return redirect()->route('admin.users.index')
                ->withErrors($e->errors())
                ->withInput();
        } catch (QueryException $e) {
            // Check if the error is due to a duplicate entry
            if ($e->errorInfo[1] == 1062) {
                $errorMessage = 'User not added because the email already exists.';
                Log::error($errorMessage);

                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => $errorMessage], 422);
                }

                return redirect()->route('admin.users.index')
                    ->with('error', $errorMessage)
                    ->withInput();
            }

            // For other database errors
            Log::error('Database error: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while creating the user.'], 500);
            }

            return redirect()->route('admin.users.index')
                ->with('error', 'An error occurred while creating the user.')
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Failed to create user: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Failed to create user.'], 500);
            }

            return redirect()->route('admin.users.index')
                ->with('error', 'Failed to create user.')
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|unique:users,email,' . $id,
                'role' => 'required|string|max:255',
                'country' => 'required|exists:country,id',
            ]);

            $user = User::findOrFail($id);
            $country = Country::findOrFail($validatedData['country']);

            $user->update([
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'role' => $validatedData['role'],
                'country_name' => $country->country_name,
            ]);

            Log::info('User updated successfully with ID: ' . $user->id);

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'User updated successfully.']);
            }

            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        } catch (ValidationException $e) {
            Log::error('Validation failed: ' . json_encode($e->errors()));

            if ($request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }

            return redirect()->route('admin.users.index')
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Failed to update user: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Failed to update user.'], 500);
            }

            return redirect()->route('admin.users.index')
                ->with('error', 'Failed to update user.')
                ->withInput();
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            Log::info('User deleted successfully with ID: ' . $id);

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
            }

            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete user: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Failed to delete user.'], 500);
            }

            return redirect()->route('admin.users.index')->with('error', 'Failed to delete user.');
        }
    }
}
