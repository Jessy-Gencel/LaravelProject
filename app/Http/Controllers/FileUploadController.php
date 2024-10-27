<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    // Display the file upload form
    public function showForm()
    {
        return view('file_upload_form');
    }

    // Handle the file upload and storage
    public function uploadFile(Request $request)
    {
        // Validate the request to ensure there's an image file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the file in the 'public/images' directory
        $path = $request->file('image')->store('images', 'public');

        // Generate the public URL for the uploaded file
        $url = Storage::url($path);

        // Pass the URL to a view to display the uploaded image
        return view('file_uploaded', compact('url'));
    }
}
