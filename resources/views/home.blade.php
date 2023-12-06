@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        @foreach($listaPosts as $umPost)
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <a href="/user/{{ $umPost->user->id }}" style="color: #fff; text-decoration: none;">{{ $umPost->user->name }}</a>
                    </div>

                    <a href="/post/{{ $umPost->id }}" style="text-decoration: none;"> 
                        <div class="card-body">

                            @if($umPost->photos->count()>0)   
                                <img src="/storage/image//{{$umPost->photos[0]->image_path}}" class="img-fluid rounded mb-3" alt="Imagem do post">
                            @endif

                            <p class="card-text">{{ $umPost->content }}</p>
                        </div>
                    </a>

                    <div class="card-footer">    
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if(!$umPost->likes->contains('user_id', $usuarioLogado->id)) 
                                    <a href="/like/{{$umPost->id}}" class="btn btn-outline-primary">Curtir</a>
                                @else
                                    <a href="/dislike/{{$umPost->id}}" class="btn btn-outline-danger">Descurtir</a>
                                @endif
                            </div>
                            <div class="text-muted">
                                {{ $umPost->created_at->diffForHumans() }}
                            </div>
                        </div>

                        <div class="mt-3">
                            <h5>Novo Comentário:</h5>
                            <form action="/comment" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="post_id" value="{{ $umPost->id }}">
                                    <textarea class="form-control" name="content" rows="3" placeholder="Escreva um comentário"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Comentar</button>
                            </form>
                        </div>

                        <div class="mt-3">
                            <p>
                                <strong>Comentários:</strong> 
                                <span class="badge bg-info text-white">{{ $umPost->comments->count() }}</span>
                            </p>
                            <ul class="list-group">
                                @foreach($umPost->comments as $umComment)
                                    <li class="list-group-item">
                                        <a href="/user/{{ $umComment->user->id }}" style="color: #000;">{{ $umComment->user->name }}</a>
                                        {{ $umComment->content }} 
                                        <small class="text-muted">
                                            {{\Carbon\Carbon::parse($umComment->created_at)->diffForHumans()}}
                                        </small>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-3">
                            <p>
                                <strong>Likes:</strong> 
                                <span class="badge bg-success">{{ $umPost->likes->count() }}</span>
                            </p>
                            <ul class="list-group">
                                @foreach($umPost->likes as $umLike)
                                    <li class="list-group-item">
                                        <a href="/user/{{ $umLike->user->id }}" style="color: #000;">{{ $umLike->user->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
