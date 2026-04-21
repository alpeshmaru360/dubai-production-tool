<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MediaImgController extends Controller
{
    public function index()
    {
        // Get all documents and pass them to the view
        $Images = MediaImages::orderBy('created_at', 'desc')->get();
        // dd($Images);
        return view('Admin.media_images', compact('Images'));
    }

    public function store(Request $request)
    {
        // Validate the uploaded files
        $request->validate([
            'image.*' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:15360', // Max size = 15MB
        ]);

        try {
            // Check if files are uploaded
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    // Get the original file name and sanitize it by replacing spaces with underscores
                    $originalFilename = $file->getClientOriginalName();
                    $sanitizedFilename = str_replace(' ', '_', $originalFilename); // Replace spaces with underscores

                    // Set the target path directly
                    $path = public_path('sales_manager/media_database/images/' . $sanitizedFilename);

                    // Move the uploaded file to the target path
                    $file->move(public_path('sales_manager/media_database/images/'), $sanitizedFilename);

                    // Store each document in the database with the sanitized file name
                    MediaImages::create([
                        'name' => $sanitizedFilename, // Storing the sanitized file name in the 'name' field
                        'image_path' => 'sales_manager/media_database/images/' . $sanitizedFilename,
                    ]);
                }
            }

            return redirect()->route('MediaImages')->with('success', 'Images uploaded successfully.');
        } catch (\Exception $e) {
            // Log the error and return an error message to the user
            Log::error('Error uploading Images: ' . $e->getMessage());
            return back()->with('error', 'Failed to upload Images.');
        }
    }

    public function destroy($id)
    {
        try {
            // Fetch the document record by its ID
            $image = MediaImages::findOrFail($id);

            // Define the file path
            $filePath = public_path('sales_manager/media_database/images/' . $image->name);

            // Check if the file exists and delete it
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }

            // Delete the database record
            $image->delete();

            // Return a JSON response for AJAX requests
            if (request()->ajax()) {
                return response()->json(['success' => true, 'message' => 'Document deleted successfully.']);
            }

            return back()->with('success', 'Image deleted successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting image: ' . $e->getMessage());

            // Return a JSON response for AJAX requests
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Failed to delete the image. ' . $e->getMessage()], 500);
            }

            return back()->with('error', 'Failed to delete the image. ' . $e->getMessage());
        }
    }
}
