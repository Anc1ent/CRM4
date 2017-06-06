<?php
class Car_class_db_model extends CI_Model {
	function car_class_db(){
		$this->load->model('car_model');
		$res = $this->car_model->get_class_name_all();
		echo '<option disabled selected>Select Make</option>';
		foreach ($res as $row) {
			echo '<option value="'.$row->id.'">'.$row->class_name.'</option>';
		}
	}
}