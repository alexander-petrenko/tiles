@extends('layouts.app')

@section('title')
    @parent Товары
@endsection

@section('content')
    <div class="content">
        <span class="alert-success">{{ $message ?? NULL }}</span>
        <div class="row">
            @forelse($products as $product)
                @include('admin.products.product')
            @empty
                <p>No products</p>
            @endforelse
        </div>
    </div>
@endsection