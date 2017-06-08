<?php

class Home_model extends CI_Model{

    public $user_id="";

	public function __construct() {
        parent::__construct();
        $this->load->model("comment_model");
        $this->load->model('like_model');
        $this->user_id=$this->session->userdata("user_id");
        
    }

	// contar los registros  
	function get_publications_count($input_search,$id_category){
        $this->db->where('publications.status', 1);

        if(!empty($id_category))
        $this->db->where('publications.category', $id_category);

        if(!empty($input_search))
        $this->db->like('publications.title', $input_search);

        $this->db->from('publications');
        $q=$this->db->get();



        return $q->num_rows();

    }

    // contar los registros  con lo que venga de POST
    function get_publications_count_post_conditions($input_search,$id_category){

        if(!empty($id_category))
        $this->db->where('publications.category', $id_category); 

        if(!empty($input_search))
        $this->db->like('publications.title', $input_search); 
        
        $this->db->where('publications.status', 1); 

        $q=$this->db->get("publications");
        return $q->num_rows();
    }

    function get_publications($limit, $start,$order_by,$input_search,$id_category){
    	
        $this->db->select('publications.*, COUNT(publications_comment.id) as amount_comments');
        $this->db->from('publications');
        $this->db->limit($limit, $start);
        $this->db->join('publications_comment', 'publications_comment.publication_id = publications.id',"left");
        $this->db->select('photo');
        $this->db->join('publications_categories', 'publications_categories.id = publications.category',"left");
        $this->db->group_by('publications.id');

        // no traer las plantillas por el momento
        if($this->user_id!=2)
        $this->db->where_not_in('publications.category', 39); 

        if(!empty($id_category))
        $this->db->where('publications.category', $id_category); 

        if(!empty($input_search))
        $this->db->like('publications.title', $input_search); 

        $this->db->where('publications.status', 1); 

        if( $this->session->userdata("publication_order_by")=="ids")
        $this->db->order_by('publications.id', 'desc');
        else if( $this->session->userdata("publication_order_by")=="views")
        $this->db->order_by('publications.views', 'desc');
        else if( $this->session->userdata("publication_order_by")=="comments")
        $this->db->order_by('amount_comments', 'desc');

                // contar publicaciones

        return $this->get_data($this->db->get());

    }
    function get_publications_divs($limit, $start,$order_by,$input_search,$id_category){
        
        $this->db->select('
                publications.like_sure,
                publications.title,
                publications.id,
                publications.category,
                publications.url_facebook,
                publications.views,
                publications.gif,
                publications.registred_on,
                COUNT(publications_comment.id) as amount_comments');
        $this->db->from('publications');
        $this->db->limit($limit, $start);
        $this->db->join('publications_comment', 'publications_comment.publication_id = publications.id',"left");
        $this->db->select('publications_categories.photo,publications_categories.name as category_name');
        $this->db->join('publications_categories', 'publications_categories.id = publications.category',"left");
        
        // no traer las plantillas por el momento
        if($this->user_id!=2)
        $this->db->where_not_in('publications.category', 39); 

        if(!empty($id_category))
        $this->db->where('publications.category', $id_category); 

        if(!empty($input_search))
        $this->db->like('publications.title', $input_search);

        $this->db->where('publications.status', 1); 

        $this->db->group_by('publications.id');
        $this->db->order_by('publications.id', 'desc');
        
        $q=$this->db->get();

        // echo $this->db->last_query();
        // exit();    
        $data = $this->get_data($q);

        // traer las imagenes
        if($data)
        foreach ($data as $key => &$value) {

            $q=$this->db->select('id,filename')
                         ->from('publications_file')
                         ->where('publications_file.publication_id', $value["id"])
                         ->get();
            $data_single=$this->get_data($q);

            $data[$value["id"]]["pictures"]= $data_single;
        }

        if(!empty($data))
        foreach ($data as $key => &$value) {

            if(!empty($value["gif"])):
            $data[$value["id"]]["gif_path"]=base_url().'images/uploads/gifPost/'.$value["gif"];
            else:
                if(!empty($value["pictures"])):
                $fileName=end($value["pictures"]);
                    if($value["registred_on"]<="2017-02-04 23:59:59"){
                    $data[$value["id"]]["gif_path"]=base_url().'images/uploads/imgPost/'.$fileName["filename"];
                    }else{
                    
                    $id_implode=(!empty($value["id"])?implode("/",str_split($value["id"])):"");
                    $data[$value["id"]]["gif_path"]=base_url().'img/'.$id_implode."/".$fileName["filename"];
                    }

                else:
                $data[$value["id"]]["gif_path"]=base_url().'images/interface/no-imagen.jpg';
                endif;
            endif;
        }


        // traer las links
        if($data)
        foreach ($data as $key => &$value) {
            if($value["like_sure"]!=1){
            $q=$this->db->select('id,link')
                
                         ->from('publications_hosting_server_link')
                         ->where('publication', $value["id"])
                         ->get();
            $data_single=$this->get_data($q);

            $data[$value["id"]]["links"]= $data_single;
            }
            else{
                $data[$value["id"]]["links"]="";
            }
        }

        // $data_fix=array();
        // if(!empty($data))
        // foreach ($data as $key => &$value) {
        // //separar por categorias 
        // $data_fix[$value["category"]]["publication"][$key]=$value;
        // $data_fix[$value["category"]]["category_name"]=$value["category_name"];

        // contar publicaciones
        // $q=$this->db->select('id')
        //                  ->from('publications')
        //                  ->where('publications.category', $value["category"])
        //                  ->where('publications.status', 1)
        //                  ->get();
        //     $num_rows_publications=$this->get_data($q);

        // if(!empty($num_rows_publications))
        // $data_fix[$value["category"]]["publications_amount"]= count($num_rows_publications);

        // }


        return $data;

    }

    function last_publications($limit){
       $q=$this->db->select('id,title')
                    ->from('publications')
                    ->limit($limit)
                    ->order_by("id","desc")
                    ->get()
                    ;
        $data = $this->get_data($q);
        return $data;
    }

    function get_publication_by($id=null){

        // informacion de  la publicacion
        $this->db->select('*');
        $this->db->from('publications');
        if(!empty($id))
        $this->db->where('publications.id', $id);
    
        $q=$this->db->get();

        $data = $this->get_data($q);

        // ahora traer  los links del post
        if(!empty($data))
        foreach ($data as $key => &$value) {

            $q=$this->db->select('publications_hosting_server.id table_id_publications_hosting_server, publications_hosting_server.id as select_hosting_servers_id,publications_hosting_server.description,publications_hosting_server.rights_universal')
                         ->from('publications_hosting_server')
                         
                         // ->select('hosting_servers.logo, hosting_servers.name as hosting_servers_name')
                         // ->join('hosting_servers','hosting_servers.id = publications_hosting_server.hosting_servers_id','left')
                         
                         ->select('publications_hosting_server_link.link as link,publications_hosting_server_link.description as description_link, publications_hosting_server_link.id as id ,publications_hosting_server_link.id as table_link_id')
                         ->join('publications_hosting_server_link','publications_hosting_server_link.publications_hosting_server_id = publications_hosting_server.id','left')
                         
                         ->where('publications_hosting_server.publication_id', $value["id"])
                         ->group_by('publications_hosting_server_link.id')
                         ->get();

        $data_single=$this->get_data($q);
        // links acomodar
        if($data_single)
        foreach ($data_single as $key_one => $value_one) {

        if(empty($value_one["table_link_id"]))
        continue;    

        $data_fixs[$value_one["select_hosting_servers_id"]]["hosting_servers_array"][$value_one["table_id_publications_hosting_server"]]["select_hosting_servers_id"] = $value_one["select_hosting_servers_id"];
        $data_fixs[$value_one["select_hosting_servers_id"]]["hosting_servers_array"][$value_one["table_id_publications_hosting_server"]]["description"] = $value_one["description"];
        $data_fixs[$value_one["select_hosting_servers_id"]]["hosting_servers_array"][$value_one["table_id_publications_hosting_server"]]["rights_universal"] = $value_one["rights_universal"];
        $data_fixs[$value_one["select_hosting_servers_id"]]["hosting_servers_array"][$value_one["table_id_publications_hosting_server"]]["table_link_id"][$value_one["table_link_id"]]["link"]= $value_one["link"];
        $data_fixs[$value_one["select_hosting_servers_id"]]["hosting_servers_array"][$value_one["table_id_publications_hosting_server"]]["table_link_id"][$value_one["table_link_id"]]["description"]= $value_one["description_link"];
        // $data_fixs[$value_one["select_hosting_servers_id"]]["logo"] = $value_one["logo"];
        $data_fixs[$value_one["select_hosting_servers_id"]]["logo"] = "";
        $data_fixs[$value_one["select_hosting_servers_id"]]["hosting_servers_name"] = "";
        // $data_fixs[$value_one["select_hosting_servers_id"]]["hosting_servers_name"] = $value_one["hosting_servers_name"];
        
        }
        if(!empty($data_fixs) )
        $data[$value["id"]]["hosting_servers"]=$data_fixs;

        }
// pr($data_fixs);
        // ahora traer  LAS imagenes del post
        if(!empty($data))
        foreach ($data as $key => &$value) {

            $q=$this->db->select('id,filename')
                         ->from('publications_file')
                         ->where('publications_file.publication_id', $value["id"])
                         ->get();
            $data_single=$this->get_data($q);

            $data[$value["id"]]["pictures"]= $data_single;
        }
        // ahora traer  el nombre del que lo publico
        if(!empty($data))
        foreach ($data as $key => &$value) {

            $q=$this->db->select('id,nickname')
                         ->from('users')
                         ->where('users.id', $value["registred_by"])
                         ->get();
            $data_single=$this->get_data($q);

            $data[$value["id"]]["nickname"]= $data_single[$value["registred_by"]]["nickname"];
            $data[$value["id"]]["month"]= only_month($value["registred_on"]);
            $data[$value["id"]]["year"]= only_year($value["registred_on"]);
            $data[$value["id"]]["day"]= only_day($value["registred_on"]);
        }

        // ahora traer el nombre de la categoria
        if(!empty($data))
        foreach ($data as $key => &$value) {

            $q=$this->db->select('id,name')
                         ->from('publications_categories')
                         ->where('publications_categories.id', $value["category"])
                         ->get();
            $data_single=$this->get_data($q);

            $data[$value["id"]]["category_name"]= $data_single[$value["category"]]["name"];
        }

        // ahora traer los pinches mensajes perdon por la palabra pero me enoje :@
        if(!empty($data))
        foreach ($data as $key => &$value) {

            $q=$this->db->select('publications_comment.*')
                        ->from('publications_comment')
                        ->where('publications_comment.publication_id', $value["id"])
                            ->select('users.nickname as registred_name')
                            ->join('users', 'users.id = publications_comment.registred_by', 'left')
                            ->order_by('publications_comment.registred_on','desc')
                            ->limit(15)
                            ->get();


            foreach ($q->result_array() as $key_dos => $value_dos) {

            $data[$value["id"]]["comments"][$value_dos["id"]]["id_comment"]=$value_dos["id"];
            $data[$value["id"]]["comments"][$value_dos["id"]]["name_comment"]=$value_dos["name"];
            $data[$value["id"]]["comments"][$value_dos["id"]]["mail_comment"]=$value_dos["email"];
            $data[$value["id"]]["comments"][$value_dos["id"]]["comment"]=$value_dos["comment"];

            if( ($value_dos["ip"]==$this->input->ip_address()) or ( (!empty($this->user_id)) and  $value_dos["registred_by"]==$this->user_id) ) 
            $data[$value["id"]]["comments"][$value_dos["id"]]["own"]=true;
            
            $data[$value["id"]]["comments"][$value_dos["id"]]["registred_on_comment"]=nicetime($value_dos["registred_on"]);
            $data[$value["id"]]["comments"][$value_dos["id"]]["registred_on_comment_title"]=$value_dos["registred_on"];
            $data[$value["id"]]["comments"][$value_dos["id"]]["registred_name"]=$value_dos["registred_name"]?:"";
            $data[$value["id"]]["comments"][$value_dos["id"]]["picture"]="";

            }

            $data[$value["id"]]["comments_amount"]=$this->comment_model->get_comments_amount($value["id"]);

        }

        // ahora traer las respuestas de los comentarios 
        if($data)
        foreach ($data as $key => &$value) {
            if(isset($value["comments"]))
            foreach ($value["comments"] as $key_dos => $value_dos) {
            $q=$this->db->select('publications_comment_response.*')
                        ->from('publications_comment_response')
                        ->where('publications_comment_response.comment_id', $value_dos["id_comment"])
                            ->select('users.nickname as registred_name')
                            ->join('users', 'users.id = publications_comment_response.registred_by', 'left')
                            ->order_by('publications_comment_response.registred_on','asc')
                            ->limit(15)
                            ->get();
                foreach ($q->result_array() as $key_three => $value_three) {

                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["id_comment_response"]=$value_three["id"];
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["name_comment_response"]=$value_three["name"];
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["mail_comment_response"]=$value_three["email"];
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["response"]=$value_three["response"];
           
                if( ($value_three["ip"]==$this->input->ip_address()) or ( (!empty($this->user_id)) and  $value_three["registred_by"]==$this->user_id) )
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["own"]=true;

                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["registred_on_comment_response"]=nicetime($value_three["registred_on"]);
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["registred_on_comment_response_title"]=$value_three["registred_on"];
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["registred_name"]=$value_three["registred_name"]?:"";
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["picture"]="";

                }

                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response_amount"]=$this->comment_model->get_responseComments_amount($value["id"],$value_dos["id_comment"]);
            }
        }


        // traer los likes o no likes de los comentarios 
        if(!empty($data[$id]["comments"]))    
        foreach ($data[$id]["comments"] as $k => &$v) {
        $data[$id]["comments"][$k]["likes"]=$this->like_model->get_likes_comm_resp_id($v["id_comment"],"comment","like",$id);
        $data[$id]["comments"][$k]["not_likes"]=$this->like_model->get_likes_comm_resp_id($v["id_comment"],"comment","not_like",$id);
        
         // traer los likes o no likes de los respuestas 
            if(!empty($data[$id]["comments"][$k]["comments_response"]))
            foreach ($data[$id]["comments"][$k]["comments_response"] as $kr => &$vr) {

                $data[$id]["comments"][$k]["comments_response"][$kr]["likes"]=$this->like_model->get_likes_comm_resp_id($vr["id_comment_response"],"response","like",$id);
                $data[$id]["comments"][$k]["comments_response"][$kr]["not_likes"]=$this->like_model->get_likes_comm_resp_id($vr["id_comment_response"],"response","not_like",$id);
        
            }    
        }    

        // if(empty($data))
        // redirect(base_url("home"));

        // ...
        return $data;

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

// categorias
    function get_categories(){
             $this->db->select('publications_categories.id as id,publications_categories.photo,publications_categories.name
                                ,COUNT(publications.id) AS publications_amount
                                ');
             $this->db->from('publications_categories');
             $this->db->select('publications.id as publications_id,publications.category');
             $this->db->join('publications',"publications.category=publications_categories.id","left");
             $this->db->order_by("publications_categories.name","asc");
             $this->db->group_by("publications_categories.id");

        $q = $this->db->get();

        return $q->result();
    }
    function get_categories_select(){
            $q=$this->db->select('id,name')
                         ->from('publications_categories')
                         ->get();
        return $q->result_array();
    }
    function get_sub_categories(){

            $q=$this->db->select('id,name')
                         ->from('publications_subcategories')
                         ->get();
        return $q->result_array();
    }

    function update_view($id){
        if(!empty($id)){
            $q=$this->db->select("views")
                ->from("publications")
                ->where('id', $id)
                ->limit(1)
                ->get()
                ->result()
                ;
            $views=array('views' => $q[0]->views+1 );

            $this->db->where('id', $id);
            $this->db->update('publications', $views); 
                return $views;
        }
    }

    public function insert_contact_info($data){
        $this->db->insert('contact_info', $data); 
    }

    public function update_contact_info($id,$data){
        $this->db->where('id', $id);
        $this->db->update('contact_info', $data); 
    }

    public function select_contact_info($data_search){
        $data=array("id"=>0);
        $this->db->where($data_search);
        $q=$this->db->get('contact_info'); 
        // pr($this->db->last_query());

        if ($q->num_rows() > 0){
            foreach ($q->result_array() as $key => $value) {
                $data=$value;
            }
        return $data["id"];
        }
        else{
        return false;
        }
    }

        public function get_menu_category(){
            $q=$this->db->select('category.id,category.name')
                         ->from('category')
                         ->where('enabled',1)
                         ->select('category_multiparent.parent_id')
                         ->join('category_multiparent', 'category_multiparent.category_id = category.id', 'left')
                         ->get()
                         ;

        foreach ($q->result_array() as $key => $row) {
            if(empty($row["parent_id"]))
            $row["parent_id"]=0;

            $menu['menus'][$row['id']] = $row;
            $menu['parent_menus'][$row['parent_id']][] = $row['id'];
        }


        # name 
                    // $q=$this->db->select('id,name,parentid')
                    //      ->where('enabled',1)
                    //      ->from('category')
                    //      ->get();

        return $menu;
    }


}
