<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class SubRequest extends FormRequest
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
            'cate_parentID'=>'required',
            'cate_name'=>'required|max:100',
            'cate_des'=>'max:300',
        ];

    }
    public function messages()
    {
        return [
            'cate_parentID.required'=>"Vui lòng chọn danh mục !",
            'cate_name.required'=>"Không được trống !",
            'cate_name.max'=>"Không quá :max ký tự !",
            'cate_des.max'=>"Không quá :max ký tự !",
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
