@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($products as $product)
            @component('components.product', [
                'image' => asset('products_images/' . $product->image),
                'title' => $product->name,
                'price' => number_format($product->price),
                'supplierName' => $product->supplier->name,
                'supplierLink' => '/'
            ])
            @endcomponent
        @endforeach
    </div>
    <div class="row">
        <div class="katalog-paging">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
