<h1>Upload file</h1>
<form method="POST" action="<?php echo route('categories.upload'); ?>" enctype="multipart/form-data">
    <div>
        <input type="file" name="photo" placeholder="Tên chuyên mục" 
        value="<?php echo old('category_name'); ?>">
    </div>
    <?php echo csrf_field(); ?>
    <button type="submit">Upload</button>
</form>