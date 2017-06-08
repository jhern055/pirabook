<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."../../../captcha/simple-capcha/simple-php-captcha.php");
class Home extends CI_Controller {

	// cargamos las librerias a usar 
	public function __construct() {
		parent:: __construct();

		$this->load->model("comment_model");
		
		$this->load->library("pagination");
		// $this->load->library('session');
		$this->load->library('CI_Bcrypt');
		$this->load->library("email");
		$this->load->helper("url");
		$this->load->helper('date');

		$this->load->helper('security');
		$this->load->helper('smiley');
		$this->load->helper('functions');

	}
	// metodo de inicio 
	public function index(){
    // $this->load->model("notifications_model");
    // $k=$this->notifications_model->getNotificationsNum_get();
    // pr($k);
		$this->show();
	}

	//  ayuda a cargar el principal
	public function show(){
	
		$data['javascript_1_11_0'] = "<script src=".base_url()."js/jquery-1.11.0.js></script>";
		$data['publications_categories'] = $this->home_model->get_categories();
		$data['main_content']='index';
		$this->load->view('includes/template',$data);

	}

	// paginacion de ajax 
	public function show_ajax(){

		$config = array();
		$http_params=array_merge($_GET,$_POST);

		// CATEGORIA
		if(!empty($_POST["id_category"])):
		$id_category = $this->security->xss_clean($_POST["id_category"]);
		else:
			if(!empty($_GET["id_category"])):
			$id_category = $this->security->xss_clean($_GET["id_category"]);
			else:
			$id_category = "";	
			endif;
		endif;
		$this->session->set_userdata('id_category',$id_category);
		$input_search=(!empty($http_params["input_search"]) ? strip_tags( $this->security->xss_clean( $http_params["input_search"]) ) :"");

		// paginacion

    	$config["base_url"] = base_url() . "home/show_ajax";
		$config['total_rows'] = $this->home_model->get_publications_count($input_search,$id_category);
		$config["per_page"] = 30;
		
        /* This Application Must Be Used With BootStrap 3 * esto es bootstrap 3 */
		$config['full_tag_open'] = "<ul class='pagination pagination-small pagination-centered things_pagination' data-id_catery='$id_category'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
    
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data = array();

		// if($_GET)
  //       $order_by = ( ($_GET["order_by"]=="views") ? "views": (($_GET["order_by"]=="comments")?"comments":"ids"));
  //   	else 
    	$order_by ="ids";
    		
		$this->session->set_userdata('publication_order_by',$order_by);

		$input_search = !empty($_POST["input_search"])?$this->security->xss_clean($_POST["input_search"]):"";
		$this->session->set_userdata('input_search',$input_search);

		$data["publications"] = $this->home_model->get_publications($config["per_page"], $page,$this->session->userdata("publication_order_by"),$this->session->userdata("input_search"),$this->session->userdata("id_category"));
        $data["pagination"] = $this->pagination->create_links();
		// ...

		// total de publicaciones 
		$data["publications_amount"] = $this->home_model->get_publications_count_post_conditions($this->session->userdata("input_search"),$this->session->userdata("id_category"));

		// $data['publications_categories'] = $this->home_model->get_categories();

		// $this->session->set_userdata('things_publications_start_row',$page);

		$_html = $this->load->view('publications_table',$data,true);
		echo $_html;
	}

	public function show_ajax_div(){
		
		$config = array();
		$http_params=array_merge($_GET,$_POST);

		// CATEGORIA
		if(!empty($_POST["id_category"])):
		$id_category = $this->security->xss_clean($_POST["id_category"]);
		else:
			if(!empty($_GET["id_category"])):
			$id_category = $this->security->xss_clean($_GET["id_category"]);
			else:
			$id_category = "";
			endif;
		endif;
		$this->session->set_userdata('id_category',$id_category);
		$input_search=(!empty($http_params["input_search"]) ? strip_tags( $this->security->xss_clean( $http_params["input_search"]) ) :"");

		// paginacion
    		
    	$config["base_url"] = base_url() . "home/show_ajax_div";
		$config['total_rows'] = $this->home_model->get_publications_count($input_search,$id_category);
		$config["per_page"] = 30;
		
        /* This Application Must Be Used With BootStrap 3 * esto es bootstrap 3 */
		$config['full_tag_open'] = "<ul class='pagination pagination-small pagination-centered things_pagination' data-paginations_div='1' data-id_catery='$id_category'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
    
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data = array();

		// if($_GET)
  		// $order_by = ( ($_GET["order_by"]=="views") ? "views": (($_GET["order_by"]=="comments")?"comments":"ids"));
  		// else 
    	$order_by ="ids";
    		
		$this->session->set_userdata('publication_order_by',$order_by);

		// $input_search = !empty($_POST["input_search"])?$this->security->xss_clean($_POST["input_search"]):"";
		$this->session->set_userdata('input_search',$input_search);

		$data["publications"] = $this->home_model->get_publications_divs($config["per_page"], $page,$this->session->userdata("publication_order_by"),$this->session->userdata("input_search"),$this->session->userdata("id_category"));
        $data["publications_amount"]= count($data["publications"]);
        $data["total_rows"]= $config['total_rows'];

        $data["pagination"] = $this->pagination->create_links();
        
		// if(empty($data["publications"]))
		// 	$page=$config["per_page"]-($config["per_page"]/2);
			
		// // ...

		// $this->session->set_userdata('things_divs_publications_start_row',$page);
		$_html = $this->load->view('publications',$data,true);
		echo $_html;
	}

