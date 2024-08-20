<x-admin-layout>
    @section('title', 'Sửa bài viết')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sửa bài viết</h1>
    </div>

    <div class="row">

        <div class="col-lg-6 col-md-12">
            <form action="{{ route('admin.posts.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Tiêu đề bài viết</label>
                    <input value="{{ old('title') ?? $post->title }}" type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" placeholder="Nhập tiêu đề...">
                    <x-validate-error :errors="$errors->get('title')" />
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea placeholder="Nhập nội dung..." class="form-control" name="content" id="content" cols="30" rows="6">{{ old('content') ?? $post->content }}</textarea>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4 mr-2">Xác Nhận</button>
                    <a class="btn btn-success px-4" href="{{ route('admin.posts.index') }}">Quay Lại</a>
                </div>
            </form>
        </div>
    </div>

</x-admin-layout>
