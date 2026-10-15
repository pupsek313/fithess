@extends('layouts.app')

@section('title', '403 — Доступ запрещён')

@section('content')
    <h1 class="big-code">403</h1>
    <div class="card">
        <p>Доступ запрещён</p>
        <p>{{ $exception->getMessage() }}</p>
        <a href="{{ route('home') }}">На главную</a>
    </div>
@endsection