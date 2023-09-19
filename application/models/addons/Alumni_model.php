<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
*  @author   : Creativeitem
*  date    : 3 November, 2019
*  Academy
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/
class Alumni_model extends CI_Model {

	protected $school_id;
	protected $active_session;

	public function __construct()
	{
		parent::__construct();
		$this->school_id = school_id();
		$this->active_session = active_session();
	}

	public function alumni_create()
	{
		$data['name'] = html_escape($this->input->post('name'));
		$data['email'] = html_escape($this->input->post('email'));
		$data['phone'] = html_escape($this->input->post('phone'));
		$data['profession'] = html_escape($this->input->post('profession'));
		$data['student_code'] = html_escape($this->input->post('student_code'));
		$data['session'] = html_escape($this->input->post('session'));
		$data['school_id'] = html_escape($this->input->post('school_id'));
		$data['created_at'] = strtotime(date('d-m-Y'));
		$this->db->insert('alumni', $data);

		$alumni_id = $this->db->insert_id();
		move_uploaded_file($_FILES['alumni_image']['tmp_name'], 'uploads/users/alumni_'.$alumni_id.'.jpg');
		$response = array(
			'status' => true,
			'notification' => get_phrase('alumni_added_successfully')
		);
		return json_encode($response);
	}

	public function alumni_update($alumni_id = '')
	{
		$data['name'] = html_escape($this->input->post('name'));
		$data['email'] = html_escape($this->input->post('email'));
		$data['phone'] = html_escape($this->input->post('phone'));
		$data['profession'] = html_escape($this->input->post('profession'));
		$data['student_code'] = html_escape($this->input->post('student_code'));
		$data['session'] = html_escape($this->input->post('session'));
		$data['school_id'] = html_escape($this->input->post('school_id'));
		$data['updated_at'] = strtotime(date('d-m-Y'));

		$this->db->where('id', $alumni_id);
		$this->db->update('alumni', $data);

		$response = array(
			'status' => true,
			'notification' => get_phrase('alumni_updated_successfully')
		);

		move_uploaded_file($_FILES['alumni_image']['tmp_name'], 'uploads/users/alumni_'.$alumni_id.'.jpg');

		return json_encode($response);
	}

	public function alumni_delete($alumni_id = '')
	{
		$this->db->where('id', $alumni_id);
		$this->db->delete('alumni');

		$response = array(
			'status' => true,
			'notification' => get_phrase('alumni_deleted_successfully')
		);

		$path = 'uploads/users/alumni_'.$alumni_id.'.jpg';
		if(file_exists($path)){
			unlink($path);
		}
		return json_encode($response);
	}

	public function get_alumni() {

		return $this->db->get_where('alumni', array('school_id' => $this->school_id));
	}

	public function get_alumni_by_id($alumni_id = "") {
		$checker = array(
			'id' => $alumni_id
		);
		return $this->db->get_where('alumni', $checker)->row_array();
	}

	public function get_alumni_image($alumni_id = "") {
		if (file_exists('uploads/users/alumni_'.$alumni_id.'.jpg'))
		return base_url().'uploads/users/alumni_'.$alumni_id.'.jpg';
		else
		return base_url().'uploads/users/placeholder.jpg';
	}


	//ALUMNI EVENTS CODE GOES HERE
	public function event_create()
	{
		$data['title'] = html_escape($this->input->post('title'));
		$data['starting_date'] = $this->input->post('starting_date').' 00:00:1';
		$data['ending_date'] = $this->input->post('ending_date').' 23:59:59';
		$data['visibility'] = $this->input->post('visibility');
		$data['school_id'] = $this->school_id;
		$data['session'] = $this->active_session;
		if (isset($_FILES['event_photo']) && !empty($_FILES['event_photo']['name'])) {

			$data['photo'] = random(15).'.jpg';
			move_uploaded_file($_FILES['event_photo']['tmp_name'], 'uploads/images/alumni_events/'.$data['photo']);
		}

		$this->db->insert('alumni_events', $data);

		$response = array(
			'status' => true,
			'notification' => get_phrase('event_has_been_added_successfully')
		);

		return json_encode($response);
	}

	public function event_update($param1 = '')
	{
		$event_previous_data = $this->db->get_where('alumni_events', array('id' => $param1))->row_array();
		$data['title'] = html_escape($this->input->post('title'));
		$data['starting_date'] = $this->input->post('starting_date').' 00:00:1';
		$data['ending_date'] = $this->input->post('ending_date').' 23:59:59';
		$data['visibility'] = $this->input->post('visibility');
		$data['school_id'] = $this->school_id;
		$data['session'] = $this->active_session;
		if (isset($_FILES['event_photo']) && !empty($_FILES['event_photo']['name'])) {
			$data['photo'] = random(15).'.jpg';
			move_uploaded_file($_FILES['event_photo']['tmp_name'], 'uploads/images/alumni_events/'.$data['photo']);
			$this->remove_image('alumni_events', $event_previous_data['photo']);
		}

		$this->db->where('id', $param1);
		$this->db->update('alumni_events', $data);

		$response = array(
			'status' => true,
			'notification' => get_phrase('event_has_been_updated_successfully')
		);

		return json_encode($response);
	}

