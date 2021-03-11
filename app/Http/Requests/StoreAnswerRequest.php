<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreAnswerRequest extends FormRequest
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
            "answer"   => 'required|min:5|max:120',
            'comment_id'   => 'exists:App\Models\Comment,id'
        ];
    }
}
