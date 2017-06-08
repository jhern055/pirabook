<?php
class Product_model extends CI_Model{

	public function __construct() {
        parent::__construct();
        $this->user_id=$this->session->userdata("user_id");
    }

    public function get_product_category__($category){

    $data=array();
    $q=$this->db->select("product_id")
                ->where("category_id",$category)
                ->from("product_to_category")
                ->get();

    if(!empty($q->result_array()))
    $data=$q->result_array();

    # Traer los articulos
        if(!empty($data)){
        
            foreach ($data as $k => &$v) {

                $q=$this->db->select("id,name,description,meta_title,meta_description,meta_keyword")
                        ->where("id",$v["product_id"])
                        ->where("status",1)
                        ->where_not_in("stock_status_id ",array(5))
                        ->from("product")
                        ->get();

                if(!empty($q->row_array()))
                $v=array_merge($q->row_array(),$v);
             
            }     

        }                


    // $data["category_data"]=$this->get_menu();
    // $data["module_childrens"]=$this->get_category_childrens($data["category_data"]["id"]);
    
    // $=$this->get_parent($data["category_data"], 10);
    // pr($childrens_cat);

// exit();
    return $data;
    }

    public function category_name_id($category){
        
        $data=array();
        $this->db->select('id,name');
        $this->db->where('id',$category);
        $this->db->where("enabled",1);
        $this->db->from('category');
        $q=$this->db->get();

        if(!empty($q->row_array()))
        $data=$q->row_array();

     return $data;
    }

    // public function get_products_amount($query_search){

    // $this->db->select('id');
    // $this->db->from('product');

    // if(!empty($query_search))
    // foreach ($query_search as $k => $row)
    // eval($row);

    // $q=$this->db->get();

    // return $q->num_rows();

    // }
public function get_products_category_amount($category){

    $data=array();
    $q=$this->db->select("product_id")
                ->where("category_id",$category)
                ->from("product_to_category")
                ->get();

    if(!empty($q->result_array()))
    $data=$q->result_array();


        if(!empty($data)){
        
            foreach ($data as $k => &$v) {

                $this->db->select("id");
                $this->db->where("id",$v["product_id"]);
                $this->db->where("status",1);
                $this->db->where_not_in("stock_status_id ",array(5));

                $this->db->from("product");

                $q=$this->db->get();

                if(!empty($q->row_array()))
                $v=array_merge($q->row_array(),$v);
             
            }     

        }    

    return count($data);

    }

    public function get_products_amount($query_search,$category){

    $data=array();
    $q=$this->db->select("product_id")
                ->where("category_id",$category)
                ->from("product_to_category")
                ->get();

    if(!empty($q->result_array()))
    $data=$q->result_array();


        if(!empty($data)){
        
            foreach ($data as $k => &$v) {

                $this->db->select("id");
                $this->db->where("id",$v["product_id"]);
                $this->db->where("status",1);
                $this->db->where_not_in("stock_status_id ",array(5));

                if(!empty($query_search))
                foreach ($query_search as $k => $row)
                eval($row);

                $this->db->from("product");
                $this->db->order_by("name","asc");

                $q=$this->db->get();

                if(!empty($q->row_array()))
                $v=array_merge($q->row_array(),$v);
             
            }     

        }    

    return count($data);

    }
    public function get_product_category($start,$end,$query_search,$category){

    $data=array();
    $q=$this->db->select("product_id")
                ->where("category_id",$category)
                ->from("product_to_category")
                ->limit($start,$end)
                ->get();

    if(!empty($q->result_array()))
    $data=$q->result_array();


        if(!empty($data)){
        
            foreach ($data as $k => &$v) {

                $this->db->select("id,name,description,meta_title,meta_description,meta_keyword,image,price");
                $this->db->where("id",$v["product_id"]);
                $this->db->where("status",1);
                $this->db->where_not_in("stock_status_id ",array(5));

                if(!empty($query_search))
                foreach ($query_search as $k => $row)
                eval($row);

                $this->db->from("product");
                $this->db->order_by("name","asc");

                $q=$this->db->get();

                if(!empty($q->row_array()))
                $v=array_merge($q->row_array(),$v);
             
            }     

        }    

    return $data;

    }

    public function get_product_id($id){

        $data=array(
        "id"               =>"",
        "name"             =>"",
        "description"      =>"",
        "meta_title"       =>"",
        "meta_description" =>"",
        "meta_keyword"     =>"",
        "image"            =>"",
        "price"            =>"",
        );

    // $q=$this->db->select("id,title")
    $q=$this->db->select(implode(",", array_keys($data)))
                ->where("id",$id)
                ->from("product")
                ->get();

    if($q->result_array())
    foreach ($q->result_array() as $key => $value)
    $data=$value;
    

    // $data["images"]=$this->publication_model->get_publication_images($data["id"]);
    // $data["server_link"]=$this->link_model->get_server_link_id("publication",null,$data["id"]);

    return $data;

    }    
}
?>