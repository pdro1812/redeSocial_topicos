@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Post: </h1>
    <hr>

    <h2>Post de {{ $post->user->name }}:</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Detalhes</th>
            </tr>
        </thead>

    </table>

        

        <tbody>
        <h5>Conteudo: {{ $post->content }}:</h5>
        </tbody>

        <button type="button" class="btn btn-outline-primary">Curtir</button><br><br>

        Comentários: 
                            <span class="badge rounded-pill bg-primary">
                            {{ $post->comments->count() }}
                            </span>
                        </p>
                        <ul class="list-group">
                            @foreach($post->comments as $umComment)
                                <li class="list-group-item">
                                    <a href="/user/{{ $umComment->user->id }}" style="color: #000;"> {{ $umComment->user->name }}</a>
                                     </b> {{ $umComment->content }} 
                                    <small class="text-muted">
                                        {{\Carbon\Carbon::parse($umComment->created_at)->format('d/m/Y h:m')}}
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                        <br>
                        <p>
                            Likes:
                            <span class="badge rounded-pill bg-primary">
                            {{ $post->likes->count() }}
                            </span>
                            <ul class="list-group">
                            @foreach($post->likes as $umLike)
                                <li class="list-group-item">
                                <a href="/user/{{ $umLike->user->id }}" style="color: #000;"> {{ $umLike->user->name }}</a>
                                </li>
                            @endforeach

@endsection
