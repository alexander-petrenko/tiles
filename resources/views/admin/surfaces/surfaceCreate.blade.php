@extends('layouts.app')

@section('title')
    @parent Создать поверхность
@endsection

@section('content')
    <div class="content">
        <h1>Создание поверхности</h1>
        <form method="post" action="{{ route('surfaces.store') }}">
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