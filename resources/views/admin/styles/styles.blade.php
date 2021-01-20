@extends('layouts.app')

@section('title')
    @parent Стили
@endsection

@section('content')
    <div>
        <span class="alert-success">{{ $message ?? NULL }}</span>
        <div class="row">
            @forelse($styles as $style)
                @include('admin.styles.style')
            @empty
                <p>No styles</p>
            @endforelse
        </div>
    </div>
@endsection