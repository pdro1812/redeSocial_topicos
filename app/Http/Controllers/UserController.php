<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function list(){

        $listaUser = User::simplePaginate(5);
        $user_id = Auth::id();
        $usuarioAutenticado = User::where('id', $user_id)->with('follows')->first();
        return view('list.users', ['list' => $listaUser, 'usuarioAutenticado' => $usuarioAutenticado]);
    }

    public function details($id){

        $user_id = Auth::id();
        $user = User::where('id', $id)->with('posts', 'posts.comments', 'posts.likes','follows','followers',  'posts.likes.user', 'posts.comments.user')->first();
        return view('user.userDetails', ['user' => $user]);
    }

    
    public function follow($id) {
        $usuarioParaSeguir = User::find($id);
        $usuarioLogado = Auth:: user();

        $usuarioLogado->follows()->attach($usuarioParaSeguir);
        
        return redirect()->back();
    }
       
    public function unfollow($id) {

        $usuarioParaNaoSeguir = User::find($id);
        $usuarioLogado = Auth::user();

        $usuarioLogado->follows()->detach($usuarioParaNaoSeguir);
        
        return redirect()->back();
    }
    
}
