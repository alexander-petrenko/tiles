@extends('layouts.app')

@section('title')
    @parent Создать материал
@endsection

@section('content')
    <div class="content">
        <h1>Создание материала</h1>
        <form method="post" action="{{ route('materials.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name">
                @include('validationError', ['attribute' => 'name'])
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
            <span class="alert-success">{{ $message ?? NULL }}</span>
        </form>
    </div>
@endsection