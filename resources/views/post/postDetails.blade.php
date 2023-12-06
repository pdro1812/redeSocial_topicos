@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card mt-4">
                <div class="card-header bg-info text-white">
                    <h1 class="mb-0">Detalhes do Post</h1>
                </div>
                <div class="card-body">
                    <h2>Post de {{ $post->user->name }}</h2>

                    <div class="mb-4">
                        <h5 class="mb-0">Conteúdo:</h5>
                        <p>{{ $post->content }}</p>
                    </div>

                    @if($post->photos->count() > 0)
                        <div class="card">
                            <img src="/storage/image/{{$post->photos[0]->image_path}}" class="card-img-top" alt="Imagem do post">
                            <div class="card-body">
                                <!-- Outros conteúdos do card, se necessário -->
                            </div>
                        </div>
                    @endif

                    <div class="mt-4">
                        @if(!$post->likes->contains('user_id', $usuarioLogado->id)) 
                            <a href="/like/{{$post->id}}" class="btn btn-success">Curtir</a>
                        @else
                            <a href="/dislike/{{$post->id}}" class="btn btn-danger">Descurtir</a>
                        @endif
                    </div>

                    <div class="mt-4">
                        <h5>Comentários:</h5>
                        <form action="/comment" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <textarea class="form-control" name="content" rows="3" placeholder="Adicione um comentário"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Adicionar Comentário</button>
                        </form>
                    </div>

                    <div class="mt-3">
                        <p><strong>Total de Comentários:</strong> <span class="badge rounded-pill bg-primary">{{ $post->comments->count() }}</span></p>
                    </div>

                    <ul class="list-group mt-3">
                        @foreach($post->comments as $umComment)
                            <li class="list-group-item">
                                <a href="/user/{{ $umComment->user->id }}" style="color: #333;">{{ $umComment->user->name }}</a>
                                {{ $umComment->content }} 
                                <small class="text-muted">
                                    {{\Carbon\Carbon::parse($umComment->created_at)->format('d/m/Y h:m')}}
                                </small>
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-3">
                        <p><strong>Total de Likes:</strong> <span class="badge rounded-pill bg-primary">{{ $post->likes->count() }}</span></p>
                        <ul class="list-group">
                            @foreach($post->likes as $umLike)
                                <li class="list-group-item">
                                    <a href="/user/{{ $umLike->user->id }}" style="color: #333;">{{ $umLike->user->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
