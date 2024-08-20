<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct(Request $request)
    {
        // Nếu trang danh sách chuyên mục hiển thị ra dòng chữ Xin Chào
        // is kiểm tra có khớp với đường dẫn
        if ($request->is('categories')) {
            echo 'Xin Chào';
        }
    }
    // Hiển thị danh sách chuyên mục -> GET
    public function index(Request $request)
    {
        // Lấy toàn bộ data không phân biệt GET hay POST
        $allData = $request->all();

        // Có thể lấy thẳng giá trị thông qua request
        $id = $request->id;

        // Lấy đường dẫn trừ tên miền, categories, categories/add
        $path = $request->path();

        // Lấy ra đường dẫn hiện tại (không lấy query string) http://127.0.0.1:8000/categories
        $url = $request->url();

        // Lấy đầy đủ bao gôm query string
        $fullUrl = $request->fullUrl();

        // Lấy ra phương thức hiện tại, kiểm tra một phương thức $request->isMethod('GET'), thường áp dụng cho route match hoặc any
        $method = $request->method();

        // Lấy ra địa chỉ ip
        $ip = $request->ip();

        // Lấy thông tin biến $_SERVER
        $server = $request->server();

        // Lấy thông tin header
        $header = $request->header();

        // Lấy ra input trên url như id, name giống như $_GET
        $id = $request->input('id');

        // Helpers request thường dược gọi ở bên view
        request()->all();
        $name = request('name', 'giá trị mặc định');

        // Lấy ra các query string đối với GET thì dùng input hoặc thuộc tính đều được, riêng POST dùng query không được
        $query = $request->query();
        return view('clients/categories/list');
    }
    // Lấy chuyên mục theo id -> GET
    public function getCategory($id)
    {
        return view('clients/categories/edit');
    }
    // Sửa danh mục -> POST
    public function updateCategory($id)
    {
        return 'Submit sửa chuyên mục: ' . $id;
    }

    // Hiển thị form thêm của danh mục -> GET
    public function addCategory(Request $request)
    {
        // Lấy ra giá trị đã flash ở dưới, với old có hổ trợ helpers thuận tiện hơn gọi trong view old('giá trị','giá trị mặc định')
        $old = $request->old('categories_name');
        return view('clients/categories/add');
    }

    // Thêm danh mục -> POST
    public function handleAddCategory(Request $request)
    {
        $allData = $request->all();
        $query = $request->query();
        // Kiểm tra input (name của input) có tồn tại không
        if ($request->has('categories_name')) {
            echo 'Tồn tại categories name';
            // Flash gán giá trị
            $request->flash();
        }

        return 'Submit thêm chuyên mục: ';
    }
    // Xóa danh mục -> GET
    public function deleteCategory($id)
    {
        return 'Submit xóa chuyên mục: ' . $id;
    }
    public function getFile()
    {
        return view('clients.categories.file');
    }

    // Xử lí lấy thông tin file
    public function handleFile(Request $request)
    {
        $file = $request->file('photo');
        // Hoặc dùng $request->photo

        // Kiểm tra file đã có hay chưa
        // if ($request->hasFile('photo')) {
        //     dd($file);
        // } else {
        //     return 'Vui lòng chọn file';
        // }

        // Kiểm tra file đã upload thành công hay chưa
        if ($request->file('photo')->isValid()) {
            dd($file);
            // Lấy ra path
            $path = $file->path();
            // Lấy đuôi file
            $extension = $file->extension();

            // Di chuyển file vào local
            $path = $file->store('images');
            $path = $file->storeAs('file-txt', 'khoa-hoc.txt');
            $fileName = $file->getClientOriginalName();
        } else {
            return 'Upload không thành công';
        }
    }
}
