<?php

namespace App\Http\Requests\Web\Post;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class PostRequest extends FormRequest
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
        // dd($this->file('file_post_image'));
        return [
            'post_title'=>'required|max:300',
            'category_id'=>'required|max:10',
            'post_des'=>'max:1000',
            'post_keywords'=>'max:255',
            'post_content'=>'required|min:10',
            'post_password'=>'max:30',
            'file_post_image'=>'mimes:jpeg,JPEG,png,PNG,jpg,JPG,gif,GIF|max:5120'
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
            'post_content.required'=>"Nộ dung bài viết được trống !",
            'post_content.min'=>"Nội dung bài phải lớn hơn :min ký tự !",
            'file_post_image.mimes'=>"Định dạng hình ảnh không hợp lệ !",
            'file_post_image.max'=>"Hình anh không được lớn hơn 5 MB !",
            'post_password.max'=>"Không quá :max ký tự !",
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
