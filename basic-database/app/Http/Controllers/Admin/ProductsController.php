<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'Danh sách sản phẩm';
    }

    /**
     * Show the form for creating a new resource.
     * Hiển thị form -> GET
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * Xử lí thêm -> POST
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * Lấy ra thông tin cụ thể -> GET
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * Hiển thì form sửa -> GET
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * Xử lí sửa -> POST
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * Xử lí xóa -> GET
     */
    public function destroy(string $id)
    {
        //
    }
}
