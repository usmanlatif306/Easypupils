<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date    : 6 July, 2020
*  Ekattor
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Live_class extends CI_Controller
{

    protected $unique_identifier = "live-class";
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
        $this->load->model('addons/Live_class_model', 'live_class_model');

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

    public function shop()
    {
        var_dump("hello");
        exit(1);
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
