@extends('layouts.app')

@section('title')
    @parent Редактировать товар $product->code
@endsection

@section('content')
    <div class="content">
        <h1>Редактирование товара {{ $product->code }}</h1>
        <form method="post" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @method('PUT')
            @csrf
            <div class="form-group">
                <label for="code">Артикул</label>
                <input type="text" name="code" value="{{ $product->code }}" class="form-control" id="code">
                @include('validationError', ['attribute' => 'code'])
            </div>
            <div class="form-group">
                <label for="price">Цена</label>
                <input type="number" name="price" value="{{ $product->price }}" class="form-control" id="price">
                @include('validationError', ['attribute' => 'price'])
            </div>
            <div class="form-group">
                <label for="category">Категория</label>
                <div id="category" class="">
                    @foreach($categories as $category)
                        <input type="checkbox" name="category[]" value="{{ $category->id }}" 
                            @foreach($product->categories as $productCategory)
                                @if($productCategory->id === $category->id)
                                    checked
                                @endif
                            @endforeach
                        > {{ $category->name }}
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'category'])
            </div>
            <div class="form-group">
                <label for="collection">Коллекция</label>
                <div id="collection" class="">
                    @foreach($collections as $collection)
                        <input type="radio" name="collection" value="{{ $collection->id }}" @if($collection->id === $product->collection_id) checked @endif> {{ $collection->name }}
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'collection'])
            </div>
            <div class="form-group">
                <label for="color">Цвет</label>
                <input type="text" name="color" value="{{ $product->color }}" class="form-control" id="color">
                @include('validationError', ['attribute' => 'color'])
            </div>
            <div class="form-group">
                <label for="shape">Форма</label>
                <div id="shape" class="">
                    @foreach($shapes as $shape)
                        <input type="radio" name="shape" value="{{ $shape->id }}" @if($shape->id === $product->shape_id) checked @endif> {{ $shape->name }}
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'shape'])
            </div>
            <div class="form-group">
                <label for="material">Материал</label>
                <div id="material" class="">
                    @foreach($materials as $material)
                        <input type="radio" name="material" value="{{ $material->id }}" @if($material->id === $product->material_id) checked @endif> {{ $material->name }}
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'material'])
            </div>
            <div class="form-group">
                <label for="surface">Поверхность</label>
                <div id="surface" class="">
                    @foreach($surfaces as $surface)
                        <input type="radio" name="surface" value="{{ $surface->id }}" @if($surface->id === $product->surface_id) checked @endif> {{ $surface->name }}
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'surface'])
            </div>
            <div class="form-group">
                <label for="style">Стиль</label>
                <div id="style" class="">
                    @foreach($styles as $style)
                        <input type="radio" name="style" value="{{ $style->id }}" @if($style->id === $product->style_id) checked @endif> {{ $style->name }}
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'style'])
            </div>
            <div class="form-group">
                <label for="length">Длина</label>
                <input type="number" name="length" value="{{ $product->length }}" class="form-control" id="length">
                @include('validationError', ['attribute' => 'length'])
            </div>
            <div class="form-group">
                <label for="width">Ширина</label>
                <input type="number" name="width" value="{{ $product->width }}" class="form-control" id="width">
                @include('validationError', ['attribute' => 'width'])
            </div>
            <div class="form-group">
                <label for="weight">Масса 1 плитки</label>
                <input type="number" name="weight" value="{{ $product->weight }}" class="form-control" id="weight">
                @include('validationError', ['attribute' => 'weight'])
            </div>
            <div class="form-group">
                <label for="in_box">Штук в упаковке</label>
                <input type="number" name="in_box" value="{{ $product->in_box }}" class="form-control" id="in_box">
                @include('validationError', ['attribute' => 'in_box'])
            </div>
            <div class="form-group">
                <label for="views">Количество просмотров</label>
                <input type="number" name="views" value="{{ $product->views }}" class="form-control" id="views">
                @include('validationError', ['attribute' => 'views'])
            </div>
            <div class="form-group">
                <label for="file">Изображение</label>
                <p>
                    Текущее изображение
                    <img src="{{ asset('/storage/images/products/small/' . $product->url) }}" alt="">
                </p>
                <input type="file" name="image" class="" id="file">
                @include('validationError', ['attribute' => 'image'])
            </div>
            <button type="submit" class="btn btn-primary">Изменить</button>
            <span class="alert-success">{{ $message ?? NULL }}</span>
        </form>
    </div>
@endsection