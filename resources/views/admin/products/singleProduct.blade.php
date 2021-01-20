@extends('layouts.app')

@section('title')
    @parent Товары
@endsection

@section('content')
    <div class="content">
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{{ asset('/storage/images/products/small/' . $product->url) }}" class="card-img" alt="">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Товар {{ $product->id }}</h5>
                        <p class="card-text">Артикул: {{ $product->code }}</p>
                        <p class="card-text">Цвет: {{ $product->color }}</p>
                        <p class="card-text">Цена: {{ $product->price }}</p>
                        <p class="card-text">Назначение: 
                            @foreach($product->categories as $category)
                                <a href="{{ route('categories.show', $category->slug) }}">
                                    <span>{{ $category->name }}</span>
                                </a>
                            @endforeach
                        </p>
                        <p class="card-text">Коллекция: {{ $product->collection->name ?? NULL}}</p>
                        <p class="card-text">Бренд: {{ $product->collection->brand->name ?? NULL}}</p>
                        <p class="card-text">Страна: {{ $product->collection->brand->country ?? NULL}}</p>
                        <p class="card-text">Форма: {{ $product->shape->name ?? NULL}}</p>
                        <p class="card-text">Материал: {{ $product->material->name ?? NULL}}</p>
                        <p class="card-text">Поверхность: {{ $product->surface->name ?? NULL}}</p>
                        <p class="card-text">Внешний вид: {{ $product->collection->texture->name ?? NULL}}</p>
                        <p class="card-text">Стиль: {{ $product->style->name ?? NULL}}</p>
                        <p class="card-text">Длина: {{ $product->length }}</p>
                        <p class="card-text">Ширина: {{ $product->width }}</p>
                        <p class="card-text">Вес: {{ $product->weight }}</p>
                        <p class="card-text">Кол-во в коробке: {{ $product->in_box }}</p>
                        <p class="card-text">Просмотры: {{ $product->views }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection