<?php

class Email_model extends CI_Model{

	public function __construct() {
        parent::__construct();
    }

    function send_increment($id_publication,$num_send){
        if(!empty($id_publication)){
            $q=$this->db->select("email_sent")
                ->from("publications")
                ->where('id', $id_publication)
                ->limit(1)
                ->get()
                ->result()
                ;
            $email_sent=array('email_sent' => $q[0]->email_sent+1 );

            $this->db->where('id', $id_publication);
            $this->db->update('publications', $email_sent); 
            return $email_sent;
        }
    }

    function get_data($q){
        $data=array();
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $row) {
                $data[$row["id"]] = $row;
            }
            return $data;
        }
        return false;
    }

}