	public function event_delete($param1 = '')
	{
		$event_previous_data = $this->db->get_where('alumni_events', array('id' => $param1))->row_array();
		$this->db->where('id', $param1);
		$this->db->delete('alumni_events');

		$this->remove_image('alumni_events', $event_previous_data['photo']);
		$response = array(
			'status' => true,
			'notification' => get_phrase('event_has_been_deleted_successfully')
		);

		return json_encode($response);
	}
	public function all_events(){

		$alumni_events = $this->db->get_where('alumni_events', array('school_id' => $this->school_id, 'session' => $this->active_session))->result_array();
		return json_encode($alumni_events);
	}

	public function get_event_image($event_photo) {
		if (file_exists('uploads/images/alumni_events/'.$event_photo))
		return base_url().'uploads/images/alumni_events/'.$event_photo;
		else
		return base_url().'uploads/images/alumni_events/placeholder.jpg';
	}

	// ALUMNI EVENT SECTION ENDS HERE

	// ALUMNI GALLERY SECTION STARTS FROM HERE
	public function gallery_create()
	{
		$data['title'] = html_escape($this->input->post('title'));
		$data['description'] = $this->input->post('description');
		$data['visibility'] = $this->input->post('visibility');
		$data['school_id'] = $this->school_id;
		$data['session'] = $this->active_session;

		$this->db->insert('alumni_gallery', $data);

		$response = array(
			'status' => true,
			'notification' => get_phrase('gallery_has_been_added_successfully')
		);

		return json_encode($response);
	}

	public function gallery_update($param1 = '')
	{
		$data['title'] = html_escape($this->input->post('title'));
		$data['description'] = $this->input->post('description');
		$data['visibility'] = $this->input->post('visibility');
		$data['school_id'] = $this->school_id;
		$data['session'] = $this->active_session;

		$this->db->where('id', $param1);
		$this->db->update('alumni_gallery', $data);



		$response = array(
			'status' => true,
			'notification' => get_phrase('gallery_has_been_updated_successfully')
		);

		return json_encode($response);
	}

	public function gallery_delete($param1 = '')
	{
		$gallery_previous_data = $this->db->get_where('alumni_gallery', array('id' => $param1))->row_array();
		$this->db->where('id', $param1);
		$this->db->delete('alumni_gallery');

		//$this->remove_image('alumni_events', $event_previous_data['photo']);
		$response = array(
			'status' => true,
			'notification' => get_phrase('gallery_has_been_deleted_successfully')
		);

		return json_encode($response);
	}

	public function add_photo_to_gallery($gallery_id = "") {
		if (isset($_FILES['gallery_photo']) && !empty($_FILES['gallery_photo']['name'])) {
			$data['gallery_id'] = $gallery_id;
			$data['photo'] = random(20).'.jpg';
			move_uploaded_file($_FILES['gallery_photo']['tmp_name'], 'uploads/images/alumni_gallery/'.$data['photo']);

			$this->db->insert('alumni_gallery_photos', $data);

			$response = array(
				'status' => true,
				'notification' => get_phrase('gallery_image_has_been_added_successfully')
			);
		}else{
			$response = array(
				'status' => false,
				'notification' => get_phrase('no_image_found')
			);
		}
		return json_encode($response);
	}

	public function get_photos_by_gallery_id($gallery_id) {
		$this->db->where('gallery_id', $gallery_id);
		return $this->db->get('alumni_gallery_photos')->result_array();
	}

	public function get_gallery_image($gallery_photo) {
		if (file_exists('uploads/images/alumni_gallery/'.$gallery_photo))
		return base_url().'uploads/images/alumni_gallery/'.$gallery_photo;
		else
		return base_url().'uploads/images/alumni_gallery/placeholder.jpg';
	}

	public function delete_photo_from_gallery($gallery_photo_id) {
		$gallery_photo_previous_data = $this->db->get_where('alumni_gallery_photos', array('id' => $gallery_photo_id))->row_array();
		$this->db->where('id', $gallery_photo_id);
		$this->db->delete('alumni_gallery_photos');
		$this->remove_image('alumni_gallery', $gallery_photo_previous_data['photo']);
		$response = array(
			'status' => true,
			'notification' => get_phrase('gallery_photo_deleted')
		);
		return json_encode($response);
	}
	// ALUMNI GALLERY SECTION ENDS HERE

	public function remove_image($type = "", $photo = "") {
		$path = 'uploads/images/'.$type.'/'.$photo;
		if(file_exists($path)){
			unlink($path);
		}
	}
}
