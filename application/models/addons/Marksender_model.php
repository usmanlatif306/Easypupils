<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date      : November, 2019
*  Ekattor School Management System With Addons
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Marksender_model extends CI_Model {

    protected $school_id;
    protected $active_session;

    public function __construct()
    {
        parent::__construct();
        $this->school_id = school_id();
        $this->active_session = active_session();
    }

    public function send_marks() {
        $receiver_name = "";
        $receiver_email = "";
        $receiver_user_type   = $this->input->post('receiver');
        $exam_id    =  $this->input->post('exam_id');
        $class_id   = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');

        $exam_details = $this->crud_model->get_exam_by_id($exam_id);
        $email_subject = get_phrase("marks_of").' '.$exam_details['name'];

        // I AM GONNA COUNT IF ANY MAIL GETS FAILED TO SEND
        $mail_failed_counter = 0;

        $students = $this->user_model->get_student_details_by_id('section', $section_id);
        foreach ($students as $student) {
            if ($receiver_user_type == 'parent') {
                $parent_details = $this->user_model->get_parent_by_id($student['parent_id'])->row_array();
                $receiver_email = $parent_details['email'];
                $receiver_name = $parent_details['name'];
            }else{
                $receiver_email = $student['email'];
                $receiver_name = $student['name'];
            }
            $email_message = get_phrase("hello").', <strong>'.$receiver_name.'</strong>, <br />';
            $email_message .= get_phrase("student_name").': <strong>'.$student['name'].'</strong>,<br/>'.get_phrase('acquired_marks_are_below').'...<br />';
            $email_message .= "<table style = 'border-collapse: collapse; border: 1px solid black; padding: 10px;'>
            <thead>
            <tr>
                <th style = 'border: 1px solid black; padding: 10px;'>".get_phrase('subject_name')."</th>
                <th style = 'border: 1px solid black; padding: 10px;'>".get_phrase('obtained_marks')."</th>
                <th style = 'border: 1px solid black; padding: 10px;'>".get_phrase('comment')."</th>
            </tr>
            </thead>
            <tbody>";

            $checker = array(
                'class_id' => $class_id,
                'section_id' => $section_id,
                'exam_id' => $exam_id,
                'student_id' => $student['student_id'],
                'session' => $this->active_session,
                'school_id' => $this->school_id
            );
            $this->db->where($checker);
            $marks = $this->db->get('marks')->result_array();
            foreach ($marks as $mark) {
                $subject_details = $this->crud_model->get_subject_by_id($mark['subject_id']);
                $email_message .= "<tr>";
                $email_message .= "<td style = 'border: 1px solid black; padding: 10px;'>".$subject_details['name']."</td><td style = 'border: 1px solid black; padding: 10px;'>".$mark['mark_obtained']."</td><td style = 'border: 1px solid black; padding: 10px;'>".$mark['comment']."</td>";
                $email_message .= "</tr>";
            }

            $email_message .= "</tbody></table>";

            $feedback = $this->email_model->send_marks_email($email_message, $email_subject, $receiver_email);
            if (!$feedback) {
                $mail_failed_counter++;

            }
        }
        if ($mail_failed_counter > 0) {
            $response = array(
                'status' => true,
                'notification' => get_phrase('some_mails_are_failed_to_sent')
            );
        }else {
            $response = array(
                'status' => true,
                'notification' => get_phrase('mail_sent_successfully')
            );
        }
        return json_encode($response);
    }

    public function get_student_list($receiver_user_type = "") {
        $receiver_user_type   = $this->input->post('receiver');
        $exam_id    =  $this->input->post('exam_id');
        $class_id   = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $students = $this->user_model->get_student_details_by_id('section', $section_id);
        return $students;
    }
}
