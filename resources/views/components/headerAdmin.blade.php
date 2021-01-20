<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('adminHome') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Админские штучки <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('products.index') }}">
                            Товары
                        </a>
                        <a class="dropdown-item" href="{{ route('collections.index') }}">
                            Коллекции
                        </a>
                        <a class="dropdown-item" href="{{ route('brands.index') }}">
                            Бренды
                        </a>
                        <a class="dropdown-item" href="{{ route('categories.index') }}">
                            Категории (назначение)
                        </a>
                        <a class="dropdown-item" href="{{ route('textures.index') }}">
                            Текстуры (внешний вид)
                        </a>
                        <a class="dropdown-item" href="{{ route('materials.index') }}">
                            Материалы
                        </a>
                        <a class="dropdown-item" href="{{ route('styles.index') }}">
                            Стили
                        </a>
                        <a class="dropdown-item" href="{{ route('surfaces.index') }}">
                            Поверхности
                        </a>
                        <a class="dropdown-item" href="{{ route('shapes.index') }}">
                            Формы
                        </a>
                        <a class="dropdown-item" href="{{ route('users.index') }}">
                            Пользователи
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="">Корзина</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="" method="GET" class="form-inline my-2 my-lg-0">
                        @csrf
                        <input name="q" value="{{ old('q') }}" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>