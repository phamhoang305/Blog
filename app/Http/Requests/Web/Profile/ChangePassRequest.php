<?php

namespace App\Http\Requests\Web\Profile;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class ChangePassRequest extends FormRequest
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
            'old_password'=>'required',
            'new_password'=>'required|min:6|max:30',
            're_password'=>'required|min:6|max:30|same:new_password',
        ];

    }
    public function messages()
    {
        return [
            'old_password.required'=>"Không được trống !",
            'new_password.required'=>"Không được trống !",
            'new_password.min'=>"Phải lớn hơn :min ký tự !",
            'new_password.max'=>"Không quá :max ký tự !",
            're_password.required'=>"Không được trống !",
            're_password.max'=>"Không quá :max ký tự !",
            're_password.same'=>"Nhập lại mật khẩu không khớp !",
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
