<!--title-->
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title">
          <i class="mdi mdi-account-circle title_icon"></i> <?php echo get_phrase('parents'); ?>
          <a href="<?php echo site_url('admin/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle mx-1">Dashboard</a>
          <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle" onclick="rightModal('<?php echo site_url('modal/popup/parent/create'); ?>', '<?php echo get_phrase('create_parent'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('add_parent'); ?></button>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body parent_content">
        <?php include 'list.php'; ?>
      </div>
    </div>
  </div>
</div>


<script>
  var showAllParents = function() {
    var url = '<?php echo route('parent/list'); ?>';

    $.ajax({
      type: 'GET',
      url: url,
      success: function(response) {
        $('.parent_content').html(response);
        initDataTable('basic-datatable');
      }
    });
  }
</script>