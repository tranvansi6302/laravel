<h1>Upload File</h1>
<form method="POST" action="<?= route('categories.upload') ?>" enctype="multipart/form-data">
    <input name="photo" placeholder="Enter your name..." type="file">
    <button type="submit">Submit</button>
    <?= csrf_field() ?>
    <!-- <input type="hidden" name="_token" value="<?= csrf_token() ?>"> -->
</form>