<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $where = [];
        if ($request->title) {
            $where[] = ['title', 'like', '%' . $request->title . '%'];
        }

        $product = Product::orderBy('id', 'desc');
        if (!empty($where)) {
            $product = $product->where($where);
        }
        $product = $product->paginate();

        if ($product->count() > 0) {
            $status = 'success';
        } else {
            $status = 'No Data';
        }
        $product = new ProductCollection($product, $status);

        // $response = [
        //     'status' => $status,
        //     'data' => $product
        // ];

        return $product;
    }
    public function detail($id)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            $status = 'success';
        } else {
            $status = 'error';
        }
        // Muốn sử lí toàn bộ trạng thái status bên file resource
        $product =  new ProductResource($product);
        return $product;
    }

    public function create(Request $request)
    {
        $request->validate(
            [
                'title' => ['required']
            ],
            [
                'title.required' => 'Tiêu đề bắt buộc phải nhập'
            ]
        );
        $product = new Product();
        $product->title = $request->title;
        $product->content = $request->content;
        $product->status = $request->status;
        $product->save();
        if ($product->id) {
            $response = [
                'status' => 'success',
                'data' => $product
            ];
        } else {
            $response = [
                'status' => 'error'
            ];
        }
        return $response;
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => ['required']
            ],
            [
                'title.required' => 'Tiêu đề bắt buộc phải nhập'
            ]
        );
        $product = Product::find($id);
        if (!$product) {
            $response = [
                'status' => 'error',
                'data' => 'No Data'
            ];
        } else {

            $method =  $request->method();
            if ($method == 'PUT') {
                $product->title = $request->title;
                $product->content = $request->content;
                $product->status = $request->status;
                $product->save();
            } else {
                if ($request->title) {
                    $product->title = $request->title;
                }
                if ($request->content) {
                    $product->content = $request->content;
                }
                if ($request->status) {
                    $product->status = $request->status;
                }
                $product->save();
            }
            $response = [
                'status' => 'success',
                'data' => $product
            ];
        }
        return $response;
    }
    public function delete($id)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            Product::destroy($product->id);
            $response = [
                'status' => 'success',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Not Found'
            ];
        }
        return $response;
    }
}
