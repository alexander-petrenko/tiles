@extends('layouts.app')

@section('title')
    @parent Результат поиска
@endsection

@section('content')
    <h2>Результаты поиска по запросу "{{ $term }}"</h2>
    @if(count($products) >= 1)
        <div>
            <h3>Товары</h3>
            <div class="row">
                @foreach($products as $product)
                    @include('admin.products.product')
                @endforeach
            </div>
        </div>
    @endif
    @if(count($collections) >= 1)
        <div>
            <h3>Коллекции</h3>
            <div class="row">
                @foreach($collections as $collection)
                    @include('admin.collections.collection')
                @endforeach
            </div>
        </div>
    @endif
    @if(count($brands) >= 1)
        <div>
            <h3>Бренды</h3>
            <div class="row">
                @foreach($brands as $brand)
                    @include('admin.brands.brand')
                @endforeach
            </div>
        </div>
    @endif
    @if(count($products) < 1 && count($collections) < 1 && count($brands) < 1)
        <p>По вашему запросу ничего не найдено. Попробуйте изменить параметры поиска</p>
    @endif
@endsection