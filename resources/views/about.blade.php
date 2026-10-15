@extends('layouts.app')

@section('title', 'О нас')

@section('content')
    <h1>О фитнес-клубе</h1>
    <div class="card">
        <p>{{ $description }}</p>
        <p>Студент: {{ $fio }}</p>
        <p>Группа: {{ $group }}</p>
    </div>
@endsection