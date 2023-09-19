<!--title-->
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title">
          <i class="mdi mdi-format-list-numbered title_icon"></i> <?php echo get_phrase('send_exam_marks'); ?>
          <a href="<?php echo site_url('superadmin/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle mx-1">Dashboard</a>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>

<div class="row">
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mb-3"><?php echo get_phrase('send_exam_marks'); ?></h4>
        <div class="row">
          <div class="col-md-12 mb-1">
            <select name="exam_id" id="exam_id" class="form-control select2" data-toggle="select2" required>
              <option value=""><?php echo get_phrase('select_a_exam'); ?></option>
              <?php $school_id = school_id();
              $exams = $this->db->get_where('exams', array('school_id' => $school_id, 'session' => active_session()))->result_array();
              foreach ($exams as $exam) { ?>
                <option value="<?php echo $exam['id']; ?>"><?php echo $exam['name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-12 mb-1">
            <select name="class_id" id="class_id" class="form-control select2" data-toggle="select2" required onchange="classWiseSection(this.value)">
              <option value=""><?php echo get_phrase('select_a_class'); ?></option>
              <?php
              $classes = $this->db->get_where('classes', array('school_id' => school_id()))->result_array();
              foreach ($classes as $class) {
              ?>
                <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-12 mb-1">
            <select name="section_id" id="section_id" class="form-control select2" data-toggle="select2" required>
              <option value=""><?php echo get_phrase('select_section'); ?></option>
            </select>
          </div>
          <div class="col-md-12 mb-1">
            <select name="receiver" id="receiver" class="form-control select2" data-toggle="select2" required>
              <option value=""><?php echo get_phrase('select_receiver'); ?></option>
              <option value="parent"><?php echo get_phrase('parent'); ?></option>
              <option value="student"><?php echo get_phrase('student'); ?></option>
            </select>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-block btn-secondary" onclick="showAllTheReceivers()"><?php echo get_phrase('show_receivers'); ?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mb-3"><?php echo get_phrase('list_of_receivers'); ?></h4>
        <div class="list_of_receivers">
          <?php include APPPATH . 'views/backend/empty.php'; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mb-3"><?php echo get_phrase('marks_sender'); ?></h4>
        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-block btn-primary" onclick="genericConfirmModal(sendMarksViaEmail)"><?php echo get_phrase('send_marks'); ?></button>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h4 class="header-title mb-3"><?php echo get_phrase('preview'); ?></h4>
        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-block btn-secondary" onclick="largeModal('<?php echo site_url('modal/popup/marksender/preview') ?>', '<?php echo get_phrase('email_preview'); ?>')"><?php echo get_phrase('preview'); ?></button>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h4 class="header-title mb-3"><?php echo get_phrase('instruction'); ?></h4>
        <div class="row mt-2">
          <div class="col-md-12">
            <div class="alert alert-success" role="alert">
              <p><?php echo get_phrase('before_sending_marks_to_the_receivers_please_make_sure_that_you_have_set_up_mail_settings_perfectly'); ?>.</p>
              <p><?php echo get_phrase('you_can_set_mail_settings'); ?> <a href="<?php echo route('smtp_settings'); ?>"> <strong><?php echo get_phrase('here'); ?></strong> </a>.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  $('document').ready(function() {
    initSelect2(['#class_id', '#exam_id', '#section_id', '#receiver']);
  });

  function classWiseSection(classId) {
    $.ajax({
      url: "<?php echo route('section/list/'); ?>" + classId,
      success: function(response) {
        $('#section_id').html(response);
      }
    });
  }

  function showAllTheReceivers() {
    var class_id = $('#class_id').val();
    var section_id = $('#section_id').val();
    var receiver = $('#receiver').val();
    if (class_id != "" && section_id != "" && receiver != "") {
      $.ajax({
        type: "post",
        url: "<?php echo site_url('addons/marksender/show_receivers'); ?>",
        data: {
          class_id: class_id,
          section_id: section_id,
          receiver: receiver
        },
        success: function(response) {
          $('.list_of_receivers').html(response);
        }
      });
    } else {
      toastr.error('<?php echo get_phrase('please_select_the_fields'); ?>');
    }
  }

  var sendMarksViaEmail = function() {
    var class_id = $('#class_id').val();
    var section_id = $('#section_id').val();
    var exam_id = $('#exam_id').val();
    var receiver = $('#receiver').val();
    if (class_id != "" && section_id != "" && exam_id != "" && receiver != "") {
      $.ajax({
        type: "post",
        url: "<?php echo site_url('addons/marksender/send'); ?>",
        data: {
          class_id: class_id,
          section_id: section_id,
          exam_id: exam_id,
          receiver: receiver
        },
        dataType: 'json',
        success: function(response) {
          if (response.status) {
            success_notify(response.notification);
          } else {
            toastr.error(response.notification);
          }
        }
      });
    } else {
      toastr.error('<?php echo get_phrase('please_select_the_fields'); ?>');
    }
  }
</script>