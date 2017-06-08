<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."../../../captcha/simple-capcha/simple-php-captcha.php");
class Comment extends CI_Controller {

	public $user_id;

	public function __construct() {
		
		parent:: __construct();
		$this->user_id=$this->session->userdata("user_id");
		$this->load->model("comment_model");

	}
	
	public function comment_html() {
	
	$data=array();

	if ($_POST) {

		$value=""; // donde se almacenara el comentario o respuesta :
		// $id_com_resp = decode_id( $_POST["id_comm"]);
		$id_com_resp =(!empty($_POST["id_comm"])? strip_tags( $this->security->xss_clean( decode_id( $_POST["id_comm"] ) ) ) :"" ) ;
		$type =(!empty($_POST["type"])? strip_tags( $this->security->xss_clean($_POST["type"]) ) :"" ) ;
		$publication_id =(!empty($_POST["publication_id"])? strip_tags( $this->security->xss_clean($_POST["publication_id"]) ) :"" ) ;
		$ip=$this->input->ip_address();
		
		$data_to_search=array(
		"id"=>$id_com_resp,
		"publication_id"=>$publication_id
			);

		if($this->user_id)
		$data_to_search=array_merge($data_to_search,array("registred_by"=>$this->user_id));
		else
		$data_to_search=array_merge($data_to_search,array("ip"=>$ip));

		switch ($type) {
			case $type=='comment':
			$value=$this->comment_model->get_comment($data_to_search);

			break;
		
			case $type=='response':
			$value=$this->comment_model->get_response($data_to_search);
			break;

			default:
			# code...
			break;
		}

	$data["type"]=$type;	
	$data["id_com_resp"]=$id_com_resp;	
	$data["comment_or_response"]=$value;
		
	}

	// return rt(true,"Trar el form comment",$value);	
	// captcha
		$_SESSION['captcha']=simple_php_captcha();
		$data["captcha"]= $_SESSION['captcha'];
	//pasamos a la vista el título y el captcha que hemos creado

	$html=$this->load->view("comments_form",$data,true);

	return rt(true,"Trar el form comment",$html);
	}

	public function delete() {

	$data=array();

	if ($_POST) {

		$value=""; // donde se almacenara el comentario o respuesta :
		// $id_com_resp = decode_id( $_POST["id_comm"]);
		$id_com_resp =(!empty($_POST["id_comm"])? strip_tags( $this->security->xss_clean( decode_id( $_POST["id_comm"] ) ) ) :"" ) ;
		$type =(!empty($_POST["type"])? strip_tags( $this->security->xss_clean($_POST["type"]) ) :"" ) ;
		$publication_id =(!empty($_POST["publication_id"])? strip_tags( $this->security->xss_clean($_POST["publication_id"]) ) :"" ) ;
		$ip=$this->input->ip_address();

	$data_to_search=array(
	"id"=>$id_com_resp,
	"publication_id"=>$publication_id
	);

	if($this->user_id)
	$data_to_search=array_merge($data_to_search,array("registred_by"=>$this->user_id));
	else
	$data_to_search=array_merge($data_to_search,array("ip"=>$ip));

	 $value=$this->comment_model->delete_it($data_to_search,$type);

	}

	return rt(true,"Se elimino el comentario",false);
	}


}
?>