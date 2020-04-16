@extends('layouts.app')
@section('content')
<h2>Lista de Produtos</h2>
<div class="d-flex justify-content-end">
    <a href="{{ route('products.create') }}" class="btn btn-success mb-2">Novo Produto</a>
</div>
<ul class="list-group">
    @foreach($products as $product)
    <li class="list-group-item">
        <img src="{{ asset('storage/'.$product->image) }}" width="40" height="40">
        <span>{{$product->name}}</span>
        @if(!$product->trashed())
            <a href="#" class="btn btn-primary btn-sm float-right ml-1">Visualizar</a>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm float-right ml-1">Editar</a>
        @else
            <form action="{{ route('restore-product.update', $product->id) }}" class="d-inline" method="POST" onsubmit="return confirm('Você tem certeza que quer reativar?')">
                @csrf
                @method('PUT')
                <button type="submit" href="#" class="btn btn-primary btn-sm float-right ml-1">Reativar</button>
            </form>
        @endif
        <form action="{{ route('products.destroy', $product->id) }}" class="d-inline" method="POST" onsubmit="return confirm('Você tem certeza que quer apagar?')">
            @csrf
            @method('DELETE')
            <button type="submit" href="#" class="btn btn-danger btn-sm float-right"> {{ $product->trashed() ? 'Remover' : 'Mover para Lixeira' }}</a>
        </form>
    </li>
    @endforeach
</ul>
@endsection