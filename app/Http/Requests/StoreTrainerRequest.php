<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    // снятый checkbox браузер не отправляет, превращаем его в false
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        return [
            'specialization_id' => ['required', 'integer', 'exists:specializations,id'],
            'name'              => ['required', 'string', 'min:3', 'max:120', 'unique:trainers,name'],
            'phone'             => ['nullable', 'string', 'regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/'],
            'bio'               => ['nullable', 'string', 'max:2000'],
            'experience'        => ['required', 'integer', 'between:0,60'],
            'price'             => ['required', 'numeric', 'between:1000,1000000'],
            'is_active'         => ['boolean'],
            'photo'             => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_photo'      => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'required'                 => 'Поле «:attribute» обязательно для заполнения.',
            'integer'                  => 'В поле «:attribute» нужно целое число.',
            'numeric'                  => 'В поле «:attribute» нужно число.',
            'name.min'                 => 'Имя должно быть не короче :min символов.',
            'name.max'                 => 'Имя должно быть не длиннее :max символов.',
            'name.unique'              => 'Тренер с таким именем уже есть.',
            'specialization_id.exists' => 'Выбранной специализации не существует.',
            'phone.regex'              => 'Телефон должен быть в формате +7 (700) 123-45-67.',
            'experience.between'       => 'Стаж должен быть от :min до :max лет.',
            'price.between'            => 'Цена должна быть от :min до :max тг.',
            'photo.image'       => 'Файл должен быть изображением.',
            'photo.mimes'       => 'Допустимые форматы: jpg, jpeg, png, webp.',
            'photo.max'         => 'Размер файла не должен превышать 2 МБ.',
            'photo.uploaded'    => 'Не удалось загрузить файл (возможно, он больше 2 МБ).',
        ];
    }

    public function attributes(): array
    {
        return [
            'specialization_id' => 'специализация',
            'name'              => 'имя',
            'phone'             => 'телефон',
            'bio'               => 'о тренере',
            'experience'        => 'стаж',
            'price'             => 'цена',
            'is_active'         => 'активность',
            'photo'             => 'фото',
        ];
    }
}