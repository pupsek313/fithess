@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
    <h1>Контакты фитнес-клуба</h1>
    <div class="card">
        <p>Адрес: {{ $address }}</p>
        <p>Телефон: {{ $phone }}</p>
        <p>E-mail: {{ $email }}</p>
    </div>
@endsection