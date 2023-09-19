<!--title-->
<div class="row d-print-none">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title">
          <i class="mdi mdi-fingerprint title_icon"></i> <?php echo get_phrase('biometric_attendance'); ?>
          <a href="<?php echo site_url('admin/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle mx-1">Dashboard</a>
          <?php if (addon_status('biometric-attendance')) : ?>
            <button type="button" class="btn btn-outline-info btn-rounded alignToTitle mr-1" onclick="rightModal('<?php echo site_url('modal/popup/biometric_attendance/biometric_attendance'); ?>', '<?php echo get_phrase('import_biometric_attendance'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('biometric_attendance'); ?></button>
          <?php endif; ?>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title"><?php echo get_phrase('biometric_attendance_data_preview'); ?></h4>
        <div class="preview_content">
          <?php include APPPATH . 'views/backend/empty.php'; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var showPreview = function() {
    var url = '<?php echo site_url('addons/biometric_attendance/preview/0/0'); ?>';
    $.ajax({
      type: 'GET',
      url: url,
      success: function(response) {
        $('.preview_content').html(response);
      }
    });
  }

  function filterPreview() {
    var class_id = $('#class_id').val();
    var date = $('#date').val();
    var url = '<?php echo site_url('addons/biometric_attendance/preview/'); ?>' + date + '/' + class_id;
    $.ajax({
      type: 'GET',
      url: url,
      success: function(response) {
        $('.preview_content').html(response);
      }
    });
  }

  function importBiometricAttendance() {
    $.ajax({
      type: "get",
      url: "<?php echo site_url('addons/biometric_attendance/import_biometric_attendance'); ?>",
      dataType: 'json',
      success: function(response) {
        if (response.status) {
          success_notify(response.notification);
        } else {
          toastr.error(response.notification);
        }
      }
    });
  }
</script>