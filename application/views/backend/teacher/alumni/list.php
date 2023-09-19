<?php
$school_id = school_id();
$alumni = $this->alumni_model->get_alumni()->result_array();
if (count($alumni) > 0): ?>
<table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
  <thead>
    <tr style="background-color: #313a46; color: #ababab;">
      <th><?php echo get_phrase('name'); ?></th>
      <th><?php echo get_phrase('image'); ?></th>
      <th><?php echo get_phrase('email'); ?></th>
      <th><?php echo get_phrase('phone'); ?></th>
      <th><?php echo get_phrase('profession'); ?></th>
      <th><?php echo get_phrase('passing_session'); ?></th>
      <th><?php echo get_phrase('options'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($alumni as $alumnus): ?>
      <tr>
        <td>
          <?php echo $alumnus['name']; ?><br><small> <strong><?php echo get_phrase('student_code'); ?> : </strong> <?php echo null_checker($alumnus['student_code']); ?> </small>
        </td>
        <td>
          <img class="rounded-circle" width="50" height="50" src="<?php echo $this->alumni_model->get_alumni_image($alumnus['id']); ?>">
        </td>
        <td><?php echo $alumnus['email']; ?></td>
        <td><?php echo $alumnus['phone']; ?></td>
        <td><?php echo ucfirst($alumnus['profession']); ?></td>
        <td>
          <?php
            $session_details = $this->crud_model->get_session($alumnus['session'])->row_array();
            echo $session_details['name'];
          ?>
        </td>
        <td>
          <div class="dropdown text-center">
            <button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/alumni/edit/'.$alumnus['id'])?>', '<?php echo get_phrase('update_alumni'); ?>');"><?php echo get_phrase('edit'); ?></a>
              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo site_url('addons/alumni/delete/'.$alumnus['id']); ?>', showAllAlumni)"><?php echo get_phrase('delete'); ?></a>
            </div>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
  <?php include APPPATH.'views/backend/empty.php'; ?>
<?php endif; ?>
