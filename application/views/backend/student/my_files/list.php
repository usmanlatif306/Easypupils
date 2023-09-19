<?php
$user_id = $this->session->userdata('user_id');
$files = $this->db->get_where('my_files', array('user_id' => $user_id))->result_array();
// $files = [];
// var_dump($files);
// exit(1);
if (count($files) > 0) : ?>
    <table id="basic-datatable" class="table table-striped table-hover dt-responsive nowrap" width="100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">File</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files  as $key => $file) : ?>
                <?php
                $sender = $this->user_model->get_user_details($message['user_id'], 'name');
                $receiver = $this->user_model->get_user_details($message['receiver_id'], 'name');
                ?>
                <tr>
                    <th scope="row"><?php echo $key + 1 ?></th>
                    <td><?php echo $file['display_name'] ?></td>
                    <td>
                        <a href="<?php echo base_url('uploads/my_files/' . $file['file']); ?>" class="btn btn-info btn-sm mb-2" download><i class="mdi mdi-download"></i> <?php echo get_phrase('download'); ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <?php include APPPATH . 'views/backend/empty.php'; ?>
<?php endif; ?>