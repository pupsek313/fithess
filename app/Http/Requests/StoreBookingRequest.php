<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone'   => ['required', 'regex:/^\+7\d{10}$/'],
            'comment' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'required'    => 'Поле «:attribute» обязательно для заполнения.',
            'phone.regex' => 'Телефон должен быть в формате +77011234567.',
            'comment.max' => 'Комментарий не должен быть длиннее :max символов.',
        ];
    }

    public function attributes(): array
    {
        return [
            'phone'   => 'телефон',
            'comment' => 'комментарий',
        ];
    }
}