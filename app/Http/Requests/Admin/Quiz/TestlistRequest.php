<?php

namespace App\Http\Requests\Admin\Quiz;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class TestlistRequest extends FormRequest
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
            'testlist_name'=>'required|max:300',
            'testlist_des'=>'max:300',
            'testlist_order'=>'max:3',
        ];

    }
    public function messages()
    {
        return [
            'testlist_name.required'=>"Vui lòng tên danh mục !",
            'testlist_name.required'=>"Không được trống !",
            'testlist_name.max'=>"Không quá :max ký tự !",
            'testlist_des.max'=>"Không quá :max ký tự !",
            'testlist_order.max'=>"Không quá :max ký tự !",
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
