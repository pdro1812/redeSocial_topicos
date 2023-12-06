@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Adicione o link para o arquivo CSS do Bootstrap, se ainda não estiver incluído -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Usuários</h1>
        <hr>

        <div class="row">
            @foreach ($list as $user)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/user/{{ $user->id }}" style="color: #333;">{{ $user->name }}</a>
                            </h5>

                            <p class="card-text">
                                <strong>Email:</strong> {{ $user->email }}
                            </p>

                           

                            <div class="text-center">
                                @if(!$usuarioAutenticado->follows->contains($user))
                                    <a href="/follow/{{$user->id}}" class="btn btn-primary">Seguir</a>
                                @else
                                    <a href="/unfollow/{{$user->id}}" class="btn btn-danger">Unfollow</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-md-12 text-center mt-3">
            {{ $list->links() }}
        </div>
    </div>
</body>
</html>
@endsection
