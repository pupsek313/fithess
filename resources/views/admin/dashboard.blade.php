@extends('layouts.admin')

@section('title', 'Панель')

@section('content')
    <h1>Панель администратора</h1>
    <ul>
        <li><a href="{{ route('admin.trainers.index') }}">Список тренеров</a></li>
        <li><a href="{{ route('admin.trainers.create') }}">Добавить тренера</a></li>
        <li><a href="{{ route('admin.specializations.index') }}">Список специализаций</a></li>
        <li><a href="{{ route('admin.specializations.create') }}">Добавить специализацию</a></li>
        <li><a href="{{ route('admin.bookings.index') }}">Заявки</a></li>
    </ul>

    <form method="POST" action="{{ route('admin.exports.catalog') }}">
        @csrf
        <button type="submit">Сформировать PDF в фоне</button>
    </form>

    <p><a href="{{ route('home') }}">На сайт</a></p>
@endsection