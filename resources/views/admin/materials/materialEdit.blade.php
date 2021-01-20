@extends('layouts.app')

@section('title')
    @parent Редактировать материал $material->name
@endsection

@section('content')
    <div class="content">
        <h1>Редактирование материала {{ $material->name }}</h1>
        <form method="post" action="{{ route('materials.update', $material) }}">
        @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" name="name" value="{{ $material->name }}" class="form-control" id="name">
                @include('validationError', ['attribute' => 'name'])
            </div>
            <button type="submit" class="btn btn-primary">Изменить</button>
            <span class="alert-success">{{ $message ?? NULL }}</span>
        </form>
    </div>
@endsection