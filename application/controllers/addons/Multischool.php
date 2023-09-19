<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date      : November, 2019
*  Ekattor School Management System With Addons
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Multischool extends CI_Controller
{

    protected $unique_identifier = "multi-school";

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
        $this->load->model('addons/Multischool_model','multischool_model');
        /*cache control*/
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
        $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache");

        /*SET DEFAULT TIMEZONE*/
        timezone();
        
        if($this->session->userdata('superadmin_login') != 1){
            redirect(site_url('login'), 'refresh');
        }

        // CHECK IF THE ADDON IS ACTIVE OR NOT
        $this->check_addon_status();
    }

    // THE MANDATORY INDEX FUNCTION
    public function index() {
        $page_data['folder_name'] = 'multi_school';
        $page_data['page_title'] = 'school_manager';
        $this->load->view('backend/index', $page_data);
    }

    // CREATE A SCHOOL
    public function create() {
        $response = $this->multischool_model->school_create();
        echo $response;
    }

    // UPDATE A SCHOOL
    public function update($alumni_id = '') {
        $response = $this->multischool_model->school_update($alumni_id);
        echo $response;
    }

    // DELETE A SCHOOL
    public function delete($school_id = '') {
        $response = $this->multischool_model->school_delete($school_id);
        echo $response;
    }

    // MAKE ACTIVE A SCHOOL
    public function activate($school_id = '') {
        $response = $this->multischool_model->active_school($school_id);
        echo $response;
    }

    // RETURN THE LIST OF SCHOOL
    public function list() {
        $this->load->view('backend/'.$this->session->userdata('user_type').'/multi_school/list');
    }


    // CHECK WHETHER THE ADDON IS INSTALLED AND ACTIVE
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
