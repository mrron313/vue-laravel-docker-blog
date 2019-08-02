<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user:id,name,user_name')
                        ->with('category:id,name')
                        ->where('approved', 1)
                        ->orderByDesc('created_at')
                        ->paginate(5);
        
        return response()->json([
            'data' => $posts
        ], 200);
    }

    public function store(PostRequest $request)
    {
        $authUserId = User::where('identification_token', $request->input('identification_token'))
                            ->first()->id;

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category_id');
        $post->user_id = $authUserId;

        $msg = 'Your post have been added. Waiting for admin response.';
        
        if($authUserId == 1){
            $post->approved = 1;
            $msg = 'Post have been added.';
        }    

        $post->save();

        return response()->json([
            'data' => $post,
            'message' => $msg
        ], 200);
    }

    public function show($postId)
    {
        $post = Post::with('user:id,name')
                    ->with('category:id,name')
                    ->where('id', $postId)->first();
        
        return response()->json([
            'data' => $post
        ], 200); 
    }

    public function categoryPosts($categoryId)
    {
        $posts = Post::where('category_id', $categoryId)
                    ->with('user:id,name')
                    ->with('category:id,name')->paginate(5);
            
        return response()->json([
            'data' => $posts
        ], 200);
    }

    public function singleUserPosts($userName)
    {
        $userPosts = Post::whereHas('user', function($q) use ($userName){
            $q->where('user_name', $userName);
        })->with('user:id,name,user_name')->with('category:id,name')
        ->orderByDesc('created_at')
        ->paginate(10);

        return response()->json([
            'data' => $userPosts
        ], 200);
    }
}
