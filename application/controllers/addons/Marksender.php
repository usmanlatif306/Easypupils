<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date      : November, 2019
*  Ekattor School Management System With Addons
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Marksender extends CI_Controller
{
    protected $unique_identifier = "marksender";

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

        /*ADDON SPECIFIC MODELS ARE HERE*/
        $this->load->model('addons/Marksender_model','marksender_model');
        /*cache control*/
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
        $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache");

        /*SET DEFAULT TIMEZONE*/
        timezone();

        if($this->session->userdata('superadmin_login') != 1 && $this->session->userdata('admin_login') != 1 && $this->session->userdata('teacher_login') != 1){
            redirect(site_url('login'), 'refresh');
        }
        // CHECK IF THE ADDON IS ACTIVE OR NOT
        $this->check_addon_status();
    }

    public function index() {
        $page_data['folder_name'] = 'marksender';
        $page_data['page_title'] = 'send_marks';
        $this->load->view('backend/index', $page_data);
    }

    public function send() {
        $response = $this->marksender_model->send_marks();
        echo $response;
    }

    public function show_receivers() {
        $page_data['class_id'] = $this->input->post('class_id');
        $page_data['section_id'] = $this->input->post('section_id');
        $page_data['receiver'] = $this->input->post('receiver');
        $page_data['students'] = $this->marksender_model->get_student_list();
        $this->load->view('backend/'.$this->session->userdata('user_type').'/marksender/receivers', $page_data);
    }

    // CHECK IF THE ADDON IS ACTIVE OR NOT. IF NOT REDIRECT TO DASHBOARD
    public function check_addon_status() {
        $checker = array('unique_identifier' => $this->unique_identifier);
        $this->db->where($checker);
        $addon_details = $this->db->get('addons')->row_array();
        if ($addon_details['status']) {
            return true;
        }else{
            $controller = "";
            if($this->session->userdata('user_type') == 'parent'){
                $controller = 'parents';
            } else{
                $controller = $this->session->userdata('user_type');
            }
            redirect(site_url($controller), 'refresh');
        }
    }
}
