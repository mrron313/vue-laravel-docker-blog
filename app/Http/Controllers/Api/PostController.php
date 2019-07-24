<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user:id,name')->with('category:id,name')->paginate(5);
        
        return response()->json([
            'data' => $posts
        ], 200);
    }

    public function categories($categoryId)
    {
        $posts = Post::where('category_id', $categoryId)->with('user:id,name')->with('category:id,name')->paginate(5);
            
        return response()->json([
            'data' => $posts
        ], 200);
    }
}
