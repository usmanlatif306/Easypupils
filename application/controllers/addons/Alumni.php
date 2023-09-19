<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date    : 3 November, 2019
*  Academy
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Alumni extends CI_Controller
{

  protected $unique_identifier = "alumni";
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
    $this->load->model('addons/Alumni_model', 'alumni_model');

    /*cache control*/
    $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
    $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
    $this->output->set_header("Pragma: no-cache");

    /*SET DEFAULT TIMEZONE*/
    timezone();

    if ($this->session->userdata('superadmin_login') != 1 && $this->session->userdata('admin_login') != 1 && $this->session->userdata('parent_login') != 1 && $this->session->userdata('teacher_login') != 1 && $this->session->userdata('student_login') != 1) {
      redirect(site_url('login'), 'refresh');
    }

    // CHECK IF THE ADDON IS ACTIVE OR NOT
    $this->check_addon_status();
  }

  // THE MANDATORY INDEX FUNCTION
  public function index()
  {
    $page_data['folder_name'] = 'alumni';
    $page_data['page_title'] = 'alumni';
    $page_data['navigate'] = 'manage_alumni';
    $this->load->view('backend/index', $page_data);
  }

  // CREATE AN ALUMNI
  public function create()
  {
    $response = $this->alumni_model->alumni_create();
    echo $response;
  }

  // UPDATE AN ALUMNI
  public function update($alumni_id = '')
  {
    $response = $this->alumni_model->alumni_update($alumni_id);
    echo $response;
  }

  // DELETE AN ALUMNI
  public function delete($alumni_id = '')
  {
    $response = $this->alumni_model->alumni_delete($alumni_id);
    echo $response;
  }

  // RETURN THE LIST OF ALUMNI
  public function list()
  {
    $this->load->view('backend/' . $this->session->userdata('user_type') . '/alumni/list');
  }


  // ALUMNI EVENTS
  public function events($param1 = "", $param2 = "", $param3 = "")
  {
    // store data on database
    if ($param1 == 'create') {
      $response = $this->alumni_model->event_create();
      echo $response;
    }

    // update data on database
    if ($param1 == 'update') {
      $response = $this->alumni_model->event_update($param2);
      echo $response;
    }

    // delelte data from database
    if ($param1 == 'delete') {
      $response = $this->alumni_model->event_delete($param2);
      echo $response;
    }

    // show data from database
    if ($param1 == 'list') {
      $this->load->view('backend/' . $this->session->userdata('user_type') . '/alumni_event/list');
    }

    // ALL THE EVENTS
    if ($param1 == 'all') {
      echo $this->alumni_model->all_events();
    }

    // showing the index file
    if (empty($param1)) {
      $page_data['folder_name'] = 'alumni_event';
      $page_data['page_title'] = 'events';
      $this->load->view('backend/index', $page_data);
    }
  }

  // ALUMNI EVENTS
  public function gallery($param1 = "", $param2 = "", $param3 = "")
  {
    // store data on database
    if ($param1 == 'create') {
      $response = $this->alumni_model->gallery_create();
      echo $response;
    }

    // update data on database
    if ($param1 == 'update') {
      $response = $this->alumni_model->gallery_update($param2);
      echo $response;
    }

    // delelte data from database
    if ($param1 == 'delete') {
      $response = $this->alumni_model->gallery_delete($param2);
      echo $response;
    }

    // show data from database
    if ($param1 == 'list') {
      $this->load->view('backend/' . $this->session->userdata('user_type') . '/alumni_gallery/list');
    }

    // showing the index file
    if (empty($param1)) {
      $page_data['folder_name'] = 'alumni_gallery';
      $page_data['page_title'] = 'gallery';
      $this->load->view('backend/index', $page_data);
    }
  }

  // GALLERY IMAGE IS HANDLED ON THIS BLOCK OF CODES
  public function gallery_photo($gallery_id = "", $param1 = "", $param2 = "", $param3 = "")
  {
    // store data on database
    if ($param1 == 'add') {
      $response = $this->alumni_model->add_photo_to_gallery($gallery_id);
      echo $response;
    }

    // delelte data from database
    if ($param1 == 'delete') {
      $response = $this->alumni_model->delete_photo_from_gallery($param2);
      echo $response;
    }

    // show data from database
    if ($param1 == 'list') {
      $page_data['gallery_id'] = $gallery_id;
      $this->load->view('backend/' . $this->session->userdata('user_type') . '/alumni_gallery_photo/list', $page_data);
    }

    // showing the index file
    if (empty($param1)) {
      $page_data['folder_name'] = 'alumni_gallery_photo';
      $page_data['page_title'] = 'photos';
      $page_data['gallery_id'] = $gallery_id;
      $this->load->view('backend/index', $page_data);
    }
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
