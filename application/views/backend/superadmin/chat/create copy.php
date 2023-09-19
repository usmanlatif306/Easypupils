<?php
$user_id = $this->session->userdata('user_id');
// $users = $this->db->get_where('users')->result_array();
$users =  $this->db->query('select * from users where id!="' . $user_id . '"')->result_array();

?>
<form method="POST" class="d-block ajaxForm" action="<?php echo route('chat/create'); ?>" enctype="multipart/form-data">
    <div class="form-row">

        <input type="hidden" name="session_id" value="<?php echo active_session(); ?>">



        <div class="form-group col-md-12">
            <label for="section_id_on_create"><?php echo get_phrase('User'); ?></label>
            <select class="form-control select2" data-toggle="select2" id="receiver_id" name="receiver_id" required>
                <option value=""><?php echo get_phrase('select_a_user'); ?></option>
                <?php foreach ($users as $user) : ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group col-md-12">
            <label for="message"><?php echo get_phrase('Message'); ?></label>
            <textarea name="message" id="message" cols="30" rows="5" class="form-control" require></textarea>

        </div>

    </div>
    <div class="form-group col-md-12 mt-2">
        <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('send Message'); ?></button>
    </div>
    </div>
</form>

<script>
    $(".ajaxForm").validate({}); // Jquery form validation initialization
    $(".ajaxForm").submit(function(e) {
        var form = $(this);
        ajaxSubmit(e, form, showAllMessages);
    });
    // $(".ajaxForm").validate({}); // Jquery form validation initialization
    // $(".ajaxForm").submit(function(e) {
    //     var form = $(this);
    //     e.preventDefault();
    //     var action = form.attr('action');
    //     var form2 = e.target;
    //     var data = new FormData(form2);
    //     $.ajax({
    //         type: "POST",
    //         url: action,
    //         processData: false,
    //         contentType: false,
    //         dataType: 'json',
    //         data: data,
    //         success: function(response) {
    //             if (response.status) {
    //                 toastr.success(response.notification);
    //                 showAllMessages();
    //                 $('#right-modal').modal('hide');
    //             } else {
    //                 toastr.error(response.notification);
    //             }
    //         }
    //     });
    // });

    $('document').ready(function() {
        initSelect2(['#receiver_id', ]);
    });
</script>