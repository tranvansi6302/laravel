<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Trường hợp edit
        $uniqueEmail = 'unique:users';
        if (session('id')) {
            $id = session('id');
            $uniqueEmail = 'unique:users,email,' . $id;
        }
        return [
            'fullname' => ['required', 'min:5'],
            'email' => ['required', 'email', $uniqueEmail],
            'group_id' => ['required', 'integer'],
        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => 'Họ và tên bắt buộc nhập',
            'fullname.min' => 'Họ và tên phải từ 5 kí tự',
            'email.required' => 'Email bắt buộc nhập',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'group_id.required' => 'Nhóm bắt buộc chọn',
            'group_id.integer' => 'Nhóm không hợp lệ',
        ];
    }
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->count() > 0) {
                    $validator->errors()->add(
                        'msg',
                        'Vui lòng kiểm tra lại dữ liệu'
                    );
                    $validator->errors()->add('msg_type', 'error');
                }
            }
        ];
    }
}
