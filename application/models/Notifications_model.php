<?php

class Notifications_model extends CI_Model{

	public $user_id;

	public function __construct() {
        parent::__construct();

		$this->user_id=$this->session->userdata("user_id");

    }

    public function getNotificationsNum_get(){

    $total=0;
	$query="SELECT publication.id AS id_publication,publication.registred_by AS registred_by_publication
			,user.nickname AS comment_nickname,comment.name AS name_comment,comment.id AS id_comment,comment.comment ,comment.registred_on as  comment_registred_on
			,user_response.nickname AS comment_response_nickname,comment_response.name AS name_comment_response,comment_response.id AS id_response ,comment_response.response ,comment_response.registred_on as  comment_response_registred_on
			FROM (publications AS publication)"

			." LEFT JOIN (SELECT id,name,comment,publication_id,registred_by,registred_on FROM publications_comment WHERE registred_by !=".$this->user_id." ORDER BY id DESC) AS comment ON comment.publication_id=publication.id"
			." LEFT JOIN (SELECT id,nickname FROM users WHERE id !=".$this->user_id.") AS user ON user.id=comment.registred_by"

			." LEFT JOIN (SELECT id,name,response,publication_id,registred_by,comment_id,registred_on FROM publications_comment_response WHERE registred_by !=".$this->user_id." ORDER BY id DESC) AS comment_response ON comment_response.comment_id=comment.id"
			." LEFT JOIN (SELECT id,nickname FROM users WHERE id !=".$this->user_id.") AS user_response ON user_response.id=comment_response.registred_by"
			
			." WHERE publication.registred_by=".$this->user_id;

	$total = $this->db->query($query)->result_array();
	foreach ($total as $key => $value) {
		if(empty($value["comment"]) and empty($value["response"]))
		unset($total[$key]);
	}

	foreach ($total as $key => $value){

	if(!empty($value["id_response"]) and !empty($value["id_comment"]))
	$total[$key]["registred_on_activity"]=$value["comment_response_registred_on"];
	else if(!empty($value["id_comment"]))
	$total[$key]["registred_on_activity"]=$value["comment_registred_on"];
	// else unset($total[$key]);

	}

	return count($total);

    }

	public function getNotificationsNum_get_amount(){

    $total=0;
	$query="SELECT publication.id AS id_publication,publication.registred_by AS registred_by_publication
			,user.nickname AS comment_nickname,comment.name AS name_comment,comment.id AS id_comment,comment.comment ,comment.registred_on as  comment_registred_on
			,user_response.nickname AS comment_response_nickname,comment_response.name AS name_comment_response,comment_response.id AS id_response ,comment_response.response ,comment_response.registred_on as  comment_response_registred_on
			FROM (publications AS publication)"

			." LEFT JOIN (SELECT id,name,comment,publication_id,registred_by,registred_on FROM publications_comment WHERE registred_by !=".$this->user_id." ORDER BY id DESC) AS comment ON comment.publication_id=publication.id"
			." LEFT JOIN (SELECT id,nickname FROM users WHERE id !=".$this->user_id.") AS user ON user.id=comment.registred_by"

			." LEFT JOIN (SELECT id,name,response,publication_id,registred_by,comment_id,registred_on FROM publications_comment_response WHERE registred_by !=".$this->user_id." ORDER BY id DESC) AS comment_response ON comment_response.comment_id=comment.id"
			." LEFT JOIN (SELECT id,nickname FROM users WHERE id !=".$this->user_id.") AS user_response ON user_response.id=comment_response.registred_by"
			
			." WHERE publication.registred_by=".$this->user_id;

	$total = $this->db->query($query)->result_array();

	if($total)
	foreach ($total as $key => $value) {
		if(empty($value["comment"]) and empty($value["response"]))
		unset($total[$key]);
	}

	foreach ($total as $key => $value){

	if(!empty($value["id_response"]) and !empty($value["id_comment"]))
	$total[$key]["registred_on_activity"]=$value["comment_response_registred_on"];
	else if(!empty($value["id_comment"]))
	$total[$key]["registred_on_activity"]=$value["comment_registred_on"];
	// else unset($total[$key]);

	}

	return count($total);
    }
    /* public function getNotificationsNum_get(){

    $total=0;
	$user_data=$this->db->select('publications_comment,publications_comment_response')
					->where('id',$this->user_id)
					->from('users')
					->get()
					->result_array();
	extract($user_data[0],EXTR_OVERWRITE);

    $ids_publications=$this->db->select('id')
			    			->where('registred_by =',$this->user_id)
			   				->from('publications')
			   				->get()
			   				->result_array();

	if(!empty($ids_publications)){		   				
	foreach ($ids_publications as $key => $value)

	$publications_comment_num=$this->db->select('id')
							->where('id >=',$publications_comment)
							->where('publication_id',$value["id"])
							->where('registred_by !=',$this->user_id)
							->from('publications_comment')
							->get()
							->result_array();

	$publications_comment_response_num=$this->db->select('id')
										->where('id >=',$publications_comment_response)
										->where('publication_id',$value["id"])
										->where('registred_by !=',$this->user_id)
										->from('publications_comment_response')
										->get()
										->result_array();
	$total=count($publications_comment_num)+count($publications_comment_response_num);
	}

	return $total;
    }
	*/

