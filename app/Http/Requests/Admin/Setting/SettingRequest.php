<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class SettingRequest extends FormRequest
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

            'title'=>'required|max:150',
            'name'=>'required|max:150',
            'route_admin'=>'required|max:150',
            'route_login'=>'required|max:150',
            'contact_mail'=>'max:150',
            'contact_phone'=>'max:15',
            'contact_address'=>'max:150',
            'iframe_map'=>'max:1000',

        ];

    }
    public function messages()
    {
        return [

            'title.required'=>"Không được trống !",
            'title.max'=>"Không quá :max ký tự !",
            'name.required'=>"Không được trống !",
            'name.max'=>"Không quá :max ký tự !",

            'route_admin.required'=>"Không được trống !",
            'route_admin.max'=>"Không quá :max ký tự !",
            'route_login.required'=>"Không được trống !",
            'route_login.max'=>"Không quá :max ký tự !",

            'contact_mail.max'=>"Không quá :max ký tự !",
            'contact_phone.max'=>"Không quá :max ký tự !",
            'contact_address.max'=>"Không quá :max ký tự !",
            'iframe_map.max'=>"Không quá :max ký tự !",



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
