<?php $alumni_gallery = $this->db->get_where('alumni_gallery', array('school_id' => school_id(), 'session' => active_session()))->result_array(); ?>
<?php if (count($alumni_gallery) > 0): ?>
  <div class="row">
    <?php foreach($alumni_gallery as $gallery):?>
      <div class="col-md-6 col-xl-3">
        <!-- project card -->
        <div class="card d-block">
          <div class="card-body" style="height: 202px;">
            <div class="dropdown float-end">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end" style="">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/alumni_gallery/edit/'.$gallery['id']); ?>', '<?php echo get_phrase('update_gallery'); ?>');"><i class="mdi mdi-pencil mr-1"></i><?php echo get_phrase('edit'); ?></a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/alumni_gallery/add_photo/'.$gallery['id']); ?>', '<?php echo get_phrase('add_photo'); ?>');"><i class="mdi mdi-image mr-1"></i><?php echo get_phrase('add_photo'); ?></a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo site_url('addons/alumni/gallery/delete/'.$gallery['id']); ?>', showAllGallery)"><i class="mdi mdi-delete mr-1"></i><?php echo get_phrase('delete'); ?></a>
                </div>
            </div>
            <!-- project title-->
            <h4 class="mt-0">
              <a href="<?php echo site_url('addons/alumni/gallery_photo/'.$gallery['id']); ?>" class="text-title"><?php echo $gallery['title']; ?></a>
            </h4>
            <?php if ($gallery['visibility']): ?>
                <div class="badge badge-success mb-3"><?php echo get_phrase('visible'); ?></div>
            <?php else: ?>
                <div class="badge badge-danger mb-3"><?php echo get_phrase('not_visible'); ?></div>
            <?php endif; ?>


            <p class="text-muted font-13 mb-3">
              <?php echo ellipsis($gallery['description'], 150); ?>
            </p>
          </div> <!-- end card-body-->
          <ul class="list-group list-group-flush">
            <li class="list-group-item p-3">
              <div>
                <?php $photos = $this->alumni_model->get_photos_by_gallery_id($gallery['id']); ?>
                <?php if (count($photos) > 0): ?>
                  <?php foreach ($photos as $key => $photo): ?>
                    <?php if ($key <= 2): ?>
                      <a href="<?php echo site_url('addons/alumni/gallery_photo/'.$gallery['id']); ?>" class="d-inline-block">
                        <img src="<?php echo $this->alumni_model->get_gallery_image($photo['photo']); ?>" class="rounded-circle avatar-xs" alt="friend">
                      </a>
                    <?php endif; ?>
                  <?php endforeach; ?>
                  <?php if (count($photos) > 3): ?>
                    <a href="<?php echo site_url('addons/alumni/gallery_photo/'.$gallery['id']); ?>" class="d-inline-block text-muted font-weight-bold ml-2">
                      +<?php echo (count($photos)-3).' '.get_phrase('more');  ?>
                    </a>
                  <?php endif; ?>
                <?php else: ?>
                  <span><?php echo get_phrase('no_photos_found'); ?></span> <span style="float: right;"> <a href="javascript:void(0);" class="text-muted" onclick="rightModal('<?php echo site_url('modal/popup/alumni_gallery/add_photo/'.$gallery['id']); ?>', '<?php echo get_phrase('add_photo'); ?>');"><?php echo get_phrase('add_photo'); ?></a> </span>
                <?php endif; ?>
              </div>
            </li>
          </ul>
        </div> <!-- end card-->
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
