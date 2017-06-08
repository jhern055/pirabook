<?php

class Post_model extends CI_Model{

	public function __construct() {
        parent::__construct();
        // $this->load->model("file_model");
    }
    
	function insert_post($data){

        $this->db->insert('publications',$data);
        return $this->db->insert_id();
    }
    function update_post($data,$idedit){

        $this->db->where('id',$idedit);
        $this->db->update('publications',$data);
        return $idedit;
    }

    function insert_hosting_server($data){

        $this->db->insert('publications_hosting_server',$data);
        return $this->db->insert_id();
    }

    function insert_hosting_server_link($data){

        $this->db->insert('publications_hosting_server_link',$data);
        return $this->db->insert_id();
    }
    function select_hosting_server_link($link_update_id){

       $q=$this->db->select('id')
                ->where('id',$link_update_id)
                ->get('publications_hosting_server_link');

        return $q->num_rows();
    }
    function update_hosting_server_description($data,$publications_hosting_server_id){

        $this->db->where('id',$publications_hosting_server_id);
        $this->db->update('publications_hosting_server',$data);
    }
    function update_hosting_server_link($data,$publications_hosting_server_id,$link_update_id){

        $this->db->where('id',$link_update_id);
        $this->db->update('publications_hosting_server_link',$data);
    }

	function get_hosting_servers(){
        $q = $this->db->get('hosting_servers');
        $data = $this->get_data($q);
    	
    	$data_fix[0]= "Seleccione algun servidor";
        foreach ($data as $key => $value)
        	$data_fix[$value["id"]]= $value["name"];

        return $data_fix;
    }

