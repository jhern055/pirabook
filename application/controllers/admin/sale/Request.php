<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {
	public  $config;
	public  $page;
	public 	$registred_by;
	public 	$idTemp;
	public 	$sys;

    // request
	public 	$uri_request;
    // ...    

	public function __construct() {

	parent::__construct();

	$this->load->model("admin/sale/request/request_model");
	$this->load->model("admin/client/client_model");

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

		// Remissiones <request>		
		$this->uri_request="admin/sale/request/";
		// </request>	
	
	}
	
	// insertar o actualizar
	public function do_it($id=null,$method=null) {
	$http_params=array_merge($_GET,$_POST);

	$http_params   =array(
	"MODE"         =>"do_it",
	"id"           =>(!empty($http_params["id"]) ? strip_tags( $this->security->xss_clean( decode_id($http_params["id"]) ) ) :""),
	"name"         =>(!empty($http_params["name"]) ?strip_tags( $this->security->xss_clean($http_params["name"]) ):""),
	"rfc"          =>(!empty($http_params["rfc"]) ?strip_tags( $this->security->xss_clean( strtoupper($http_params["rfc"]) ) ):""),
	"capacity"     =>(!empty($http_params["capacity"]) ?strip_tags( $this->security->xss_clean($http_params["capacity"]) ):""),
	"storage_unit" =>(!empty($http_params["storage_unit"]) ?strip_tags( $this->security->xss_clean($http_params["storage_unit"]) ):""),
	"client"      =>(!empty($http_params["client"]) ?strip_tags( $this->security->xss_clean($http_params["client"]) ):""),
	"client_subsidiary"      =>(!empty($http_params["client_subsidiary"]) ?strip_tags( $this->security->xss_clean($http_params["client_subsidiary"]) ):""),
	"provider"      =>(!empty($http_params["provider"]) ?strip_tags( $this->security->xss_clean($http_params["provider"]) ):""),
	"folio"       =>(!empty($http_params["folio"]) ?strip_tags( $this->security->xss_clean($http_params["folio"]) ):""),
	"status"      =>(!empty($http_params["status"]) ?strip_tags( $this->security->xss_clean($http_params["status"]) ):""),
	"comment"     =>(!empty($http_params["comment"]) ?strip_tags( $this->security->xss_clean($http_params["comment"]) ):""),
	"date"        =>(!empty($http_params["date"]) ?strip_tags( $this->security->xss_clean($http_params["date"]) ):""),
	"details"     =>(!empty($http_params["details"]) ?$http_params["details"]:array()),
	"subsidiary"  =>(!empty($http_params["subsidiary"]) ?strip_tags( $this->security->xss_clean($http_params["subsidiary"]) ):""),
	"method_of_payment"  =>(!empty($http_params["method_of_payment"]) ?strip_tags( $this->security->xss_clean($http_params["method_of_payment"]) ):""),
	"payment_condition"  =>(!empty($http_params["payment_condition"]) ?strip_tags( $this->security->xss_clean($http_params["payment_condition"]) ):""),

	"type_of_currency" =>(!empty($http_params["type_of_currency"]) ?strip_tags( $this->security->xss_clean($http_params["type_of_currency"]) ):""),
	"exchange_rate"    =>(!empty($http_params["exchange_rate"]) ?strip_tags( $this->security->xss_clean($http_params["exchange_rate"]) ):""),
	);


		extract($http_params);

		if(!empty($id)):
		$data_depend=array("updated_by" =>$this->registred_by,"updated_on" =>$this->now);
		else:
		$data_depend=array("registred_by" =>$this->registred_by,"registred_on" =>$this->now);
		endif;

		if($method=="requestView"){ 

    	// no vacios
    		$response_required=$this->required_fields("sale",$http_params);
    		if(!$response_required["status"])
			return $response_required;
    	// ...

		// Aqui almacenamos en el arreglo el cual vamos a insertar o actualizar
			$data=array(
			"name"       =>$name,
			"folio"       =>$folio,
			"client"     =>$client,
			"client_subsidiary" =>$client_subsidiary,
			"status"     =>$status,
			"comment"    =>$comment,
			"date"       =>$date,
			"subsidiary" =>$subsidiary,
			"method_of_payment"=>$method_of_payment,
			"payment_condition"=>$payment_condition,
			"type_of_currency"=>$type_of_currency,
			"exchange_rate"=>$exchange_rate,
			);

		// validar que  no exista un registro identico 
		if($this->request_model->record_same_request($data,$id) )
		return array("status"=>0,"msg"=>"Ya existe un registro identico ","data"=>false);

		$data=array_merge($data_depend,$data);

		if($id)
		$last_id=$this->request_model->update_request($data,$id);
		else
		$last_id=$this->request_model->insert_request($data);

		// processar details
		$response_detail=$this->processDetail("request",$last_id);

		if(!$response_detail["status"])
		return $response_detail;
		// 
		return array("status"=>1,"msg"=>"Exito","data"=>$last_id);

		}

	// </requestView> 

		return $last_id;
	}

	public function required_fields($module,$http_params){

		if($module=="sale"){
		if(empty($http_params["client"]))
		return array("status"=>0,"msg"=>"Selecciona un cliente","client"=>1);

		if(empty($http_params["client_subsidiary"]))
		return array("status"=>0,"msg"=>"Selecciona una sucursal de cliente","client_subsidiary"=>1);
		}

		if(empty($http_params["subsidiary"]))
		return array("status"=>0,"msg"=>"Selecciona una sucursal","subsidiary"=>1);

		if(empty($http_params["folio"]))
		return array("status"=>0,"msg"=>"Especifica un folio","folio"=>1);

		if(empty($http_params["date"]))
		return array("status"=>0,"msg"=>"Especifica un fecha","date"=>1);

		if(!empty($http_params["type_of_currency"]) and $http_params["type_of_currency"]!=1 and empty($http_params["exchange_rate"]))
		return array("status"=>0,"msg"=>"Debe de especificar el tipo de cambio","exchange_rate"=>1);
		
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


	$module="admin/sale/request/";
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
// <request> 

	// carga ajax
	public function request_ajax() {

	$module=$this->uri_request;

	$http_params=array_merge($_GET,$_POST);
	$http_params          =array(
	"input_search_request" =>(!empty($http_params["input_search_request"]) ? strip_tags( $this->security->xss_clean( $http_params["input_search_request"] ) ) :""),
	"show_amount_request"  =>(!empty($http_params["show_amount_request"]) ? strip_tags( $this->security->xss_clean( $http_params["show_amount_request"])  ) :10),
	);
	extract($http_params);

	$page_amount=$show_amount_request;

	$query_search=array(
		"\$this->db->like('folio', \"".$input_search_request."\");",
		);

	$this->pagination->initialize($this->config_pagination("admin/sale/request/request_ajax",$this->request_model->get_request_amount($query_search),$page_amount) );

	$data=array(
		"module"=>$module,
		"sys"=>$this->sys,
		"input_search_request"=>$input_search_request,
		"show_amount"=>$show_amount_request,
		"records_array"=>$this->request_model->get_request($page_amount, $this->page,$query_search),
		"pagination"=>$this->pagination->create_links(),
		"module_data"=>$this->request_model->m_name($module),
		);
	$data["module_data"]["module_data_method_do_it"]="admin/sale/request/requestView/";

    $data["modules_quick"]=$this->load->get_back_access($module);

	// sale/request/
	$html=$this->load->view("admin/sale/request/ajax/table-request-view",$data,true);
	$data["html"]=$html;

	// $this->session->set_userdata('record_start_row_request',$this->page);

	if(!empty($_GET["ajax"]))
	echo $data["html"];
	else
	return $data;

	}

	// carga normal
	public function index() {
		
	$data=$this->request_ajax();

	$this->session->set_userdata("idTemp");
	$this->session->set_userdata('input_search_request');
	$this->session->set_userdata("sessionMode_request");

	// if(!empty($this->page) and !empty($data["records_array"]))
	// $this->session->set_userdata('record_start_row_request',$this->page);

	if(!empty($_POST["ajax"]))
	return print_r(json_encode(array("status"=>1,"msg"=>"HtmlConExito","html"=>$this->load->view("admin/sale/request/request_view",$data,true) ))) ;
	else
	return $this->load->template("admin/sale/request/request_view",$data);

	}

	public function requestView($id=null) {

	$id_affected='';

	$module=$this->uri_request;
	$array["module"]=$module;

	if(!empty($_POST["id"]))
    $id=decode_id( strip_tags( $this->security->xss_clean($_POST["id"]) ) );
	
    $MODE=(!empty($_POST["MODE"])?strip_tags( $this->security->xss_clean($_POST["MODE"]) ) : "");

	if(!empty($this->idTemp) and $MODE!="add")
	$id=$this->idTemp;

	// <status> checar el status si esta como cancelada o estatus pagada no puede editar 
	$data_before=$this->request_model->get_request_id($id);

	if($data_before["status"]==3 and $_POST)
	return print_r(json_encode( array("status"=>0,"msg"=>"No puede editar porque esta cancelada","data"=>false ) ));

	if($data_before["status"]==2 and $_POST)
	return print_r(json_encode( array("status"=>0,"msg"=>"No puede editar porque esta pagada","data"=>false ) ));
	// </status> 

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
	$return=$this->do_it($id,"requestView");

		if(!$return["status"])
		return print_r(json_encode($return));		
		else
		$id=$return["data"];

	$this->session->set_userdata("idTemp",$id);

	endif;

	// traer el registro 
	$array['data']=$this->request_model->get_request_id($id);

	if(!empty($MODE) and $MODE=="view")
	$array['data']['MODE']="do_it";
	else if (!empty($id))
	$array['data']['MODE']="view";
	else
	$array['data']['MODE']="do_it";

	// <F5>
	$sessionMode=$this->session->userdata("sessionMode_request");
	if(!empty($_POST)):
		$this->session->set_userdata("sessionMode_request",$array['data']['MODE']);
	endif;
	$array['id']=$id;
	// </F5>

	// nombre del modulo
	$array['data']["module_data"]=$this->request_model->m_name($module);	
	$array['data']["module_data_method_do_it"]="admin/sale/request/requestView/";

	// <OWN>
	$this->load->model("config/config_model");
	$array['data']['subsidiaries']=$this->config_model->get_id_subsidiary();
    $array['data']["clients"]=$this->client_model->get_clients();
    $array['data']["client_subsidiaries"]=$this->client_model->get_client_subsidiaries($array['data']["client"],true);
    $array['data']["type_of_currencies"]=$this->config_model->get_type_of_currency();
	// </OWN>

		if(!empty($_POST["MODE"])){
		$this->load->model("vars_system_model");
		$array["data"]["sys"]=$this->vars_system_model->_vars_system();

    	$array["data"]["modules_quick"]=$this->load->get_back_access($module);

		$html=$this->load->view($module."dinamyc-inputs",$array["data"],true);
		return print_r(json_encode( array("status"=>1, "html"=>$html,"id"=>$id,"MODE"=>$array['data']['MODE'],"MODE_POST"=>$MODE,"data_inform"=>$array['data']) ));	

		}

	$this->load->template($module.'dinamyc-view',$array);

	}

	public function request_delete() {

	$module=$this->uri_request;

	$this->load->model("admin/stock/catalog/article/article_model");

    // <RightCheck> 
        $return_valid=rights_validation($module."delete","ajax");

        if(!$return_valid["status"])
        return print_r(json_encode($return_valid));       
    // </RightCheck>

	if(!empty($_POST["id"]))
    $id=decode_id( strip_tags( $this->security->xss_clean($_POST["id"]) ) );

    // borrar los detalles 
    $this->article_model->delete_details("request",$id,null);

	if($this->request_model->request_delete_it($id))
	return print_r(json_encode( array("status"=>1,"msg"=>"Se elimino","data"=>false ) ));

	}
// </request>

// <detail>
	public function processDetail($source_module,$id_record){

	$this->load->model("admin/stock/catalog/article/article_model");
	$response=$this->article_model->processDetailArticle($source_module,$id_record);
	return $response;

	}
	
	// </details>
}
