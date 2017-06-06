<?php
class Car_model_db_model extends CI_Model {
	function car_model_db(){
		$str = addslashes($_POST['str']);
		$this->load->model('car_model');
		$res = $this->car_model->get_model_in_mark($str);
		echo '<option disabled selected>Select Model</option>';
		foreach ($res as $row) {
			echo '<option value="'.$row->id.'" onclick="document.getElementById(\'step3\').style.display = \'inline\';">'.$row->model_name.'</option>';
		}
	}
}