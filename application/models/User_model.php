<?php

class User_model extends CI_Model{

	public function __construct() {
        parent::__construct();
    }

    function get_user(){

    $user_id=$this->session->userdata("user_id"); 

    if($user_id):
        $q=$this->db->select('rights')
        			->from('users')
                    ->where('id',$user_id)
        			->limit('1')
        			->get();

        return $q->result_array()[0]["rights"];         
    endif;
          
    }

}