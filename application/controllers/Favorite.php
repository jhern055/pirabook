<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favorite extends CI_Controller {

	public $user_id="";
	public $registred_by="";

	// cargamos las librerias a usar 
	public function __construct() {

		parent:: __construct();
		$this->load->library('CI_Bcrypt');
		$this->load->model('favorite_model');
		$this->load->helper('security');
		$this->load->model("login_model");

		$this->user_id      = $this->session->userdata('user_id');
		$this->registred_by = $this->session->userdata('user_id');
        $this->login_model->is_logged_in(current_url());
	}

	// metodo de inicio 
	public function index(){

		$data=array();
		$data['javascript_1_11_0'] = "<script src=".base_url()."js/jquery-1.11.0.js></script>";
		$data['publications_categories'] = $this->home_model->get_categories();
		$data['my_favorites'] = $this->buildMenu_favorite();
		$data_input['users_favorites_select'] = $this->favorite_model->users_favorites();

		$data_input['linkPreview_css']='<link rel="stylesheet" type="text/css" href="'.base_url().'/css/LinkPreview/linkPreview.css" />';
		$data_input['stylesheet_css']='<link rel="stylesheet" type="text/css" href="'.base_url().'/css/LinkPreview/stylesheet.css" />';

		$data_input['linkPreview'] = "<script src=".base_url()."js/LinkPreview/linkPreview.js></script>";
		$data_input['linkPreviewRetrieve'] = "<script src=".base_url()."js/LinkPreview/linkPreviewRetrieve.js></script>";

		$data['favorite_view_add_link'] =$this->load->view('favorite_view_add_link',$data_input,true);
		$data['main_content']      ='favorite_widget_view';
		$this->load->view('includes/template',$data);

	}

	function inputs(){

	$id_favorite =strip_tags($this->security->xss_clean($_POST["id_favorite"]));
	$users_favorites_select="";

	$attributes = 'id="favorite" tabindex="2"';
	if(!empty($id_favorite)){
	$users_favorites_select = $this->favorite_model->users_favorites($id_favorite);
	if(count($users_favorites_select)>1)
	$data_favorites= form_dropdown('sub_category',$users_favorites_select,null,$attributes);
	}
	
	return print_r(json_encode(
					array(
						"select_favorite"=>$data_favorites
						)
					));

	}

	public function link(){

	$data =array();
	$now  = date("Y-m-d H:i:s");
	$link_array=$_POST["link_array"];

	if(empty($_POST["parentid"]))
	{$return=array("status"=>0,"msg"=>"No especificaste la carpeta","folder"=>1); return print_r(json_encode($return));}


	if(!empty($link_array))
	foreach ($link_array as $k1 => $v1) {
		$id="";
		$link="";
		$parentid="";

		if(empty($v1["link"]))
		{$return=array("status"=>0,"msg"=>"No especificaste el link","link"=>1); return print_r(json_encode($return));}
		else
		$link=strip_tags( $this->security->xss_clean($v1["link"]));

		// if(empty($v1["parentid"]))
		// {$return=array("status"=>0,"msg"=>"No especificaste el parentid","parentid"=>1); return print_r(json_encode($return));}
		// else
		$parentid=strip_tags( $this->security->xss_clean($v1["parentid"]));

		if(!empty($v1["id"]))
		$id=decode_id(strip_tags( $this->security->xss_clean($v1["id"]) ));

		$data[$k1]=array(
			"id"=>$id,
			"link"=>$link,
			"users_favorites"=>$parentid,
			);
	}	

	if(!empty($data))
	foreach ($data as $k2 => $v2) {

		if(!empty($v2["id"])):
		$data_depend=array("updated_by" =>$this->registred_by,"updated_on" =>$now);
		else:
		$data_depend=array("registred_by" =>$this->registred_by,"registred_on" =>$now);
		endif;

		$data[$k2]=array_merge($data_depend,$data[$k2]);
		
		$link_favorite_id = (!empty($v2["id"])?$this->favorite_model->update_link($data[$k2],$v2["id"]):$this->favorite_model->insert_link($data[$k2]));
		
	}

	// select favorite
	$attributes = 'id="favorite" tabindex="2"';
	$users_favorites_select = $this->favorite_model->users_favorites(0);
	$data_favorites= form_dropdown('sub_category',$users_favorites_select,null,$attributes);

	return print_r(json_encode( array("status"=>1,"msg"=>"Se inserto el link","select_favorite"=>$data_favorites ) ) ) ;

	// return rt(true,"Se inserto el link",false);

	}

	public function in(){

		if(empty($_POST["nickname"]))
		$return=array("status"=>0,"msg"=>"No especificaste el nickname","nickname"=>1);

		if(empty($_POST["password"]))
		$return=array("status"=>0,"msg"=>"No especificaste el password","password"=>1);

		if(!empty($_POST["nickname"]))
		$pass_hash=$this->login_model->check_if_there_nickname( $this->security->xss_clean($_POST["nickname"]));
		
		if(empty($pass_hash))
		$return=array("status"=>0,"msg"=>"Este nickname no esta registrado si gustas puedes crear una cuenta","thereNickName"=>1);

		$password = $this->security->xss_clean($_POST["password"]);
		$nickname = $this->security->xss_clean($_POST["nickname"]);
		
		if(!empty($pass_hash)){
		if(!$this->ci_bcrypt->check_password($password,$pass_hash[0]["pass_hash"]))
		$return=array("status"=>0,"msg"=>"Vuelve a introducir tu contraseña","passwordBad"=>1);
		}

		if(!empty($return) )
		return print_r(json_encode($return) );	
		else{

			$user["user"]=array("nickname"=>$nickname,"user_id"=>encode_url($pass_hash[0]["id"]),"user_email"=>$pass_hash[0]["email"]);	
			$this->session->set_userdata($user);
			$this->session->set_userdata("user_id",$pass_hash[0]["id"]);
			return rt(true,"Bienvenido a Pirabook :)",false);

		}

	}

	public function addFolder(){

		$data=array();
		$data['javascript_1_11_0'] = "<script src=".base_url()."js/jquery-1.11.0.js></script>";
		$data['publications_categories'] = $this->home_model->get_categories();
		$data['my_favorites'] = $this->buildMenu_favorite();
		$data_input['users_favorites_select'] = $this->favorite_model->users_favorites();

		$data['favorite_view_add_link'] =$this->load->view('favorite_view_add_folder',$data_input,true);
		$data['main_content']='favorite_widget_view';
		$this->load->view('includes/template',$data);

	}

	public function Folder_it(){

	$data =array();
	$now  = date("Y-m-d H:i:s");
	$folder_array=$_POST["folder_array"];

	if(!empty($folder_array))
	foreach ($folder_array as $k1 => $v1) {
		$id="";
		$folder="";
		$parentid="";

		if(empty($v1["folder"]))
		{$return=array("status"=>0,"msg"=>"No especificaste el folder","folder"=>1); return print_r(json_encode($return));}
		else
		$folder=strip_tags( $this->security->xss_clean($v1["folder"]));

		$parentid=strip_tags( $this->security->xss_clean($v1["parentid"]));

		if(!empty($v1["id"]))
		$id=decode_id(strip_tags( $this->security->xss_clean($v1["id"]) ));

		$data[$k1]=array(
			"id"=>$id,
			"title"=>$folder,
			"parentid"=>$parentid,
			);
	}	

	if(!empty($data))
	foreach ($data as $k2 => $v2) {

		if(!empty($v2["id"])):
		$data_depend=array("updated_by" =>$this->registred_by,"updated_on" =>$now);
		else:
		$data_depend=array("registred_by" =>$this->registred_by,"registred_on" =>$now);
		endif;

		$data[$k2]=array_merge($data_depend,$data[$k2]);
		
		$link_favorite_id = (!empty($v2["id"])?$this->favorite_model->update_folder($data[$k2],$v2["id"]):$this->favorite_model->insert_folder($data[$k2]));
		
	}


	// select favorite
	$attributes = 'id="favorite" tabindex="2"';
	$users_favorites_select = $this->favorite_model->users_favorites(0);
	$data_favorites= form_dropdown('sub_category',$users_favorites_select,null,$attributes);

	return print_r(json_encode( array("status"=>1,"msg"=>"Se inserto el folder","select_favorite"=>$data_favorites ) ) ) ;

	}

	public function buildMenu_favorite(){

		$menu_html="";
		$menu_html.=buildMenu(0, $this->favorite_model->get_my_favorites());
		$menu_html.='<link rel="stylesheet" type="text/css" href="'.base_url().'/css/dynamic_menu_favorite/styles.css" />';
		$menu_html.='<script type="text/javascript" src="'.base_url().'/css/dynamic_menu_favorite/script.js"></script>';

		if(!empty($_POST["ajax"]))
		return print_r(json_encode( array("status"=>1,"menu"=>$menu_html ) ) ) ;
		else
		return $menu_html;
	}

	public function delete(){
	$id_favorite =strip_tags($this->security->xss_clean($_POST["id_menu"]));
	$id_favorite_decode=decode_id($id_favorite);
	// si es su favorito deja avanzar
		if($this->favorite_model->favorites_your( $id_favorite_decode )){

			// verificar si tiene hijos y si tiene hijos no eliminar
			if($msg=$this->favorite_model->favorite_relation( $id_favorite_decode ))
	 		return rt(false,$msg.", no puede ser eliminada",false);
	 		else{

			$this->favorite_model->delete_it( $id_favorite_decode );
	 		return rt(true,"eliminado exitosamente",false);
	 		}
		}
		else
	 	return rt(false," este favorito no te pertenece",false);

	}

	public function delete_url(){
	$id_url =strip_tags($this->security->xss_clean($_POST["id_url"]));
	$id_url_decode=decode_id($id_url);
	// si es su favorito deja avanzar
		if($this->favorite_model->url_your( $id_url_decode )){

			$this->favorite_model->delete_url_it( $id_url_decode );
	 		return rt(true,"eliminado exitosamente",false);
		}
		else
	 	return rt(false," este url no te pertenece",false);

	}


	public function get_links(){

	if(!empty($_POST["id_menu"])):
	$id_favorite =strip_tags($this->security->xss_clean($_POST["id_menu"]));
	$id_favorite_decode=decode_id($id_favorite);
	endif;

		// paginacion
		$this->load->library("pagination");
    	$config["base_url"] = base_url() . "favorite/get_links";
		$config['total_rows'] = $this->favorite_model->get_links_amount($id_favorite_decode);
		$config["per_page"] = 5;
		
        /* This Application Must Be Used With BootStrap 3 * esto es bootstrap 3 */
		$config['full_tag_open'] = "<ul class='pagination pagination-small pagination-centered things_pagination' data-paginations_div='1' data-id_favorite='$id_favorite'>";
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
 		$data["pagination"] = $this->pagination->create_links();

	$data['folder'] =$this->favorite_model->get_links($config["per_page"], $page,$id_favorite_decode);

	$this->session->set_userdata('things_divs_links_start_row',$page);

	$html="";
	$html =$this->load->view('links_views',$data,true);

	return rt(true,"informacion exito",$html );

	}

}