<?php $gallery_details = $this->db->get_where('alumni_gallery', array('id' => $gallery_id))->row_array(); ?>
<!--title-->
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body py-2">
        <h4 class="page-title">
          <i class="mdi mdi-calendar-clock title_icon"></i> <?php echo get_phrase('photos_of') . ' ' . $gallery_details['title']; ?>
          <a href="<?php echo site_url('admin/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle mx-1">Dashboard</a>
          <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle" onclick="rightModal('<?php echo site_url('modal/popup/alumni_gallery_photo/add_photo/' . $gallery_id); ?>', '<?php echo get_phrase('add_photo'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('add_photo'); ?></button>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>

<div class="row">
  <div class="col-12 alumni_gallery_photo_content">
    <?php include 'list.php'; ?>
  </div>
</div>
<script>
  var showAllGalleryPhotos = function() {
    var url = '<?php echo site_url('addons/alumni/gallery_photo/' . $gallery_id . '/list'); ?>';

    $.ajax({
      type: 'GET',
      url: url,
      success: function(response) {
        $('.alumni_gallery_photo_content').html(response);
      }
    });
  }
</script>