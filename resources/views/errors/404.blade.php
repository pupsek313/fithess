@extends('layouts.app')

@section('title', '404 — Страница не найдена')

@section('content')
    <h1 class="big-code">404</h1>
    <x-alert type="error">Такой страницы нет</x-alert>
    <a href="{{ route('home') }}">На главную</a>
@endsection