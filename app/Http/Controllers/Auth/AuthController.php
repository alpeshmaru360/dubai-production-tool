<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;

class AuthController extends Controller
{
    public function login_Form()
    {
        
        // Return the view for the login form
        return view('auth.login'); // Make sure this matches the path to your login view
    }
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); 
            // dd($user);
            $role = $user->role;

            switch ($role) {
                case 'Admin':
                    // Redirect to the admin dashboard
                    return redirect()->intended(route('AdminDashboard'));
                    break;
                case 'Sales Manager':
                    // Redirect to the sales manager dashboard
                    return redirect()->intended(route('SaleManagerDashboard'));
                    break;
                default:
                    // Redirect to a default page if the role doesn't match any case
                    return redirect()->intended(route('AuthLogin'));
                    break;
            }
        }
        else {
            // Redirect back with an error message if authentication fails
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
        
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
