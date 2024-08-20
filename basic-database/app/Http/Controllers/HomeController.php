<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $data = [];
    public function index()
    {
        // $title = 'Học lập trình Laravel';
        // $content = '<br> Học về View trong Laravel';
        // $dataView = [
        //     'title' => $title,
        //     'content' => $content
        // ];
        // Cách 2 Nếu key và value cùng tên thì có thể dùng compact -> nó sẽ gom lại thành mảng và tạo key giống tên biến
        // return view('home', compact('title', 'content'));

        // Cách 3 dùng with
        // return view('home')->with([
        //     'title' => $title,
        //     'content' => $content
        // ]);

        // Cách 4
        // return View::make('home', compact('title', 'content'));

        // Blade Template Engine 
        $this->data['welcome'] = 'Học lập trình Laravel';
        $this->data['dataArr'] = [
            'Item 1',
            'Item 2',
            'Item 3',
        ];
        $this->data['message'] = 'Đặt hàng thành công';
        $this->data['title'] = 'Trang chủ';
        return view('clients.home', $this->data);
    }

    public function products()
    {
        $this->data['title'] = 'Sản phẩm';
        return view('clients.products', $this->data);
    }

    public function getAdd()
    {
        $this->data['title'] = 'Thêm sản phẩm';
        return view('clients.add', $this->data);
    }

    public function handleAdd(Request $request)
    {
        dd($request);
    }
    public function handlePut(Request $request)
    {
        dd($request);
    }

    public function downloadImg(Request $request)
    {
        if (!empty($request->image)) {
            $image = trim($request->image);
            // download-> link nội bộ, upload từ máy lên, streamDownload download từ link bên ngoài
            return response()->streamDownload(function () use ($image) {
                $imageContent = file_get_contents($image);
                echo $imageContent;
            }, 'image.png');

            // Trả về response dạng Download file
            // return response()->download($pathToFile,$name, $hedader)
        }
    }
}
