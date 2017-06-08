<?php
class Gossiping_model extends CI_Model{
    

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
// <gossiping>
    public function get_gossiping_amount($query_search){

    $this->db->select('id');
    $this->db->from("gossiping");

    if(!empty($query_search))
    foreach ($query_search as $k => $row)
    eval($row);

    $q=$this->db->get();

    return $q->num_rows();

    }

    public function get_gossiping($start,$end,$query_search){
    $this->load->model("email/email_model");
    $this->load->model("link/link_model");

    $data=array();
    $this->db->select("id,title as name");
    $this->db->from("gossiping");

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
    // $data[$key]["host_server"]=$this->link_model->get_server_link_id("gossiping",null,$row["id"]);
    // foreach ($data[$key]["host_server"] as $keyhost => $server_row)
    $data[$key]["host_server"][$key]["links"]=$this->link_model->get_link_details_by_id("gossiping",null,$row["id"]);
    // </link>

    // // <email>
    // // $data[$key]["emails_sent"]=$this->email_model->get_dad_email("admin/sale/gossiping/",$row["id"]);
    // // </email>

    }
    
    return $data;

    }

    public function get_gossiping_id($id){

    $this->load->model("link/link_model");
    $this->load->model("gossiping/gossiping_model");
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
        "registred_by" =>"",
        "updated_by"   =>"",
        );

    // $q=$this->db->select("id,title")
    $q=$this->db->select(implode(",", array_keys($data)))
                ->where("id",$id)
                ->from("gossiping")
                ->get();

    if($q->result_array())
    foreach ($q->result_array() as $key => $value)
    $data=$value;
    

    $data["images"]=$this->gossiping_model->get_gossiping_images($data["id"]);
    $data["server_link"]=$this->link_model->get_server_link_id("gossiping",null,$data["id"]);

    return $data;

    }
    public function get_gossiping_images($id){

    $data=array();
    $this->db->select("id,filename");
    $this->db->where("gossiping_id",$id);
    $this->db->from("gossiping_file");

    if($q=$this->db->get())
    $data=$q->result_array();

    return $data;
    }

    // mismo registro
    public function record_same_gossiping($data,$id){
        $ac=false;

        if(!empty($id))
        $this->db->where_not_in("id",$id);

        $this->db->where($data);
        $row=$this->db->get("gossiping");
        
        if($row->num_rows())
        $ac=true;    

        return $ac;
    }

    public function update_gossiping($data,$id){
        
        $this->db->where("id",$id);
        $this->db->update("gossiping",$data);

    return $id;
    }

    public function insert_gossiping($data){
        
        $this->db->insert("gossiping",$data);
        
    return $this->db->insert_id();
    }

    public function gossiping_delete_it($id){

        $this->db->where("id",$id);
        if($this->db->delete("gossiping"))
        return true;
    }
    // dbocess images
    public function insert_image_gossiping($data){
        
        $this->db->insert("gossiping_file",$data);
        
    return $this->db->insert_id();
    }
    public function delete_image_gossiping($file_id,$gossiping_id=null){
        
        $this->db->where("id",$file_id);
        $this->db->where("gossiping_id",$gossiping_id);
        $this->db->delete("gossiping_file");
        
    }
    public function delete_all_image_gossiping($gossiping_id){
        
        $this->db->where("gossiping_id",$gossiping_id);
        $this->db->delete("gossiping_file");
        
    }    
// </gossiping>

}
?>