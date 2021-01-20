<div class="col-sm-4">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('products.show', $product->slug) }}" class="">
                <img src="{{ asset('/storage/images/products/small/' . $product->url) }}" alt="">
            </a>
            <h5 class="card-title">Артикул: {{ $product->code }}</h5>
            <p>Коллекция: {{ $product->collection->name }}</p>
            <p>Цена: {{ $product->price }}</p>
        </div>
        <div class="addToCart">
            <form action="" method="post" class="form-inline">
                @csrf
                <label for="quantity">Количество</label>
                <input type="number" name="quantity" id="quantity" value="1" class="form-control">
                @include('validationError', ['attribute' => 'quantity'])
                <button type="submit" class="btn btn-success">Добавить в корзину</button>
            </form>
        </div>
        <div class="admin_options">
            <div>
                <a href="{{ route('products.edit', $product->slug) }}" class="btn btn-secondary">Изменить</a>
            </div>
            <div>
                <form action="{{ route('products.destroy', $product) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-secondary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>