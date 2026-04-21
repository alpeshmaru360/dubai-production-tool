<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaDocs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MediaDocsController extends Controller
{
    public function index()
    {
        // Get all documents and pass them to the view
        $Documents = MediaDocs::orderBy('created_at', 'desc')->get();
        // dd($Images);
        return view('Admin.media_docs', compact('Documents'));
    }

    public function store(Request $request)
    {
        // Validate the uploaded files
        $request->validate([
            'document.*' => 'required|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,odt,ods|max:5120', // Max size = 5MB per file
        ]);

        try {
            // Check if files are uploaded
            if ($request->hasFile('document')) {
                foreach ($request->file('document') as $file) {
                    // Get the original file name and sanitize it by replacing spaces with underscores
                    $originalFilename = $file->getClientOriginalName();
                    $sanitizedFilename = str_replace(' ', '_', $originalFilename); // Replace spaces with underscores

                    // Set the target path directly
                    $path = public_path('sales_manager/media_database/documents/' . $sanitizedFilename);

                    // Move the uploaded file to the target path
                    $file->move(public_path('sales_manager/media_database/documents/'), $sanitizedFilename);

                    // Store each document in the database with the sanitized file name
                    MediaDocs::create([
                        'name' => $sanitizedFilename, // Storing the sanitized file name in the 'name' field
                        'document_path' => 'sales_manager/media_database/documenta/' . $sanitizedFilename,
                    ]);
                }
            }

            return redirect()->route('MediaDocs')->with('success', 'Documents uploaded successfully.');
        } catch (\Exception $e) {
            // Log the error and return an error message to the user
            Log::error('Error uploading Documents: ' . $e->getMessage());
            return back()->with('error', 'Failed to upload Documents.');
        }
    }

    public function destroy($id)
    {
        try {
            // Fetch the document record by its ID
            $document = MediaDocs::findOrFail($id);

            // Define the file path
            $filePath = public_path('sales_manager/media_database/documents/' . $document->name);

            // Check if the file exists and delete it
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }

            // Delete the database record
            $document->delete();

            // Return a JSON response for AJAX requests
            if (request()->ajax()) {
                return response()->json(['success' => true, 'message' => 'Document deleted successfully.']);
            }

            return back()->with('success', 'Document deleted successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting document: ' . $e->getMessage());

            // Return a JSON response for AJAX requests
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Failed to delete the document. ' . $e->getMessage()], 500);
            }

            return back()->with('error', 'Failed to delete the document. ' . $e->getMessage());
        }
    }
}
