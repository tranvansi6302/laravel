<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        // Quy ước tên table chữ thường, cách nhau bởi dấu gạch dưới, dạng số nhiều
        // Tên model: Post => posts
        // ProductCategory => product_categories
        // $allPost = Post::all();
        // $post = Post::find('c1');
        // dd($post);

        // $post = new Post();
        // $post->id = 'c4';
        // $post->title = 'Bài viết 4';
        // $post->content = 'Nội dung 4';
        // $post->status = 1;
        // $post->save();
        // TODO lấy toàn bộ bản ghi
        $allPosts = Post::all();
        $title = 'Danh sách bài viết';
        // if ($allPosts->count() > 0) {
        //     foreach ($allPosts as $item) {
        //         echo $item->title . '<br>';
        //     }
        // }

        // TODO lấy 1 bản ghi -> dựa theo khóa chính
        // $post = Post::find('c1');

        // $activePosts = Post::where('status', 1)->get();
        // dd($activePosts);

        // TODO xóa mềm
        // Để lấy tất cả bản ghi kể cả các bản ghi đã bị xóa mềm
        $allPosts = Post::withTrashed()->get();

        return view('posts.list', compact('allPosts', 'title'));
    }
    public function add()
    {
        $dataInsert = [
            'title' => 'Bài viết 1',
            'content' => 'Nội dung 1',
            'status' => 1
        ];
        // $post = Post::create($dataInsert);
        // Sử dụng query builder
        // $status = Post::insert($dataInsert);
        // Lấy ra id vừa insert 
        // $id = $post->id;

        // firstOrCreate lấy ra bản ghi đầu tiên của dữ liệu phù hợp với query nếu tồn tại không insert, không tồn tại sẽ insert
        $post = Post::firstOrCreate([
            'id' => 1, // sẽ không thêm được vì có tồn tại id=1
        ], $dataInsert);

        // Phương thức save thêm dữ liệu thông qua object thông thường được sử dụng trước khi check việc gì đó mà không cần sử lí mảng
        $check = false;
        $post = new Post();
        $post->title = 'Bài viết ';
        $post->content = 'Nội dung2';
        if ($check == true) {
            $post->status = 1;
        }
        $post->save();
    }

    public function update($id)
    {
        // Cách 1
        $post = Post::find($id);
        // $post->title = 'Bài viết đã sửa';
        // $post->content = 'Nội dung đã sửa';
        // $post->save();

        // Cách 2
        $dataUpdate = [
            'title' => 'Tiêu đề đã sửa cách 2',
            'content' => 'Nội dung đã sửa cách 2'
        ];
        // $status = $post->update($dataUpdate);

        // Cách 3
        // $status = Post::where('id', $id)->update($dataUpdate);

        // Cách 4 nếu tìm thấy id thì update không thì insert
        Post::updateOrCreate(['id' => $id], $dataUpdate);
    }

    public function delete($id)
    {
        // $status = Post::destroy($id);
        // Xóa nhiều bản ghi Post::destroy($id, $id1) hoặc Post::destroy([$id1, $id2]) hoặc collect

        // Sử dụng query builder
        // $status = Post::where('id', $id)->delete();
    }
    public function handleDeleteAny(Request $request)
    {
        $deleteArr = $request->delete;
        if (!empty($deleteArr)) {
            $status = Post::destroy($deleteArr);
            if ($status) {
                $msg = 'Đã xóa ' . count($deleteArr) . ' bài viết';
            } else {
                $msg = 'Bạn không thể xóa vào lúc này vui lòng thử lại sau';
            }
        } else {
            $msg = 'Vui lòng chọn bài viết muốn xóa';
        }
        return redirect()->route('posts.index')->with('msg', $msg);
    }

    public function restore($id)
    {
        // Cách 1
        // $post = Post::withTrashed()->where('id', $id)->first();

        // Cách 2
        $post = Post::onlyTrashed()->where('id', $id)->first();
        if (!empty($post)) {
            $post->restore();
            return redirect()->route('posts.index')->with('msg', 'Khôi phục thành công');
        } else {
            return redirect()->route('posts.index')->with('msg', 'Không tồn tại bài viết');
        }
    }

    public function handleForceDelete($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        if (!empty($post)) {
            $post->forceDelete();
            return redirect()->route('posts.index')->with('msg', 'Xóa bài viết thành công');
        } else {
            return redirect()->route('posts.index')->with('msg', 'Không tồn tại bài viết');
        }
    }
}
