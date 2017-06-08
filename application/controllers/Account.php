<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public $user_id;

	public function __construct() {

		parent:: __construct();
		// $this->load->helper("url");
		// $this->load->library("pagination");
		// $this->load->helper('date');
		// $this->load->helper('security');
		// $this->load->library('CI_Bcrypt');
		// $this->load->helper('smiley');
		// $this->load->library("email");
		// $this->load->model("notifications_model");
		$this->user_id=$this->session->userdata("user_id");
	}
	public function index() {
	if(empty($this->user_id))
	redirect("/home");	

	$data=array();	
	$data['main_content']='account_view';
	$this->load->view('includes/template',$data);
	}

}
?>