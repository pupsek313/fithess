@extends('layouts.admin')

@section('title', 'Панель')

@section('content')
    <h1>Панель администратора</h1>
    <ul>
        <li><a href="{{ route('admin.trainers') }}">Список тренеров</a></li>
        <li><a href="{{ route('admin.trainers.create') }}">Добавить тренера</a></li>
    </ul>
    <a href="{{ route('home') }}">На сайт</a>
@endsection