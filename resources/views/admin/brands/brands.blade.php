@extends('layouts.app')

@section('title')
    @parent - Бренды
@endsection

@section('content')
    <div>
        <span class="alert-success">{{ $message ?? NULL }}</span>
        <div class="row">
            @forelse($brands as $brand)
                @include('admin.brands.brand')
            @empty
                <p>No brands</p>
            @endforelse
        </div>
    </div>
@endsection