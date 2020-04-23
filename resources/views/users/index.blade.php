@extends('layouts.app')
@section('content')
<h2>Lista de Usuários</h2>
<ul class="list-group">
    @foreach($users as $user)
        @if($user->id != auth()->user()->id)
            <li class="list-group-item">
                <span>{{$user->name}}</span>
                <span>({{$user->email}})</span>
                <form action="{{ route('users.change-admin', $user->id) }}" class="d-inline" method="POST" onsubmit="return confirm('Você tem certeza que quer atualizar o Admin?')">
                    @csrf
                    @method('PUT')
                    <button type="submit" href="#" class="btn btn-sm float-right ml-1 {{ $user->isAdmin() ? 'btn-danger' : 'btn-primary'}}">
                        {{$user->isAdmin() ? 'Remover Admin' : 'Adicionar Admin'}}
                    </button>
                </form>
            </li>
        @endif
    @endforeach
</ul>
@endsection