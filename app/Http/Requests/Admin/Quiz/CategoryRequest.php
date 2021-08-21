<?php

namespace App\Http\Requests\Admin\Quiz;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class CategoryRequest extends FormRequest
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
            'name'=>'required|max:150',
            'des'=>'max:300',
            'order'=>'max:3',
        ];

    }
    public function messages()
    {
        return [
            'name.required'=>"Vui lòng tên danh mục !",
            'name.required'=>"Không được trống !",
            'name.max'=>"Không quá :max ký tự !",
            'des.max'=>"Không quá :max ký tự !",
            'order.max'=>"Không quá :max ký tự !",
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
