<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/File.php");

class Post extends CI_Controller {

	// cargamos las librerias a usar 
	public function __construct() {

		parent:: __construct();
		// $this->load->library('session');
		// $this->load->model("file_model");
		$this->load->model("post_model");
        $this->load->library('CI_Bcrypt');
		$this->load->helper('security');
		$this->load->helper('smiley');
		
	}

	public function create_and_edit(){

	return false;
	// esto es momentaneo 
	if(!empty($_POST["publication_id"]))	
	$idedit=$this->security->xss_clean( decode_id($_POST["publication_id"]) );
	
	$data['keditor_js'] = "<script src='".base_url()."js/ckeditor/ckeditor.js'></script>";
	
	// $data['upload_site'] = "<script src='".base_url()."js/upload/site.js'></script>";
	// $data['upload_ajaxfileupload'] = "<script src='".base_url()."js/upload/ajaxfileupload.js'></script>";

	// librerias imagenes
	$data['jquery_fileupload'] = "<script src='".base_url()."js/jQueryFileUpload/jquery.fileupload.js'></script>";
	$data['jquery_fileupload_ui'] = "<script src='".base_url()."js/jQueryFileUpload/jquery.fileupload-ui.js'></script>";

	$data['stylesheet_fileupload'] = '<link rel="stylesheet" href="'.base_url().'css/jQueryFileUpload/jquery.fileupload.css">';
	$data['stylesheet_fileupload_ui'] = '<link rel="stylesheet" href="'.base_url().'css/jQueryFileUpload/jquery.fileupload-ui.css">';
	    
	// preparar las categorias para el select
	$data['publications_categories'] = $this->home_model->get_categories_select();
	
	$data['publications_categories_select'][0]="Selecciona una categoria";

	if($data['publications_categories']) 
	foreach ($data['publications_categories'] as $key => $value)
	$data['publications_categories_select'][$value["id"]]=$value["name"];

	// preparar las sub-categorias para el select
	$data['publications_sub_categories'] = $this->home_model->get_sub_categories();

	$data['publications_sub_categories_select'][0]="Selecciona una Sub-Categoria";

	if($data['publications_sub_categories']) 
	foreach ($data['publications_sub_categories'] as $key => $value)
	$data['publications_sub_categories_select'][$value["id"]]=$value["name"];

	if ($_POST) {
		// return print_r(json_encode($_POST["description"]));
		$this->load->helper('email');	
		if(!$_POST["title"])
		$return=array("status"=>0,"msg"=>"El titulo es importante","title"=>1);
		
		if(!$_POST["description"])
		$return=array("status"=>0,"msg"=>"Descripción es obligatoria","description"=>1);
		
		if(!$_POST["category"])
		$return=array("status"=>0,"msg"=>"Categoria es obligatoria","category"=>1);
		
		if($this->session->userdata("user_id")==false){

			if(!empty($_POST["email"]) and !valid_email($_POST["email"]))
			$return=array("status"=>0,"msg"=>"El email no es correcto","email"=>1);
	

			if(!$_POST["password"] and empty($idedit))
			$return=array("status"=>0,"msg"=>"Password es necesario","password"=>1);
			else{ 
			$this->load->library('CI_Bcrypt'); 

				if( !empty($_POST["password"]) )
				$passwordHash = $this->ci_bcrypt->hash_password($this->security->xss_clean($_POST["password"])); 
			}	

		}

		if(!empty($return))
		return print_r(json_encode($return));

		$now          = date("Y-m-d H:i:s");
		$title        = $this->security->xss_clean($_POST["title"])?:"";
		$description  = $_POST["description"]?:"";
		$description  = 
		str_replace(
			array("&lt;iframe","&gt;","&lt;/iframe>","&lt;object","&lt;/object>","&lt;param","&lt;embed"),
			array("<iframe",">","</iframe>","<object","</object>","<param","<embed"), 
			$_POST["description"])?:"";
		// $description  = $this->security->xss_clean(str_replace(array("&lt;iframe","&gt;","&lt;/iframe>"),array("<iframe",">","</iframe>"), $_POST["description"]) )?:"";
		$category     = strip_tags($this->security->xss_clean($_POST["category"])?:"");
		$sub_category = strip_tags($this->security->xss_clean($_POST["sub_category"])?:"");
		$email        = strip_tags($this->security->xss_clean($_POST["email"])?:"");
		$url_facebook = $this->security->xss_clean($_POST["url_facebook"])?:"";
		$ip           = $this->input->ip_address();
		$registred_by = $this->security->xss_clean($this->session->userdata("user_id"))?:"";

		$data=array(
		"title"        =>$title,
		"description"  =>$description,
		"category"     =>$category,
		"sub_category" =>$sub_category,
		"email"        =>$email,
		"url_facebook" =>$url_facebook,
		"ip"           =>$ip
		);	

		if(!empty($passwordHash))
		$data=array_merge(array("password" =>$passwordHash),$data);

		if(!empty($idedit)):
		$data_depend=array("updated_by" =>$registred_by,"updated_on" =>$now);

		// esto es para cuando este en editar y le de F5 se salga
		$this->newdata($idedit,false);

		else:
		$data_depend=array("registred_by" =>$registred_by,"registred_on" =>$now);
		endif;

		$data=array_merge($data_depend,$data);
		$publication_id = (!empty($idedit)?$this->post_model->update_post($data,$idedit):$this->post_model->insert_post($data));
		// intertar los servidores de links 

		if(!empty($_POST["hostingServer"]) ){		
			foreach ($_POST["hostingServer"] as $key => $value) {

			//  si cargo links y no especidico el server	
			if(!empty($value["links"]) and empty($value["id_server"]))
			$return=array("status"=>0,"msg"=>"Si especificaste links tienes que seleccionar un servidor","hosting_servers"=>1);	

			if(!empty($return))
			return print_r(json_encode($return));
				
			if(empty($value["id_server"]))
			continue;	
			$hosting_servers_id = $this->security->xss_clean($value["id_server"])?:"";
			$description        = $this->security->xss_clean($value["description_links"])?:"";
			
			$data=array(
			"description"        =>$description,
			"hosting_servers_id" =>$hosting_servers_id,
			"publication_id"     =>$publication_id
			);	

			$data_depend=array(
			"registred_by" =>$registred_by,
			"registred_on" =>$now
			);
		
			$data=array_merge($data_depend,$data);

			$publications_hosting_server_id =$this->post_model->insert_hosting_server($data);

			if($value["links"])
			$links_explode =  $this->security->xss_clean($value["links"])? explode(",", $this->security->xss_clean($value["links"])) :"";
			
				if($links_explode)
				foreach ($links_explode as $key => $value) {

				if(empty($value))
				continue;
				$link  = $this->security->xss_clean($value)?:"";
				
				$data=array(
				"link"                           =>$link,
				"publications_hosting_server_id" =>$publications_hosting_server_id
				);

				$data_depend=array(
				"registred_by" =>$registred_by,
				"registred_on" =>$now
				);
				
				$data=array_merge($data_depend,$data);	

				$this->post_model->insert_hosting_server_link($data);
				
				}	

			}
		}
		// Actualizar los servidores descripcion 
		if(!empty($_POST["descriptionHostSvrUpdate"]) )	
		foreach ($_POST["descriptionHostSvrUpdate"] as $key => $value) {
		
		$publications_hosting_server_id = $this->security->xss_clean($value["id_server_update"])?:"";
		$description_link = $this->security->xss_clean($value["description_link"])?:"";

		$data=array(
			"description"=>$description_link,
			"updated_by" =>$registred_by,
			"updated_on" =>$now
			);	
		$this->post_model->update_hosting_server_description($data,$publications_hosting_server_id);

		}

		// Actualizar los servidores links 
		if(!empty($_POST["hostingServerUpdate"]) ){		
			foreach ($_POST["hostingServerUpdate"] as $key => $value) {

			if(empty($value["link_update"]))
			continue;	

			// where
			$publications_hosting_server_id = $this->security->xss_clean($value["id_server_update"])?:"";
			if(!empty($value["link_update_id"])):
			$link_update_id     = $this->security->xss_clean(base64_decode($value["link_update_id"]))?:"";
			else:
			$link_update_id =0;
			endif;	

			$link = $this->security->xss_clean($value["link_update"])?:"";
			$link_original = $value["link_original"]?$this->security->xss_clean($value["link_original"]):"";
			$link_description_update = $value["link_description_update"]?$this->security->xss_clean($value["link_description_update"]):"";
			
			$data=array(
				"link"=>$link,
				"original"=>$link_original,
				"description"=>$link_description_update
				);	
			
			// $query=$this->post_model->select_hosting_server_link($link_update_id);
			// return print_r(json_encode($query));

			if($this->post_model->select_hosting_server_link($link_update_id)):
			$data_depend=array("updated_by" =>$registred_by,"updated_on" =>$now);
			$data=array_merge($data_depend,$data);	
			$this->post_model->update_hosting_server_link($data,$publications_hosting_server_id,$link_update_id);
			else:

			$data_depend=array("registred_by" =>$registred_by,"registred_on" =>$now,"publications_hosting_server_id" =>$publications_hosting_server_id);
			$data=array_merge($data_depend,$data);	
			$this->post_model->insert_hosting_server_link($data);

			endif;
				
			}
		}
		//...
		// crear gif
		$file=new File();
		$fileGifName=$file->create_gif($publication_id);
		$this->post_model->set_or_delete_gif($publication_id,$fileGifName);

		// imagenes cargadas
		if(!empty($_POST["img_ids_upload"]) ){	
			foreach ($_POST["img_ids_upload"] as $key => $value) {
				$ids_publications_file[]= decode_id($this->security->xss_clean($value["id_img"]));
			}
			$ids_publications_file_implode=implode(",", $ids_publications_file);
			$file->updateImg($publication_id,$ids_publications_file);
		}



		if(!empty($idedit)):
		$msg="Modificado exitosamente";
		else:
		$msg="Post creado exitosamente";
		endif;

		return	rt(true,$msg,$publication_id);

	}

	$data['main_content']='management_post_view';
	$this->load->view('includes/template',$data);

	}

