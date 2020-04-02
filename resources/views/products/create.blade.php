@extends('layouts.app')
@section('content')
<h2>Cria Categorias</h2>
<form action="{{ route('products.store') }}" class="bg-white p-3" method="POST">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-group">
                @foreach($errors->all() as $error)
                    <li class="list-group-item text-danger">{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @csrf
    <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" name="name" placeholder="Digite o nome do produto">
    </div>
    <div class="form-group">
        <label for="name">Descrição:</label>
        <textarea class="form-control" name="description" placeholder="Digite a descrição do produto"></textarea>
    </div>
    <div class="form-group">
        <label for="name">Preço:</label>
        <input type="number" class="form-control" name="price">
    </div>
    <div class="form-group">
        <label for="name">Desconto:</label>
        <input type="number" class="form-control" name="discount" value="0">
    </div>
    <div class="form-group">
        <label for="name">Número de produtos em estoque:</label>
        <input type="number" class="form-control" name="stock" value="0">
    </div>
    <div class="form-group" style="display:none">
        <label for="name">Imagem:</label>
        <input type="text" class="form-control" name="image" value="null">
    </div>
    <button type="submit" class="btn btn-success">Criar produto</button>
</form>
@endsection