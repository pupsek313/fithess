<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateTrainerRequest extends StoreTrainerRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:120',
                Rule::unique('trainers', 'name')->ignore($this->route('trainer')),
            ],
        ]);
    }
}