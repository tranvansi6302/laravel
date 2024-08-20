<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidationController extends Controller
{
    private $data;
    public function __construct()
    {
        $this->data = [];
    }
    public function getValidation()
    {
        $this->data['title'] = 'Validation';
        $this->data['errorMessage'] = 'Vui lòng kiểm tra dữ liệu nhập vào';
        return view('form.add', $this->data);
    }

    // Validation sử dụng lớp Request
    public function handleValidationV1(Request $request)
    {
        // $request->validate($rule,$message), $rule là một mảng dữ liệu với key và input name, value là các rule ràng buộc
        // $message là một mảng dữ liệu chứa các thông báo, nếu không điền sẽ lấy thông báo mặc định
        // :attribute tên name của trường input
        // :min value của kí tự

        $rules = [
            'username' => 'required|min:4',
            'email' => 'required|email'
        ];
        $message =  [
            'username.required' => 'Tên người dùng bắt buộc nhập',
            'username.min' => 'Tên người dùng lớn hơn bằng :min kí tự',
            'email.required' => 'Địa chỉ email bắt buộc nhập',
            'email.email' => 'Địa chỉ email sai định dạng',
        ];
        $request->validate($rules, $message);
    }
    // Validation sử dụng lớp Form Request
    public function handleValidationV2(ValidationRequest $validationRequest)
    {
        dd($validationRequest->all());
    }

    // Validation sử dụng lớp Validator
    public function handleValidationV3(Request $request)
    {
        $rules = [
            'username' => 'required|min:4',
            'email' => 'required|email'
        ];
        $message =  [
            'username.required' => ':attribute bắt buộc nhập',
            'username.min' => ':attribute lớn hơn bằng :min kí tự',
            'email.required' => ':attribute bắt buộc nhập',
            'email.email' => ':attribute sai định dạng',
        ];

        // Định nghĩa lại các name input
        $attribute = [
            'username' => 'Tên người dùng',
            'email' => 'Địa chỉ email'
        ];
        $validator  = Validator::make($request->all(), $rules, $message, $attribute);
        // Xử lí trường hợp validation thất bại -> $validator->fails()
        if ($validator->fails()) {
            $validator->errors()->add('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào');
        }
        // $validator->validate();
        return back()->withErrors($validator);
    }
}
