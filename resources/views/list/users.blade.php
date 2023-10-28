@extends('layouts.app')

@section('content')
<html>
    <body>
        <h1>Lista de usuários</h1>
        <hr>
        <ul>
            @foreach ($list as $user)
                <li>
                    <a href="/user/{{ $user->id }}" style="color: #000;">{{ $user->name }}</a>
                    
                    <button type="button" class="btn btn-outline-primary">Seguir</button>

                </li>
            @endforeach
        </ul>
    </body>
</html>
@endsection
