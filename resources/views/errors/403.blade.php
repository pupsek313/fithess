@extends('layouts.app')

@section('title', '403 — Доступ запрещён')

@section('content')
    <h1 class="big-code">403</h1>
    <x-alert type="warning">Доступ запрещён. У вас нет прав для этой страницы.</x-alert>
    <a href="{{ route('home') }}">На главную</a>
@endsection