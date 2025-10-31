<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ResizeProfileImage;

class ImageController extends Controller
{ public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);

        $path = $request->file('image')->store('uploads', 'public');

        // Dispatch job to resize image
        ResizeProfileImage::dispatch('storage/' . $path);

        return response()->json([
            'message' => 'Image uploaded successfully! Resize job has been queued.',
            'path' => 'storage/' . $path,
        ]);
    }
}
