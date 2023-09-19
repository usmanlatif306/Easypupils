<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date    : 6 July, 2020
*  Ekattor
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Online_exam extends CI_Controller
{

    protected $unique_identifier = "online-exam";
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

        /*LOADING ALL THE MODELS HERE*/
        $this->load->model('Crud_model',     'crud_model');
        $this->load->model('User_model',     'user_model');
        $this->load->model('Settings_model', 'settings_model');
        $this->load->model('Payment_model',  'payment_model');
        $this->load->model('Email_model',    'email_model');
        $this->load->model('Addon_model',    'addon_model');
        $this->load->model('Frontend_model', 'frontend_model');

        /*ADDON SPECIFIC MODELS*/
        $this->load->model('addons/online_exam_model', 'online_exam_model');

        /*cache control*/
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
        $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache");

        /*SET DEFAULT TIMEZONE*/
        timezone();

        // CHECK IF THE ADDON IS ACTIVE OR NOT
        $this->check_addon_status();
    }

    // THE MANDATORY INDEX FUNCTION
    // INDEX FUNCTION WILL ONLY BE AVAILABLE TO TEACHER AND STUDENT
    public function index()
    {
        if ($this->session->userdata('teacher_login') != 1 && $this->session->userdata('student_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['folder_name'] = 'online_exam';
        $page_data['page_title'] = 'your_online_exam';
        $page_data['navigate'] = 'online_exam';
        $this->load->view('backend/index', $page_data);
    }

    // RETURN THE LIST OF LIVE CLASSES AND STUDENT
    public function list()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $this->load->view('backend/' . $this->session->userdata('user_type') . '/live_class/list');
    }

    // Create FUNCTION WILL ONLY BE AVAILABLE TO TEACHER
    public function create()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['folder_name'] = 'online_exam';
        $page_data['page_title'] = 'arrange_a_online_exam';
        $page_data['page_name'] = 'create';
        $page_data['navigate'] = 'add_new';
        $this->load->view('backend/index', $page_data);
    }

    // STORE FUNCTION WILL ONLY BE AVAILABLE TO TEACHER
    public function store()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $response = $this->online_exam_model->store();
        echo $response;
    }

    // UPDATE FUNCTION WILL ONLY BE AVAILABLE TO TEACHER
    public function update()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $response = $this->online_exam_model->update();
        echo $response;
    }

    // DELETE FUNCTION WILL ONLY BE AVAILABLE TO TEACHER
    public function delete($id)
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $response = $this->online_exam_model->delete($id);
        echo $response;
    }

    // SENDMAIL FUNCTION WILL ONLY BE AVAILABLE TO TEACHER
    public function sendmail()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $response = $this->online_exam_model->sendmail();
        echo $response;
    }

    // START FUNCTION WILL STAR THE MEETING
    public function start($id)
    {
        if ($this->session->userdata('teacher_login') != 1 && $this->session->userdata('student_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $user_type = $this->session->userdata('user_type');
        $live_class_details = $this->online_exam_model->get_live_class_by_id($id);

        if ($live_class_details->num_rows() > 0) {
            $live_class_details = $live_class_details->row_array();
            $teacher_details = $this->user_model->get_user_details($live_class_details['teacher_id']);
            $page_data['page_title'] = 'on_going';
            $page_data['teacher_details'] = $teacher_details;
            $page_data['live_class_details'] = $live_class_details;
            $page_data['class_details'] = $this->db->get_where('classes', array('id' => $live_class_details['class_id']))->row_array();
            $page_data['subject_details'] = $this->db->get_where('subjects', array('id' => $live_class_details['subject_id']))->row_array();
            $page_data['logged_user_details'] = $this->user_model->get_user_details($this->session->userdata('user_id'));
            $page_data['live_class_settings'] = $this->online_exam_model->get_live_class_settings($live_class_details['teacher_id']);
            $this->load->view("backend/$user_type/online_exam/meeting", $page_data);
        } else {
            redirect(site_url('addons/online_exam'), 'refresh');
        }
    }

    // SETTINGS FUNCTION FOR ZOOM
    // SETTINGS FUNCTION WILL ONLY BE AVAILABLE TO ADMIN AND SUPERADMIN
    public function settings($action = "")
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }

        $page_data['folder_name'] = 'online_exam';
        $page_data['page_name'] = 'settings';
        $page_data['page_title'] = 'online_exam_settings';
        $page_data['navigate'] = 'manage_alumni';
        $this->load->view('backend/index', $page_data);
    }

    // UPDATE SETTINGS FUNCTION FOR UPDATING ZOOM SETTINGS
    // UPDATE SETTINGS FUNCTION WILL ONLY BE AVAILABLE TO ADMIN AND SUPERADMIN
    public function update_settings()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $response = $this->online_exam_model->update_settings();
        $this->session->set_flashdata('success_message', get_phrase('online_exam_settings_updated_successfully'));
        redirect(site_url('addons/online_exam/settings'), 'refresh');
        //echo $response;
    }



    // CHECK IF THE ADDON IS ACTIVE OR NOT. IF NOT REDIRECT TO DASHBOARD
    public function check_addon_status()
    {
        $checker = array('unique_identifier' => $this->unique_identifier);
        $this->db->where($checker);
        $addon_details = $this->db->get('addons')->row_array();
        if ($addon_details['status']) {
            return true;
        } else {
            $controller = "";
            if ($this->session->userdata('user_type') == 'parent') {
                $controller = 'parents';
            } else {
                $controller = $this->session->userdata('user_type');
            }
            redirect(site_url($controller), 'refresh');
        }
    }
}
