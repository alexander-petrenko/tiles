<div class="col-sm-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $surface->name }}</h5>
        </div>
        <div class="admin_options">
            <div>
                <a href="{{ route('surfaces.edit', $surface->slug) }}" class="btn btn-secondary">Изменить</a>
            </div>
            <div>
                <form action="{{ route('surfaces.destroy', $surface) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-secondary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>