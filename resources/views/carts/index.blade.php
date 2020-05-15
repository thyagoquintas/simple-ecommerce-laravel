@extends('layouts.store')
@section('content')
<h2>Carrinho de compra</h2>
<section class="container py-4">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Remover</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->discountPrice() }}</td>
                <td><a href="{{ route('cart-remove', $product->id) }}" class="btn btn-danger btn-sm">Remover</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="#" class="btn btn-primary btn-lg">Finalizar compra</a>
</section>
@endsection