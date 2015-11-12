<?php

class User extends CI_Controller{

    public function nearby(){
    	$id = get_cookie("slave_game_user_id");
        $states = '(1, 2)';
        $statement = 'select * from user where state in (1, 2) and id != \''. $id.  '\';';
        $query = $this->db->query($statement);
    	echo json_encode($query->result_array());
    }

    public function show(){
    	
    }

    public function update(){

    }
}
