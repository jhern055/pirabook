<?php
class Googlee_model extends CI_Model{

    public function __construct() {
        parent::__construct();
    }

    public function hosting_server_id($publication){
    $data=array("id"=>"");
        
        $this->db->select("id");
        $this->db->from("publications_hosting_server");
        $this->db->where("publication_id",$publication);
        $q=$this->db->get();

        if($q->result_array())
        foreach ($q->result_array() as $key => $value) {
        $data=$value;
        }

    return $data["id"];
    }
    public function select_rar_name($rar_name){

    $data=array();
        $this->db->select("id,title");
        $this->db->from("publications");
        $this->db->where("rar_name",$rar_name);

        $q=$this->db->get();
        // if(!$q->result_array())
        // pr($this->db->last_query());
            
        foreach ($q->result_array() as $key => $row){
        $data["title"]= $row["title"];
        $data["id"]= $row["id"];
        }

    if(empty($data)){
        $this->db->select("id,title");
        $this->db->from("publications");

        $rar_name=trim(str_replace("_www.pirabook.com","", $rar_name));
        $title=ucwords(desencript_name($rar_name));
        $title = preg_replace('/\s+/', ' ', $title);  

        $this->db->where("title",$title);

        $q=$this->db->get();
        // if(!$q->result_array())
        // pr($this->db->last_query());
            
        foreach ($q->result_array() as $key => $row){
        $data["title"]= $row["title"];
        $data["id"]= $row["id"];
        }        
    }
        
    // si ya tiene url de descarga quitarlo
    if(!empty($data)){
            $this->db->select("id");
            $this->db->from("publications_hosting_server_link");
            $this->db->where("publication",$data["id"]);
            $q=$this->db->get();

            if($q->num_rows()>=1)
            $data="";
    }

    return $data;
    }

    public function real_not_found_rar_name($rar_name){

    $data=array();
        $this->db->select("id,title");
        $this->db->from("publications");
        $this->db->where("rar_name",$rar_name);

        $q=$this->db->get();
        // if(!$q->result_array())
        // pr($this->db->last_query());
            
        foreach ($q->result_array() as $key => $row){
        $data["title"]= $row["title"];
        $data["id"]= $row["id"];
        }

    if(empty($data)){
        $this->db->select("id,title");
        $this->db->from("publications");

        $rar_name=trim(str_replace("_www.pirabook.com","", $rar_name));
        $title=ucwords(desencript_name($rar_name));
        $title = preg_replace('/\s+/', ' ', $title);  

        $this->db->where("title",$title);

        $q=$this->db->get();
        // if(!$q->result_array())
        // pr($this->db->last_query());
            
        foreach ($q->result_array() as $key => $row){
        $data["title"]= $row["title"];
        $data["id"]= $row["id"];
        }        
    }
        
    return $data;
    }

    // function update_link($data,$id){

    //     $this->db->where('id',$id);
    //     $this->db->update('users_favorites_url',$data);
    //     return $id;
    // }

    // function insert_link($data){        

    //     $this->db->insert('users_favorites_url',$data);
    //     return $this->db->insert_id();
    // }

    // function update_folder($data,$id){

    //     $this->db->where('id',$id);
    //     $this->db->update('users_favorites',$data);
    //     return $id;
    // }

}
?>