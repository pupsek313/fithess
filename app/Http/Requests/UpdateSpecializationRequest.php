<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateSpecializationRequest extends StoreSpecializationRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:80',
                Rule::unique('specializations', 'name')->ignore($this->route('specialization')),
            ],
        ]);
    }
}