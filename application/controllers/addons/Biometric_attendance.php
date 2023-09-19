<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date    : 3 November, 2019
*  Academy addon
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Biometric_attendance extends CI_Controller
{
  protected $unique_identifier = "biometric-attendance";

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

    /*ADDON SPECIFIC MODEL*/
    $this->load->model('addons/Biometric_attendance_model','biometric_attendance_model');

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
    $page_data['folder_name'] = 'biometric_attendance';
    $page_data['page_title'] = 'biometric_attendance';
    $this->load->view('backend/index', $page_data);
  }

  public function store_excel() {
    $response = $this->biometric_attendance_model->store_excel();
    // LETS CONVERT THE FILE TO CSV
    $this->crud_model->excel_to_csv('uploads/biometric_excel_files/biometric_attendance.xls');
    echo $response;
  }

  public function preview($filtered_date, $filtered_class_id) {
    $page_data['container'] = $this->biometric_attendance_model->preview_csv($filtered_date, $filtered_class_id);
    $page_data['classes'] = $this->crud_model->get_classes()->result_array();
    $this->load->view('backend/'.$this->session->userdata('user_type').'/biometric_attendance/preview', $page_data);
  }

  public function import_biometric_attendance() {
    $response = $this->biometric_attendance_model->import_biometric_attendance();
    echo $response;
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
