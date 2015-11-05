<?php

class Hello  extends CI_Controller {

	public function index()
	{
		$query = $this->db->query("select * from test;");
		$result = 1;
		foreach($query->result() as $row)
		{
			$result = $result + 1;
		}
		echo $result;
	}
}
