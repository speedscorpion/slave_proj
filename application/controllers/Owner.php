<?php
class Owner  extends CI_Controller {

	public function asset(){
		$id = get_cookie("slave_game_user_id");
		$query = $this->db->query('select nickname, id from user where state != 6 and id in (select slave_id from slave where state = 1 and owner_id = \''.$id.'\');');
		$this->load->view('owner/stand', ['data'=>$query->result()]);
	}

	public function jail(){
		$id = get_cookie("slave_game_user_id");
		$query = $this->db->query('select nickname, id form user where state = 6 and id in (select slave_id from slave where state = 1 and owner_id = \''.$id.'\');');
		$this->load->view('owner/jail', ['data'=>$query->result()]);
	}

	public function suspect($target){
		$id = get_cookie("slave_game_user_id");
		$query = $this->db->get_where('user', ['id'=>$target]);
		$state = $query->row()->state;
		if($state == 4){
			$this->eliminate($target, $id);
			echo "success";
		}else if($state == 5){
			$this->break_up($id, $target);
			echo "success";
		}else{
			$this->db->where('id', $id);
			$this->db->update('user', ['state'=>7, 'cool'=>time()]);
			echo "fail";
		}
	}

	private function eliminate($target, $owner){
		$this->db->where('id', $target);
		$this->db->update('user', ['state'=>6, 'cool'=>time()]);
		$query = $this->db->query('select flag, fighter from threat where state = 1 and owner_id = \''. $owner. '\';');
		$data = $query->row();
		$this->db->where('flag', $data->flag);
		$this->db->update('threat', ['fighter'=>$data->fighter - 1]);
	}

	private function break_up($id, $target){
		$flag = $this->db->query('select flag from threat where state = 1 and owner_id = \''.$id.'\';')->row()->flag;
		$this->db->query('update threat set state = 3 where flag = \''.$flag.'\';');
		$query = $this->db->query('update user set state = 3 where id in (select slave_id from raise where flag = \''.$flag. '\');');

		$this->db->where('id', $target);
		$this->db->update('user', ['state'=>6, 'cool'=>time()]);
	}

}
