<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index(){
		
		$arreglo = array();
		$this->load->model('inicio_model');
		
		$arreglo['anuncios'] = $this->inicio_model->traer_anuncios();
		$arreglo['main_content']='index';

		mpr($arreglo);
		$this->load->view('includes/template',$arreglo);	        

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */