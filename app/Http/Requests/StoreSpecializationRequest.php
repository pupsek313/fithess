<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecializationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'min:2', 'max:80', 'unique:specializations,name'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'required'    => 'Поле «:attribute» обязательно для заполнения.',
            'name.min'    => 'Название должно быть не короче :min символов.',
            'name.max'    => 'Название должно быть не длиннее :max символов.',
            'name.unique' => 'Такая специализация уже есть.',
            'max'         => 'Поле «:attribute» слишком длинное (не более :max символов).',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'        => 'название',
            'description' => 'описание',
        ];
    }
}