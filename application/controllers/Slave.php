<?php
class Slave  extends CI_Controller {


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
		if($num > 9)
			return true;
		else
			return false;
	}


    private function be_slave($subject, $object){
        $query = $this->db->get_where('user', ['id'=>$subject]);
        $data = $query->row();
        $data->state = 3;
        $data->asset = 0;
        $this->db->where('id', $subject);
        $this->db->update('user', $data);

        $query = $this->db->get_where('user', ['id'=>$object]);
        $data = $query->row();
        if($data->state == 1 || $data->state == 5)
            $data->state = 2;
        $data->asset = $data->asset + 1;
        $this->db->where('id', $object);
        $this->db->update('user', $data);

        $this->db->insert('slave', ['owner_id'=>$object, 'slave_id'=>$subject]);
    }


    private function get_rid_of_threat($target){
        $query = $this->db->query('select flag from threat where state = 1 and owner_id = \''.$target.'\';');
        if($query->result() != [])
            $this->db->query('update set state = 3 where flag = \''.$query->row()->flag.'\';');
    }

	public function capture($enemy)
    {
        $subject = get_cookie("slave_game_user_id");
        if($subject == NULL)
        	echo 'invalid';
        $result = $this->judge_result($subject, $enemy);
        if($result){
            $this->be_slave($enemy, $subject);
            $this->get_rid_of_threat($enemy);
        	$this->load->view('owner/wall', ['enemy'=>$enemy, 'result'=>true]);
        }else{
            $result = $this->release($subject);
            if($result != []){
                $this->db->where_in('id', $this->get_slave_relation($result));
                $this->db->update('slave',['state'=>2]);

                $this->db->where_in('id', $this->get_slaves($result));
                $this->db->update('user', ['state'=>1]);

                $this->get_rid_of_threat($subject);                
            }
            $this->be_slave($subject, $enemy);
        	$this->load->view('owner/wall', ['enemy'=>$enemy, 'result'=>false]);
        }
    }

	private function add_slave($id, $num){
    	$data = $this->db->get_where('user', ['id'=>$id ])->row();
        if($data->state == 1)
            $data->state = 2;
        $data->asset = $data->asset + $num;
        $this->db->where('id', $id);
    	$this->db->update('user', $data);
    	return $data->asset;
    }

    public function transfer($enemy){
        $id = get_cookie("slave_game_user_id");
    	$result = $this->release($enemy);
        if($result != []){
            foreach ($this->get_slaves($result) as $item) 
                $this->db->insert('slave', ['owner_id'=>$id, 'slave_id'=>$item]);
            $slave_num = $this->add_slave($id, sizeof($result));

            $this->db->where_in('id', $this->get_slaves($result));
            $this->db->update('user', ['state'=>3]);

            $this->db->where_in('id', $this->get_slave_relation($result));
            $this->db->update('slave', ['state'=>2]);
        }
        
        $this->load->view('owner/palace', []);
    }


    private function get_slave_relation($result){
        $ids = [];
        foreach ($result as $item) 
            $ids[] = $item->id;
        return $ids;
    }


    private function get_slaves($result){
        $slaves = [];
        foreach ($result as $item)
            $slaves[] = $item->slave_id;
        return $slaves;
    }

    private function release($enemy){
        $query = $this->db->query('select id, slave_id from slave where state = 1 and owner_id = \''.$enemy. '\';');
        return $query->result();
    }

    public function free($enemy){
    	$subject = get_cookie("slave_game_user_id");
        $result = $this->release($enemy);
        if($result != []){
            $this->db->where_in('id', $this->get_slave_relation($result));
            $this->db->update('slave',['state'=>2]);

            $this->db->where_in('id', $this->get_slaves($result));
            $this->db->update('user', ['state'=>1]);
        }
        
    	$this->load->view('owner/palace', []);
    }


    public function victory(){
        $this->load->view('slave/fire', []);
    }

	public function raise(){
		$id = get_cookie("slave_game_user_id");
		$owner = $this->db->query('select owner_id from slave where state = 1 and slave_id = \''.$id.'\';')->row()->owner_id;
		$query = $this->db->query('select flag, fighter, launcher from threat where state = 1 and owner_id = \''.$owner.'\';');
		$result = $query->result();
		if($result == NULL){
			$uuid = $this->uuid();
            $this->db->insert('threat', ['flag'=>$uuid, 'owner_id'=> $owner, 'launcher'=>$id]);
			$this->db->insert('raise', ['flag'=>$uuid, 'slave_id'=>$id]);
			$this->db->where('id', $id);
            $this->db->update('user', ['state'=>5]);
			echo "我策划了一场起义，希望能干掉这个暴君";
		}else{
			$holder = $query->row();
            $this->db->insert('raise', ['flag'=>$holder->flag, 'slave_id'=>$id]);
            $this->db->where('flag', $holder->flag);
            $this->db->update('threat',['fighter'=>$holder->fighter + 1]);
            $sum = $this->db->get_where('user', ['id'=>$owner])->row()->asset;
            if($holder->fighter + 1 > floor($sum/2)){
                $result = $this->release($owner);
                
                $this->db->where_in('id', $this->get_slaves($result));
                $this->db->update('user', ['state'=>1]);

                $this->db->where_in('id', $this->get_slave_relation($result));
                $this->db->update('slave', ['state'=>2]);

                $this->db->where('flag', $holder->flag);
                $this->db->update('threat', ['state'=>2]);

                $this->be_slave($owner, $holder->launcher);
                echo "victory";
            }else{
                $this->db->where('id', $id);
                $this->db->update('user', ['state'=>4]);
                echo "我参加了一场起义，我要推翻这个暴君";
            }
            
		}
	}


}
