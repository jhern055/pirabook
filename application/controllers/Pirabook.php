<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pirabook extends CI_Controller {

	public function __construct() {

	parent::__construct();

	}
	
	public function children($module=null) {


	$module="pirabook/";
	$data["module"]=$module;	

	$data["module_data"]=$this->load->module_text_from_id($module);
	$data["module_childrens"]=$this->load->get_module_childrens($data["module_data"]["id"]);

	// if(empty($data["module_childrens"]))
	// redirect($module);	

	if(!empty($_POST["ajax"]))
	return print_r(json_encode(array("status"=>1,"msg"=>"HtmlConExito","html"=>$this->load->view('recycled/menu/Module_children',$data,true) ))) ;
	else
	return $this->load->template('recycled/menu/Module_children',$data);

	}

	// carga normal
	public function index() {
	$this->children("pirabook/");	

	}

}