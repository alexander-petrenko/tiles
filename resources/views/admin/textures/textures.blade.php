@extends('layouts.app')

@section('title')
    @parent Текстуры (внешний вид)
@endsection

@section('content')
    <div>
        <span class="alert-success">{{ $message ?? NULL }}</span>
        <div class="row">
            @forelse($textures as $texture)
                @include('admin.textures.texture')
            @empty
                <p>No textures</p>
            @endforelse
        </div>
    </div>
@endsection