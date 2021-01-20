@extends('layouts.app')

@section('title')
    @parent Создать товар
@endsection

@section('content')
    <div class="content">
        <h1>Создание товара</h1>
        <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="code">Артикул</label>
                <input type="text" name="code" value="{{ old('code') }}" class="form-control" id="code">
                @include('validationError', ['attribute' => 'code'])
            </div>
            <div class="form-group">
                <label for="price">Цена</label>
                <input type="number" name="price" value="{{ old('price') }}" class="form-control" id="price">
                @include('validationError', ['attribute' => 'price'])
            </div>
            <div class="form-group">
                <label for="category">Категория</label>
                <div id="category" class="">
                    @foreach($categories as $category)
                        <input type="checkbox" name="category[]" value="{{ $category->id }}"> {{ $category->name }}
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'category'])
            </div>
            <div class="form-group">
                <label for="collection">Коллекция</label>
                <div id="collection" class="">
                    @foreach($collections as $collection)
                        <input type="radio" name="collection" value="{{ $collection->id }}"> {{ $collection->name }}
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'collection'])
            </div>
            <div class="form-group">
                <label for="color">Цвет</label>
                <input type="text" name="color" value="{{ old('color') }}" class="form-control" id="color">
                @include('validationError', ['attribute' => 'color'])
            </div>
            <div class="form-group">
                <label for="shape">Форма</label>
                <div id="shape" class="">
                    @foreach($shapes as $shape)
                        <input type="radio" name="shape" value="{{ $shape->id }}"> {{ $shape->name }}
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'shape'])
            </div>
            <div class="form-group">
                <label for="material">Материал</label>
                <div id="material" class="">
                    @foreach($materials as $material)
                        <input type="radio" name="material" value="{{ $material->id }}"> {{ $material->name }}
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'material'])
            </div>
            <div class="form-group">
                <label for="surface">Поверхность</label>
                <div id="surface" class="">
                    @foreach($surfaces as $surface)
                        <input type="radio" name="surface" value="{{ $surface->id }}"> {{ $surface->name }}
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'surface'])
            </div>
            <div class="form-group">
                <label for="style">Стиль</label>
                <div id="style" class="">
                    @foreach($styles as $style)
                        <input type="radio" name="style" value="{{ $style->id }}"> {{ $style->name }}
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'style'])
            </div>
            <div class="form-group">
                <label for="length">Длина</label>
                <input type="number" name="length" value="{{ old('length') }}" class="form-control" id="length">
                @include('validationError', ['attribute' => 'length'])
            </div>
            <div class="form-group">
                <label for="width">Ширина</label>
                <input type="number" name="width" value="{{ old('width') }}" class="form-control" id="width">
                @include('validationError', ['attribute' => 'width'])
            </div>
            <div class="form-group">
                <label for="weight">Масса 1 плитки</label>
                <input type="number" name="weight" value="{{ old('weight') }}" class="form-control" id="weight">
                @include('validationError', ['attribute' => 'weight'])
            </div>
            <div class="form-group">
                <label for="in_box">Штук в упаковке</label>
                <input type="number" name="in_box" value="{{ old('in_box') }}" class="form-control" id="in_box">
                @include('validationError', ['attribute' => 'in_box'])
            </div>
            <div class="form-group">
                <label for="views">Количество просмотров</label>
                <input type="number" name="views" value="{{ old('views') }}" class="form-control" id="views">
                @include('validationError', ['attribute' => 'views'])
            </div>
            <div class="form-group">
                <label for="file">Изображение</label>
                <input type="file" name="image" class="" id="file">
                @include('validationError', ['attribute' => 'image'])
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
            <span class="alert-success">{{ $message ?? NULL }}</span>
        </form>
    </div>
@endsection