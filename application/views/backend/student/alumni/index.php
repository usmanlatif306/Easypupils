<!--title-->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body py-1">
                <h4 class="page-title">
                    <i class="mdi mdi-book-open-page-variant title_icon"></i> <?php echo get_phrase('manage_alumni'); ?>
                    <a href="<?php echo site_url('parents/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle mx-1">Dashboard</a>
                    <!-- <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle" onclick="rightModal('<?php echo site_url('modal/popup/alumni/create'); ?>', '<?php echo get_phrase('add_new_alumni'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('add_new_alumni'); ?></button> -->
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body alumni_content">
                <?php include 'list.php'; ?>
            </div>
        </div>
    </div>
</div>

<script>
    var showAllAlumni = function() {
        var url = '<?php echo site_url('addons/alumni/list'); ?>';

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $('.alumni_content').html(response);
                initDataTable('basic-datatable');
            }
        });
    }
    var redirectToDashboard = function() {
        var url = '<?php echo route('dashboard'); ?>';
        window.location.replace(url);
    }
</script>