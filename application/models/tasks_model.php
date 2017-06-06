<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks_model extends CI_Model{

///////////////////////////
//Работа с пользователями//
///////////////////////////

	// Получить информацию по пользователю
	function get_user($uid){
		$this->db->where('id', $uid);
		$query = $this->db->get('PM_users');
		return $countQ = $query->row();
	}

	// Получить пользователя по email
	function get_user_by_email($uemail){
		$this->db->where('email', $uemail);
		$query = $this->db->get('PM_users');
		return $countQ = $query->row(); 
	}

	// Добавить нового пользователя
	function add_new_user($addArray){
		$this->db->insert('PM_users', $addArray);
		return $this->db->insert_id();
	}

	// Заменям значение пользователя
	function update_user($uid, $updateArray){
		$this->db->where('id', $uid);
		$this->db->update('PM_users', $updateArray);
	}

/////////////////////
//Работа с задачами//
/////////////////////

	// Получение задач по user_id
	function get_tasks_by_uid($uid){
		$this->db->select('*');
		$this->db->from('PM_tasks');
		$this->db->where('PM_tasks.uid', $uid);
		$this->db->order_by('atDate', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Получение задач по owner
	function get_tasks_by_owner($own){
		$this->db->select('*');
		$this->db->from('PM_tasks');
		$this->db->where('PM_tasks.owner', $own);
		$this->db->order_by('atDate', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Получение задач по parent_id
	function get_tasks_by_parent($parent){
		$this->db->select('t.*, u1.nickname as wnickname, u1.email as wemail, u2.nickname as onickname, u2.email as oemail');
		$this->db->from('PM_tasks as t');
		$this->db->join('PM_users as u1', 'u1.id=t.uid', 'LEFT');
		$this->db->join('PM_users as u2', 'u2.id=t.owner', 'LEFT');
		$this->db->where('t.parentid', $parent);
		$this->db->order_by('t.atDate', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Удаление задачи
	function delete_task_by_id($id){
		$this->db->where('id', $id);
		$this->db->delete('PM_tasks');
	}

	// This my task
	function update_task($id, $name, $value){
		$this->db->where('id', $id);
		$this->db->update('PM_tasks', array($name => $value));
	}

	// Добавить новую задачу
	function add_new_task($addArray){
		$this->db->insert('PM_tasks', $addArray);
		return $this->db->insert_id();
	}

	// Получение всех задач
	function get_tasks_all(){
		$this->db->select('t.*, u1.nickname as wnickname, u1.email as wemail, u2.nickname as onickname, u2.email as oemail');
		$this->db->from('PM_tasks as t');
		$this->db->join('PM_users as u1', 'u1.id=t.uid', 'LEFT');
		$this->db->join('PM_users as u2', 'u2.id=t.owner', 'LEFT');
		$this->db->order_by('t.atDate', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

//////////////////////////
//Работа с комментариями//
//////////////////////////

	// Получение всех комментариев
	function get_comments_all(){
		$this->db->select('c.*, u1.nickname as wnickname, u1.email as wemail');
		$this->db->from('PM_coments as c');
		$this->db->join('PM_users as u1', 'u1.id=c.uid', 'LEFT');
		$this->db->order_by('c.atDate', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Получение комментариев по t_id
	function get_comments_by_tid($tid){
		$this->db->select('c.*, u1.nickname as wnickname, u1.email as wemail');
		$this->db->from('PM_coments as c');
		$this->db->join('PM_users as u1', 'u1.id=c.uid', 'LEFT');
		$this->db->where('c.tid', $tid);
		$this->db->order_by('c.atDate', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// Получение комментариев по id
	function get_comment_by_id($id){
		$this->db->select('c.*, u1.nickname as wnickname, u1.email as wemail');
		$this->db->from('PM_coments as c');
		$this->db->join('PM_users as u1', 'u1.id=c.uid', 'LEFT');
		$this->db->where('c.id', $id);
		$this->db->order_by('c.atDate', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Получение комментариев по u_id
	function get_comments_by_uid($uid){
		$this->db->select('*');
		$this->db->from('PM_coments');
		$this->db->where('PM_coments.uid', $uid);
		$this->db->order_by('atDate', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Получение комментариев по status
	function get_comments_by_status($status){
		$this->db->select('*');
		$this->db->from('PM_coments');
		$this->db->where('PM_coments.status', $status);
		$this->db->order_by('atDate', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Добавить новый комментарий
	function add_new_comment($addArray){
		$this->db->insert('PM_coments', $addArray);
		return $this->db->insert_id();
	}

	// Удаление комментария
	function delete_comment_by_id($id){
		$this->db->where('id', $id);
		$this->db->delete('PM_coments');
	}
}