<?php

namespace App\Http\Requests\Breed;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreBreedRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:40',
            'description' => 'required|string|max:255',
            'age' => 'required|integer',
            'state' => [
                'required', 'string', Rule::in(['Available', 'Adopted', 'In progress'])
            ],
            'image' => 'required|image|mimes:png,jpg,gif,svg,jpeg|max:2048',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = [
            'status' => 'failure',
            'status_code' => 400,
            'message' => 'Bad Request',
            'errors' => $validator->errors(),
        ];

        throw new HttpResponseException(
            response()->json($response, 400)
        );
    }
}
