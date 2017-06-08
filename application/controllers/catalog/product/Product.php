<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public  $page;
	public function __construct() {

	parent::__construct();

	$this->load->model("catalog/product/product_model");
    $segment = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

	$this->page=( (!empty($segment))? $segment:0);

	}

	public function category() {
	
	$category =(!empty($this->uri->segment(3)) ? strip_tags( $this->security->xss_clean( $this->uri->segment(3) ) ) :0);
	$this->load->library("pagination");
	
	# traer los productos de la categoria y hacer paginacion

	$data['main_content']='catalog/product/category';
	$data['common_right']=false;

	#PAGINACION

	$http_params=array_merge($_GET,$_POST);
	$http_params          =array(
	"input_search_product" =>(!empty($http_params["input_search_product"]) ? strip_tags( $this->security->xss_clean( $http_params["input_search_product"] ) ) :""),
	"show_amount_products"  =>(!empty($http_params["show_amount_products"]) ? strip_tags( $this->security->xss_clean( $http_params["show_amount_products"])  ) :5),
	);
	extract($http_params);

	$page_amount=$show_amount_products;
// pr($page_amount	); exit();
	$query_search=array(
		"\$this->db->like('description', \"".$input_search_product."\");",
		);

	$total_products_category=$this->product_model->get_products_category_amount($category);
	$data["text_pagination"]="Página ".$this->page." con ".$page_amount." productos de ".$total_products_category." en total (1 Páginas)";
   
   	$data['products_category']=$this->product_model->get_product_category($page_amount, $this->page,$query_search,$category);

	$this->pagination->initialize($this->config_pagination("product/category/".$category."/",$this->product_model->get_products_amount($query_search,$category),$page_amount) );
	$data['pagination']=$this->pagination->create_links();
	#<paginacion>  ....


	$this->load->view('includes/template',$data);
	
	}


	public function config_pagination($method,$amount,$per_page) {

	$config["base_url"] = base_url() .$method;
	// $config["base_url"] = base_url() .$method;
	$config['total_rows'] = $amount;
	$config["per_page"] = $per_page;
	// pr(str_replace("/", "_", $method));
	/* This Application Must Be Used With BootStrap 3 * esto es bootstrap 3 */
	$config['full_tag_open'] = "<ul class='pagination pagination-small pagination-centered ".str_replace("/", "_", $method)."' data-paginations_div='1'>";
	$config['full_tag_close'] ="</ul>";
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';
	$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='javascript:void(0)' class='not-active'>";
	$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
	$config['next_tag_open'] = "<li>";
	$config['next_tag_close'] = "</li>";
	$config['prev_tag_open'] = "<li>";
	$config['prev_tag_close'] = " </li>";
	$config['first_tag_open'] = "<li>";
	$config['first_tag_close'] = "</li>";
	$config['first_url'] = '0';
	$config['last_tag_open'] = "<li>";
	$config['last_tag_close'] = "</li>";

	return $config;

	}	
}
