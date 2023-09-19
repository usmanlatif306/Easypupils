<!--title-->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">
                <i class="mdi mdi-calendar-range title_icon"></i> <?php echo get_phrase('session'); ?>
                <a href="<?php echo site_url('parents/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle mx-1">Dashboard</a>
                <button type="button" class="btn btn-icon btn-success btn-rounded mb-1 mt-3 alignToTitle float-right" onclick="rightModal('<?php echo site_url('modal/popup/session/create'); ?>', '<?php echo get_phrase('create_new_session'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('add_session'); ?></button>
            </h4>
        </div>
    </div>
</div>

<div class="row session_content">
    <?php include 'list.php'; ?>
</div>


<script>
    function makeSessionActive() {
        var session_id = $('#session_dropdown').val();
        var url = '<?php echo route('session_manager/active_session/'); ?>' + session_id
        $.ajax({
            type: 'GET',
            url: url,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                // $('#session_content').html(response.view);
                (response.status === true) ? toastr.success(response.notification): toastr.error(response.notification);
            }
        });

        showAllSessions();
    }

    var showAllSessions = function() {
        var url = '<?php echo route('session_manager/list'); ?>';

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $('.session_content').html(response);
                initDataTable('basic-datatable');
                initSelect2(['#session_dropdown']);
            }
        });
    }
</script>