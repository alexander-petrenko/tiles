@extends('layouts.app')

@section('title')
    @parent Материалы
@endsection

@section('content')
    <div>
        <span class="alert-success">{{ $message ?? NULL }}</span>
        <div class="row">
            @forelse($materials as $material)
                @include('admin.materials.material')
            @empty
                <p>No materials</p>
            @endforelse
        </div>
    </div>
@endsection