<?php

class User extends CI_Controller{

    public function nearby(){
    	$id = get_cookie("slave_game_user_id");
        $states = '(1, 2)';
        $query = $this->db->get_where('user', ['state in '=>$states, 'id != '=>$id]);
    	return json_encode($query->result_array());
    }

    public function show(){
    	
    }

    public function update(){

    }
}
