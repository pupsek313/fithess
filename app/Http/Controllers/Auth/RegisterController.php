<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'required'           => 'Поле «:attribute» обязательно для заполнения.',
            'email'              => 'Введите корректный e-mail.',
            'max'                => 'Поле «:attribute» слишком длинное (не более :max символов).',
            'email.unique'       => 'Пользователь с таким e-mail уже зарегистрирован.',
            'password.confirmed' => 'Пароли не совпадают.',
            'password.min'       => 'Пароль должен быть не короче :min символов.',
        ], [
            'name'     => 'имя',
            'email'    => 'e-mail',
            'password' => 'пароль',
        ]);

        $user = User::create($data);   // пароль захеширует cast 'hashed' в модели User

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')
            ->with('success', 'Добро пожаловать, ' . $user->name);
    }
}