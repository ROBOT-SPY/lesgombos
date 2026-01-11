<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            //
            'city' => ['name', 'string', 'unique:activities,city', 'max:50'],

        ];

        if ($this->method() === 'PUT') {
            $rules = array_merge($rules, [
                'name' => ['sometimes', 'required', 'max:100', 'unique:activities,name'],

            ]);
        }

        return $rules;
    }
}
