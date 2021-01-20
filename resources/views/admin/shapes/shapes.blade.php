@extends('layouts.app')

@section('title')
    @parent Формы
@endsection

@section('content')
    <div>
        <span class="alert-success">{{ $message ?? NULL }}</span>
        <div class="row">
            @forelse($shapes as $shape)
                @include('admin.shapes.shape')
            @empty
                <p>No shapes</p>
            @endforelse
        </div>
    </div>
@endsection