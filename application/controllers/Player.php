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

    public function enter($nickname=NULL)
    {
        
        $id = get_cookie("slave_game_user_id");
        if ($id == NULL) { // create new user
            $data = $this->create_player($nickname);
            $data['state'] = 1;
        }else{
            // get user info and return
            $query = $this->db->get_where('user', array('id'=>$id));
            $data = $query->row();
            if($nickname != NULL){
                $data->nickname = $nickname;
                $this->db->where('id', $data->id);
                $this->db->update('user', $data);
            }
        }
        switch ($data->state) {
            case 1:
            case 2:
            case 7:
                $this->load->view("owner/palace", []);
                break;
            case 3:
            case 4:
            case 5:
                $this->load->view("slave/square", []);
                break;
            case 6:
                $this->load->view("slave/jail", []);
                break;
            default:
                break;
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
