<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Post;
use App\Models\Photo;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function formPost(){
        return view('post.create');
    }

    public function store(Request $request)
    {   

        //pega a imagem que veio no formulário
        $image = $request->file('file');
        //define um novo nome
        $imageName = time().'.'.$image->extension();
        //salva a imagem na pasta /public/storage/image
        $image->move(public_path('storage/image/'),$imageName);

        $conteudo = $request['content'];
        $post = new Post();
        $post->content = $conteudo;
        $post->user_id = Auth::id();
        $post->save();

         $foto = new Photo();
         $foto->image_path = $imageName;
         $foto->post_id = $post->id;
         $foto->save();
         

        return response()->json(['success'=>$imageName]);
        
    }

    public function details($id){

        $post = Post::where('id', $id)->with('user','comments','comments.user','likes','likes.user')->first();
        $usuarioLogado = Auth::user();
        return view('post.postDetails', ['post' => $post, 'usuarioLogado' => $usuarioLogado]);
    }


    public function like($id) {

        $post = Post::find($id);
        //$UserId = Auth::id();
        $usuarioLogado = Auth::user(); //User::where('id',$UserId)->with('likedPosts')->get();

        $usuarioLogado->likedPosts()->attach($post);
        
        return redirect()->back();
    }

    public function dislike($id) {

        $post = Post::find($id);
        $usuarioLogado = Auth::user();

        $usuarioLogado->likedPosts()->detach($post);
        
        return redirect()->back();
    }

}
