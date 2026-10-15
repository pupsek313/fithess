@extends('layouts.app')

@section('title', 'Закрыто')

@section('content')
    <h1>Сейчас закрыто</h1>
    <div class="card">
        <p>Сейчас закрыто, работаем с {{ $from }} до {{ $to }}</p>
    </div>
@endsection