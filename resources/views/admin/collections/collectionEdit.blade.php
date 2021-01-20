@extends('layouts.app')

@section('title')
    @parent Редактировать коллекцию $collection->name
@endsection

@section('content')
    <div class="content">
        <h1>Редактирование коллекции {{ $collection->name }}</h1>
        <form method="post" action="{{ route('collections.update', $collection) }}" enctype="multipart/form-data">
        @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Наименование</label>
                <input type="text" name="name" value="{{ $collection->name }}" class="form-control" id="name">
                @include('validationError', ['attribute' => 'name'])
            </div>
            <div class="form-group">
                <label for="brand">Бренд</label>
                <div id="brand" class="">
                    @foreach($brands as $brand)
                    <p>
                        <input type="radio" name="brand" value="{{ $brand->id }}" @if($brand->id === $collection->brand_id) checked @endif> {{ $brand->name }}
                    </p>
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'brand'])
            </div>
            <div class="form-group">
                <label for="texture">Текстура (внешний вид)</label>
                <div id="texture" class="">
                    @foreach($textures as $texture)
                    <p>
                        <input type="radio" name="texture" value="{{ $texture->id }}" @if($texture->id === $collection->texture_id) checked @endif> {{ $texture->name }}
                    </p>
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'texture'])
            </div>
            <div class="form-group">
                <label for="file">Изображение</label>
                <p>
                    Текущее изображение
                    <img src="{{ asset('/storage/images/collections/small/' . $collection->url) }}" alt="">
                </p>
                <input type="file" name="image" class="" id="file">
                @include('validationError', ['attribute' => 'image'])
            </div>
            <button type="submit" class="btn btn-primary">Изменить</button>
            <span class="alert-success">{{ $message ?? NULL }}</span>
        </form>
    </div>
@endsection