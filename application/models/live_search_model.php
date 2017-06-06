<?php
class Live_search_model extends CI_Model {
	function live_search(){
		$str = addslashes($_POST['str']);
        $i = addslashes($_POST['i']);
        $str2 = addslashes($_POST['str2']);
		echo '<ul class="drop-list" id="drop-list'.$i.'">';
		if (!empty($str)) {
			$this->load->model('address_model');
			if (preg_match('/[0-9]{1,}/', $str)) {
				$res = $this->address_model->get_ind_name_like($str);
				$x = 0;
    			foreach ($res as $row) {
    				$x++;
    				echo '<li id="item_a'.$i.'_'.$x.'" onclick="document.getElementById(\'autocomplete-'.$i.'\').value = this.innerHTML; document.getElementById(\'result_list_'.$i.'\').style.display=\'none\'">'.$row->ind_name;
    				$inf = $this->address_model->get_info_by_ind($row->ind_name);
    				foreach ($inf as $val) {
    					echo ', '.$val->city_name.', '.$val->state_name.'</li>';
    				}
    				if ($x==5) break;
    			}
    		} else {
				$res = $this->address_model->get_citys_name_like($str);
				$x = 0;
    			foreach ($res as $row) {
    				$x++;
    				echo '<li id="item_a'.$i.'_'.$x.'" onclick="document.getElementById(\'autocomplete-'.$i.'\').value = this.innerHTML; document.getElementById(\'result_list_'.$i.'\').style.display=\'none\'">'.$row->city_name;
    				$inf = $this->address_model->get_state_by_id($row->own_state);
    				foreach ($inf as $val) {
    					echo ', '.$val->state_name.'</li>';
    				}
    				if ($x==5) break;
    			}
    		}
    	}
    	echo '</ul>';
	}
}