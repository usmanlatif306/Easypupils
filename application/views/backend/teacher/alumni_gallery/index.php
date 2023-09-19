<!--title-->
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body py-1">
        <h4 class="page-title">
          <i class="mdi mdi-calendar-clock title_icon"></i> <?php echo get_phrase('gallery'); ?>
          <a href="<?php echo site_url('teacher/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle ml-1">Dashboard</a>
          <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle" onclick="rightModal('<?php echo site_url('modal/popup/alumni_gallery/create'); ?>', '<?php echo get_phrase('add_new_gallery'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('add_new_gallery'); ?></button>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>

<div class="row">
  <div class="col-12 alumni_gallery_content">
    <?php include 'list.php'; ?>
  </div>
</div>

<script>
  var showAllGallery = function() {
    var url = '<?php echo site_url('addons/alumni/gallery/list'); ?>';

    $.ajax({
      type: 'GET',
      url: url,
      success: function(response) {
        $('.alumni_gallery_content').html(response);
      }
    });
  }
</script>