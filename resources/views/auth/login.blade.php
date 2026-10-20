@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <h1>Вход</h1>

    <form method="POST" action="{{ route('login') }}" class="form auth-box">
        @csrf

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

        <label class="check">
            <input type="checkbox" name="remember" value="1" @checked(old('remember'))>
            Запомнить меня
        </label>

        <div class="form-actions">
            <button type="submit">Войти</button>
            <a href="{{ route('register') }}">Регистрация</a>
        </div>
    </form>
@endsection