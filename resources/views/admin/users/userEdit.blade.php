@extends('layouts.app')

@section('title')
    @parent Редактировать пользователя
@endsection

@section('content')
    <div class="content">
        <h1>Редактирование пользователя</h1>
        <form method="post" action="{{ route('users.update', $user) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name">
                @include('validationError', ['attribute' => 'name'])
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email">
                @include('validationError', ['attribute' => 'email'])
            </div>
            <div class="form-group">
                <label for="role">Роль</label>
                <div id="role" class="">
                    <input type="radio" name="role" value="0" @if($user->role === 0) checked @endif> Обычный пользователь
                    <input type="radio" name="role" value="1" @if($user->role === 1) checked @endif> Админ
                </div>
                @include('validationError', ['attribute' => 'role'])
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <span class="alert-success">{{ $message ?? NULL }}</span>
        </form>
    </div>
@endsection