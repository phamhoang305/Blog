<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class SettingMailRequest extends FormRequest
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
            'MAIL_DRIVER'=>'max:150',
            'MAIL_HOST'=>'max:150',
            'MAIL_PORT'=>'max:150',
            'MAIL_FROM_ADDRESS'=>'max:150',
            'MAIL_FROM_NAME'=>'max:150',
            'MAIL_ENCRYPTION'=>'max:150',
            'MAIL_USERNAME'=>'max:150',
            'MAIL_PASSWORD'=>'max:150',
            'MAIL_RECEIVE'=>'max:150'
        ];

    }
    public function messages()
    {
        return [
            'MAIL_DRIVER.max'=>"Không quá :max ký tự !",
            'MAIL_HOST.max'=>"Không quá :max ký tự !",
            'MAIL_PORT.max'=>"Không quá :max ký tự !",
            'MAIL_FROM_ADDRESS.max'=>"Không quá :max ký tự !",
            'MAIL_FROM_NAME.max'=>"Không quá :max ký tự !",
            'MAIL_ENCRYPTION.max'=>"Không quá :max ký tự !",
            'MAIL_USERNAME.max'=>"Không quá :max ký tự !",
            'MAIL_PASSWORD.max'=>"Không quá :max ký tự !",
            'MAIL_RECEIVE.max'=>"Không quá :max ký tự !",
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
