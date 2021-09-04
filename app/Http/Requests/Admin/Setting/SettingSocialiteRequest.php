<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class SettingSocialiteRequest extends FormRequest
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
            'facebook_status'=>'max:3',
            'facebook_client_id'=>'max:150',
            'facebook_client_secret'=>'max:150',
            'facebook_redirect'=>'max:150',

            'google_status'=>'max:3',
            'google_client_id'=>'max:150',
            'google_client_secret'=>'max:150',
            'google_redirect'=>'max:150',

            'github_status'=>'max:3',
            'github_client_id'=>'max:150',
            'github_client_secret'=>'max:150',
            'github_redirect'=>'max:150',
        ];

    }
    public function messages()
    {
        return [
            'facebook_status.max'=>"Không quá :max ký tự !",
            'facebook_client_id.max'=>"Không quá :max ký tự !",
            'facebook_client_secret.max'=>"Không quá :max ký tự !",
            'facebook_redirect.max'=>"Không quá :max ký tự !",
            'google_status.max'=>"Không quá :max ký tự !",
            'google_client_id.max'=>"Không quá :max ký tự !",
            'google_client_secret.max'=>"Không quá :max ký tự !",
            'google_redirect.max'=>"Không quá :max ký tự !",
            'github_status.max'=>"Không quá :max ký tự !",
            'github_client_id.max'=>"Không quá :max ký tự !",
            'github_client_secret.max'=>"Không quá :max ký tự !",
            'github_redirect.max'=>"Không quá :max ký tự !",

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
