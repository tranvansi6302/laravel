<h1>Thêm chuyên mục</h1>
<form method="POST" action="<?= route('categories.add') ?>">
    <input name="categories_name" placeholder="Enter your name..." type="text">
    <button type="submit">Submit</button>
    <?= csrf_field() ?>
    <!-- <input type="hidden" name="_token" value="<?= csrf_token() ?>"> -->
</form>