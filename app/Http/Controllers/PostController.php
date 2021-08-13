<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentRessource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::orderBy('created_at', 'desc')->get();
        return PostResource::collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(['content' => 'required']);
        // return array('Request has [post_image]'=>$request->has('post_image'));
        $post = Auth::user()->Posts()->create(['content' => $request->content]);
        if ($request->has('post_image')) {
            // $post->image_path=$request->post_image->split('/')[];
            $urlArray = explode('/', $request->post_image);
            $post->image_path = array_pop($urlArray);
            $post->save();
        }
        // return response()->json($post);
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        // return response()->json($post);
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $request->validate(['content' => 'required']);
        $post->content = $request->content;
        if ($request->has('post_image')) {
            $post->image_path = $request->post_image;
        }
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return response()->json(['sucess' => 'post deleted']);
    }


    public function like(Request $request)
    {
        // $$post->Likes->pluck->('user_id');
        $post = Post::find($request->post_id);
        if ($post->isLiked()) {
            $post->Likes()->where('user_id', Auth::id())->delete();
            return response()->json(['isLiked' => false]);
        } else {
            $post->Likes()->create(['user_id' => Auth::id()]);
            return response()->json(['isLiked' => true]);
        }
    }

    public function getPostComments(Request $request)
    {
        $request->validate(['post_id' => 'required']);
        $post = Post::find($request->post_id);
        if ($post) {
            return CommentRessource::collection($post->comments->sortByDesc('created_at'));
        } else {
            return response()->json(['error' => 'Post not Found'], 404);
        }
    }

    public function addPostComment(Request $request)
    {
        $request->validate(['post_id' => 'required', 'content' => 'required']);
        $post = Post::find($request->post_id);
        if ($post) {
            //    return CommentRessource::collection($post->comments);
            $comment = $post->comments()->create(['user_id' => Auth::id(), 'content' => $request->content]);
            return new CommentRessource($comment);
        } else {
            return response()->json(['error' => 'Post not Found'], 404);
        }
    }
}
