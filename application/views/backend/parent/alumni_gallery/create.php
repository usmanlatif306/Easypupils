<form method="POST" class="d-block ajaxForm" action="<?php echo site_url('addons/alumni/gallery/create'); ?>">
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="title"><?php echo get_phrase('gallery_title'); ?></label>
      <input type="text" class="form-control" id="title" name = "title" required>
      <small id="name_help" class="form-text text-muted"><?php echo get_phrase('provide_title_name'); ?></small>
    </div>

    <div class="form-group col-md-12">
      <label for="title"><?php echo get_phrase('description'); ?></label>
      <textarea name="description" class="form-control" rows="8" cols="80" required></textarea>
      <small id="description_help" class="form-text text-muted"><?php echo get_phrase('provide_description'); ?></small>
    </div>

    <div class="form-group col-md-12">
        <label for="visibility"><?php echo get_phrase('visibility_on_website'); ?></label>
        <select name="visibility" id="visibility" class="form-control select2" data-toggle = "select2">
            <option value="1"><?php echo get_phrase('show'); ?></option>
            <option value="0"><?php echo get_phrase('no_need_to_show'); ?></option>
        </select>
        <small id="" class="form-text text-muted"><?php echo get_phrase('visibility_on_website'); ?></small>
    </div>

    <div class="form-group  col-md-12">
      <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('save_gallery'); ?></button>
    </div>
  </div>
</form>

<script>
$(document).ready(function () {
  $('select.select2:not(.normal)').each(function () { $(this).select2({ dropdownParent: '#right-modal' }); });
});
$(".ajaxForm").validate({}); // Jquery form validation initialization
$(".ajaxForm").submit(function(e) {
  var form = $(this);
  ajaxSubmit(e, form, showAllGallery);
});
</script>
