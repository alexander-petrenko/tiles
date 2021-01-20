@extends('layouts.app')

@section('title')
    @parent Редактировать бренд $brand->name
@endsection

@section('content')
    <div class="content">
        <h1>Редактирование бренда {{ $brand->name }}</h1>
        <form method="post" action="{{ route('brands.update', $brand) }}" enctype="multipart/form-data">
        @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Наименование</label>
                <input type="text" name="name" value="{{ $brand->name }}" class="form-control" id="name">
                @include('validationError', ['attribute' => 'name'])
            </div>
            <div class="form-group">
                <label for="country">Страна</label>
                <input type="text" name="country" value="{{ $brand->country }}" class="form-control" id="country">
                @include('validationError', ['attribute' => 'country'])
            </div>
            <div class="form-group">
                <label for="file">Изображение</label>
                <p>
                    Текущее изображение
                    <img src="{{ asset('/storage/images/brands/small/' . $brand->url) }}" alt="">
                </p>
                <input type="file" name="image" class="" id="file">
                @include('validationError', ['attribute' => 'image'])
            </div>
            <button type="submit" class="btn btn-primary">Изменить</button>
            <span class="alert-success">{{ $message ?? NULL }}</span>
        </form>
    </div>
@endsection