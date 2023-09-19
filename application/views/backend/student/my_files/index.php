<!--title-->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-book-open-page-variant title_icon"></i> <?php echo get_phrase('my_files'); ?>
                    <a href="<?php echo site_url('student/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle mx-1">Dashboard</a>
                    <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle" onclick="rightModal('<?php echo site_url('modal/popup/my_files/create'); ?>', '<?php echo get_phrase('upload_file'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('upload_file'); ?></button>

                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body files_content">
                <?php include 'list.php'; ?>
            </div>
        </div>
    </div>
</div>

<script>
    var showAllFiles = function() {
        var url = '<?php echo route('my_files/list'); ?>';
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $('.files_content').html(response);
                initDataTable('basic-datatable');
            }
        });
    }
</script>