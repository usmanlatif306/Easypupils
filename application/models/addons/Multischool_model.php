<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*  @author   : Creativeitem
*  date      : November, 2019
*  Ekattor School Management System With Addons
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/

class Multischool_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function school_create()
	{
		$data['name'] = html_escape($this->input->post('name'));
		$data['address'] = html_escape($this->input->post('address'));
		$data['phone'] = html_escape($this->input->post('phone'));
		$this->db->insert('schools', $data);

		$response = array(
			'status' => true,
			'notification' => get_phrase('school_added_successfully')
		);
		return json_encode($response);
	}

	public function school_update($school_id = '')
	{
		$data['name'] = html_escape($this->input->post('name'));
		$data['address'] = html_escape($this->input->post('address'));
		$data['phone'] = html_escape($this->input->post('phone'));
		$this->db->where('id', $school_id);
		$this->db->update('schools', $data);

		$response = array(
			'status' => true,
			'notification' => get_phrase('school_updated_successfully')
		);
		return json_encode($response);
	}

	public function school_delete($school_id = '')
	{
		$this->db->where('id', $school_id);
		$this->db->delete('schools');

		$response = array(
			'status' => true,
			'notification' => get_phrase('school_deleted_successfully')
		);
		return json_encode($response);
	}

	public function active_school($school_id = '')
	{
		$this->db->where('id', 1);
		$updater = array(
			'school_id' => $school_id
		);
		$this->db->update('settings', $updater);

		$response = array(
			'status' => true,
			'notification' => get_phrase('school_activated_successfully')
		);
		return json_encode($response);
	}
}
