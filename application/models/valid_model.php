<?php
class Valid_model extends CI_Model {
	function valid(){
		$num = addslashes($_POST['num']);
		$au = addslashes($_POST['au'.$num]);
		$arr = array($_POST['res0'], $_POST['res1'], $_POST['res2']);
		$this->load->model('address_model');
		if (is_numeric($arr[0])) {
			$res1 = $this->address_model->get_info_by_ind($arr[0]);
			$res2 = $this->address_model->get_info_by_city($arr[1]);
			$res3 = $this->address_model->get_citys_in_state($arr[2]);
			if (empty($res1) || empty($res2) || empty($res3)){
				echo '<script>document.getElementById("autocomplete-'.$num.'").style.color = "red"</script>';
			} else {
				echo '<script>document.getElementById("autocomplete-'.$num.'").style.color = "black"</script>';
			}
		} else {
			$res1 = $this->address_model->get_info_by_city($arr[0]);
			$res2 = $this->address_model->get_citys_in_state($arr[1]);
			if (empty($res1) || empty($res2)){
				echo '<script>document.getElementById("autocomplete-'.$num.'").style.color = "red"</script>';
			} else {
				echo '<script>document.getElementById("autocomplete-'.$num.'").style.color = "black"</script>';
			}
		}
		
	}
}