	public function edit_post_management_html(){

	$id_publication=$this->security->xss_clean($_POST["id_publication"]);
	$data_publication=$this->post_model->get_publication_by_id($id_publication);
		
	// revisar si es el password de la publicacion para editar
	$return=$this->check_password_function();
	if(!$return["status"])
    return print_r(json_encode($return));

	$data['data_publication'] = $data_publication;

	$data['keditor_js'] = "<script src='".base_url()."js/ckeditor/ckeditor.js'></script>";
	
	// librerias imagenes
	$data['jquery_fileupload'] = "<script src='".base_url()."js/jQueryFileUpload/jquery.fileupload.js'></script>";
	$data['jquery_fileupload_ui'] = "<script src='".base_url()."js/jQueryFileUpload/jquery.fileupload-ui.js'></script>";
	
	$data['stylesheet_fileupload'] = '<link rel="stylesheet" href="'.base_url().'css/jQueryFileUpload/jquery.fileupload.css">';
	$data['stylesheet_fileupload_ui'] = '<link rel="stylesheet" href="'.base_url().'css/jQueryFileUpload/jquery.fileupload-ui.css">';
	
	
	// preparar las categorias para el select
	$data['publications_categories'] = $this->home_model->get_categories_select();
	$data['publications_categories_select'][0]="Selecciona una categoria";

	if($data['publications_categories']) 
	foreach ($data['publications_categories'] as $key => $value) 
	$data['publications_categories_select'][$value["id"]]=$value["name"];
	// -....

	// preparar las sub-categorias para el select
	$data['publications_sub_categories'] = $this->home_model->get_sub_categories();
	$data['publications_sub_categories_select'][0]="Selecciona una Sub-Categoria";

	if($data['publications_sub_categories']) 
	foreach ($data['publications_sub_categories'] as $key => $value)
	$data['publications_sub_categories_select'][$value["id"]]=$value["name"];
	// -....
	$html = $this->load->view('management_post_view',$data,true);

	// esto es para cuando este en editar y le de F5 no se salga 
	$this->newdata($id_publication,true);

	return	rt(true,"editar publicación",$html);

	}

