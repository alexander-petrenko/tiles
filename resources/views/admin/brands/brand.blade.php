<div class="col-sm-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $brand->name }}</h5>
            <p>Страна: {{ $brand->country }}</p>
            <a href="{{ route('brands.show', $brand->slug) }}" class="">
                <img src="{{ asset('/storage/images/brands/small/' . $brand->url) }}" alt="{{ $brand->name }}">
            </a>
        </div>
        <div class="admin_options">
            <div>
                <a href="{{ route('brands.edit', $brand->slug) }}" class="btn btn-secondary">Изменить</a>
            </div>
            <div>
                <form action="{{ route('brands.destroy', $brand) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-secondary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>