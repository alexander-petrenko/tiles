@extends('layouts.app')

@section('title')
    @parent Коллекции
@endsection

@section('content')
    <div>
        <span class="alert-success">{{ $message ?? NULL }}</span>
        <div class="row">
            @forelse($collections as $collection)
                @include('admin.collections.collection')
            @empty
                <p>No collections</p>
            @endforelse
        </div>
    </div>
@endsection