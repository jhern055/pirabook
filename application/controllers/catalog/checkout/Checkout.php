<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct() {

	parent::__construct();

	$this->load->model("catalog/product/product_model");
    $segment = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

	}

	public function index(){
	// $data['main_content']='catalog/checkout/checkout_pcel';
	$data['main_content']='catalog/checkout/checkout';
	$data['common_right']=false;
	$this->load->view('includes/template',$data);
	}

	public function checkout(){

	// $data['main_content']='catalog/checkout/checkout';
	// $data['common_right']=false;
	// $this->load->view('includes/template',$data);

	}

}
 ?>