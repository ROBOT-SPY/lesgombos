<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class WorkerRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255', 'unique:workers,email'],
            'location_id' => ['required', 'integer'],
            'activity_id' => ['required', 'integer'],
        ];

        if ($this->method() === 'PUT') {
            $rules = array_merge($rules, [
                'name' => ['sometimes', 'required', 'string', 'max:255'],
                'lastname' => ['sometimes', 'required', 'string', 'max:255'],
                'contact' => ['sometimes', 'required', 'string', 'max:255'],
                'email' => ['sometimes', 'required', 'string', 'email', 'max:255', 'unique:workers,email'],
                'location_id' => ['sometimes', 'required', 'integer'],
                'activity_id' => ['sometimes', 'required', 'integer'],
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
