<?php

namespace App\Http\Controllers\Admin\ProductTypeDocs;

use App\Http\Controllers\Controller;
use App\Models\Product_type_docs\ControlDocs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ControlDocsController extends Controller
{
    public function index()
    {
        // Get all documents and pass them to the view
        $documents = ControlDocs::orderBy('created_at', 'desc')->get();
        return view('Admin.Product_type_docs/control_docs', compact('documents'));
    }

    public function store(Request $request)
    {
        // Validate the uploaded files
        $request->validate([
            'document.*' => 'required|file|max:15360', // Max size = 15MB
        ]);

        try {
            // Check if files are uploaded
            if ($request->hasFile('document')) {
                foreach ($request->file('document') as $file) {
                    // Get the original file name and sanitize it by replacing spaces with underscores
                    $originalFilename = $file->getClientOriginalName();
                    $sanitizedFilename = str_replace(' ', '_', $originalFilename); // Replace spaces with underscores

                    // Set the target path directly
                    $path = public_path('sales_manager/document_portal/product_types/control_docs/' . $sanitizedFilename);

                    // Move the uploaded file to the target path
                    $file->move(public_path('sales_manager/document_portal/product_types/control_docs/'), $sanitizedFilename);

                    // Store each document in the database with the sanitized file name
                    ControlDocs::create([
                        'name' => $sanitizedFilename, // Storing the sanitized file name in the 'name' field
                        'document_path' => 'sales_manager/document_portal/product_types/control_docs/' . $sanitizedFilename,
                    ]);
                }
            }

            return redirect()->route('ControlDoc')->with('success', 'Documents uploaded successfully.');
        } catch (\Exception $e) {
            // Log the error and return an error message to the user
            Log::error('Error uploading documents: ' . $e->getMessage());
            return back()->with('error', 'Failed to upload documents.');
        }
    }

    public function destroy($id)
    {
        try {
            // Fetch the document record by its ID
            $document = ControlDocs::findOrFail($id);

            // Define the file path
            $filePath = public_path('sales_manager/document_portal/product_types/control_docs/' . $document->name);

            // Check if the file exists and delete it
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }

            // Delete the database record
            $document->delete();

            return back()->with('success', 'Document deleted successfully.');
        } catch (\Exception $e) {
            // Handle errors
            Log::error('Error deleting document: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete the document.');
        }
    }
}
