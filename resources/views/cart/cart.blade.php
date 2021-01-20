@extends('layouts.app')

@section('title')
    @parent Корзина
@endsection

@section('content')
    <div class="content">
        <h1>Корзина покупок</h1>
        @php
            $cartCost = 0;
        @endphp
        <table class="table table-bordered">
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Стоимость</th>
            </tr>
            @forelse($products as $product)
                @php
                    $productPrice = $product->price;
                    $productQuantity = $product->pivot->quantity;
                    $productCost = $productPrice * $productQuantity;
                    $cartCost = $cartCost + $productCost;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->code }}; {{ $product->collection->name }}</td>
                    <td>{{ $productPrice }}</td>
                    <td>
                        <form action="{{ route('admin.cart.minus', ['id' => $product->id]) }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="fas fa-minus-square"></i>
                            </button>
                        </form>
                        <span class="mx-1">{{ $productQuantity }}</span>
                        <form action="{{ route('admin.cart.plus', ['id' => $product->id]) }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="fas fa-plus-square"></i></div>
                            </button>
                        </form>
                    </td>
                    <td>{{ $productCost }}</td>
                </tr>
            @empty
                <p>Ваша корзина пока пуста</p>
            @endforelse
            <tr>
                <th colspan="4">Итого:</th>
                <th>{{ $cartCost }}</th>
            </tr>
        </table>
    </div>
@endsection