	// esto es para cuando este en editar y le de F5 no se salga 
	public function newdata($id_publication,$modify){

		$newdata = array('id_publication'  => $id_publication,'modify'=> $modify);
		return $this->session->set_userdata($newdata);

	}
	public function check_password_function(){

	// password para editar o borrar universalmente
    $this->load->model("vars_system_model");
    $sys=$this->vars_system_model->_vars_system();
    $universal_password=$sys["config"]["universal_password"]?$sys["config"]["universal_password"]:"";
    // ***

	$id_publication=$this->security->xss_clean($_POST["id_publication"]);
	$data_publication=$this->post_model->get_publication_by_id($id_publication);
	$passwordHash=$data_publication[$id_publication]["password"];

	$user_id=$this->session->userdata("user_id");
	$registred_by=$data_publication[$id_publication]["registred_by"];

	// return print_r( json_encode($user_id." / ".$registred_by) );

	if(!empty($_POST["passwordToModify"]))	
	$passwordToModify=$this->security->xss_clean($_POST["passwordToModify"]);
	
	if(!empty($passwordToModify)){

	$passwordContentModify[]=array("password"=>$passwordToModify);
	$this->session->set_userdata('passwordContentModify',$passwordContentModify);

	}

	$return=array("status"=>0,"msg"=>"No coinciden","password"=>1);

	if($this->session->userdata("passwordContentModify"))
	foreach($this->session->userdata("passwordContentModify") as $key => $value):

    if ( $this->ci_bcrypt->check_password($value["password"], $passwordHash) ):

     	// if( !($this->ci_bcrypt->check_password($value["password"],$universal_password)) ):
	$return=array("status"=>1,"msg"=>"Si coinciden","password"=>1);

    	// endif;
    endif;
	
	endforeach;

	/* Validacion de password universal */  
	if(!empty($value["password"]))
    if ( $this->ci_bcrypt->check_password($value["password"],$universal_password) )
	$return=array("status"=>1,"msg"=>"Si coinciden","password"=>1);

	/* Validacion de registrado  */
	if( !empty($user_id) and !empty($registred_by) ):
	    if ( $user_id==$registred_by )
		$return=array("status"=>1,"msg"=>"Si coinciden","password"=>1);
	endif;

	if(!empty($_POST["ajax"]))
	$ajax=$this->security->xss_clean($_POST["ajax"]);
	
	if(!empty($ajax)):
	return print_r( json_encode($return) );
	else:
	return $return;
	endif;

	}

	public function hostingServersLinks(){

		$data['hosting_servers'] = $this->post_model->get_hosting_servers();
      	$html= $this->load->view("hosting_servers_view",$data,true);
      	return rt(true,"",$html);
	}

	public function delete_link_hosting_server(){

		if(!empty($_POST["id_hosting_server"])){
		$id_link_hosting_server=$this->security->xss_clean($_POST["id_hosting_server"]);
		$this->post_model->delete_link_hosting_server_by_id($id_link_hosting_server);
      	}
      	return rt(true,"Eliminado exitosamente",false);
	}

	public function delete(){

		$id_publication=$this->security->xss_clean($_POST["id_publication"]);
		$passwordToModify=$this->security->xss_clean($_POST["passwordToModify"]);

		if(!empty($passwordToModify)){
			if($this->check_password_function()){

			$this->post_model->delete_model($id_publication);	
			return rt(true,"Se eliminó la publicación exitosamente",false);
				
			}
		}

	}

}
?>