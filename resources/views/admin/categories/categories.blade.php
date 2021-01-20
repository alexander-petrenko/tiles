@extends('layouts.app')

@section('title')
    @parent Категории (назначение)
@endsection

@section('content')
    <div>
        <span class="alert-success">{{ $message ?? NULL }}</span>
        <div class="row">
            @forelse($categories as $category)
                @include('admin.categories.category')
            @empty
                <p>No categories</p>
            @endforelse
        </div>
    </div>
@endsection