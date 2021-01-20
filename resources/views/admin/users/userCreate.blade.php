@extends('layouts.app')

@section('title')
    @parent Создать пользователя
@endsection

@section('content')
    <div class="content">
        <h1>Создание пользователя</h1>
        <form method="post" action="{{ route('users.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name">
                @include('validationError', ['attribute' => 'name'])
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email">
                @include('validationError', ['attribute' => 'email'])
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" class="form-control" id="password">
                @include('validationError', ['attribute' => 'password'])
            </div>
            <div class="form-group">
                <label for="password_confirm">Подтверждение пароля</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirm">
            </div>
            <div class="form-group">
                <label for="role">Роль</label>
                <div id="role" class="">
                    <input type="radio" name="role" value="0" checked> Обычный пользователь
                    <input type="radio" name="role" value="1"> Админ
                </div>
                @include('validationError', ['attribute' => 'role'])
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
            <span class="alert-success">{{ $message ?? NULL }}</span>
        </form>
    </div>
@endsection