    public function getNotifications_get($amount_show=null){

	if(empty($this->user_id))
	return;

    // get own publications id 
	$notifications_data=array();
	$publication_data_fix=array();

	$end=5;

	if(!empty($amount_show))
	$end+=$amount_show;	

    // $ids_publications=$this->db->select('id')
			 //    			->where('registred_by =',$this->user_id)
			 //   				->from('publications')
			 //   				->get()
			 //   				->result_array();

	$query="SELECT publication.id AS id_publication,publication.title AS title_publication,publication.registred_by AS registred_by_publication
			,user.nickname AS comment_nickname,comment.name AS name_comment,comment.id AS id_comment,comment.comment ,comment.registred_on as  comment_registred_on
			,user_response.nickname AS comment_response_nickname,comment_response.name AS name_comment_response,comment_response.id AS id_response ,comment_response.response ,comment_response.registred_on as  comment_response_registred_on
			FROM (publications AS publication)"

			." LEFT JOIN (SELECT id,name,comment,publication_id,registred_by,registred_on FROM publications_comment WHERE registred_by !=".$this->user_id." ORDER BY id DESC) AS comment ON comment.publication_id=publication.id"
			." LEFT JOIN (SELECT id,nickname FROM users WHERE id !=".$this->user_id.") AS user ON user.id=comment.registred_by"

			." LEFT JOIN (SELECT id,name,response,publication_id,registred_by,comment_id,registred_on FROM publications_comment_response WHERE registred_by !=".$this->user_id." ORDER BY id DESC) AS comment_response ON comment_response.comment_id=comment.id"
			." LEFT JOIN (SELECT id,nickname FROM users WHERE id !=".$this->user_id.") AS user_response ON user_response.id=comment_response.registred_by"
			
			." WHERE publication.registred_by=".$this->user_id
			." LIMIT 0,".$end."";

	$query = $this->db->query($query);
	

	$notifications_data["publications"]=$query->result_array();

	if($notifications_data["publications"])
	foreach ($notifications_data["publications"] as $key => $value) {
		if(empty($value["comment"]) and empty($value["response"]))
		unset($notifications_data["publications"][$key]);
	}

	$notifications_data["notifications_amount"]=$this->getNotificationsNum_get_amount();
	if(!empty($notifications_data["publications"]))	
	foreach ($notifications_data["publications"] as $key => $value){

	if(!empty($value["id_response"]) and !empty($value["id_comment"]))
	$notifications_data[$key]["registred_on_activity"]=$value["comment_response_registred_on"];
	else if(!empty($value["id_comment"]))
	$notifications_data[$key]["registred_on_activity"]=$value["comment_registred_on"];
	else unset($notifications_data[$key]);

	}

	$registred_on_activity=array();
	if($notifications_data):
	foreach($notifications_data["publications"] as $k => $v): 
		
		if(!empty($v["registred_on_activity"]))
		$registred_on_activity[$k]=$v["registred_on_activity"]; 

	endforeach; 

	if(!empty($registred_on_activity) )
	array_multisort($registred_on_activity,SORT_DESC,SORT_STRING,$notifications_data["publications"]); 
	endif;

	/*
	$registred_on_activity=array();

	if(!empty($notifications_data))	
	foreach ($notifications_data as $key => $value){
	
	$notifications_data_fix[$value["id_publication"]][$value["id_comment"]]["id_publication"]=$value["id_publication"];
	$notifications_data_fix[$value["id_publication"]][$value["id_comment"]]["registred_by_publication"]=$value["registred_by_publication"];
	$notifications_data_fix[$value["id_publication"]][$value["id_comment"]]["id_comment"]=$value["id_comment"];
	$notifications_data_fix[$value["id_publication"]][$value["id_comment"]]["comment"]=$value["comment"];
	
	if(!empty($value["id_response"]))
	$notifications_data_fix[$value["id_publication"]][$value["id_comment"]]["registred_on_activity"]=$value["comment_response_registred_on"];
	else
	$notifications_data_fix[$value["id_publication"]][$value["id_comment"]]["registred_on_activity"]=$value["comment_registred_on"];

	if(!empty($value["id_response"])){
	$notifications_data_fix[$value["id_publication"]][$value["id_comment"]]["comment_response"][$value["id_response"]]["id_response"]=$value["id_response"];
	$notifications_data_fix[$value["id_publication"]][$value["id_comment"]]["comment_response"][$value["id_response"]]["response"]=$value["response"];
	}

	}

	// ordenar los comentarios y respuestas por registred_on_activity
	if($notifications_data_fix):
	foreach($notifications_data_fix as $keyy => $vv): 
		
		foreach($vv as $k=>$v): 

		$registred_on_activity[$k]=$v["registred_on_activity"]; 

		endforeach; 
	
	array_multisort($registred_on_activity,SORT_DESC,SORT_STRING,$notifications_data_fix[$keyy]); 
	endforeach; 

	endif;


	// if(!empty($ids_publications))	
	// foreach ($ids_publications as $key => $value){

	// // get comments by depend publications id 
 // 	$notifications_data[$value["id"]]["publications_comment"]=$this->db->select('*')
	// 												->where('publication_id',$value["id"])
	// 												->where('registred_by !=',$this->user_id)
	// 												->from('publications_comment')
	// 												->get()
	// 												->result_array();
	// }
	// foreach ($ids_publications as $key => $value){

	// $notifications_data[$value["id"]]["publications_comment"]["publications_comment_response"]=$this->db->select('*')
	// 														->where('publication_id',$value["id"])
	// 														->where('registred_by !=',$this->user_id)
	// 														->from('publications_comment_response')
	// 														->get()
	// 														->result_array();
	// }
	*/

	return $notifications_data;
    }
}