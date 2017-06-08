<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Link_model extends CI_Model{

    // public $db;

	public function __construct() {
        parent::__construct();
    }

    public function m_name($uri_string){
    // $s=$this->load->database("default");

    // $data=array();
    // $q=$s->select("id,name,link")
    //             ->where("link",$uri_string)
    //             ->from("modules")
    //             ->get();

    //     if($q->result_array())
    //     foreach ($q->result_array() as $key => $value):
    //         $data=$value;
    //     endforeach;

    // return $data;
    }

    public function get_hosting_servers(){

        $data=array();
        $this->db->select('*');

        $this->db->from("hosting_servers");

        if($q=$this->db->get())
        foreach ($q->result_array() as $key => $value) {
        $data[$value["id"]]=$value["name"] ;
        }

        return $data;        
    }

    public function get_publications_hosting_server($publication_id){

        $data=array();
        $this->db->select('*');
        $this->db->where('publication_id',$publication_id);

        $this->db->from("publications_hosting_server");

        if($q=$this->db->get())
        foreach ($q->result_array() as $key => $value) {
        $data[$value["id"]]=$value["description"] ;
        }

        return $data;        
    }
    // trear el detalle de registro
    public function get_server_link_id($module,$id,$id_record){

        if(empty($module)) return;
        $data=array();
        $this->db->select('*');

        if(!empty($id))
        $this->db->where("id",$id);

        if($module=="publication"):
        $this->db->where("publication_id",$id_record);
        $this->db->from("publications_hosting_server");
        endif;

        if($q=$this->db->get())
        foreach ($q->result_array() as $key => $value) {
        $data =$value ;
        }

        return $data;
    }



    public function get_link_details_by_id($module,$id,$id_record){

        if(empty($module)) return;
        $data=array();
        $this->db->select('*');

        if(!empty($id))
        $this->db->where_not_in("id",$id);

        if($module=="publication"):
        $this->db->where("publication",$id_record);
        $this->db->from("publications_hosting_server_link");
        $this->db->order_by("publications_hosting_server_id", "asc");

        endif;

        $q=$this->db->get();

        $data = $q->result_array();

        // if($module=="publication"):
        //     array_sort_by_column($data,"publications_hosting_server_id",SORT_ASC);
        // endif;

        return $data;
    }

    public function record_links_there($module,$id){

        $this->db->select('id');
        $this->db->where('id',$id);
        
        if($module=="publication")
        $q=$this->db->get("publications_hosting_server_link");

        return $q->num_rows();
    }

    public function update_links($module,$data,$id_record,$id){

        $this->db->where('id',$id);

        if($module=="publication")
        $this->db->update("publications_hosting_server_link",$data);

        return $id;
    }

    public function insert_links($module,$data){

        if($module=="publication")
        $this->db->insert("publications_hosting_server_link",$data);

        return $this->db->insert_id();
    }

    public function delete_links($module,$id_record,$timestamp){

        if($module=="publication")
        $this->db->where("publication",$id_record);

        if($module=="publication")
        $this->db->delete("publications_hosting_server_link");

    }

    public function delete_link_it($module,$id,$id_record){

        $this->db->where('id',$id);
        
        if($module=="publication")
        $this->db->where("publication",$id_record);

        if($module=="publication")
        $this->db->delete("publications_hosting_server_link");

        return true;
    }

    public function get_pirabook_links($module,$id,$id_record){

        $data=array();
        if(empty($id))
        return $data;

        $this->db->where('id',$id);
        $this->db->select('*');

        if($module=="publication")
        $this->db->where("publication",$id_record);

        if($module=="publication"){
        $this->db->from("publications_hosting_server_link");
            
        }

        $q=$this->db->get();
        $data=$q->result_array();

        if($module=="publication"){
            array_sort_by_column($data,"publications_hosting_server_id",SORT_ASC);            
        }
        return $data;
    }

    public function select_dad_links($module,$id_record){

        $data=array();
        $this->db->select("id,import,link");
        $this->db->where('id',$id_record);

        if($module=="publication")
        $this->db->from("publications");

        $q=$this->db->get();

        foreach ($q->result_array() as $k => $v)
        $data=$v;

        return $data;
    }

    public function update_dad_links($module,$data,$id_record){

        $this->db->where('id',$id_record);

        if($module=="publication")
        $this->db->update("publication",$data);

        return $id_record;
    }
// </details>

    public function get_pirabook_grups_link($module,$id,$id_record){

        $this->db->where('id',$id);
        $this->db->select('*');

        $this->db->from("publications_hosting_server");

        $q=$this->db->get();
        $data=$q->result_array();

        return $data;
    }
    public function record_group_link_there($module,$id){

        $this->db->select('id');
        $this->db->where('id',$id);
        
        if($module=="publication")
        $q=$this->db->get("publications_hosting_server_link");

        return $q->num_rows();
    }

    public function update_group_link($data,$id_record,$id){

        $this->db->where('id',$id);

        $this->db->update("publications_hosting_server",$data);

        return $id;
    }

    public function insert_group_link($data){

        $this->db->insert("publications_hosting_server",$data);

        return $this->db->insert_id();
    }

    public function delete_group_link($id,$id_record){

        $this->db->where("publications_hosting_server_id",$id);
        $this->db->where("publication",$id_record);
        $this->db->from("publications_hosting_server_link");
        $q=$this->db->get();

        if($q->num_rows())
        return false;
            
        $this->db->where("id",$id);
        $this->db->where("publication_id",$id_record);
        $this->db->delete("publications_hosting_server");

        return true;
    }

    public function delete_groups_link($id_record){

        $this->db->where("publication_id",$id_record);
        $this->db->delete("publications_hosting_server");

    }

    public function get_group_links($id,$id_record){

        $data=array();
        $this->db->select('*');

        if(!empty($id))
        $this->db->where("id",$id);

        $this->db->where("publication_id",$id_record);
        $this->db->from("publications_hosting_server");
        $this->db->order_by("description", "asc");

        $q=$this->db->get();

        $data = $q->result_array();

        return $data;
    }
    public function there_title_name($title){

        $q=$this->db->select('id')
                    ->from('publications')
                    ->where('title',$title)
                    ->get()
                    ;
        return $q->num_rows();
    }
    public function there_title_name_rows($title){

        $q=$this->db->select('id')
                    ->from('publications')
                    ->where('title',$title)
                    ->get()
                    ;
        if(!empty($q->result_array()))
        return $q->result_array()[0];
    }
    public function update_rar_name($data,$title){

        $this->db->where('title',$title);
        // $this->db->where('category',0);
        // $this->db->where('sub_category',0);
        // $this->db->where('email',"");
        // $this->db->where('registred_by',0);
        // $this->db->where('registred_on',"0000-00-00 00:00:00");
        // $this->db->where('updated_on',"0000-00-00 00:00:00");
        $this->db->update('publications',$data);
        // $this->db->delete('publications');

    }

    public function there_link($original,$publication){

        $q=$this->db->select('id')
                    ->from('publications_hosting_server_link')
                    ->where('original',$original)
                    ->where('publication',$publication)
                    ->get()
                    ;
        return $q->num_rows();
    }
    
    public function publication_update($data,$publication){
        $this->db->where('id',$publication);
        $this->db->update('publications',$data);

    }

    public function link_insert_sinc($data){

        // $this->db->where('publications_hosting_server_id',$data["publications_hosting_server_id"]);
        // $this->db->where('hosting_servers_id',$data["hosting_servers_id"]);
        // $this->db->where('registred_by',0);
        // $this->db->where('description',1);
        // // $this->db->where('original',"");
        // $this->db->where('registred_on',"0000-00-00 00:00:00");
        // $this->db->where('updated_on',"0000-00-00 00:00:00");
        
        // $this->db->where('publication',$data["publication"]);
        // $this->db->where('original',$data["original"]);
        // $this->db->delete('publications_hosting_server_link');
        
        $this->db->insert('publications_hosting_server_link',$data);
    }
}