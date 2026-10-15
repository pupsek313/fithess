@extends('layouts.app')

@section('title', 'Запись на тренировку')

@section('content')
    <h1>Записаться на тренировку</h1>
    <div class="card">
        <form>
            <p><label>Ваше имя: <input type="text" name="name"></label></p>
            <p><label>Телефон: <input type="tel" name="phone"></label></p>
            <button type="button">Записаться на тренировку</button>
        </form>
    </div>
@endsection