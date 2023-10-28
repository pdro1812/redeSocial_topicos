@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do usuário: {{ $user->name }}</h1>
    <hr>

    <h2>Posts de {{ $user->name }}:</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Publicações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->posts as $umPost)
            
                <tr>
                    <td>{{ $umPost->content }}</td>
                    <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ $umPost->likes->count() }}Likes</button>

                                        <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Likes:</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @foreach ($umPost->likes as $like)
                            <a href="/user/{{ $like->user->id }}" style="color: #000;">{{$like->user->name}}</a><br>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>

                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                    {{ $umPost->comments->count() }}Comentarios</button>

                                            <!-- Modal -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Comentários:</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            @foreach ($umPost->comments as $comments)
                            <a href="/user/{{ $comments->user->id }}" style="color: #000;">{{$comments->user->name}}:</a> {{$comments->content }}<br><br><hr>
                            @endforeach

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



        <h2>Usuários que {{ $user->name }} segue:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->follows as $seguindo)
                    <tr>
                        <td><a href="/user/{{ $seguindo->id }}" style="color: #000;">{{ $seguindo->name }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Usuários que seguem {{ $user->name }}:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->followers as $seguido)
                    <tr>
                        <td><a href="/user/{{ $seguido->id }}" style="color: #000;">{{ $seguido->name }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
