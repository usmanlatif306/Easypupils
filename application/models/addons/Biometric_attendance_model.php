<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
*  @author   : Creativeitem
*  date    : 3 November, 2019
*  Academy
*  http://codecanyon.net/user/Creativeitem
*  http://support.creativeitem.com
*/
class Biometric_attendance_model extends CI_Model {

	protected $school_id;
	protected $active_session;

	public function __construct()
	{
		parent::__construct();
		$this->school_id = school_id();
		$this->active_session = active_session();
	}

	public function store_excel() {
		if (!empty($_FILES['biometric_attendance_file']['name'])) {
			move_uploaded_file($_FILES['biometric_attendance_file']['tmp_name'], 'uploads/biometric_excel_files/biometric_attendance.xls');

			$response = array(
				'status' => true,
				'notification' => get_phrase('file_uploaded_successfully')
			);

		}else{
			$response = array(
				'status' => false,
				'notification' => get_phrase('invalid_file')
			);
		}

		return json_encode($response);
	}

	public function preview_csv($filtered_date, $filtered_class_id) {
		$container = array(); // THIS ARRAY WILL WRAP BELOW TWO ARRAYS
		$student_and_status = array();
		$dates = array();
		if (($handle = fopen('assets/csv_file/exception_stat.csv', 'r')) !== FALSE) { // Check the resource is valid
			$count = 0;
			while (($all_data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Check opening the file is OK!

				if($count > 2){
					if ($all_data[0] > 0) {
						$student_id = $all_data[0];
						$date = $all_data[3];
						$entry_time = $all_data[4];
						$out_time = $all_data[5];
						$student_details = $this->user_model->get_student_details_by_id('student', $student_id);
						if ($filtered_date == 0 && $filtered_class_id == 0) {
							$filtered_date = $date;
							$filtered_class_id = $student_details['class_id'];
						}
						$status = false;
						if ($entry_time != "" || $out_time != "") {
							$status = true;
						}
						if ($filtered_class_id == $student_details['class_id'] && $filtered_date == $date) {
							array_push($student_and_status, array('student_id' => $student_details['student_id'], 'name' => $student_details['name'], 'status' => $status));
						}

						if (!in_array($date, $dates)) {
							array_push($dates, $date);
						}
					}
				}
				$count++;
			}
			fclose($handle);
		}

		$container['dates'] = $dates;
		$container['student_and_status'] = $student_and_status;
		$container['filtered_date'] = $filtered_date;
		$container['filtered_class_id'] = $filtered_class_id;
		return $container;
	}

	public function import_biometric_attendance() {
		$response = $this->crud_model->excel_to_csv('uploads/biometric_excel_files/biometric_attendance.xls');
		if ($response) {
			if (($handle = fopen('assets/csv_file/exception_stat.csv', 'r')) !== FALSE) { // Check the resource is valid
				$count = 0;
				while (($all_data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Check opening the file is OK!
					if($count > 2){
						if ($all_data[0] > 0) {
							$student_id = $all_data[0];
							$date = $all_data[3];
							$entry_time = $all_data[4];
							$out_time = $all_data[5];
							$student_details = $this->user_model->get_student_details_by_id('student', $student_id);
							if (count($student_details)) {
								$data['timestamp'] = strtotime($date);
								$data['class_id']  = $student_details['class_id'];
								$data['section_id']  = $student_details['section_id'];
								$data['student_id']  = $student_details['id'];
								if ($entry_time != "" || $out_time != "") {
									$data['status']  = 1;
								}else{
									$data['status']  = 0;
								}
								$data['session_id']  = active_session();
								$data['school_id']  = school_id();

								$checker = array(
									'timestamp' => $data['timestamp'],
									'class_id'  => $data['class_id'],
									'section_id' => $data['section_id'],
									'student_id' => $data['student_id'],
									'session_id' => $data['session_id'],
									'school_id' => $data['school_id'],
								);
								$this->db->where($checker);
								$previous_data = $this->db->get('daily_attendances', $checker);
								if ($previous_data->num_rows() > 0) {
									$previous_data = $previous_data->row_array();
									if ($previous_data['status'] == 0) {
										$this->db->where('id', $previous_data['id']);
										$this->db->update('daily_attendances', $data);
									}
								}else{
									$this->db->insert('daily_attendances', $data);
								}
							}
						}
					}
					$count++;
				}
				fclose($handle);
			}

			$response = array(
				'status' => true,
				'notification' => get_phrase('biometric_attendance_imported_successfully')
			);

		}else{
			$response = array(
				'status' => false,
				'notification' => get_phrase('an_error_occurred')
			);
		}

		return json_encode($response);
	}
}
