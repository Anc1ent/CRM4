<?php
class Address_model extends CI_Model {
	function __construct(){
		$config['hostname'] = 'localhost';
		$config['username'] = 'root';
		$config['password'] = 'qwaszx12QW';
		$config['database'] = 'swatmoves';
		$config['dbdriver'] = 'mysqli';
		$config['dbprefix'] = '';
		$config['pconnect'] = FALSE;
		$config['db_debug'] = TRUE;
		$config['cache_on'] = FALSE;
		$config['cachedir'] = '';
		$config['char_set'] = 'utf8';
		$config['dbcollat'] = 'utf8_general_ci';
		$this->load->database($config);
	}
//like search
	function get_state_name_like($state){								//получаем штат по части его названия
		$this->db->select('*');
		$this->db->from('addr_state');
		$this->db->where("state_name LIKE '$state%'");
		$query = $this->db->get();
		return $query->result();
	}
	function get_citys_name_like($city){								//получаем город по части его названия
		$this->db->select('*');
		$this->db->from('addr_city');
		$this->db->where("city_name LIKE '$city%'");
		$query = $this->db->get();
		return $query->result();
	}
	function get_ind_name_like($ind){									//получаем индекс по части его названия
		$this->db->select('*');
		$this->db->from('addr_ind');
		$this->db->where("ind_name LIKE '$ind%'");
		$query = $this->db->get();
		return $query->result();
	}
//name search
	function get_citys_in_state($state){								//получаем по имени штата какие города в нем находятся
		$this->db->select('*');
		$this->db->from('addr_state');
		$this->db->join('addr_city', 'addr_city.own_state = addr_state.id', 'INNER');
		$this->db->where('addr_state.state_name', $state);
		$query = $this->db->get();
		return $query->result();
	}
	function get_info_by_city($city){									//получаем по имени города к какому штату принадлежит город, и какие индексы относятся к нему
		$this->db->select('*');
		$this->db->from('addr_city');
		$this->db->join('addr_state', 'addr_state.id = addr_city.own_state', 'INNER');
		$this->db->join('addr_ind', 'addr_ind.own_city = addr_city.id', 'INNER');
		$this->db->where('addr_city.city_name', $city);
		$query = $this->db->get();
		return $query->result();
	}
	function get_info_by_ind($ind){										//получаем по имени индекса к какому городу и штату принадлежит индекс
		$this->db->select('*');
		$this->db->from('addr_ind');
		$this->db->join('addr_state', 'addr_state.id = addr_ind.own_state', 'INNER');
		$this->db->join('addr_city', 'addr_city.id = addr_ind.own_city', 'INNER');
		$this->db->where('addr_ind.ind_name', $ind);
		$query = $this->db->get();
		return $query->result();
	}
//id search
	function get_state_by_id($state){									//получаем штат по его id
		$this->db->select('*');
		$this->db->from('addr_state');
		$this->db->where('addr_state.id', $state);
		$query = $this->db->get();
		return $query->result();
	}
	function get_city_by_id($city){										//получаем город по его id
		$this->db->select('*');
		$this->db->from('addr_city');
		$this->db->where('addr_city.id', $city);
		$query = $this->db->get();
		return $query->result();
	}
	function get_index_by_id($ind){										//получаем индекс по его id
		$this->db->select('*');
		$this->db->from('addr_ind');
		$this->db->where('addr_ind.id', $ind);
		$query = $this->db->get();
		return $query->result();
	}
//redirect
	function search_db(){												//перенаправляем, какой функции надо обрабатывать запрос, на основе выбранного поля выпадающего списка
		$this->load->helper('url');
		$option = $this->input->post('option');
		$value = $this->input->post('search_txt');
		$this->$option($value);
	}
}