<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class ValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Mặc định false
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|min:4',
            'email' => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => ':attribute bắt buộc nhập',
            'username.min' => ':attribute lớn hơn bằng :min kí tự',
            'email.required' => ':attribute bắt buộc nhập',
            'email.email' => ':attribute sai định dạng',
        ];
    }
    // Thay đổi tên trường lấy tên tự động
    public function attributes()
    {
        return [
            'username' => 'Tên người dùng',
            'email' => 'Địa chỉ email'
        ];
    }

    // Sau khi validate khi có bắt kì lỗi nào xảy ra
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->count() > 0) {
                    $validator->errors()->add(
                        'msg',
                        'Vui lòng kiểm tra lại dữ liệu'
                    );
                }
            }
        ];
    }

    // Trước khi validate có thể cần xử lí đầu vào
    protected function prepareForValidation(): void
    {
        $this->merge([
            // Ví dụ thêm trường create_at trước khi submit form, thông thường sẽ sau này sẽ xử lí slug
            'create_at' => date('Y-m-d')
        ]);
    }

    // Custom lỗi 403
    protected function failedAuthorization()
    {
        // Nếu bên view muốn hiển thị thông báo này thì dùng exception->getMessage()
        // throw new AuthorizationException('Bạn không có quyền truy cập');

        // Chuyển hướng khi không có quyền và gửi lỗi sang view
        throw new HttpResponseException(redirect('/')->with('msg', 'Bạn không có quyền truy cập trang này'));

        // Ví dụ khi truy cập vào trang 403 nhưng muốn hiển thị view 404 -> ghi đè
        // throw new HttpResponseException(abort(404));
    }
}