    function delete_model($id_publication){

        // borrar
        // los comentarios las respuestas de comentarios
        $this->db->select('id');
        $this->db->from('publications_comment');
        $this->db->where('publication_id',$id_publication);
        $ids_publications_comment =$this->get_data($this->db->get());
        
        if(!empty($ids_publications_comment))
        foreach ($ids_publications_comment as $key => $value)
        $ids_publications_comment_simple_array[]=$key;

        if(!empty($ids_publications_comment_simple_array)){
        $this->db->where_in('comment_id', $ids_publications_comment_simple_array);
        $this->db->delete('publications_comment_response');

        $this->db->where_in('id', $ids_publications_comment_simple_array);
        $this->db->delete('publications_comment');
        }

        // los links de publicidad
        $this->db->select('id');
        $this->db->from('publications_hosting_server');
        $this->db->where('publication_id',$id_publication);
        $ids_publications_hosting_server =$this->get_data($this->db->get());
        
        if(!empty($ids_publications_hosting_server))
        foreach ($ids_publications_hosting_server as $key => $value)
        $ids_publications_hosting_server_simple_array[]=$key;

        if(!empty($ids_publications_hosting_server_simple_array)){
        $this->db->where_in('publications_hosting_server_id', $ids_publications_hosting_server_simple_array);
        $this->db->delete('publications_hosting_server_link');

        $this->db->where_in('id', $ids_publications_hosting_server_simple_array);
        $this->db->delete('publications_hosting_server');
        }

        // los imagenes de publicidad
        $this->db->select('id,filename');
        $this->db->from('publications_file');
        $this->db->where('publication_id',$id_publication);
        $ids_publications_file =$this->get_data($this->db->get());

        if(!empty($ids_publications_file))
        foreach ($ids_publications_file as $key => $value)
        $ids_publications_file_simple_array[]=$key;

        if(!empty($ids_publications_file))
        foreach ($ids_publications_file as $key => $value):
        @unlink(FCPATH.'images/uploads/imgPost/'.$value['filename']);
        endforeach;

        if(!empty($ids_publications_file_simple_array)):
        $this->db->where_in('id', $ids_publications_file_simple_array);
        $this->db->delete('publications_file');
        endif;

        // GIF
        $this->file_model->delete_gif($id_publication);
        
        // Publicacion
        if(!empty($id_publication)):
        $this->db->where('id', $id_publication);
        $this->db->delete('publications');
        endif;    

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

    function get_publication_by_id($id_publication){

        $this->db->select('id,title,description,category,sub_category,email,password,url_facebook,registred_by');
        $this->db->from('publications');
        $this->db->where('id',$id_publication);
        $data = $this->get_data($this->db->get());

        // ahora traer  LAS imagenes del post
        if($data)
        foreach ($data as $key => &$value) {

            $q=$this->db->select('id,filename')
                         ->from('publications_file')
                         ->where('publications_file.publication_id', $value["id"])
                         ->get();
            $data_single=$this->get_data($q);

            $data[$value["id"]]["pictures"]= $data_single;
        }
        
       // ahora traer  los links del post
        if($data)
        foreach ($data as $key => &$value) {

            $q=$this->db->select('publications_hosting_server.id table_id_publications_hosting_server, publications_hosting_server.hosting_servers_id as select_hosting_servers_id,publications_hosting_server.description')
                         ->from('publications_hosting_server')
                         
                         ->select('hosting_servers.logo, hosting_servers.name as hosting_servers_name')
                         ->join('hosting_servers','hosting_servers.id = publications_hosting_server.hosting_servers_id','left')
                         
                         ->select('publications_hosting_server_link.link as link,publications_hosting_server_link.original as link_original,publications_hosting_server_link.description as description_link, publications_hosting_server_link.id as id ,publications_hosting_server_link.id as table_link_id,publications_hosting_server_link.publications_hosting_server_id')
                         ->join('publications_hosting_server_link','publications_hosting_server_link.publications_hosting_server_id = publications_hosting_server.id','left')
                         
                         ->where('publications_hosting_server.publication_id', $value["id"])
                         ->group_by('publications_hosting_server_link.id')
                         ->get();

        $data_single=$this->get_data($q);
        // links acomodar
        if($data_single)
        foreach ($data_single as $key_one => $value_one) {
        if(empty($value_one["link"]))
        continue;
    
        $data_fixs[$value_one["select_hosting_servers_id"]]["hosting_servers_array"][$value_one["table_id_publications_hosting_server"]]["select_hosting_servers_id"] = $value_one["select_hosting_servers_id"];
        $data_fixs[$value_one["select_hosting_servers_id"]]["hosting_servers_array"][$value_one["table_id_publications_hosting_server"]]["description"] = $value_one["description"];
        $data_fixs[$value_one["select_hosting_servers_id"]]["hosting_servers_array"][$value_one["table_id_publications_hosting_server"]]["table_link_id"][$value_one["table_link_id"]]["link"]= $value_one["link"];
        $data_fixs[$value_one["select_hosting_servers_id"]]["hosting_servers_array"][$value_one["table_id_publications_hosting_server"]]["table_link_id"][$value_one["table_link_id"]]["link_original"]= $value_one["link_original"];
        $data_fixs[$value_one["select_hosting_servers_id"]]["hosting_servers_array"][$value_one["table_id_publications_hosting_server"]]["table_link_id"][$value_one["table_link_id"]]["description"]= $value_one["description_link"];
        
        $data_fixs[$value_one["select_hosting_servers_id"]]["publications_hosting_server_id"] = $value_one["publications_hosting_server_id"];
        $data_fixs[$value_one["select_hosting_servers_id"]]["logo"] = $value_one["logo"];
        $data_fixs[$value_one["select_hosting_servers_id"]]["hosting_servers_name"] = $value_one["hosting_servers_name"];
        
        }
        if(!empty($data_fixs) )
        $data[$value["id"]]["hosting_servers"]=$data_fixs;

        }
        return  $data;
    }

    function delete_link_hosting_server_by_id($id_link_hosting_server){
        $id_link_hosting_server_decode=base64_decode($id_link_hosting_server);
        $this->db->where('id', $id_link_hosting_server_decode);
        $this->db->delete('publications_hosting_server_link'); 
    }

    // eliminar o insertar gif
    function set_or_delete_gif($id_publication,$fileGifName){
        if(!empty($id_publication)){

        $this->file_model->delete_gif($id_publication);

        $gif=array('gif' =>$fileGifName );

        $this->db->where('id', $id_publication);
        $this->db->update('publications', $gif); 
        return $gif;
        }
    } 

}