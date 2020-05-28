@extends('layouts.store')
@section('content')
<section class="container py-4">
    <div class="row">
        <div class="mx-auto col-10 text-center">
            <h2 class="text-uppercase">{{ $title }}</h2>
            <p class="text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum, nobis!</p>
        </div>
    </div>
    <div class="row">
        @forelse($products as $product)
            <div class="mx-auto col-sm-10 col-md-6 col-lg-3">
                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid">
                <span class="d-block h6 text-center mt-3">{{ $product->name }}</span>
                <div class="text-center">
                    <span class="text-muted old-price">{{$product->price()}}</span>
                    <span>{{ $product->discountPrice() }}</span>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('show-product', $product->id) }}" class="btn btn-primary btn-sm">Visualizar</a>
                    <a href="#" class="btn btn-secondary btn-sm">Comprar</a>
                </div>
            </div>
        @empty
            <p class="mt-4">Não foi encontrado nenhum produto com o nome <strong>{{ $title }}</strong></p>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $products->appends(['s' => request()->query('s')])->links() }}
    </div>
</section>
@endsection