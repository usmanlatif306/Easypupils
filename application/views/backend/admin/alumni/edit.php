<?php $alumnus = $this->db->get_where('alumni', array('id' => $param1))->row_array(); ?>
<form method="POST" class="d-block ajaxForm" action="<?php echo site_url('addons/alumni/update/'.$param1); ?>" enctype="multipart/form-data">
  <div class="form-row">
    <input type="hidden" name="school_id" value = "<?php echo school_id(); ?>">
    <div class="form-group col-md-12">
      <label for="name"><?php echo get_phrase('alumni_name'); ?></label>
      <input type="text" class="form-control" id="name" name = "name" value="<?php echo $alumnus['name']; ?>" required>
      <small id="name_help" class="form-text text-muted"><?php echo get_phrase('provide_alumni_name'); ?></small>
    </div>

    <div class="form-group col-md-12">
      <label for="student_code"><?php echo get_phrase('student_code'); ?></label>
      <input type="text" class="form-control" id="student_code" name = "student_code" value="<?php echo $alumnus['student_code']; ?>" required>
      <small id="student_code_help" class="form-text text-muted"><?php echo get_phrase('provide_student_code'); ?></small>
    </div>

    <div class="form-group col-md-12">
      <label for="phone"><?php echo get_phrase('email'); ?></label>
      <input type="email" class="form-control" id="email" name = "email" value="<?php echo $alumnus['email']; ?>" required>
      <small id="" class="form-text text-muted"><?php echo get_phrase('provide_alumni_name'); ?></small>
    </div>

    <div class="form-group col-md-12">
      <label for="name"><?php echo get_phrase('phone'); ?></label>
      <input type="text" class="form-control" id="phone" name = "phone" value="<?php echo $alumnus['phone']; ?>" required>
      <small id="name_help" class="form-text text-muted"><?php echo get_phrase('provide_alumni_phone_number'); ?></small>
    </div>
    <div class="form-group col-md-12">
      <label for="profession"><?php echo get_phrase('profession'); ?></label>
      <input type="text" class="form-control" id="profession" name = "profession" value="<?php echo $alumnus['profession']; ?>" required>
      <small id="profession_help" class="form-text text-muted"><?php echo get_phrase('provide_alumni_profession'); ?></small>
    </div>
    <div class="form-group col-md-12">
      <label for="session"><?php echo get_phrase('session'); ?></label>
      <select name="session" id="session" class="form-control select2" data-toggle = "select2">
        <option value=""><?php echo get_phrase('select_a_session'); ?></option>
        <?php
        $sessions = $this->crud_model->get_session()->result_array();
        foreach ($sessions as $session): ?>
        <option value="<?php echo $session['id']; ?>" <?php if ($session['id'] == $alumnus['session']): ?> selected <?php endif; ?>><?php echo $session['name']; ?></option>
      <?php endforeach; ?>
    </select>
    <small id="" class="form-text text-muted"><?php echo get_phrase('provide_a_session'); ?></small>
  </div>

  <div class="form-group col-md-12">
    <label for="addon_zip"><?php echo get_phrase('upload_alumni_photo'); ?></label>
    <div class="custom-file-upload d-inline-block">
      <input type="file" class="form-control" id="alumni_image" name = "alumni_image">
    </div>
  </div>

  <div class="form-group  col-md-12">
    <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('update_alumni'); ?></button>
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
  ajaxSubmit(e, form, showAllAlumni);
});
initCustomFileUploader();
</script>
