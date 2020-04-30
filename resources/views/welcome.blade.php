@extends('layouts.store')
@section('css')
<style>
.banner {
    min-height: 400px;
    background: url('http://via.placeholder.com/1100x400');
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}

.old-price {
    text-decoration: line-through;
}
</style>
@endsection
@section('content')
    <section class="banner d-flex align-items-center px-4">
        <div>
            <span class="h2 d-block m-0 text-capitalize">Toda nossa loja está</span>
            <span class="h1 d-block mb-3 text-uppercase font-weight-bold">em promoção</span>
            <a href="#" class="btn btn-primary">Veja nossos produtos</a>
        </div>
    </section>
    <section class="container py-5">
        <div class="row">
            <div class="mx-auto col-10 text-center">
                <h2 class="text-uppercase">Nossos Produtos</h2>
                <p class="text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, ducimus.</p>
            </div>
            <div class="row">
            @foreach($products as $product)
                <div class="mx-auto col-sm-10 col-md-6 col-lg-3">
                    <div class="mb-3">
                        <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid">
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-primary btn-sm">Visualizar</a>
                            <a href="#" class="btn btn-secondary btn-sm">Compar</a>
                        </div>
                        <span class="d-block h6 text-center mt-4">{{$product->name}}</span>
                        <div class="text-center">
                            <span class="text-muted old-price">{{$product->fPrice()}}</span>
                            <span class="">{{$product->fDiscountPrice()}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
@endsection