	// traer el annuncio a ver por id
	public function publication(){

		$id=$this->security->xss_clean($this->uri->segment(3));

		// aumentar un view al anuncio
		if(!$_POST)
		$this->home_model->update_view($id);
		
		if($_POST){
			// echo sprintf('#%06X', mt_rand(0, 0xFFFFFF));
			$this->load->helper('email');
			// if(!$_POST["name"])
			// $return=array("status"=>0,"msg"=>"Se requiere nombre","data"=>false);

			if(!$_POST["comment"])
			return print_r(json_encode(array("status"=>0,"msg"=>"Se requiere el comentario","data"=>false)));
			
			if(!$_POST["publication_id"])
			return print_r(json_encode(array("status"=>0,"msg"=>"Faltan parametros","data"=>false) ));
		
			if(!empty($_POST["email"]) and !valid_email($_POST["email"]))
			return print_r(json_encode(array("status"=>0,"msg"=>"El email no es correcto","data"=>false) ));
// <captcha>
			if(!$_POST["captcha"])
			return print_r(json_encode(array("status"=>0,"msg"=>"Introduce la captcha","data"=>false,"captcha"=>1)));

			if(!empty($_POST["captcha"]))
			$captcha=strip_tags($this->security->xss_clean($_POST["captcha"]));

			if(!empty($_POST["captcha"]) and $_SESSION["captcha"]["code"] !=$_POST["captcha"])
			return print_r(json_encode(array("status"=>0,"msg"=>"La capcha que capturaste no coincide","data"=>false,"captcha"=>1)));
			
			// if(!empty($_POST["captcha"]) and !$this->captcha_model->check($this->input->ip_address(),$captcha) )
			// return print_r(json_encode(array("status"=>0,"msg"=>"La capcha que capturaste no coincide","data"=>false,"captcha"=>1)));
// </captcha>

			if(!empty($return) )
			return print_r(json_encode($return) );	
			else{
				
				$now = date("Y-m-d H:i:s");
				$registred_by=$this->security->xss_clean($this->session->userdata("user_id"));

				if( !empty($_POST["id_com_resp"]) )
				$id_com_resp=strip_tags($this->security->xss_clean( decode_id($_POST["id_com_resp"]) ));

				if(!empty($_POST["commentToResponse"]) or (!empty($_POST["type"]) and $_POST["type"]=="response" ) ) {

				$data=array(
				"response"=>$this->security->xss_clean($_POST["comment"]),
				"publication_id"=>$this->security->xss_clean($_POST["publication_id"]),
				"ip"=>$this->input->ip_address()
				);	

				// comentario a responder este solo se usa si no viene de actualizar
				if(!empty($_POST["commentToResponse"]))
				$data["comment_id"]=strip_tags($this->security->xss_clean($_POST["commentToResponse"]));
			
				if(!empty($_POST["name"]))
				$data["name"]  =$this->security->xss_clean($_POST["name"]);

				if(!empty($_POST["email"]))
				$data["email"] =$this->security->xss_clean($_POST["email"]);

				if(!empty($id_com_resp)):
				$data_depend=array("updated_by" =>$registred_by,"updated_on" =>$now);
				else:
				$data_depend=array("registred_by" =>$registred_by,"registred_on" =>$now);
				endif;
				
				$data=array_merge($data_depend,$data);

				if(!empty($id_com_resp)):
				$this->comment_model->update_comment_response($data,$id_com_resp);
				else:
				$this->comment_model->insert_comment_response($data);
				endif;


				}else{

				$data=array(
				"comment"=>$this->security->xss_clean($_POST["comment"]),
				"publication_id"=>$this->security->xss_clean($_POST["publication_id"]),
				"ip"=>$this->input->ip_address(),
				);	

				if(!empty($_POST["name"]))
				$data["name"]  =$this->security->xss_clean($_POST["name"]);

				if(!empty($_POST["email"]))
				$data["email"] =$this->security->xss_clean($_POST["email"]);

				if(!empty($id_com_resp)):
				$data_depend=array("updated_by" =>$registred_by,"updated_on" =>$now);
				else:
				$data_depend=array("registred_by" =>$registred_by,"registred_on" =>$now);
				endif;
				
				$data=array_merge($data_depend,$data);
				// return	rt(true,"Se inserto el comentario",$_POST);

				if(!empty($id_com_resp)):
				$this->comment_model->update_comment($data,$id_com_resp);
				else:
				$this->comment_model->insert_comment($data);
				endif;

				}

		        $data_update_ajax["publication"]=$this->home_model->get_publication_by($this->security->xss_clean($_POST["publication_id"]));

        		$see=$this->load->view('posted_comments',$data_update_ajax, true);
				return	rt(true,"Se inserto el comentario",$see);

			}
		}
		
		$data = array();
		$data['keditor_js'] = "<script src='".base_url()."js/ckeditor/ckeditor.js'></script>";
		$data['javascript_1_11_0'] = "<script src=".base_url()."js/jquery-1.11.0.js></script>";
		
		// social locker
		$data['css_social_locker'] = "<link href='".base_url()."css/social_locker/socialLocker.css'  rel='stylesheet'>";
		// ....
		$data['tabs'] = "<link href=".base_url()."css/tabs.css rel='stylesheet'>";
		
		$data['id'] = (!(empty($id))?$id:0);
		$data['publication'] = $this->home_model->get_publication_by($id);

		$data['publications_categories'] = $this->home_model->get_categories();

		// captcha
		$_SESSION['captcha'] =simple_php_captcha();
		$data["captcha"]     = $_SESSION['captcha'];

		if($data['publication'][$id]["is_sale"]==1):
		// $data['main_content']='product/mireino';
		$data['main_content']='product/product_detail2';
		// $data['main_content']='product/leo_digital';
		else:
		$data['main_content']='publication_view';
		endif;
		$this->load->model("vars_system_model");
		
		// $this->load->view('product/leo_digital');
		$this->load->view('includes/template',$data);
	}
	public function publication_html(){

		$id_publication=$this->security->xss_clean($_POST["id_publication"]);
		
		$newdata = array('id_publication'  => $id_publication,'modify'=> false);
 		$this->session->set_userdata($newdata);

		return print_r( json_encode(array("status"=>1,"msg"=>"","data"=>false)) );

	}

