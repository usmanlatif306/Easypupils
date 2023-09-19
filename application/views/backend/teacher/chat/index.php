<?php
$user_id = $this->session->userdata('user_id');
$messages =  $this->db->query('select * from messages where user_id="' . $user_id . '" or receiver_id="' . $user_id . '"')->result_array();
?>
<!--title-->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-message title_icon"></i> <?php echo get_phrase('chat'); ?>
                    <a href="<?php echo site_url('teacher/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle ml-1">Dashboard</a>
                    <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle" onclick="rightModal('<?php echo site_url('modal/popup/chat/create'); ?>', '<?php echo get_phrase('new_mesage'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('new_mesage'); ?></button>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<!-- Displaying chats -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body message_content">
                <?php include 'list.php'; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="messageModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModelLabel">Message From Usman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 id="messageModelMessage">Message</h4>
            </div>

        </div>
    </div>
</div>
<script>
    // console.log(url);
    var showAllMessages = function() {
        var url = '<?php echo route('chat/list'); ?>';
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {

                $('.message_content').html(response);
                initDataTable('basic-datatable');
            }
        });
    }
    $(document).on('click', '.view', function() {
        var sender = $(this).attr("data-sender");
        var message = $(this).attr("data-message");
        $("#messageModelLabel").text("Message From " + sender);
        $('#messageModelMessage').text(message);
        $('#messageModel').modal('show');
    });
</script>