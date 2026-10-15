@extends('layouts.admin')

@section('title', 'Новый тренер')

@section('content')
    <h1>Добавить тренера</h1>
    <form>
        <p><label>Имя: <input type="text" name="name"></label></p>
        <p><label>Специализация: <input type="text" name="specialty"></label></p>
        <p><label>Стаж: <input type="number" name="experience"></label></p>
        <p><label>Цена: <input type="number" name="price"></label></p>
        <button type="button">Сохранить</button>
    </form>
@endsection