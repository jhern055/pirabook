<?php

class Email_model extends CI_Model{

    public $registred_by;
    public $now;

	public function __construct() {
        parent::__construct();
        $this->registred_by=$this->security->xss_clean($this->session->userdata("user_id"));
        $this->now = date("Y-m-d H:i:s");

    }

    public function emails_sent($source_module,$id_record,$emailExplode){

        $data["number_of_times"]="";
        $this->db->select("number_of_times");
        $this->db->where('id_record', $id_record);
        $this->db->where('source_module', $source_module);

        $this->db->where('registred_by', $this->registred_by);

        $this->db->from("emails_sent");
        $this->db->limit(1);
        $q=$this->db->get();

        // return $this->db->last_query();

        if($q->num_rows()){

        foreach ($q->result_array() as $key => $row)
        $data=$row;

        $data_depend=array("updated_by" =>$this->registred_by,"updated_on" =>$this->now);
        }
        else
        $data_depend=array("registred_by" =>$this->registred_by,"registred_on" =>$this->now);
        
        $number_of_times=array(
            'number_of_times' => (!empty($data["number_of_times"])?$data["number_of_times"]+1:1),
            'source_module' => $source_module,
            'id_record' => $id_record,
            'emails' => (!empty($emailExplode)?implode(",", $emailExplode):""),
             );
        $number_of_times=array_merge($data_depend,$number_of_times);

        if($q->num_rows()){

        $this->db->where('registred_by', $this->registred_by);

        $this->db->where('source_module', $source_module);
        $this->db->where('id_record', $id_record);
        $this->db->update('emails_sent', $number_of_times); 

        }else
        $this->db->insert('emails_sent', $number_of_times); 

        return true;
    }


    public function get_dad_email($source_module,$id_record){

        $data=array();
        $this->load->model("config/config_model");

        $this->db->where('source_module',$source_module);
        $this->db->where('id_record',$id_record);
        $this->db->from('emails_sent');

        if($q=$this->db->get())
        $data=$q->result_array();
        
        if($data)
        foreach ($data as $key => $row) {
            if(!empty($row["updated_by"]))
            $data[$key]["registred_name"]=$this->config_model->get_user_id($row["updated_by"]);
            else
            $data[$key]["registred_name"]=$this->config_model->get_user_id($row["registred_by"]);
        }
        
        return $data;
    }

    public function get_data($q){
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
