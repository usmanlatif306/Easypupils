<?php if (count($students) > 0): ?>
  <?php if ($receiver == 'parent'): ?>
    <div class="table-responsive-sm">
      <table class="table table-bordered table-centered table-sm mb-0">
        <thead>
          <tr>
            <th><?php echo get_phrase('parent').' ('.get_phrase('receiver').')'; ?></th>
            <th><?php echo get_phrase('student'); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($students as $student): ?>
            <tr>
              <td>
                <?php
                  $parent_details = $this->user_model->get_parent_by_id($student['parent_id'])->row_array();
                  echo "<b>".$parent_details['name']."</b><br/><small>".get_phrase('email').': <strong>'.$parent_details['email']."</strong></small>";
                ?>
              </td>
              <td>
                <?php
                  echo $student['name'];
                ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="table-responsive-sm">
      <table class="table table-bordered table-centered table-sm mb-0">
        <thead>
          <tr>
            <th><?php echo get_phrase('student').' ('.get_phrase('receiver').')'; ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($students as $student): ?>
            <tr>
              <td>
                <?php
                  echo "<b>".$student['name']."</b><br/><small>".get_phrase('email').": <strong>".$student['email']."</strong></small>";
                ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
<?php else: ?>
  <?php include APPPATH.'views/backend/empty.php'; ?>
<?php endif; ?>
