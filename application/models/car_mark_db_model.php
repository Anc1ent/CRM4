<?php
class Car_mark_db_model extends CI_Model {
	function car_mark_db(){
		$this->load->model('car_model');
		$res = $this->car_model->get_mark_name_all();
		echo '<option disabled selected>Select Make</option>';
		foreach ($res as $row) {
			echo '<option value="'.$row->id.'" onmouseup="car_model_all(\''.$row->mark_name.'\')">'.$row->mark_name.'</option>';
		}
	}
}