@extends('layouts.app')

@section('title')
    @parent Создать категорию
@endsection

@section('content')
    <div class="content">
        <h1>Создание категории</h1>
        <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Наименование</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name">
                @include('validationError', ['attribute' => 'name'])
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