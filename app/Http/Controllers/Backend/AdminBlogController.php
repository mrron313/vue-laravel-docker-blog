<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\PostApproved;
use App\Http\Controllers\Controller;

class AdminBlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('category:id,name')
                        ->with('user:id,name')
                        ->orderBy('approved', 'asc')
                        ->orderByDesc('created_at')
                        ->get();

        return view('backend.posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('backend.posts.single', compact('post'));
    }

    public function approve(Request $request)
    {
        $userUpdated = Post::find($request->input('post_id'))
                ->update(['approved' => 1]);

        $user = User::whereHas('posts', function($q) use ($request){
                $q->where('posts.id', $request->input('post_id'));
        })->first();
        
        if( $userUpdated ){

            $approvedDetails = [
                'post_id' => $request->input('post_id'),
                'message' => "Your post has been approved."
            ];

            $user->notify(new PostApproved($approvedDetails));
        }
        
        return redirect('/dashboard/posts/'. $request->input('post_id') )
                    ->with('success', 'Post is approved!');
    }
}
