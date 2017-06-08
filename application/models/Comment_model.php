<?php

class Comment_model extends CI_Model{

    public $user_id="";

    public function __construct() {
        parent::__construct();
        $this->user_id=$this->session->userdata("user_id");
    }

	function insert_comment($data){

        $this->db->insert('publications_comment',$data);

    }

    function update_comment($data,$id){

        $this->db->where('id',$id);
        $this->db->update('publications_comment',$data);

    }

    function insert_comment_response($data){

        $this->db->insert('publications_comment_response',$data);

    }

    function update_comment_response($data,$id){

        $this->db->where('id',$id);
        $this->db->update('publications_comment_response',$data);

    }

    function get_comment_by_publication($id_publication,$limit){
    	
         $q=$this->db->select('publications_comment.*')
                        ->from('publications_comment')
                        ->where('publications_comment.publication_id', $id_publication)
                            ->select('users.nickname as registred_name')
                            ->join('users', 'users.id = publications_comment.registred_by', 'left')
                            ->order_by('publications_comment.registred_on','desc')
                            ->limit($limit)
                            ->get();

        foreach ($q->result_array() as $key_dos => $value_dos) {

            $data["comments"][$value_dos["id"]]["id_comment"]=$value_dos["id"];
            $data["comments"][$value_dos["id"]]["name_comment"]=$value_dos["name"];
            $data["comments"][$value_dos["id"]]["mail_comment"]=$value_dos["email"];
            $data["comments"][$value_dos["id"]]["comment"]=$value_dos["comment"];

            if( ($value_dos["ip"]==$this->input->ip_address()) or ( (!empty($this->user_id)) and  $value_dos["registred_by"]==$this->user_id) )
            $data["comments"][$value_dos["id"]]["own"]=true;
            
            $data["comments"][$value_dos["id"]]["registred_on_comment"]=nicetime($value_dos["registred_on"]);
            $data["comments"][$value_dos["id"]]["registred_on_comment_title"]=$value_dos["registred_on"];
            $data["comments"][$value_dos["id"]]["registred_name"]=$value_dos["registred_name"]?:"";
            $data["comments"][$value_dos["id"]]["picture"]="";

        }
        $data["comments_amount"]=$this->get_comments_amount($id_publication);

        foreach ($data["comments"] as $key_dos => $value_dos) {
            $q=$this->db->select('publications_comment_response.*')
                        ->from('publications_comment_response')
                        ->where('publications_comment_response.comment_id', $value_dos["id_comment"])
                            ->select('users.nickname as registred_name')
                            ->join('users', 'users.id = publications_comment_response.registred_by', 'left')
                            ->order_by('publications_comment_response.registred_on','asc')
                            ->limit(15)
                            ->get();

                foreach ($q->result_array() as $key_three => $value_three) {

                $data["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["id_comment_response"]=$value_three["id"];
                $data["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["name_comment_response"]=$value_three["name"];
                $data["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["mail_comment_response"]=$value_three["email"];
                $data["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["response"]=$value_three["response"];

                if( ($value_three["ip"]==$this->input->ip_address()) or ( (!empty($this->user_id)) and  $value_three["registred_by"]==$this->user_id) )
                $data["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["own"]=true;

                $data["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["registred_on_comment_response"]=nicetime($value_three["registred_on"]);
                $data["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["registred_on_comment_response_title"]=$value_three["registred_on"];
                $data["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["registred_name"]=$value_three["registred_name"]?:"";
                $data["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["picture"]="";

                }
                $data["comments"][$value_dos["id_comment"]]["comments_response_amount"]=$this->get_responseComments_amount($id_publication,$value_dos["id_comment"]);

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
                            ->order_by('publications_comment_response.registred_on','desc')
                            ->limit(15)
                            ->get();
                foreach ($q->result_array() as $key_three => $value_three) {

                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["id_comment_response"]=$value_three["id"];
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["name_comment_response"]=$value_three["name"];
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["mail_comment_response"]=$value_three["email"];
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["response"]=$value_three["response"];
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["registred_on_comment_response"]=nicetime($value_three["registred_on"]);
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["registred_on_comment_response_title"]=$value_three["registred_on"];
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["registred_name"]=$value_three["registred_name"]?:"";
                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response"][$value_three["id"]]["picture"]="";

                }

                $data[$value["id"]]["comments"][$value_dos["id_comment"]]["comments_response_amount"]=$this->comment_model->get_responseComments_amount($value["id"],$value_dos["id_comment"]);
            }
        }


        // traer los likes o no likes de los comentarios 
        if(!empty($data["comments"]))    
        foreach ($data["comments"] as $k => &$v) {
        $data["comments"][$k]["likes"]=$this->like_model->get_likes_comm_resp_id($v["id_comment"],"comment","like",$id_publication);
        $data["comments"][$k]["not_likes"]=$this->like_model->get_likes_comm_resp_id($v["id_comment"],"comment","not_like",$id_publication);
        
         // traer los likes o no likes de los respuestas 
            if(!empty($data["comments"][$k]["comments_response"]))
            foreach ($data["comments"][$k]["comments_response"] as $kr => &$vr) {

                $data["comments"][$k]["comments_response"][$kr]["likes"]=$this->like_model->get_likes_comm_resp_id($vr["id_comment_response"],"response","like",$id_publication);
                $data["comments"][$k]["comments_response"][$kr]["not_likes"]=$this->like_model->get_likes_comm_resp_id($vr["id_comment_response"],"response","not_like",$id_publication);
        
            }    
        }    
     
        return $data;

    }
    // traer las respuestas del comentario
    function get_commentResponse_by_PublicationAndidComent($id_publication,$id_comment,$limit){

    $q=$this->db->select('publications_comment_response.*')
                ->from('publications_comment_response')
                ->where('publications_comment_response.comment_id', $id_comment)
                ->where('publications_comment_response.publication_id', $id_publication)
                    ->select('users.nickname as registred_name')
                    ->join('users', 'users.id = publications_comment_response.registred_by', 'left')
                    ->order_by('publications_comment_response.registred_on','desc')
                    ->limit($limit)
                    ->get();

        foreach ($q->result_array() as $key_three => $value_three) {

        $data[$value_three["id"]]["id_comment_response"]=$value_three["id"];
        $data[$value_three["id"]]["name_comment_response"]=$value_three["name"];
        $data[$value_three["id"]]["mail_comment_response"]=$value_three["email"];
        $data[$value_three["id"]]["response"]=$value_three["response"];
        $data[$value_three["id"]]["registred_on_comment_response"]=nicetime($value_three["registred_on"]);
        $data[$value_three["id"]]["registred_on_comment_response_title"]=$value_three["registred_on"];
        $data[$value_three["id"]]["registred_name"]=$value_three["registred_name"]?:"";
        $data[$value_three["id"]]["picture"]="";

        }
        
        return $data;

    }
    // traer el total de mensajes
    function get_comments_amount($id_publication){

            $q=$this->db->select('publications_comment.*')
                    ->from('publications_comment')
                    ->where('publications_comment.publication_id', $id_publication)
                    ->get();

            return $q->num_rows();      
    }
    // traer el total de respuesta de un mensaje
    function get_responseComments_amount($id_publication,$id_comment){

            $q=$this->db->select('publications_comment_response.*')
                    ->from('publications_comment_response')
                    ->where('publications_comment_response.comment_id', $id_comment)
                    ->where('publications_comment_response.publication_id', $id_publication)
                    ->get();
            return $q->num_rows();      
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

    function get_comment($data_to_search){
    $data="";
            $q=$this->db->select('comment')
                    ->from('publications_comment')
                    ->where($data_to_search)
                    ->limit(1)
                    ->get();
            if($q->result_array())  
            foreach ($q->result_array() as $key => $value) 
             $data=$value["comment"];
            
            return $data;       
            // return $this->db->last_query();      
    }

    function get_response($data_to_search){
    $data="";

            $q=$this->db->select('response')
                    ->from('publications_comment_response')
                    ->where($data_to_search)
                    ->limit(1)
                    ->get();
            if($q->result_array())  
            foreach ($q->result_array() as $key => $value) 
            $data=$value["response"];                
           
            return $data;       
    }

    function delete_it($data_to_search,$type){

        $this->db->where($data_to_search);
        $this->db->limit(1);
        if($type=="comment"){
        $this->db->delete('publications_comment');
        $this->delete_comment_response($data_to_search);
        }
        else if($type=="response")
        $this->db->delete('publications_comment_response');

    }

    function delete_comment_response($data_to_search){
    
    if($data_to_search["id"]):
    $this->db->where("comment_id",$data_to_search["id"]);
    $this->db->where("publication_id",$data_to_search["publication_id"]);
    $this->db->delete('publications_comment_response');
    endif;
    
    }
}
