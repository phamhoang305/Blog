<?php

namespace App\Http\Requests\Admin\Page;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class PageRequest extends FormRequest
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
            'post_title'=>'required|max:300',
            'post_des'=>'max:1000',
            'post_keywords'=>'max:255',
            'page_link'=>'max:300',
            'page_link_type'=>'max:10',
            'page_status_header'=>'max:10',
            'page_status_sidebar'=>'max:10',
            'post_content'=>'required|min:10',
        ];

    }
    public function messages()
    {
        return [
            'post_title.required'=>"Không được trống !",
            'post_title.max'=>"Không quá :max ký tự !",
            'category_id.required'=>"Vui lòng chọn danh mục bài viết !",
            'category_id.max'=>"Không quá :max ký tự !",
            'post_des.max'=>"Không quá :max ký tự !",
            'post_keywords.max'=>"Không quá :max ký tự !",
            'page_link.max'=>"Không quá :max ký tự !",
            'page_link_type.max'=>"Không quá :max ký tự !",
            'page_status_header.max'=>"Không quá :max ký tự !",
            'page_status_sidebar.max'=>"Không quá :max ký tự !",
            'post_content.required'=>"Nộ dung bài viết được trống !",
            'post_content.min'=>"Nội dung bài phải lớn hơn :min ký tự !",
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
