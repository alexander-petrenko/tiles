@extends('layouts.app')

@section('title')
    @parent Результат поиска
@endsection

@section('content')
    <div>
        <h2>По внешнему виду</h2>
        <div class="row">
            @forelse($textures as $texture)
                @include('admin.textures.texture')
            @empty
                <p>No textures</p>
            @endforelse
        </div>
    </div>
    <div>
        <h2>По назначению</h2>
        <div class="row">
            @forelse($categories as $category)
                @include('admin.categories.category')
            @empty
                <p>No categories</p>
            @endforelse
        </div>
    </div>
@endsection