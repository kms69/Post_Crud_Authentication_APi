<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json([
            "success" => true,
            "message" => "Post List",
            "data" => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'body' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 200);
        }
        $post = Post::create($input);
        return response()->json([
            "success" => true,
            "message" => "Post created successfully.",
            "data" => $post
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Post retrieved successfully.",
            "data" => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $post->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Post updated successfully.",
            "data" => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            "success" => true,
            "message" => "Post deleted successfully.",
            "data" => $post
        ]);
    }
}
