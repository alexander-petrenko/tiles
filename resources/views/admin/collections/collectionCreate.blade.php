@extends('layouts.app')

@section('title')
    @parent Создать коллекцию
@endsection

@section('content')
    <div class="content">
        <h1>Создание коллекции</h1>
        <form method="post" action="{{ route('collections.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Наименование</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name">
                @include('validationError', ['attribute' => 'name'])
            </div>
            <div class="form-group">
                <label for="brand">Бренд</label>
                <div id="brand" class="">
                    @foreach($brands as $brand)
                    <p>
                        <input type="radio" name="brand" value="{{ $brand->id }}"> {{ $brand->name }}
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
                        <input type="radio" name="texture" value="{{ $texture->id }}"> {{ $texture->name }}
                    </p>
                    @endforeach
                </div>
                @include('validationError', ['attribute' => 'texture'])
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