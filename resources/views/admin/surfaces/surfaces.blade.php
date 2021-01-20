@extends('layouts.app')

@section('title')
    @parent Поверхности
@endsection

@section('content')
    <div>
        <span class="alert-success">{{ $message ?? NULL }}</span>
        <div class="row">
            @forelse($surfaces as $surface)
                @include('admin.surfaces.surface')
            @empty
                <p>No surfaces</p>
            @endforelse
        </div>
    </div>
@endsection