<?php
class Car_model extends CI_Model {
	function __construct(){
		$config['hostname'] = 'http://31.128.75.157';
		$config['username'] = 'root';
		$config['password'] = 'qwaszx12QW';
		$config['database'] = 'db';
		$config['dbdriver'] = 'swatmoves';
		$config['dbprefix'] = '';
		$config['pconnect'] = FALSE;
		$config['db_debug'] = TRUE;
		$config['cache_on'] = FALSE;
		$config['cachedir'] = '';
		$config['char_set'] = 'utf8';
		$config['dbcollat'] = 'utf8_general_ci';
		$this->load->database($config);
	}
//all list
	function get_mark_name_all(){										//получаем всех производителей
		$this->db->select('*');
		$this->db->from('car_mark');
		$query = $this->db->get();
		return $query->result();
	}
	function get_class_name_all(){										//получаем все классы
		$this->db->select('*');
		$this->db->from('car_class');
		$query = $this->db->get();
		return $query->result();
	}
//like search
	function get_mark_name_like($mark){									//получаем производителя по части его названия
		$this->db->select('*');
		$this->db->from('car_mark');
		$this->db->where("mark_name LIKE '%$mark%'");
		$query = $this->db->get();
		return $query->result();
	}
	function get_class_name_like($class){								//получаем класс по части его названия
		$this->db->select('*');
		$this->db->from('car_class');
		$this->db->where("class_name LIKE '%$class%'");
		$query = $this->db->get();
		return $query->result();
	}
	function get_model_name_like($model){								//получаем модель по части его названия
		$this->db->select('*');
		$this->db->from('car_model');
		$this->db->where("model_name LIKE '%$model%'");
		$query = $this->db->get();
		return $query->result();
	}
//name search
	function get_model_in_mark($mark){									//получаем по имени производителя какие модели он выпускает
		$this->db->select('*');
		$this->db->from('car_mark');
		$this->db->join('car_model', 'car_model.own_mark = car_mark.id', 'INNER');
		$this->db->where('car_mark.mark_name', $mark);
		$query = $this->db->get();
		return $query->result();
	}
	function get_model_in_class($class){								//получаем по имени класса какие модели к нему относятся
		$this->db->select('*');
		$this->db->from('car_class');
		$this->db->join('car_model', 'car_model.own_class = car_class.id', 'INNER');
		$this->db->where('car_class.class_name', $class);
		$query = $this->db->get();
		return $query->result();
	}
	function get_info_by_model($model){									//получаем по имени модели, к какому классу и производителю она принадлежит
		$this->db->select('*');
		$this->db->from('car_model');
		$this->db->join('car_mark', 'car_mark.id = car_model.own_mark', 'INNER');
		$this->db->join('car_class', 'car_class.id = car_model.own_class', 'INNER');
		$this->db->where('car_model.model_name', $model);
		$query = $this->db->get();
		return $query->result();
	}
//id search
	function get_mark_by_id($mark){										//получаем производителя по его id
		$this->db->select('*');
		$this->db->from('car_mark');
		$this->db->where('car_mark.id', $mark);
		$query = $this->db->get();
		return $query->result();
	}
	function get_class_by_id($class){									//получаем класс по его id
		$this->db->select('*');
		$this->db->from('car_class');
		$this->db->where('car_class.id', $class);
		$query = $this->db->get();
		return $query->result();
	}
	function get_model_by_id($model){									//получаем модель по ее id
		$this->db->select('*');
		$this->db->from('car_model');
		$this->db->where('car_model.id', $model);
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