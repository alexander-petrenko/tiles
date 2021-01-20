@extends('layouts.app')

@section('title')
    @parent Редактировать категорию $category->name
@endsection

@section('content')
    <div class="content">
        <h1>Редактирование категории {{ $category->name }}</h1>
        <form method="post" action="{{ route('categories.update', $category) }}" enctype="multipart/form-data">
        @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Наименование</label>
                <input type="text" name="name" value="{{ $category->name }}" class="form-control" id="name">
                @include('validationError', ['attribute' => 'name'])
            </div>
            <div class="form-group">
                <label for="file">Изображение</label>
                <p>
                    Текущее изображение
                    <img src="{{ asset('/storage/images/categories/small/' . $category->url) }}" alt="">
                </p>
                <input type="file" name="image" class="" id="file">
                @include('validationError', ['attribute' => 'image'])
            </div>
            <button type="submit" class="btn btn-primary">Изменить</button>
            <span class="alert-success">{{ $message ?? NULL }}</span>
        </form>
    </div>
@endsection