<?php

class Like_model extends CI_Model{

    public $user_id="";

	public function __construct() {
        parent::__construct();
        $this->user_id=$this->session->userdata("user_id");
    }

	function insert($data){

        $this->db->insert('publications_like',$data);
        return $this->db->insert_id();
    }

    function delete($id_record,$ip,$type,$option,$id_publication){

        $this->db->where('id_record',$id_record);
        $this->db->where('ip',$ip);
        $this->db->where('type',$type);
        $this->db->where('option',$option);
        $this->db->where('id_publication',$id_publication);

        if(!empty($this->user_id))
        $this->db->where('registred_by',$this->user_id);

        $this->db->delete('publications_like');

    }

    function check_if_there($id_record,$ip,$type,$option,$id_publication){

        $this->db->select('id');
        $this->db->from('publications_like');
        $this->db->where('id_record',$id_record);
        $this->db->where('ip',$ip);
        $this->db->where('type',$type);
        $this->db->where('option',$option);
        $this->db->where('id_publication',$id_publication);

        if(!empty($this->user_id))
        $this->db->where('registred_by',$this->user_id);

        $q=$this->db->get();
        return $q->num_rows();

    }
    function get_likes($id_record,$type,$option,$id_publication){

        $q=$this->db->select('id')
        			->from('publications_like')
                    ->where('id_record',$id_record)
        			->where('id_publication',$id_publication)
                    ->where('type',$type)
                    ->where('option',$option)
        			->get()
        			;
		return $q->num_rows();
    }

// traer los likes de comentario o respuestaspor id
    function get_likes_comm_resp_id($id,$type,$option,$id_publication){

        $q=$this->db->select('id')
                    ->from('publications_like')
                    ->where('id_record',$id)
                    ->where('id_publication',$id_publication)
                    ->where('type',$type)
                    ->where('option',$option)
                    ->get()
                    ;
        // return $this->db->last_query();
        return $q->num_rows();
    }

}