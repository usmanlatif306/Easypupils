<?php
$user_id = $this->session->userdata('user_id');
$messages =  $this->db->query('select * from messages where user_id="' . $user_id . '" or receiver_id="' . $user_id . '" ORDER BY created_at DESC')->result_array();


if (count($messages) > 0) : ?>
    <table id="basic-datatable" class="table table-striped table-hover dt-responsive nowrap" width="100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Sender</th>
                <th scope="col">Receiver</th>
                <th scope="col">Time</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $key => $message) : ?>
                <?php
                $sender = $this->user_model->get_user_details($message['user_id'], 'name');
                $receiver = $this->user_model->get_user_details($message['receiver_id'], 'name');
                ?>
                <tr>
                    <th scope="row"><?php echo $key + 1 ?></th>
                    <td><?php echo $sender ?></td>
                    <td><?php echo $receiver ?></td>
                    <td><?php echo $message['created_at'] ?></td>
                    <td>
                        <span class="pointer font-large mr-2 view" title="View Message" data-sender="<?php echo $sender ?>" data-message="<?php echo $message['message'] ?>"><i class="mdi mdi-eye"></i></span>
                        <a href="javascript:void(0);" class="font-large" onclick="confirmModal('<?php echo route('chat/delete/' . $message['id']); ?>', showAllMessages)"><i class="mdi mdi-delete text-danger"></i></a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <?php include APPPATH . 'views/backend/empty.php'; ?>
<?php endif; ?>