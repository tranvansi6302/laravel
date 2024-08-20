<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $list = Post::orderBy('created_at', 'desc')->where('user_id', $userId)->get();
        return view('admin.posts.list', compact('list'));
    }

    public function getAdd()
    {
        return view('admin.posts.add');
    }

    public function handleAdd(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->rules(),
            $this->messages()
        );
        if ($validator->fails()) {
            toast('Vui lòng kiểm tra lại dữ liệu nhập vào', 'warning');
        }
        $validator->validate();
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->save();
        toast('Thêm dữ liệu thành công', 'success');
        return redirect()->route('admin.posts.index');
    }
    public function getEdit(Request $request, Post $post)
    {
        // Xử lí policy vì có liên quan đến tài nguyên nên xử lí trong controller
        $this->authorize('update', $post);
        $request->session()->put('postId', $post->id);
        return view('admin.posts.edit', compact('post'));
    }

    public function handleUpdate(Request $request)
    {
        if (session('postId')) {
            $postId = session('postId');
        }
        $post = Post::find($postId);
        $this->authorize('update', $post);
        $validator = Validator::make(
            $request->all(),
            $this->rules(),
            $this->messages()
        );
        if ($validator->fails()) {
            toast('Vui lòng kiểm tra lại dữ liệu nhập vào', 'warning');
        }
        $validator->validate();
        if (!empty($post)) {
            $post->title = $request->title;
            $post->content = $request->content;
            $post->save();
            toast('Cập nhật dữ liệu thành công', 'success');
        } else {
            toast('Bài viết không tồn tại', 'warning');
        }
        $request->session()->remove('postId');
        return redirect()->route('admin.posts.index');
    }

    public function handleDelete(Post $post)
    {
        $this->authorize('delete', $post);

        if (Auth::user()->id != $post->id) {
            Post::destroy($post->id);
            toast('Xóa dữ liệu thành công', 'success');
        } else {
            toast('Không thể xóa bài viết này', 'warning');
        }

        return redirect()->route('admin.posts.index');
    }

    public function rules()
    {
        return  [
            'title' => ['required'],
        ];
    }
    public function messages()
    {
        return  [
            'title.required' => 'Tiêu đề bắt buộc phải nhập',
        ];
    }
}
