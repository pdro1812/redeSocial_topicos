<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::id();
        $user = User::where('id', $user_id)->with('posts', 'posts.comments', 'posts.likes')->first();
        $listaPosts = $user->posts()->get();
        return view('home', ['listaPosts' => $listaPosts]);

    }
}
