<?php $book_details = $this->crud_model->get_book_by_id($param1); ?>
<form method="POST" class="d-block ajaxForm" action="<?php echo route('book/update/' . $param1); ?>">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="name"><?php echo get_phrase('book_name'); ?></label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $book_details['name']; ?>" required>
        </div>

        <div class="form-group col-md-12">
            <label for="author"><?php echo get_phrase('author'); ?></label>
            <input type="text" class="form-control" id="author" name="author" value="<?php echo $book_details['author']; ?>" required>
        </div>

        <div class="form-group col-md-12">
            <label for="copies"><?php echo get_phrase('number_of_copy'); ?></label>
            <input type="number" class="form-control" id="copies" name="copies" min="0" value="<?php echo $book_details['copies']; ?>" required>
        </div>

        <div class="form-group col-md-12">
            <label for="url"><?php echo get_phrase('book_url'); ?></label>
            <input type="text" class="form-control" id="url" name="url" value="<?php echo $book_details['url']; ?>" required>
        </div>

        <div class="form-group  col-md-12">
            <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('update_book_info'); ?></button>
        </div>
    </div>
</form>

<script>
    $(".ajaxForm").validate({});
    $(".ajaxForm").submit(function(e) {
        var form = $(this);
        ajaxSubmit(e, form, showAllBooks);
    });
</script>