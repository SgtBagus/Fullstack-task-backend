<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
               'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->messages()->first(),
                    'status' => false,
                ], 500);
            }

            $uploadFolder = 'images/'.$request->path;
            $image = $request->file('image');
            $image_uploaded_path = $image->store($uploadFolder, 'public');

            $uploadedImageResponse = [
                "image_name" => basename($image_uploaded_path),
                "image_url" => Storage::disk('public')->url($image_uploaded_path),
                "mime" => $image->getClientMimeType()
            ];

            return response()->json([
                'data' => $uploadedImageResponse,
                'message' => "File Uploaded Successfully",
                'status' => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong!",
                'status' => false,
            ], 500);
        }
    }
}