	public function showMoreComments(){
			
		$lastmsg=$this->security->xss_clean($_GET["lastmsg"]);
		$id_publication=$this->security->xss_clean($_GET["id_publication"]);
		$limit=15+$lastmsg;

		
		$return["publication"][]=$this->comment_model->get_comment_by_publication($id_publication,$limit);
        $html=$this->load->view('posted_comments',$return, true);
		$commentsAmount=$this->comment_model->get_comments_amount($id_publication);


		if($lastmsg >= $commentsAmount)
    	return rt(false,"No hay mas comentarios");
    

		return rt(true,"",$html);
	}

	public function showMoreCommentsResponse(){
			
		$lastmsg=$this->security->xss_clean($_GET["lastmsg"]);
		$id_publication=$this->security->xss_clean($_GET["id_publication"]);
		$id_comment=$this->security->xss_clean($_GET["id_comment"]);
		$limit=15+$lastmsg;


		$return["comments_response_amount"]=$this->comment_model->get_responseComments_amount($id_publication,$id_comment);
		$return["comments_response"]=$this->comment_model->get_commentResponse_by_PublicationAndidComent($id_publication,$id_comment,$limit);
        $html=$this->load->view('nested_comment',$return, true);

		$responseCommentsAmount=$this->comment_model->get_responseComments_amount($id_publication,$id_comment);

		if($lastmsg >= $responseCommentsAmount)
    	return rt(false,"No hay mas comentarios");

		return rt(true,"",$html);
	}

	public function sendInfo(){

		$data=array(
		"name"=>$this->security->xss_clean($_POST["name"]),
		"contact"=>$this->security->xss_clean($_POST["contact_info"]),
		);

		if($id=$this->home_model->select_contact_info($data))
    	$this->home_model->update_contact_info($id,$data);
    	else
    	$this->home_model->insert_contact_info($data);

		$this->load->helper("email");
    	$return =sendNotification($data,"Informacion de Roku");

    	if($return["status"])
    	return print_r(json_encode($return));	

    	return print_r(json_encode($return));
	}
}