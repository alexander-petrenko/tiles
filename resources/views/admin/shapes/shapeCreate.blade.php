@extends('layouts.app')

@section('title')
    @parent Создать форму
@endsection

@section('content')
    <div class="content">
        <h1>Создание формы</h1>
        <form method="post" action="{{ route('shapes.store') }}">
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