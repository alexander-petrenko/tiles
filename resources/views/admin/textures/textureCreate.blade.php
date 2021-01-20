@extends('layouts.app')

@section('title')
    @parent Создать текстуру
@endsection

@section('content')
    <div class="content">
        <h1>Создание текстуры</h1>
        <form method="post" action="{{ route('textures.store') }}" enctype="multipart/form-data">
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