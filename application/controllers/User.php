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
    	$id = get_cookie("slave_game_user_id");
        $this->load->view('show', $this->get_data($id));
    }

    private function get_data($id){
        $data = [];
        $query = $this->db->query('select * from slave where owner_id = \''.$id.'\';');
        $data['owner_record'] = $query->result();
        $query = $this->db->query('select * from slave where slave_id = \''.$id.'\';');
        $data['slave_record'] = $query->result();
        $query = $this->db->query('select count(*) from threat where state = 3 and owner_id = \''.$id.'\';');
        $data['handle_count'] = $query->row()->count(*);
        $query = $this->db->query('select count(*) from threat where state = 2 and flag in (select flag from raise where slave_id = \''.$id.'\');');
        $data['raise_count'] = $query->row()->count(*);
        return $data;
    }

    public function state($player)
    {
        $this->load->view('show', $this->get_data($player));
    }

}
