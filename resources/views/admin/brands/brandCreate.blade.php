@extends('layouts.app')

@section('title')
    @parent Создать бренд
@endsection

@section('content')
    <div class="content">
        <h1>Создание бренда</h1>
        <form method="post" action="{{ route('brands.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Наименование</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name">
                @include('validationError', ['attribute' => 'name'])
            </div>
            <div class="form-group">
                <label for="country">Страна</label>
                <input type="text" name="country" value="{{ old('country') }}" class="form-control" id="country">
                @include('validationError', ['attribute' => 'country'])
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