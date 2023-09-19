<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date      : November, 2019
*  Ekattor School Management System With Addons
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Work_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function save_my_work()
    {
        $file_extension = pathinfo($_FILES['work']['name'], PATHINFO_EXTENSION);
        $data['work'] = md5(rand(10000000, 20000000)) . '.' . $file_extension;
        move_uploaded_file($_FILES['work']['tmp_name'], 'uploads/my_work/' . $data['work']);
        $this->session->set_flashdata('flash_message', "File saved successfully");
        $response = array(
            'status' => true,
            'notification' => get_phrase('File saved successfully')
        );
        return json_encode($response);
    }
}
