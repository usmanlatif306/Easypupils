<!--title-->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">
                <i class="mdi mdi-grease-pencil title_icon"></i> <?php echo get_phrase('Grade'); ?>
                <a href="<?php echo site_url('parents/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle mx-1">Dashboard</a>
            </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body grade_content">
                <?php include 'list.php'; ?>
            </div>
        </div>
    </div>
</div>

<script>
    var showAllGrades = function() {
        var url = '<?php echo route('grade/list'); ?>';

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $('.grade_content').html(response);
                initDataTable('basic-datatable');
            }
        });
    }
</script>