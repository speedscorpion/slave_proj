<?php

class Player extends CI_Controller {

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

    public function state(){
        $id = get_cookie("slave_game_user_id");
        $this->still_cool($id);
        $query = $this->db->get_where('user', array('id'=>$id));
        $data = $query->row();
        echo $data->state;
    }

    public function change($nickname){
        $id = get_cookie("slave_game_user_id");
        if($id == NULL){
            $data = $this->create_player($nickname);
        }else{
            $query = $this->db->get_where('user', array('id'=>$id));
            $data = $query->row();
            if($nickname != NULL){
                $data->nickname = $nickname;
                $this->db->where('id', $data->id);
                $this->db->update('user', $data);
            }
        }
        $this->load->view("owner/palace", ['user'=>$data]);
    }

    private get_current_owner($id){
        $owner_id = $this->db->query('select owner_id from slave where state = 1 and slave_id = \''.$id.'\');')->row()->owner_id;
        return $this->db->query('select nickname from user where id = \''.$owner_id.'\';')->nickname;
    }

    public function enter()
    {
        $id = get_cookie("slave_game_user_id");
        if ($id == NULL) { // create new user
            $this->load->view('index', []);
            return;
        }
        $query = $this->db->get_where('user', array('id'=>$id));
        $data = $query->row();
        switch ($data->state) {
            case 7:
                $this->still_cool($id);
            case 1:
            case 2:
                $this->load->view("owner/palace", ['user'=> $data]);
                break;
            case 3:
            case 4:
            case 5:
                $this->load->view("slave/square", ['user'=>$data, 'owner_name'=>$this->get_current_owner($id)]);
                break;
            case 6:
                if($this->still_cool($id))
                    $this->load->view("slave/jail", ['user'=> $data]);
                else{
                    
                    $this->load->view("slave/square", ['user'=> $data, 'owner_name'=>$this->get_current_owner($id)]);
                }
                break;
            default:
                break;
        }
        
    }

    private function still_cool($id){
        $query = $this->db->query('select cool, state from user where id = \''.$id . '\';');
        $cool_time = $query->row()->cool;
        $state = $query->row()->state;
        if(time() - $cool_time > 10){
            $this->db->where('id', $id);
            if($state == 7)
                $this->db->update('user', ['state'=>2, 'cool'=>0]);
            if($state == 6)
                $this->db->update('user', ['state'=>3, 'cool'=>0]);
            return false;
        }else{
            return true;
        }
    }

    

    private function create_player($nickname){
        $id = $this->uuid();
            $cookie = array(
                'name' => 'slave_game_user_id',
                'value' => $id,
                'expire' => '2678400', // one month
                'path' => '/',
            );
            set_cookie($cookie);
            if ($nickname == NULL) {
                $nickname = 'Boring Name';
            }
            $data = array(
                'id' => $id,
                'nickname' => $nickname,
                'asset' => 0
            );
        $this->db->insert('user', $data);
        return $data;
    }
}
