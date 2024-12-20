<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            'id' => "posts",
            'menu' => 'Gallery',
            'galleries' => array()
            // 'galleries' => Post::where('picture', '!=', '')->whereNotNull('picture')->orderBy('created_at', 'desc')->paginate(30)
        );
        return view('gallery.index', $data);
    }
    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/gallery",
     *     tags={"Gallery"},
     *     summary="Get list of books pictured",
     *     description="Mengambil daftar galeri",   
     * @OA\Response(
     *         response=200,
     *         description="Sukses mendapatkan data galeri",
     *         @OA\JsonContent(
     *             type="object",
     *             properties={
     *                 @OA\Property(property="status", type="boolean", example=true),
     *                 @OA\Property(property="message", type="string", example="Berhasil mendapatkan semua foto"),
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         properties={
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="title", type="string", example="The Analytical Rules"),
     *                             @OA\Property(property="writer", type="string", example="Harry Potter"),
     *                             @OA\Property(property="picture", type="string", example="image_new_url.jpg")
     *                         }
     *                     )
     *                 ),
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */
    public function indexAPI()
    {
        $data_gambar = Post::where('picture', '!=', '')->whereNotNull('picture')->orderBy('created_at', 'desc')->get();

        // Mereturn respons dalam format JSON
        return response()->json([
            'status' => true,
            'message' => "Berhasil mendapatkan semua gambar",
            'data' => $data_gambar,
        ], 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:10000'
        ]);

        // Upload Image
        if ($request->hasFile('picture')) {
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $filenameToSave = $filename . '_' . time() . '.' . $extension;
            // Menyimpan gambar di public/posts
            $path = $request->file('picture')->storeAs('posts', $filenameToSave);
        } else {
            $filenameToSave = null;
        }

        $post = new Post;
        $post->picture = $filenameToSave;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        return redirect('gallery')->with('success', 'Berhasil menambahkan data baru');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gallery = Post::find($id);
    
        if (!$gallery) {
            return redirect('gallery')->with('error', 'Gallery item not found');
        }
        
        return view('gallery.edit')->with('gallery', $gallery);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999'
        ]);

        $post = Post::find($id);
        if ($request->hasFile('picture')) {
            if ($post->picture != 'noimage.png') {
                Storage::delete('public/posts/' . $post->picture); // Pastikan path sesuai
            }

            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $filenameToSave = $filename . '_' . time() . '.' . $extension;
            // Menyimpan gambar di public/posts
            $path = $request->file('picture')->storeAs('posts/', $filenameToSave);

            $post->picture = $filenameToSave;
        }

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        return redirect('gallery')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post->picture != 'noimage.png') {
            Storage::delete('public/posts/' . $post->picture); // Pastikan path sesuai
        }

        $post->delete();

        return redirect('gallery')->with('success', 'Data berhasil dihapus');
    }

    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/gallery",
     *     tags={"gallery"},
     *     summary="Returns a Sample API gallery response",
     *     description="A sample gallery to test out the API",
     *     operationId="gallery",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent
     *           (example={
     *               "success": true,
     *               "message": "Berhasil memproses galleries",
     *               "galleries": {
     *                  {
     *                      "id": 1,
     *                      "title": "gallery bell",
     *                      "description": "deskripsi gallery bell",
     *                      "picture": "bell.jpeg",
     *                      "created_at": "2024-11-06T02:20:42.000000Z",
     *                      "updated_at": "2024-11-06T02:20:42.000000Z"
     *                  }
     *              }
     *          }),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan",
     *         @OA\JsonContent
     *           (example={
     *               "detail": "strings"
     *          }),
     *     )
     * )
     */
    public function gallery()
    {
        $data = array(
            'message' => 'Berhasil memproses galleries',
            'success' => true,
            'galleries' => Post::where('picture', '!=', '')->whereNotNull('picture')->orderBy('created_at', 'desc')->get()
        );
        return response()->json($data);
    }
}