<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    public function formPost(){
        return view('post.create');
    }

    public function store(Request $request)
    {
        $messages = array(
            //'title.required'=> 'É obrigatorio ter um titulo para a att',
            'content.required'=> 'É obrigatorio ter conteudo',
        );
        $regras = array(
            //'title' => 'required|string|max:255',
            'content' => 'required',
        );

        $validator = Validator::make($request->all(), $regras, $messages);

        if ($validator->fails()){
            return redirect('create/post')
            ->withErrors($validator)
            ->withInput($request->all);
        }

        $obj_Post = new Post();
        //$obj_Post->title = $request['title'];
        $obj_Post->content = $request['content'];
        $obj_Post->user_id = Auth::id();
        $obj_Post->save();

        return redirect('/home')->with('sucess', 'Post criado com sucesso');

        

    }

    public function details($id){

        $post = Post::where('id', $id)->with('user','comments','comments.user','likes','likes.user')->first();
        return view('post.postDetails', ['post' => $post]);
    }
}
