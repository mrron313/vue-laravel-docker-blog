<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\PostApproved;
use App\Http\Controllers\Controller;

class AdminBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

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

            $user->notify(new PostApproved($approvedDetails)); // Mail sent to user
        }

        $key = 'AAAAtaIDi4E:APA91bFOEgexTYoZmdVMhBtNyN92cVjysHsYdiT70B5_NP4CqFnOxouysZvrFls9jlfwrQDFoyyFlCUYucFJ7C0Pb4pBb9WNJHUdJD_Erf6eVkZCSsAMoSIXVD_fi3lyTO-Y9gEa-PeB';

        $data = array(
                      "to" => $user->user_device_token,
                      "notification" => array( "title" => "Tech Blog", 
                      "body" => "Your post is approved!", 
                      "icon" => url('/images/favicon-96x96.png'), 
                      "click_action" => url('/'))
                );          

        $data_string = json_encode($data); 
        
        echo "The Json Data : ".$data_string; 
        
        $headers = array
        (
             'Authorization: key=' . $key, 
             'Content-Type: application/json'
        );                                                                                 
                                                                                                                             
        $ch = curl_init();  
        
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );                                                                  
        curl_setopt( $ch,CURLOPT_POST, true );  
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);                                                                  
                                                                                                                             
        $result = curl_exec($ch);
        
        curl_close ($ch);        
        
        return redirect('/dashboard/posts/'. $request->input('post_id') )
                    ->with('success', 'Post is approved!');
    }
}
