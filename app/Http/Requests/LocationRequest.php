<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class LocationRequest extends FormRequest
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
            'city' => ['required', 'string', 'unique:locations,city', 'max:50'],
            'long' => ['required', 'numeric'],
            'lat' => ['required', 'numeric'],
        ];

        if ($this->method() === 'PUT') {
            $rules = array_merge($rules, [
                'city' => ['sometimes', 'required', 'max:100'],
                'long' => ['sometimes', 'required', 'numeric'],
                'lat' => ['sometimes', 'required', 'numeric'],
            ]);
        }

        return $rules;

    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors(),

            ], Response::HTTP_BAD_REQUEST)
        );

    }
}
