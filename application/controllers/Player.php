<?php

class Player extends CI_Controller {

    public function uuid($trim = false) 
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
        $this->load->database();
        $id = get_cookie("slave_game_user_id");
        if ($id == NULL) { // create new user
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
                'asset' => 0,
                'state' => 1,
            );
            $this->db->insert('user', $data);
        } else if ($nickname != NULL) { // update nickname
            $query = $this->db->get_where('user', array('id'=>$id));
            $data = $query->row();
            $data->nickname = $nickname;
            $this->db->where('id', $data->id);
            $this->db->update('user', $data);
        }
        // get user info and return
        $query = $this->db->get_where('user', array('id'=>$id));
        $data = $query->row();
        echo json_encode($data);
    }
}
