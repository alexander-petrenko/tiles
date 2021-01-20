<div class="col-sm-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $texture->name }}</h5>
            <a href="{{ route('textures.show', $texture->slug) }}" class="">
                <img src="{{ asset('/storage/images/textures/small/' . $texture->url) }}" alt="{{ $texture->name }}">
            </a>
        </div>
        <div class="admin_options">
            <div>
                <a href="{{ route('textures.edit', $texture->slug) }}" class="btn btn-secondary">Изменить</a>
            </div>
            <div>
                <form action="{{ route('textures.destroy', $texture) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-secondary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>