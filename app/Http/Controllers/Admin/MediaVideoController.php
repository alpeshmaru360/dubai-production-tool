<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaVideos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MediaVideoController extends Controller
{
    public function index()
    {
        // Get all documents and pass them to the view
        $Videos = MediaVideos::orderBy('created_at', 'desc')->get();
        // dd($Images);
        return view('Admin.media_videos', compact('Videos'));
    }

    public function store(Request $request)
    {
        // Validate the uploaded files
        $request->validate([
            'video.*' => 'required|mimetypes:video/mp4,video/x-msvideo,video/x-matroska,video/quicktime,video/x-ms-wmv,video/x-flv,video/webm,video/3gpp|max:15360', // 15MB per file
        ]);

        try {
            // Check if files are uploaded
            if ($request->hasFile('video')) {
                foreach ($request->file('video') as $file) {
                    // Get the original file name and sanitize it by replacing spaces with underscores
                    $originalFilename = $file->getClientOriginalName();
                    $sanitizedFilename = str_replace(' ', '_', $originalFilename); // Replace spaces with underscores

                    // Set the target path directly
                    $path = public_path('sales_manager/media_database/videos/' . $sanitizedFilename);

                    // Move the uploaded file to the target path
                    $file->move(public_path('sales_manager/media_database/videos/'), $sanitizedFilename);

                    // Store each document in the database with the sanitized file name
                    MediaVideos::create([
                        'name' => $sanitizedFilename, // Storing the sanitized file name in the 'name' field
                        'video_path' => 'sales_manager/media_database/videos/' . $sanitizedFilename,
                    ]);
                }
            }

            return redirect()->route('MediaVideos')->with('success', 'Vidoes uploaded successfully.');
        } catch (\Exception $e) {
            // Log the error and return an error message to the user
            Log::error('Error uploading Videos: ' . $e->getMessage());
            return back()->with('error', 'Failed to upload Videos.');
        }
    }

    public function destroy($id)
    {
        try {
            // Fetch the document record by its ID
            $video = MediaVideos::findOrFail($id);

            // Define the file path
            $filePath = public_path('sales_manager/media_database/videos/' . $video->name);

            // Check if the file exists and delete it
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }

            // Delete the database record
            $video->delete();

            // Return a JSON response for AJAX requests
            if (request()->ajax()) {
                return response()->json(['success' => true, 'message' => 'Video deleted successfully.']);
            }

            return back()->with('success', 'Video deleted successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting video: ' . $e->getMessage());

            // Return a JSON response for AJAX requests
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Failed to delete the video. ' . $e->getMessage()], 500);
            }

            return back()->with('error', 'Failed to delete the video. ' . $e->getMessage());
        }
    }
}
