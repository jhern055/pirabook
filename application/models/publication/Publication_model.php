<?php
class Publication_model extends CI_Model{
    

	public function __construct() {
        parent::__construct();
        $this->user_id=$this->session->userdata("user_id");
        
    }

    public function m_name($uri_string){

    $data=array();
    $q=$this->db->select("id,name,link")
                ->where("link",$uri_string)
                ->from("modules")
                ->get();

        if($q->result_array())
        foreach ($q->result_array() as $key => $value):
            $data=$value;
        endforeach;

    return $data;
    }
// <publication>
    public function get_publication_amount($query_search){

    $this->db->select('id');
    $this->db->from("publications");

    if(!empty($query_search))
    foreach ($query_search as $k => $row)
    eval($row);

    $q=$this->db->get();

    return $q->num_rows();

    }

    public function get_publication($start,$end,$query_search){
    $this->load->model("email/email_model");
    $this->load->model("link/link_model");

    $data=array();
    $this->db->select("id,title as name,status");
    $this->db->from("publications");

    if(!empty($query_search))
    foreach ($query_search as $k => $row)
    eval($row);

    $this->db->limit($start,$end);

    $this->db->order_by("id","asc");
    if($q=$this->db->get())
    $data=$q->result_array();

    if(!empty($data))
    foreach ($data as $key => $row) {

    // <link>
    // $data[$key]["host_server"]=$this->link_model->get_server_link_id("publication",null,$row["id"]);
    // foreach ($data[$key]["host_server"] as $keyhost => $server_row)
    $data[$key]["host_server"][$key]["links"]=$this->link_model->get_link_details_by_id("publication",null,$row["id"]);
    // </link>

    // // <email>
    // // $data[$key]["emails_sent"]=$this->email_model->get_dad_email("admin/sale/publication/",$row["id"]);
    // // </email>

    }
    
    return $data;

    }

    public function get_publication_id($id){

    $this->load->model("link/link_model");
    $this->load->model("publication/publication_model");
    $this->load->model("config/config_model");

        $data=array(
        'id'           =>"",
        "title"        =>"",
        "description"  =>"",
        "category"     =>"",
        "sub_category" =>"",
        "email"        =>"",
        "password"     =>"",
        "url_facebook" =>"",
        "price"        =>"",
        "views"        =>"",
        "ip"           =>"",
        "email_sent"   =>"",
        "like_sure"    =>"",
        "is_sale"      =>"",
        "status"      =>"",
        "registred_by" =>"",
        "updated_by"   =>"",
        );

    // $q=$this->db->select("id,title")
    $q=$this->db->select(implode(",", array_keys($data)))
                ->where("id",$id)
                ->from("publications")
                ->get();

    if($q->result_array())
    foreach ($q->result_array() as $key => $value)
    $data=$value;
    

    $data["images"]=$this->publication_model->get_publication_images($data["id"]);
    $data["server_link"]=$this->link_model->get_server_link_id("publication",null,$data["id"]);

    return $data;

    }
    public function get_publication_images($id){

    $data=array();
    $this->db->select("id,filename");
    $this->db->where("publication_id",$id);
    $this->db->from("publications_file");

    if($q=$this->db->get())
    $data=$q->result_array();

    return $data;
    }

    // mismo registro
    public function record_same_publication($data,$id){
        $ac=false;

        if(!empty($id))
        $this->db->where_not_in("id",$id);

        $this->db->where($data);
        $row=$this->db->get("publications");
        
        if($row->num_rows())
        $ac=true;    

        return $ac;
    }

    public function update_publication($data,$id){
        
        $this->db->where("id",$id);
        $this->db->update("publications",$data);

    return $id;
    }

    public function insert_publication($data){
        
        $this->db->insert("publications",$data);
        
    return $this->db->insert_id();
    }

    public function publication_delete_it($id){

        $this->db->where("id",$id);
        if($this->db->delete("publications"))
        return true;
    }
    // dbocess images
    public function insert_image_publication($data){
        
        $this->db->insert("publications_file",$data);
        
    return $this->db->insert_id();
    }
    public function delete_image_publication($file_id,$publication_id=null){
        
        $this->db->where("id",$file_id);
        $this->db->where("publication_id",$publication_id);
        $this->db->delete("publications_file");
        
    }
    public function delete_all_image_publication($publication_id){
        
        $this->db->where("publication_id",$publication_id);
        $this->db->delete("publications_file");
        
    }    
// </publication>

}
?>