<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SoBad extends CI_Controller {
	public  $config;
	public  $page;
	public 	$registred_by;
	public 	$idTemp;
	public 	$sys;

    // publication
	public 	$uri_publication;
    // ...    

	public function __construct() {

	parent::__construct();

	$this->load->model("publication/publication_model");

	$this->load->model("vars_system_model");
	$this->load->library("pagination");
	$segment=(int)$this->uri->segment(2);
	$this->sys=$this->vars_system_model->_vars_system();

	// esto es porque tuve conflicto con el segmento 3 cuando era  segmento/segmento/segmento/segmento/
	$x =3; 
	while (is_string($segment) or empty($segment) ){
		$segment=$this->uri->segment($x)?(int)$this->uri->segment($x):""; $x++;

		if($x>=20){
		$segment=0;	
		break;
		}
	}

	$this->page=( (!empty($segment))? $segment:0);

	$this->now = date("Y-m-d H:i:s");
	$this->registred_by=$this->security->xss_clean($this->session->userdata("user_id"));
	$this->idTemp=$this->session->userdata("idTemp");

	
    $MODE=(!empty($_POST["MODE"])?strip_tags( $this->security->xss_clean($_POST["MODE"]) ) : "");

    $uri_string=array_merge($_GET,$_POST);
    $uri_string=(!empty($uri_string["uri_string"])? $uri_string["uri_string"]:$this->uri->uri_string );

		// Remissiones <publication>		
		$this->uri_publication="publication/";
		// </publication>	
	
	}
	
	// insertar o actualizar
	public function do_it($id=null,$method=null) {
	$http_params=array_merge($_GET,$_POST);

	$http_params   =array(
	"MODE"         =>"do_it",
	"id"           =>(!empty($http_params["id"]) ? strip_tags( $this->security->xss_clean( decode_id($http_params["id"]) ) ) :""),
	"title"        =>(!empty($http_params["title"]) ?strip_tags( $this->security->xss_clean($http_params["title"]) ):""),
	"description"  =>(!empty($http_params["description"]) ?strip_tags( $this->security->xss_clean($http_params["description"]) ):""),
	"category"     =>(!empty($http_params["category"]) ?strip_tags( $this->security->xss_clean($http_params["category"]) ):""),
	"sub_category" =>(!empty($http_params["sub_category"]) ?strip_tags( $this->security->xss_clean($http_params["sub_category"]) ):""),
	"email"        =>(!empty($http_params["email"]) ?strip_tags( $this->security->xss_clean($http_params["email"]) ):""),
	"password"     =>(!empty($http_params["password"]) ?strip_tags( $this->security->xss_clean($http_params["password"]) ):""),
	"url_facebook" =>(!empty($http_params["url_facebook"]) ?strip_tags( $this->security->xss_clean($http_params["url_facebook"]) ):""),
	"price"        =>(!empty($http_params["price"]) ?strip_tags( $this->security->xss_clean($http_params["price"]) ):""),
	"file_name_tmp"=>(!empty($http_params["files"]) ?$http_params["files"]:""),
	
	);

	extract($http_params);

	// <limpiar>
	$file_name=array(); 
	if(is_array($file_name_tmp))
		foreach ($file_name_tmp as $k => $v) $file_name[]=$this->security->xss_clean($v["file_name"]);	
	// </limpiar>

		if(!empty($id)):
		$data_depend=array("updated_by" =>$this->registred_by,"updated_on" =>$this->now);
		else:
		$data_depend=array("registred_by" =>$this->registred_by,"registred_on" =>$this->now);
		endif;

		if($method=="publicationView"){ 

    	// no vacios
    		$response_required=$this->required_fields("publication",$http_params);
    		if(!$response_required["status"])
			return $response_required;
    	// ...

		// Aqui almacenamos en el arreglo el cual vamos a insertar o actualizar
			$data              =array(
			"title"            =>$title,
			"description"      =>$description,
			"category"         =>$category,
			"sub_category"     =>$sub_category,
			"email"            =>$email,
			"password"         =>$password,
			"url_facebook"     =>$url_facebook,
			"price"            =>$price,
			);

		// validar que  no exista un registro identico 
		if($this->publication_model->record_same_publication($data,$id) )
		return array("status"=>0,"msg"=>"Ya existe un registro identico ","data"=>false);

		$data=array_merge($data_depend,$data);

		if($id)
		$last_id=$this->publication_model->update_publication($data,$id);
		else{
		$last_id=$this->publication_model->insert_publication($data);
					// <own>
			$this->load->model("file_model");
			// print_r(json_encode($file_name));
					if(!empty($file_name)):
					// mover y insertar en el registro
						foreach ($file_name as $k => $file):

							$tmp_file=pathinfo(decode_id($file));


							$data_tmp["filename"]=$tmp_file["basename"];
							$data_tmp["publication_id"]=$last_id;
							$tmp_move[$k]["filename"]=$tmp_file["basename"];

						endforeach;

						    // <mover>
						$this->load->helper("file");
						// print_r(json_encode($tmp_move));
							foreach ($tmp_move as $tmp_mv_name) {
								
								if(!empty($tmp_mv_name["filename"])){
								$response=move_file("publication_file",$tmp_mv_name["filename"]);
									if(!empty($response["status"]))
									return $response;
								}

							}
							// </mover>
						$this->file_model->insert_file_uni("publication",$data_tmp);
					endif;
					// </own>			
		}

		return array("status"=>1,"msg"=>"Exito","data"=>$last_id);

		}

	// </publicationView> 

		return $last_id;
	}

	public function required_fields($module,$http_params){

		// if($module=="sale"){
		// if(empty($http_params["client"]))
		// return array("status"=>0,"msg"=>"Selecciona un cliente","client"=>1);

		// if(empty($http_params["client_subsidiary"]))
		// return array("status"=>0,"msg"=>"Selecciona una sucursal de cliente","client_subsidiary"=>1);
		// }

		// if(empty($http_params["subsidiary"]))
		// return array("status"=>0,"msg"=>"Selecciona una sucursal","subsidiary"=>1);

		// if(empty($http_params["folio"]))
		// return array("status"=>0,"msg"=>"Especifica un folio","folio"=>1);

		// if(empty($http_params["date"]))
		// return array("status"=>0,"msg"=>"Especifica un fecha","date"=>1);

		// if(!empty($http_params["type_of_currency"]) and $http_params["type_of_currency"]!=1 and empty($http_params["exchange_rate"]))
		// return array("status"=>0,"msg"=>"Debe de especificar el tipo de cambio","exchange_rate"=>1);
		
		return array("status"=>1,"msg"=>"Todos los campos ok");

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
	$config['last_tag_open'] = "<li>";
	$config['last_tag_close'] = "</li>";

	return $config;

	}

	public function children() {


	$module="publication/";
	$data["module"]=$module;	

	$data["module_data"]=$this->load->module_text_from_id($module);
	$data["module_childrens"]=$this->load->get_module_childrens($data["module_data"]["id"]);

	if(empty($data["module_childrens"]))
	redirect($module);	

	if(!empty($_POST["ajax"]))
	return print_r(json_encode(array("status"=>1,"msg"=>"HtmlConExito","html"=>$this->load->view('recycled/menu/Module_children',$data,true) ))) ;
	else
	return $this->load->template('recycled/menu/Module_children',$data);

	}
// <publication> 

	// carga ajax
	public function publication_ajax() {

	$module=$this->uri_publication;

	$http_params=array_merge($_GET,$_POST);
	$http_params          =array(
	"input_search_publication" =>(!empty($http_params["input_search_publication"]) ? strip_tags( $this->security->xss_clean( $http_params["input_search_publication"] ) ) :""),
	"show_amount_publication"  =>(!empty($http_params["show_amount_publication"]) ? strip_tags( $this->security->xss_clean( $http_params["show_amount_publication"])  ) :20),
	);
	extract($http_params);

	$page_amount=$show_amount_publication;

	$query_search=array();
	if(!empty($input_search_publication)){
	$query_search=array(
		"\$this->pr->like('title', \"".$input_search_publication."\");",
		);
	}

	$this->pagination->initialize($this->config_pagination("publication/publication_ajax",$this->publication_model->get_publication_amount($query_search),$page_amount) );

	$data=array(
		"module"=>$module,
		"sys"=>$this->sys,
		"input_search_publication"=>$input_search_publication,
		"show_amount"=>$show_amount_publication,
		"records_array"=>$this->publication_model->get_publication($page_amount, $this->page,$query_search),
		"pagination"=>$this->pagination->create_links(),
		"module_data"=>$this->publication_model->m_name($module),
		);
	$data["module_data"]["module_data_method_do_it"]="publication/publicationView/";

    $data["modules_quick"]=$this->load->get_back_access($module);

	// sale/publication/
	$html=$this->load->view("publication/ajax/table-publication-view",$data,true);
	$data["html"]=$html;

	// $this->session->set_userdata('record_start_row_publication',$this->page);

	if(!empty($_GET["ajax"]))
	echo $data["html"];
	else
	return $data;

	}

	// carga normal
	public function index() {
		
	$data=$this->publication_ajax();

	$this->session->set_userdata("idTemp");
	$this->session->set_userdata('input_search_publication');
	$this->session->set_userdata("sessionMode_publication");

	// if(!empty($this->page) and !empty($data["records_array"]))
	// $this->session->set_userdata('record_start_row_publication',$this->page);

	if(!empty($_POST["ajax"]))
	return print_r(json_encode(array("status"=>1,"msg"=>"HtmlConExito","html"=>$this->load->view("publication/publication_view",$data,true) ))) ;
	else
	return $this->load->template("publication/publication_view",$data);

	}

	public function publicationView($id=null) {

	$id_affected='';

	$module=$this->uri_publication;
	$array["module"]=$module;

	if(!empty($_POST["id"]))
    $id=strip_tags( $this->security->xss_clean(decode_id($_POST["id"]) ) );
	
    $MODE=(!empty($_POST["MODE"])?strip_tags( $this->security->xss_clean($_POST["MODE"]) ) : "");

	if(!empty($this->idTemp) and $MODE!="add")
	$id=$this->idTemp;

    // <RightCheck> 
    if(!empty($MODE)):

        $module_do_it=(!empty($id)?"update":"insert");
        $return_valid=rights_validation($array["module"].$module_do_it,"ajax");

        if(!$return_valid["status"])
        return print_r(json_encode($return_valid));       

    endif;
    // </RightCheck> 

	if(!empty($MODE) and $MODE=="do_it"):

	// retorna el id que se vio afectado asi sea UPDATE o INSERT o si existe un registro identico
	$return=$this->do_it($id,"publicationView");

		if(!$return["status"])
		return print_r(json_encode($return));		
		else
		$id=$return["data"];

	$this->session->set_userdata("idTemp",$id);

	endif;

	// traer el registro 
	$array['data']=$this->publication_model->get_publication_id($id);

	if(!empty($MODE) and $MODE=="view")
	$array['data']['MODE']="do_it";
	else if (!empty($id))
	$array['data']['MODE']="view";
	else
	$array['data']['MODE']="do_it";

	// <F5>
	$sessionMode=$this->session->userdata("sessionMode_publication");
	if(!empty($_POST)):
		$this->session->set_userdata("sessionMode_publication",$array['data']['MODE']);
	endif;
	$array['id']=$id;
	// </F5>

	// <OWN>
	$this->load->model("pirabook_model");
	$array['data']["categories"]=$this->pirabook_model->get_id_categories();
	$array['data']["sub_categories"]=$this->pirabook_model->get_id_sub_categories();

	// </OWN>
	// nombre del modulo
	// <OWN>
	$array['data']["module_data"]=$this->publication_model->m_name($module);	
	$array['data']["module_data_method_do_it"]="publication/publicationView/";

	// print_r(json_encode($_POST));
		if(!empty($_POST["MODE"])){

		$this->load->model("vars_system_model");
		$array["data"]["sys"]=$this->vars_system_model->_vars_system();

    	$array["data"]["modules_quick"]=$this->load->get_back_access($module);

		$html=$this->load->view($module."dinamyc-inputs",$array["data"],true);
		return print_r(json_encode( array("status"=>1, "html"=>$html,"id"=>$id,"MODE"=>$array['data']['MODE'],"MODE_POST"=>$MODE,"data_inform"=>$array['data']) ));	

		}

	$this->load->template($module.'dinamyc-view',$array);

	}

	public function publication_delete() {

	$module=$this->uri_publication;

	$this->load->model("link/link_model");

    // <RightCheck> 
        $return_valid=rights_validation($module."delete","ajax");

        if(!$return_valid["status"])
        return print_r(json_encode($return_valid));       
    // </RightCheck>

	if(!empty($_POST["id"]))
    $id=decode_id( strip_tags( $this->security->xss_clean($_POST["id"]) ) );

    // borrar los pagos 
    $this->link_model->delete_links("publication",$id,null);

    // <imagenes> borrar las imagenes 
    $imagenes=$this->publication_model->get_publication_images($id);
    if(!empty($imagenes))
    foreach ($imagenes as $ĸ => $row)
    @unlink(FCPATH.$this->sys["storage"]["publication_config"].$row["filename"]);

    $this->publication_model->delete_all_image_publication($id);
    // </imagenes>
	if($this->publication_model->publication_delete_it($id))
	return print_r(json_encode( array("status"=>1,"msg"=>"Se elimino","data"=>false ) ));

	}
// </publication>
}
