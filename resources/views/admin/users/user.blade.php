<div class="col-sm-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Пользователь {{ $user->id }}</h5>
        </div>
        <div class="card-body">
            <p class="">Имя: {{ $user->name }}</p>
        </div>
        <div class="card-body">
            <p class="">Email: {{ $user->email }}</p>
        </div>
        <div class="card-body">
            <p class="">Роль: 
                @if($user->role === 0)
                    Обычный пользователь
                @elseif($user->role === 1)
                    Админ
                @endif
            </p>
        </div>
        <div class="card-body">
            <p class="">Зарегистрирован: {{ $user->created_at }}</p>
        </div>
        <div class="card-body">
            <p class="">Изменен: {{ $user->updated_at }}</p>
        </div>
        <div class="admin_options">
            <div>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-secondary">Изменить</a>
            </div>
            <div>
                <form action="{{ route('users.destroy', $user) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-secondary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>