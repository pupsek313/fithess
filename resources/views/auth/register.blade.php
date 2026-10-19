@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <h1>Регистрация</h1>

    @if ($errors->any())
        <x-alert type="error">Исправьте ошибки в форме ({{ $errors->count() }})</x-alert>
    @endif

    <form method="POST" action="{{ route('register') }}" class="form auth-box">
        @csrf

        <label>Имя
            <input type="text" name="name" value="{{ old('name') }}"
                   @class(['invalid' => $errors->has('name')])>
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </label>

        <label>E-mail
            <input type="email" name="email" value="{{ old('email') }}"
                   @class(['invalid' => $errors->has('email')])>
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </label>

        <label>Пароль
            <input type="password" name="password"
                   @class(['invalid' => $errors->has('password')])>
            @error('password') <div class="error">{{ $message }}</div> @enderror
        </label>

        <label>Повтор пароля
            <input type="password" name="password_confirmation">
        </label>

        <div class="form-actions">
            <button type="submit">Зарегистрироваться</button>
            <a href="{{ route('login') }}">Уже есть аккаунт?</a>
        </div>
    </form>
@endsection