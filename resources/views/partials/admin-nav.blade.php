<nav class="menu">
    <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>Панель</a>
    <a href="{{ route('admin.trainers.index') }}" @class(['active' => request()->routeIs('admin.trainers*')])>Тренеры</a>
    <a href="{{ route('admin.specializations.index') }}" @class(['active' => request()->routeIs('admin.specializations*')])>Специализации</a>
    <a href="{{ route('home') }}">На сайт</a>

    <span class="user-info">
        {{ auth()->user()->name }}
        ({{ ['admin' => 'администратор', 'editor' => 'редактор'][auth()->user()->role] ?? auth()->user()->role }})
    </span>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="link">Выйти</button>
    </form>
</nav>