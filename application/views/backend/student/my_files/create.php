<form method="POST" class="d-block ajaxForm" action="<?php echo route('my_files/create'); ?>" enctype="multipart/form-data">
    <div class="form-group">
        <label for="file">File</label>
        <input id="file" type="file" name="file" class="form-control" required />
    </div>
    <div class="form-group mt-2">
        <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('upload_file'); ?></button>
    </div>
    </div>
</form>

<script>
    $(".ajaxForm").validate({});
    $(".ajaxForm").submit(function(e) {
        var form = $(this);
        ajaxSubmit(e, form, showAllFiles);
    });
</script>