<?php
class link_preview_model extends CI_Model{

    public $user_id;

	public function __construct() {
        parent::__construct();
        $this->load->helper("module_html");
        $this->user_id=$this->session->userdata("user_id");
    }

    function users_favorites($id=null){

    $data=array();
        $this->db->select("id,title");
        $this->db->from("users_favorites");

        if(!empty($id))
        $this->db->where("parentid",$id);
        else
        $this->db->where("parentid",0);

        $this->db->where("registred_by",$this->user_id);
        $this->db->order_by("title","asc");
        
        $q=$this->db->get();

    $data[0] = "Seleccione una carpeta";

    foreach ($q->result_array() as $key => $row) 
        $data[$row["id"]] = $row["title"];

    return $data;
    }

    function update_link($data,$id){

        $this->db->where('id',$id);
        $this->db->update('users_favorites_url',$data);
        return $id;
    }

    function insert_url($data){        

        $this->db->insert('users_favorites_url',$data);
        return $this->db->insert_id();
    }

    function select($id=null){        

        $this->db->select("*");
        $this->db->from("users_favorites_url");

        if(!empty($id))
        $this->db->where("id",$id);

        $this->db->where("registred_by",$this->user_id);
        $q=$this->db->get();
        

        $rows = array();
        foreach($q->result_array() as $r) {

            $r["text"] = HighLight::url($r["text"]);
            $r["description"] = HighLight::url($r["description"]);

            array_push($rows, $r);
        }

        return $rows;

    }

    function delete_it($id){        

        if($this->favorites_your($id)){
        $this->db->where("id",$id);
        $this->db->delete("users_favorites");
        }
    }

}
?>