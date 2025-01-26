<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::inRandomOrder()->get();
        return PostResource::collection($posts);
    }
    public function indexUser()
    {
        $user = Auth::user()->customers->id;
        $posts = Post::where('poster_id', $user)->orderByDesc('created_at')->get();
        return PostResource::collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['poster_id'] = $request->user()->customers->id;

        $imagePath = request()->file( 'image')->store('categories', 'public');
        $imageUrl = Storage::url($imagePath);
        $validatedData['image'] = $imageUrl;
        


        // get the new image path 
        // $baseUrl = url('/');
        // $imageName = str::random(10) . "." . $request->image->getClientOriginalExtension();
        // $path = '/api/posts/image/' . $imageName;
        // Storage::disk('public')->put($imageName, file_get_contents($request->image));
        // $validatedData['image'] = $baseUrl . $path;


        // post creation
        $post = Post::create($validatedData);
        return response()->json(
            new PostResource($post),

            200
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $post = Post::where('poster_id', Auth::user()->customers->id)->find($id);
        if (!$post) {
            return response()->json([
                'message' => 'Post not found',
            ], 404);
        }
        $oldImagePath = $post->getOriginal('image');
        $baseUrl = url('api/posts/image/');
        // Check if the image path starts with the base URL and strip it
        // if ($oldImagePath && str_starts_with($oldImagePath, $baseUrl)) {
        //     $oldImagePath = substr($oldImagePath, strlen($baseUrl));
        // }
        // // Check if the image exists and delete it
        // if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {

        //     Storage::disk('public')->delete($oldImagePath);
        // }

        // Delete the post
        // $post->delete();
        // return response()->json([

        //     'message' => 'Successfully deleted post',

        // ], 200);
        $oldImagePath = substr($oldImagePath, strlen($baseUrl));
        return [
            'image' => $oldImagePath,
            'imsage' => Storage::disk('public')->exists($oldImagePath),
        ];
    }
}
