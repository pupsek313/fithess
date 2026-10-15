@extends('layouts.app')

@section('title', '404 — Страница не найдена')

@section('content')
    <h1 class="big-code">404</h1>
    <div class="card">
        <p>Такой страницы нет</p>
        <a href="{{ route('home') }}">На главную</a>
    </div>
@endsection