<?php
class Owner  extends CI_Controller {

	public function asset(){
		$id = get_cookie("slave_game_user_id");
		$query = $this->db->query('select slave_id from slave where owner_id = $id;');
		$result = $query->result_array();
		$query = $this->db->query('select id, nickname from user where id in $result->slave_id;');
		return $query->result_array();
	}

	public function suspect($target){
		$id = get_cookie("slave_game_user_id");
		$query = $this->db->query('select state from user where id = $target;');
		$state = $query->row()->state;
		if($state == 3){
			$this->db->query('update set state = 6 where id = $target;');
			return "success";
		}else if($state == 4){
			$this->db->query('update set state = 6 where id = $target;');
			break_up($id);
			return "success";
		}else{
			$this->db->query('update set state = 7 where id = $id;');
			return "fail";
		}
	}

	private function break_up($id){
		$flag = $this->db->query('select flag from threat where owner_id = $id;')->row()->flag;
		$this->db->query('update set state = 3 where flag = $flag;');
	}

}
