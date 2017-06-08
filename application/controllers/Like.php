<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Like extends CI_Controller {

	// cargamos las librerias a usar 
	public function __construct() {

		parent:: __construct();
		$this->load->model('like_model');
		$this->load->helper('security');

	}

	public function in(){
		
		$id_publication= $this->security->xss_clean($_POST["id_publication"]);
		$id_comm=(!empty($_POST["id_comm"])?$this->security->xss_clean($_POST["id_comm"]):"");
		$id_comm=base64_decode($id_comm);
		$ip = $this->input->ip_address();
		$now = date("Y-m-d H:i:s");
		$type=(!empty($_POST["type"])?$this->security->xss_clean($_POST["type"]):"");
		$option="like";

		$array=array(
			"ip"=>$ip,
			"id_record"=>$id_comm,
			"id_publication"=>$id_publication,
			"type"=>$type,
			"option"=>$option,
			"registred_by"=>$this->session->userdata("user_id"),
			"registred_on"=>$now
			);

		if($this->like_model->check_if_there($id_comm,$ip,$type,$option,$id_publication) )
		$this->like_model->delete($id_comm,$ip,$type,$option,$id_publication);
		else
		$this->like_model->insert($array);

		if($this->like_model->check_if_there($id_comm,$ip,$type,"not_like",$id_publication) )
		$this->like_model->delete($id_comm,$ip,$type,"not_like",$id_publication);

		$data=array(
			"likes"=>$this->like_model->get_likes($id_comm,$type,$option,$id_publication),
			"Nolikes"=>$this->like_model->get_likes($id_comm,$type,"not_like",$id_publication)
			);
		
		// success, msg, data
		return rt(true,"exito",$data);
	}

	public function out(){
		
		$id_publication= $this->security->xss_clean($_POST["id_publication"]);
		$id_comm=(!empty($_POST["id_comm"])?$this->security->xss_clean($_POST["id_comm"]):"");
		$id_comm=base64_decode($id_comm);
		$ip = $this->input->ip_address();
		$now = date("Y-m-d H:i:s");
		$type=(!empty($_POST["type"])?$this->security->xss_clean($_POST["type"]):"");
		$option="not_like";

		$array=array(
			"ip"=>$ip,
			"id_record"=>$id_comm,
			"id_publication"=>$id_publication,
			"type"=>$type,
			"option"=>$option,
			"registred_by"=>$this->session->userdata("user_id"),
			"registred_on"=>$now
			);


		if($this->like_model->check_if_there($id_comm,$ip,$type,$option,$id_publication) )
		$this->like_model->delete($id_comm,$ip,$type,$option,$id_publication);
		else
		$this->like_model->insert($array);

		if($this->like_model->check_if_there($id_comm,$ip,$type,"like",$id_publication) )
		$this->like_model->delete($id_comm,$ip,$type,"like",$id_publication);

		$data=array(
			"likes"=>$this->like_model->get_likes($id_comm,$type,"like",$id_publication),
			"Nolikes"=>$this->like_model->get_likes($id_comm,$type,$option,$id_publication)
			);
		
		// success, msg, data
		return rt(true,"exito",$data);
	}
}