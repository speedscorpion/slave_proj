<?php
class Hello  extends CI_Controller {


private function uuid($trim = false) 
    {

        $format = ($trim == false) ? '%04x%04x-%04x-%04x-%04x-%04x%04x%04x' : '%04x%04x%04x%04x%04x%04x%04x%04x';

        return sprintf($format,
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
    
	private function judge_result($subject, $object){
		$num = rand(0, 9);
		if(num > 4)
			return true;
		else
			return false;
	}
	public function capture($enemy)
    {
        $subject = get_cookie("slave_game_user_id");
        if($subject == NULL)
        	return 'invalid';
        $result = $this->judge_result($subject, $enemy);
        if($result){
        	$this->load('owner/palace', []);
        }else{
        	$this->load('slave/squqre', []);
        }
    }

	public function add_slave($id, $num){
    	$this->db->query('update user set state = 2 where id = $subject;');
    	$query = $this->db->query('select asset from user where id = $subject;');
    	$salve_num = $query->row()->asset;
    	$slave_num = $slave_num + $num;
    	$this->db->query('update user set asset = $slave_num where id = $subject;');
    	return $slave_num;
    }

    public function tansfer($enemy){
    	$result = free($enemy);
    	foreach ($result as $item) {
    		$this->db->query('insert into slave(owner_id, slave_id) values($subject, $item->slave_id);');
    	}
    	
    	return add_salve($subject, $result->size());
    }

    public function free($enemy){
    	$subject = get_cookie("slave_game_user_id");
    	$query = $this->db->query('select id, slave_id from slave where state = 1 and owner_id = $enemy;');
    	$result = $query->result_array();
    	$this->db->query('update slave set state = 2 where id in $result->id;');
    	return $reuslt;
    }

	public function raise(){
		$id = get_cookie("slave_game_user_id");
		$owner = $this->db->query('select owner_id form slave where slave_id = $id and state = 1;')->row()->owner_id;
		$query = $this->db->query('select flag from threat, fighter where owner_id = $owner and state = 1;');
		$result = $query->result();
		if($result == null){
			$uuid = create_uuid();
			$this->db->query('insert into threat(flag, owner_id, launcher) values($uuid, $owner, $id)');
			$this->db->query('insert into raise(flag, slave_id) values($uuid, $id);');
			$this->db->query('update user set state = 5 where id = $id;');
			return "lead";
		}else{
			$holder = $query->row();
			$threat = $holder->flag;
			$fighter = $holder->num + 1;
			$this->db->query('update set fighter = $fighter where flag = $threat;');
			$this->db->query('insert into raise(flag, slave_id) values($threat, $id);');
			$this->db->query('update user set state = 4 where id = $id;');
			return "join";
		}
	}


}
