<nav class="menu">
    <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>Панель</a>
    <a href="{{ route('admin.trainers.index') }}" @class(['active' => request()->routeIs('admin.trainers*')])>Тренеры</a>
    <a href="{{ route('admin.specializations.index') }}" @class(['active' => request()->routeIs('admin.specializations*')])>Специализации</a>
    <a href="{{ route('admin.logout') }}">Выход</a>
</nav>