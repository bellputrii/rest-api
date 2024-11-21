<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/gallery",
     *     tags={"Gallery"},
     *     summary="Upload an image to the gallery",
     *     description="Accepts an image file and returns the URL of the uploaded image",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"image"},
     *                 @OA\Property(
     *                     property="image",
     *                     description="Image file to upload",
     *                     type="string",
     *                     format="binary"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Image uploaded successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Image uploaded successfully",
     *                 "data": {
     *                     "url": "http://example.com/storage/images/filename.jpg"
     *                 }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input or file not uploaded"
     *     )
     * )
     */
    public function uploadImage(Request $request)
    {
        // Validasi input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Proses unggah gambar
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $path = $image->storeAs('public/images', $image->getClientOriginalName());

            // Menghasilkan URL file yang diupload
            $imageUrl = Storage::url($path);

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'data' => [
                    'url' => $imageUrl,
                ],
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to upload image',
        ], 400);
    }
}
