<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function list(){
        $listaUser = User::all();
        return view('list.users', ['list' => $listaUser]);
    }

    public function details($id){

        $user_id = Auth::id();
        $user = User::where('id', $id)->with('posts', 'posts.comments', 'posts.likes','follows','followers',  'posts.likes.user', 'posts.comments.user')->first();
        return view('user.userDetails', ['user' => $user]);
    }

    
    
}
