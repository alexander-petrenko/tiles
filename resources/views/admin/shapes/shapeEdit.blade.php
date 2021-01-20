@extends('layouts.app')

@section('title')
    @parent Редактировать форму $shape->name
@endsection

@section('content')
    <div class="content">
        <h1>Редактирование формы {{ $shape->name }}</h1>
        <form method="post" action="{{ route('shapes.update', $shape) }}">
        @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" name="name" value="{{ $shape->name }}" class="form-control" id="name">
                @include('validationError', ['attribute' => 'name'])
            </div>
            <button type="submit" class="btn btn-primary">Изменить</button>
            <span class="alert-success">{{ $message ?? NULL }}</span>
        </form>
    </div>
@endsection