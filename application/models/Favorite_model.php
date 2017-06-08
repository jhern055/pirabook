<?php
class Favorite_model extends CI_Model{

    public $user_id;

	public function __construct() {
        parent::__construct();
        $this->load->helper("module_html");
        $this->user_id=$this->session->userdata("user_id");
    }

    function get_my_favorites(){

    $menu = array(
        'menus' => array(),
        'parent_menus' => array()
    );

    $q=$this->db->select("id,title,link,parentid")
                ->from("users_favorites")
	    		->where("registred_by",$this->user_id)
                ->order_by("title","asc")
	    		->get();
    foreach ($q->result_array() as $key => $row) {

        //creates entry into menus array with current menu id ie. $menus['menus'][1]
        $menu['menus'][$row['id']] = $row;
        //creates entry into parent_menus array. parent_menus array contains a list of all menus with children
        $menu['parent_menus'][$row['parentid']][] = $row['id'];
    }

    return $menu;
    }

    function get_my_favorites_favorite(){

    $my_favorites=$this->get_my_favorites();
    $data=array();
    foreach ($my_favorites as $key => $value)
    	$data[$value["module"]]=$value["module"];

    	if(!empty($data));
	    return $data;
    }

    function get_it_html(){

	$my_favorites=$this->get_my_favorites_favorite();
	$my_favorites_array=$this->get_my_favorites();
    $html=modules_html_list($my_favorites,$html="",false,false,false,$my_favorites_array);
    return $html;
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

    function insert_link($data){        

        $this->db->insert('users_favorites_url',$data);
        return $this->db->insert_id();
    }

    function update_folder($data,$id){

        $this->db->where('id',$id);
        $this->db->update('users_favorites',$data);
        return $id;
    }

    function insert_folder($data){        

        $this->db->insert('users_favorites',$data);
        return $this->db->insert_id();
    }

    function favorites_your($id){        

        $this->db->select("id,title");
        $this->db->from("users_favorites");

        $this->db->where("id",$id);

        $this->db->where("registred_by",$this->user_id);
        $q=$this->db->get();
        
        if($q->result())
        return true;
        else
        return false;

    }

    function url_your($id){        

        $this->db->select("id");
        $this->db->from("users_favorites_url");

        $this->db->where("id",$id);

        $this->db->where("registred_by",$this->user_id);
        $q=$this->db->get();
        
        if($q->result())
        return true;
        else
        return false;

    }
    function delete_it($id){        

        if($this->favorites_your($id)){
        $this->db->where("id",$id);
        $this->db->delete("users_favorites");
        }
    }

    function delete_url_it($id){        

        if($this->url_your($id)){
        $this->db->where("id",$id);
        $this->db->delete("users_favorites_url");
        }
    }

    function favorite_relation($id){        
    
    $text="";

    // ///////////////////////////////////////////7
        $this->db->select("id");
        $this->db->from("users_favorites");
        $this->db->where("parentid",$id);

        $this->db->where("registred_by",$this->user_id);
        $q=$this->db->get();
        
        if($q->result())
        $text="Tiene carpetas creadas dentro de esta categoria";

    if($text)
    return $text;
    // ///////////////////////////////////////////7

        $this->db->select("id");
        $this->db->from("users_favorites_url");
        $this->db->where("users_favorites",$id);

        $this->db->where("registred_by",$this->user_id);
        $q=$this->db->get();

        if($q->result())
        $text="Tiene favoritos creados";

    if($text)
    return $text;
    // ///////////////////////////////////////////7
        
    return false;
    }

    // traer los links de favoritos
    function get_links($limit=null, $start=null,$id_menu){        

    $data=array();

        $this->db->select("id,text,image,title,canonicalUrl,url,description,iframe,users_favorites");
        $this->db->from("users_favorites_url");

        $this->db->where("users_favorites",$id_menu);

        $this->db->limit($limit, $start);

        $this->db->where("registred_by",$this->user_id);
        $q=$this->db->get();
        
        $c=1;
        if($q->result_array())
        foreach ($q->result_array as $k => $v):
         $data[$v["users_favorites"]]["folder"]=$v["users_favorites"];
         $data[$v["users_favorites"]]["links"][$v["id"]]=$v;
         // $data[$v["users_favorites"]]["links_amount"]=$c++;
        endforeach;

    // amount
     $data[$id_menu]["links_amount"]=$this->get_links_amount($id_menu);
    //nombre del folder 
    if(!empty($data[$id_menu]["folder"]))
    foreach ($data as $k => &$v):
       $this->db->select("id,title")
                ->from("users_favorites")
                ->where("registred_by",$this->user_id)
                ->where("id",$v["folder"]);
    $q=$this->db->get();

    if($q->result_array()[0]["title"])
    $v["folder_name"]=$q->result_array()[0]["title"];
    endforeach; 
    // .............
    
    return  $data;

    }

    // contar los registros  con lo que venga de POST
    function get_links_amount($id_menu){

        $this->db->where("users_favorites",$id_menu);
        $this->db->where("registred_by",$this->user_id);
        
        $q=$this->db->get("users_favorites_url");
        return $q->num_rows();
    }
}
?>