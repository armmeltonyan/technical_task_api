<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    { 
        throw new HttpResponseException(
          response()->json([
            'status' => false,
            'messages' => $validator->errors()->all()
          ], 422)
        ); 
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required|min:3',
            "email" => 'unique:users,email|required|email',
            'age' => 'required|integer',
            'password' => 'required|min:6'
        ];
    }
}
