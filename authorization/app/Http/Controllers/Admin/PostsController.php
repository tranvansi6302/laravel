<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    public function index()
    {
        // $this->authorize('viewAny', Post::class);
        $user = Auth::user();
        dd($user->can('viewAny', Post::class));
        // dd($response);

        // return view('admin.posts.list');
    }

    public function add()
    {
        // Lấy user không phải user đang đăng nhập (demo)
        $user = User::find(2);
        if (Gate::forUser($user)->allows('posts.add')) {
            return 'Có quyền thêm bài viết';
        }



        // Demo kiểm tra phân quyền
        // if (Gate::allows('posts.add')) {
        //     return '<h1>Có quyền thêm bài viết</h1>';
        // }
        // // Kiểm tra không có quyền
        // if (Gate::denies('posts.add')) {
        //     return '<h1>Không có quyền thêm bài viết</h1>';
        // }
        // return '<h1>Thêm bài bài viêt</h1>';

        // Nếu không check bằng middleware hoặc can có thể check ở đây
        $this->authorize('posts.add');
    }

    public function edit(Post $post)
    {


        if (Gate::allows('posts.edit', $post)) {
            return '<h1>Cho phép chỉnh sửa bài bài viêt ' . $post->id . '</h1>';
        }
        if (Gate::denies('posts.edit', $post)) {
            return '<h1>Không cho phép chỉnh sửa bài bài viêt ' . $post->id . '</h1>';
        }

        // Kiểm tra user có quyền làm gì hay không
        // $user = User::find(2);
        // if (Gate::forUser($user)->allows('posts.edit', $post)) {
        //     return 'Có quyền sửa bài viết';
        // }
        // if (Gate::forUser($user)->denies('posts.edit', $post)) {
        //     return 'Không có quyền sửa bài viết';
        // }
    }
}
