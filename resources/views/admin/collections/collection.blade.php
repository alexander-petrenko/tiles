<div class="col-sm-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $collection->name }}</h5>
            <p>Бренд: {{ $collection->brand->name ?? NULL}}</p>
            <p>Страна: {{ $collection->brand->country ?? NULL}}</p>
            <p>Текстура (внешний вид): {{ $collection->texture->name ?? NULL }}</p>
            <a href="{{ route('collections.show', $collection->slug) }}" class="">
                <img src="{{ asset('/storage/images/collections/small/' . $collection->url) }}" alt="{{ $collection->name }}">
            </a>
        </div>
        <div class="admin_options">
            <div>
                <a href="{{ route('collections.edit', $collection->slug) }}" class="btn btn-secondary">Изменить</a>
            </div>
            <div>
                <form action="{{ route('collections.destroy', $collection) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-secondary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>