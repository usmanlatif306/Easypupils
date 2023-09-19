<?php $alumni_gallery_photos = $this->db->get_where('alumni_gallery_photos', array('gallery_id' => $gallery_id))->result_array(); ?>
<?php if (count($alumni_gallery_photos) > 0): ?>
  <div class="row">
    <?php foreach($alumni_gallery_photos as $photo_photo):?>
      <div class="col-md-6 col-xl-3">
        <div class="card d-block">
          <img class="card-img-top" src="<?php echo $this->alumni_model->get_gallery_image($photo_photo['photo']); ?>" alt="project image cap">
          <div class="card-img-overlay">
            <div style="float: right;">
              <button type="button" class="btn btn-icon btn-warning btn-sm"onclick="confirmModal('<?php echo site_url('addons/alumni/gallery_photo/'.$gallery_id.'/delete/'.$photo_photo['id']); ?>', showAllGalleryPhotos)"> <i class="mdi mdi-delete"></i> </button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php else: ?>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <?php include APPPATH.'views/backend/empty.php'; ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
