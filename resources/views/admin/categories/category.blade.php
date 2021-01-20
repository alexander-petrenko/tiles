<div class="col-sm-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $category->name }}</h5>
            <a href="{{ route('categories.show', $category->slug) }}" class="">
                <img src="{{ asset('/storage/images/categories/small/' . $category->url) }}" alt="{{ $category->name }}">
            </a>
        </div>
        <div class="admin_options">
            <div>
                <a href="{{ route('categories.edit', $category->slug) }}" class="btn btn-secondary">Изменить</a>
            </div>
            <div>
                <form action="{{ route('categories.destroy', $category) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-secondary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>