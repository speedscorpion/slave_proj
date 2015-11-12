<?php

class User extends CI_Controller{

    public function nearby(){
    	$id = get_cookie("slave_game_user_id");
    	$query = $this->db->query('select id, nickname, state from user where state = 1 or state = 2 and id != $id;');
    	return json_encode($query->result_array());
    }

    public function show(){
    	
    }

    public function update(){

    }
}
