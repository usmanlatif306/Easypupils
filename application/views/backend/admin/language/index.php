<!-- start page title -->
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title">
          <i class="mdi mdi-database title_icon"></i> <?php echo get_phrase('languages'); ?>
          <a href="<?php echo site_url('admin/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle mx-1">Dashboard</a>
          <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle" onclick="rightModal('<?php echo site_url('modal/popup/language/create'); ?>', '<?php echo get_phrase('add_language'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('add_language'); ?></button>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>
<!-- end page title -->

<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <div class="language_content">
          <?php include 'list.php'; ?>
        </div> <!-- end table-responsive-->
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>


<script>
  var showAllLanguages = function() {
    var url = '<?php echo route('language/list'); ?>';

    $.ajax({
      type: 'GET',
      url: url,
      success: function(response) {
        $('.language_content').html(response);
        initDataTable('basic-datatable');
      }
    });
  }
</script>