<nav class="menu">
    <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Главная</a>
    <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>О нас</a>
    <a href="{{ route('contacts') }}" @class(['active' => request()->routeIs('contacts')])>Контакты</a>
    <a href="{{ route('trainers.index') }}" @class(['active' => request()->routeIs('trainers.*')])>Тренеры</a>
    <a href="{{ route('rules') }}" @class(['active' => request()->routeIs('rules')])>Правила</a>
    <a href="{{ route('booking') }}" @class(['active' => request()->routeIs('booking')])>Записаться на тренировку</a>

    @guest
        <a href="{{ route('login') }}" @class(['active' => request()->routeIs('login')])>Вход</a>
        <a href="{{ route('register') }}" @class(['active' => request()->routeIs('register')])>Регистрация</a>
    @endguest

    @auth
        @can('admin-panel')
            <a href="{{ route('admin.dashboard') }}">Админ-панель</a>
        @endcan

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="link">Выйти ({{ auth()->user()->name }})</button>
        </form>
    @endauth
</nav>