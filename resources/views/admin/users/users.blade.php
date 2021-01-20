@extends('layouts.app')

@section('title')
    @parent Пользователи
@endsection

@section('content')
    <div>
        <span class="alert-success">{{ $message ?? NULL }}</span>
        <div class="row">
            @forelse($users as $user)
                @include('admin.users.user')
            @empty
                <p>No users</p>
            @endforelse
        </div>
    </div>
@endsection