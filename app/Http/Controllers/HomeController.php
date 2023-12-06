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
        $user = User::where('id', $user_id)->with(
            'posts', 'posts.comments', 'posts.likes', 
            'posts.comments.user', 'posts.likes.user', 'posts.photos' )->first();
        $usuarioLogado = Auth::user();
        $listaPosts = $user->posts()->get();
        $listaPosts = $user->posts()->orderBy('created_at', 'desc')->get();
        return view('home', ['listaPosts' => $listaPosts, 'usuarioLogado' => $usuarioLogado]);

    }
}
