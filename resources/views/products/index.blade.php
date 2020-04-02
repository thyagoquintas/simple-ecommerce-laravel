@extends('layouts.app')
@section('content')
<h2>Lista de Produtos</h2>
<div class="d-flex justify-content-end">
    <a href="{{ route('products.create') }}" class="btn btn-success mb-2">Novo Produto</a>
</div>
<ul class="list-group">
    @foreach($products as $product)
    <li class="list-group-item">
        <span>{{$product->name}}</span>
        <a href="#" class="btn btn-primary btn-sm float-right ml-1">Visualizar</a>
        <a href="#" class="btn btn-warning btn-sm float-right ml-1">Editar</a>
        <a href="#" class="btn btn-danger btn-sm float-right">Apagar</a>
    </li>
    @endforeach
</ul>
@endsection