<?php $event = $this->db->get_where('alumni_events', array('id' => $param1))->row_array(); ?>
<form method="POST" class="d-block ajaxForm" action="<?php echo site_url('addons/alumni/events/update/'.$param1); ?>">
  <div class="form-row">
    <div class="form-group col-md-12 mb-1">
      <label for="title"><?php echo get_phrase('event_title'); ?></label>
      <input type="text" class="form-control" id="title" name = "title" value="<?php echo $event['title']; ?>" required>
      <small id="name_help" class="form-text text-muted"><?php echo get_phrase('provide_title_name'); ?></small>
    </div>
    <div class="form-group col-md-12 mb-1">
        <label for="starting_date"><?php echo get_phrase('event_starting_date'); ?></label>
        <input type="text" value="<?php echo date('m/d/Y', strtotime($event['starting_date'])); ?>" class="form-control" id="starting_date" name = "starting_date" data-provide = "datepicker" required>
        <small id="name_help" class="form-text text-muted"><?php echo get_phrase('provide_starting_date'); ?></small>
    </div>

    <div class="form-group col-md-12 mb-1">
        <label for="ending_date"><?php echo get_phrase('event_ending_date'); ?></label>
        <input type="text" value="<?php echo date('m/d/Y', strtotime($event['ending_date'])); ?>" class="form-control" id="ending_date" name = "ending_date" data-provide = "datepicker" required>
        <small id="name_help" class="form-text text-muted"><?php echo get_phrase('provide_ending_date'); ?></small>
    </div>

    <div class="form-group col-md-12 mb-1">
        <label for="visibility"><?php echo get_phrase('visibility_on_website'); ?></label>
        <select name="visibility" id="visibility" class="form-control select2" data-toggle = "select2">
            <option value="1" <?php if($event['visibility'] == 1) echo 'selected'; ?>><?php echo get_phrase('show'); ?></option>
            <option value="0" <?php if($event['visibility'] == 0) echo 'selected'; ?>><?php echo get_phrase('no_need_to_show'); ?></option>
        </select>
        <small id="" class="form-text text-muted"><?php echo get_phrase('visibility_on_website'); ?></small>
    </div>

    <div class="form-group col-md-12 mb-1">
        <label for="addon_zip"><?php echo get_phrase('upload_event_photo'); ?></label>
        <div class="custom-file-upload d-inline-block">
            <input type="file" class="form-control" id="event_photo" name = "event_photo">
        </div>
    </div>

    <div class="form-group  col-md-12 mt-1">
      <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('save_event'); ?></button>
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
  ajaxSubmit(e, form, showAllEvents);
});
initCustomFileUploader();
</script>
