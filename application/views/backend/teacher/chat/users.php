<?php
$school_id = school_id();
$enrols = $this->db->get_where('enrols', array('class_id' => $class_id, 'section_id' => $section_id, 'school_id' => $school_id, 'session' => active_session()))->result_array();

foreach ($enrols as $enroll) : ?>
    <?php
    $student = $this->db->get_where('students', array('id' => $enroll['student_id']))->row_array();
    $parent = $this->db->get_where('parents', array('id' => $student['parent_id']))->row_array();
    ?>
    <!-- parent name -->
    <option value="<?php echo $this->user_model->get_user_details($parent['user_id'], 'id'); ?>"><?php echo $this->user_model->get_user_details($parent['user_id'], 'name'); ?> (Parent)</option>
    <!-- student name -->
    <option value="<?php echo $this->user_model->get_user_details($student['user_id'], 'id'); ?>"><?php echo $this->user_model->get_user_details($student['user_id'], 'name'); ?> (Student)</option>
<?php endforeach; ?>