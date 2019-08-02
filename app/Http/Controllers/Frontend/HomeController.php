<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('frontend.home');
    }

    public function posts()
    {
        return view('frontend.blog', [
            'auth_user' => Auth::user()
        ]);
    }
}
