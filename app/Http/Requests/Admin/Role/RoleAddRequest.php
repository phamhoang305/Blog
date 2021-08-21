<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class RoleAddRequest extends FormRequest
{
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

            'role_name'=>'required|max:30',
            'role_des'=>'required|max:300',
        ];

    }
    public function messages()
    {
        return [

            'role_name.required'=>"Không được trống !",
            'role_name.max'=>"Không quá :max ký tự !",
            'role_des.required'=>"Không được trống !",
            'role_des.max'=>"Không quá :max ký tự !",
        ];
    }
    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ],JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
