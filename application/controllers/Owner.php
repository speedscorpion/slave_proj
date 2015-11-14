<?php
class Owner  extends CI_Controller {

	public function asset(){
		$id = get_cookie("slave_game_user_id");
		$query = $this->db->query('select slave_id from slave where owner_id = \''.$id.'\';');
		$result = $query->result_array();
		$slaves = [];
		foreach ($result as $item) {
			$slaves[] = $item['slave_id'];
		}
		$this->db->where_in('id', $slaves);
		$data = $this->db->get('user')->result();
		$this->load->view('owner/stand', ['data'=>$data]);
	}

	public function jail(){
		$this->load->view('owner/jail', []);
	}

	public function suspect($target){
		$id = get_cookie("slave_game_user_id");
		$query = $this->db->get_where('user', ['id'=>$target]);
		$state = $query->row()->state;
		if($state == 4){
			$this->eliminate($target, $id);
			echo "success";
		}else if($state == 5){
			$this->eliminate($target, $id);
			$this->break_up($id);
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

	private function break_up($id){
		$flag = $this->db->query('select flag from threat where state = 1 owner_id = \''.$id.'\';')->row()->flag;
		$this->db->query('update set state = 3 where flag = \''.$flag.'\';');
	}

}
