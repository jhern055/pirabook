<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH."libraries/api/adfly/PHP/example.php";

class Link extends CI_Controller {

public $id;
public $http_params;
public $sys;
public $source_module;
public $now;
public $registred_by;

	public function __construct(){
		parent::__construct();

		$this->load->model("link/link_model");

		$this->load->model("vars_system_model");
		$this->sys=$this->vars_system_model->_vars_system();
		$this->now = date("Y-m-d H:i:s");
		$this->registred_by=$this->security->xss_clean($this->session->userdata("user_id"));

		// $this->load->model('functions_model');
		$this->http_params=array_merge($_GET,$_POST);
		// $this->load->helper('xml/xml_helper');

		$this->http_params   =array(
		"id"=>(!empty($this->http_params["id"]) ? strip_tags( $this->security->xss_clean( decode_id($this->http_params["id"]) ) ) :""),
		"source_module"=>(!empty($this->http_params["source_module"]) ? strip_tags( $this->security->xss_clean( decode_id($this->http_params["source_module"]) ) ) :""),
		"module"=>(!empty($this->http_params["module"]) ? strip_tags( $this->security->xss_clean( decode_id($this->http_params["module"]) ) ) :""),
		"id_record"=>(!empty($this->http_params["id_record"]) ? strip_tags( $this->security->xss_clean( decode_id($this->http_params["id_record"]) ) ) :""),
		"pay_import_sum"=>(!empty($this->http_params["pay_import_sum"]) ? strip_tags( $this->security->xss_clean($this->http_params["pay_import_sum"] ) ) :""),
		);
	}

	public function get_information($http_params){
	$data["data"]=array();
	$this->load->model("publication/publication_model");

	$data["module_data"]=$this->publication_model->m_name($this->uri->uri_string."/");

    if($http_params["source_module"]=="publication/link/")
	 	$data["data"]=$this->publication_model->get_publication_id($http_params["id"]);

   // 	$data["data"]=array_merge(
	 	// array(
	 		// "subsidiaries"=>$this->config_model->get_id_subsidiary(),
	 		// "type_of_currency_array"=>$this->config_model->get_type_of_currency(),
	 	// 	),
	 	// $data["data"]);

		return $data;
	}
	
	public function linkView() {
	}

	public function pirabook() {

	$data=array(
		"id"=>$this->http_params["id"],
		"module"=>$this->http_params["source_module"],
		"data"=>$this->get_information($this->http_params)["data"],
		"module_data"=>$this->link_model->m_name("link/"),
		);

	$data["data"]=array_merge(
					array("sys"=>$this->sys),
					array("module"=>$this->http_params["module"]),
					array("modules_quick"=>$this->load->get_back_access($this->http_params["source_module"])),
					$data["data"]
					);
	$this->load->template('link/dinamyc-view',$data);

	}

	// functions links
		// este metodo es para el token input 
	public function tokeninput(){

	if( isset($_GET["request"]["name"]) ){
	$name =strip_tags( $this->security->xss_clean( $_GET["request"]["name"] )?:"" );
	$var_name="\$this->db->like('name', \"".$name."\");";
	$data=$this->link_model->get_articles_token_search($var_name);
	}

	return print_r( json_encode($data));

	}

	//Aqui solo pongo el ITEM para hacer el insert  HTML
	public function add_link(){

	if( isset($_POST["MODE"]) )
	$MODE =strip_tags( $this->security->xss_clean( $_POST["MODE"] )?:"" );

	$id_record=$this->http_params["id_record"];

	$data['edit']=false;
	if( isset($_POST["edit"]) )
	$data['edit']=strip_tags( $this->security->xss_clean( $_POST["edit"] )?:"" );

	if(!empty($MODE) and $MODE=="view")
	$data['MODE'] ="do_it";
	else if (!empty($id))
	$data['MODE'] ="view";
	else
	$data['MODE'] ="do_it";

	$data['hosting_servers']=$this->link_model->get_hosting_servers();
	$data['publications_hosting_servers']=$this->link_model->get_publications_hosting_server($id_record);

	// Arreglo de los articulos 

	$data=array_merge(
		array(
		"link_details"=>array(0),
		"sys"=>$this->sys,
		// "type_of_currency_array"=>$this->config_model->get_type_of_currency(),
		),
		$data
		); 

	$_html = $this->load->view('recycled/link/link_detail_inputs',$data,true);
	echo json_encode($_html);

	}	

//Aqui se inserta lo que viene en el item
	public function add_link_do(){

	$module=$this->http_params["module"];
	$id_record=$this->http_params["id_record"];

	if( isset($_POST["MODE"]) )
	$MODE =strip_tags( $this->security->xss_clean( $_POST["MODE"] )?:"" );

	$data['edit']=false;
	if( isset($_POST["edit"]) )
	$data['edit']=strip_tags( $this->security->xss_clean( $_POST["edit"] )?:"" );

	if(!empty($MODE) and $MODE=="view")
	$data['MODE'] ="do_it";
	else if (!empty($MODE) and $MODE=="do_it")
	$data['MODE'] ="view";

	// procesar los detalles que aun no se insertar solo los insertaremos como text en el html
	if(!empty($_POST["link_details"]) )		
	foreach ($_POST["link_details"] as $k => $vdt) {

	// shorter adfly and linkshrink 
	if(empty($vdt["link"]) and !empty($vdt["original"])){
	
	$ex = new PhpAfly();
	$res = $ex->shorten(array($vdt["original"]), 'adfly.local');

		if(!empty($res['data'][0]["short_url"])){
		$linkshrink_response=curl_api(array("key"=>"btz","url"=>$res['data'][0]["short_url"]),"https://linkshrink.net/api.php","",false);
		$vdt["link"]=$linkshrink_response;
		}

	}	

	if(empty($vdt["link"]))
	continue;	

	// <RightCheck> 
    $module_do_it=(!empty($vdt["id"])?"update":"insert");
	$return_valid=rights_validation($this->http_params["source_module"].$module_do_it,"ajax");

	if(!$return_valid["status"])
	return print_r(json_encode($return_valid));       
    // </RightCheck>

	if(!empty($vdt["id"])):
	$id=(!empty($vdt["id"]) )?strip_tags( $this->security->xss_clean( decode_id($vdt["id"]) ) ) :"";
	else:
	$id =0;
	endif;


	$link_details[$k] =array(
	$module                          =>$id_record,
	"id"                             =>(!empty($id)?$id:null),
	"description"                    =>isset($vdt["description"])?trim( strip_tags( $this->security->xss_clean($vdt["description"]) ) ) :"",
	"link"                           =>isset($vdt["link"])?trim( strip_tags( $this->security->xss_clean($vdt["link"]) ) ) :"",
	"original"                       =>isset($vdt["original"])?trim( strip_tags( $this->security->xss_clean($vdt["original"]) ) ) :"",
	"hosting_servers_id"             =>isset($vdt["hosting_servers_id"])?trim( strip_tags( $this->security->xss_clean($vdt["hosting_servers_id"] ) )) :"",
	"publications_hosting_server_id" =>isset($vdt["publications_hosting_server_id"])?trim( strip_tags( $this->security->xss_clean($vdt["publications_hosting_server_id"]) )) :"",
	);

	// return print_r(json_encode($link_details[$k]));

		// revisar si existe el registro si no insertarlo
		if($this->link_model->get_pirabook_links($module,$id,$id_record)){
		
		$data_depend=array("updated_by" =>$this->registred_by,"updated_on" =>$this->now);

		$data_process=array_merge($data_depend,$link_details[$k]);	
		
			if(!$this->link_model->update_links($module,$data_process,$id_record,$id))
			{ return array("status"=>0,"msg"=>"No se pudo actualizar el pago"); }

		}

		else{

		$data_depend=array("registred_by" =>$this->registred_by,"registred_on" =>$this->now,$module =>$id_record);
		
		$data_process=array_merge($data_depend,$link_details[$k]);	

			if(!$last_reg_id=$this->link_model->insert_links($module,$data_process) )
			{ return array("status"=>0,"msg"=>"No se pudo insertar el pago"); }
			else
			$link_details=$this->link_model->get_pirabook_links($module,$last_reg_id,$id_record);

		}


	}

	$data=array_merge(
		array(
		"link_details"=>(!empty($link_details)?$link_details:array()),
		"sys"=>$this->sys,
		// "type_of_currency_array"=>$this->config_model->get_type_of_currency(),
		),
		$data
	); 

	$data['hosting_servers']=$this->link_model->get_hosting_servers();
	$data['publications_hosting_servers']=$this->link_model->get_publications_hosting_server($id_record);

	$_html = $this->load->view('recycled/link/link_detail_inputs',$data,true);

	return print_r( json_encode( array("status"=>1,"msg"=>"Exito","html"=>$_html) ) );

	}	
	
	public function link_details(){

	$id_record =(!empty($_POST["id_record"])?strip_tags( $this->security->xss_clean( decode_id($_POST["id_record"]) )) :"");
	$module =(!empty($_POST["module"])?strip_tags( $this->security->xss_clean( decode_id($_POST["module"]) ) ):"");

	// else
	$data['MODE']="view";
	$data['hosting_servers']=$this->link_model->get_hosting_servers();
	$data['publications_hosting_servers']=$this->link_model->get_publications_hosting_server($id_record);

	// $this->load->model("config/config_model");
	$data=array_merge(
		array(
		"link_details"=>$this->link_model->get_link_details_by_id($module,null,$id_record),
		"sys"=>$this->sys,
		// "type_of_currency_array"=>$this->config_model->get_type_of_currency(),
		),
		$data
	); 
	// print_r(json_encode($data["link_details"]));
	$_html = $this->load->view('recycled/link/link_detail_inputs',$data,true);

	return print_r( json_encode( array("status"=>1,"msg"=>"Html de articulos","html"=>$_html) ) );
	
	}
	public function get_link_by(){
	
	$id =(!empty($_POST["id"])?trim( strip_tags( $this->security->xss_clean(decode_id($_POST["id"])) ) ) :"");
	$source_module =(!empty($_POST["source_module"])?strip_tags( $this->security->xss_clean( decode_id($_POST["source_module"]) ) ):"");

	$details=$this->link_model->get_pirabook_links($source_module,$id,$this->http_params["id_record"]);
	
	foreach ($details as $key => $row) 
	$details[$key]=array_merge($details[$key],array("id"=>encode_id($row["id"])));

	return print_r(json_encode($details));
	}

	public function get_group_by(){
	
	$id =(!empty($_POST["id"])?trim( strip_tags( $this->security->xss_clean(decode_id($_POST["id"])) ) ) :"");
	$source_module =(!empty($_POST["source_module"])?strip_tags( $this->security->xss_clean( decode_id($_POST["source_module"]) ) ):"");

	$details=$this->link_model->get_group_links($id,$this->http_params["id_record"]);
	
	foreach ($details as $key => $row) 
	$details[$key]=array_merge($details[$key],array("id"=>$row["id"]));

	return print_r(json_encode($details));
	}

	public function delete_link(){
	
	$id =(!empty($_POST["id"])?strip_tags( $this->security->xss_clean(decode_id($_POST["id"])) ) :"");
	$id_record=$this->http_params["id_record"];
	$module=$this->http_params["module"];
    // <RightCheck> 
        $return_valid=rights_validation($this->http_params["source_module"]."delete","ajax");

        if(!$return_valid["status"])
        return print_r(json_encode($return_valid));       
    // </RightCheck>

	if($this->link_model->delete_link_it($this->http_params["module"],$id,$this->http_params["id_record"]) )
	return print_r( json_encode( array("status"=>1,"msg"=>"Se elimino") ) );
	else
	return print_r( json_encode( array("status"=>0,"msg"=>"Hubo un error al eliminar el pago") ) );

	}
// ----------------------


	public function  real_dir($dir_path){
                   $path_dir=str_replace(
                            array(" ","(",")","'","!","&","{","}","`","[","]",";","$"), 
                            array("\\ ","\(","\)","\'","\!","\&","\{","\}","\`","\[","\]","\;","\\$"), 
                            $dir_path);
	return $path_dir;  
	}
	public function index(){
		// $scandir=scandir( dirname(__FILE__) );
		set_time_limit(0);
		$this->load->helper("string");

		$root_path_music= "/media/daniel/67F18E800D673AB3/zip3/pira11";
		$this->load->helper("file_helper");
		$directories=scandir_folders($root_path_music);
		$dir_files=dir_files($root_path_music);

		// mv
		// $files=get_filenames($root_path_music,false,false);
		// if(!empty($files))
		// foreach ($files as $key => $file_name) {
		// 	$mv="mv ".$file_name." ". $file_name.".rar";
		// 	pr($mv);
		// }
		// construir el query del zip


		$rar=array();
		if(!empty($directories))
		foreach ($directories as $key => $dir){
			$explode=explode("/", $dir);
		$name_not_space=$root_path_music."/".encript_name(end($explode) )."_www.pirabook.com";	
		$name=$root_path_music."/".encript_name(end($explode) )."_www.pirabook.com ";	

		if(!file_exists($name_not_space))
		$rar[]="rar a ".$name.$root_path_music."/".$this->real_dir(end($explode))."/* -hpwww.pirabook.com -ep1";
		}
			


		// pr(scandir_folders("/home/daniel/"));
		// pr($directories);
		// exit();
		if(!empty($rar))
		foreach ($rar as $key => $command_rar) :

		$exce=shell_exec($command_rar);

		// pr($exce);
		// pr($command_rar);
		endforeach;
		pr("</br>");


		// remane
		// foreach ($dir_files as $key => $value) {
		// 	pr("mv ".str_replace(array(" ","(",")"),array("\\ ","\\(","\\)"),$value)." ".str_replace(array(" ","(",")"),array("\\ ","\\(","\\)"),  str_replace("Karaokanta - ", "", $value) ) );
		// }

		// rezise
		// foreach ($dir_files as $key => $value) {
		// 	pr("convert ".$value." -resize 140X113 ".$value);
		// }
		// pr($dir_files);

	}

	
	public function group_links(){

	$id_record =(!empty($_POST["id_record"])?strip_tags( $this->security->xss_clean( decode_id($_POST["id_record"]) )) :"");
	$module =(!empty($_POST["module"])?strip_tags( $this->security->xss_clean( decode_id($_POST["module"]) ) ):"");

	$data['MODE']="view";

	$data=array_merge(
		array(
		"group_link_detail"=>$this->link_model->get_group_links(null,$id_record),
		"sys"=>$this->sys,
		),
		$data
	); 
	// print_r(json_encode($data["link_details"]));

	$_html = $this->load->view('recycled/link/group_link_inputs',$data,true);

	return print_r( json_encode( array("status"=>1,"msg"=>"Html de articulos","html"=>$_html) ) );
	
	}

	//Aqui solo pongo el ITEM para hacer el insert  HTML
	public function add_group_link(){

	if( !empty($_POST["group_link_detail"]) )
	$group_link_detail =$_POST["group_link_detail"];


	$id_record=$this->http_params["id_record"];

	$data['edit']=false;
	if( isset($_POST["edit"]) )
	$data['edit']=strip_tags( $this->security->xss_clean( $_POST["edit"] )?:"" );

	if(!empty($MODE) and $MODE=="view")
	$data['MODE'] ="do_it";
	else if (!empty($id))
	$data['MODE'] ="view";
	else
	$data['MODE'] ="do_it";

	if( isset($_POST["MODE"]) )
	$data['MODE'] =$_POST["MODE"];


	$data=array_merge(
		array(
		"group_link_detail"=>(!empty($group_link_detail)?$group_link_detail:array(0)),
		"sys"=>$this->sys,
		),
		$data
		); 

	$_html = $this->load->view('recycled/link/group_link_inputs',$data,true);
	echo json_encode($_html);

	}

	public function add_group_link_do(){

	$module    =$this->http_params["module"];
	$id_record =$this->http_params["id_record"];

	if( isset($_POST["MODE"]) )
	$MODE =strip_tags( $this->security->xss_clean( $_POST["MODE"] )?:"" );

	$data['edit']=false;
	if( isset($_POST["edit"]) )
	$data['edit']=strip_tags( $this->security->xss_clean( $_POST["edit"] )?:"" );

	if(!empty($MODE) and $MODE=="view")
	$data['MODE'] ="do_it";
	else if (!empty($MODE) and $MODE=="do_it")
	$data['MODE'] ="view";

	// procesar los detalles que aun no se insertar solo los insertaremos como text en el html
	if(!empty($_POST["group_link_detail"]) )		
	foreach ($_POST["group_link_detail"] as $k => $vdt) {

	if(empty($vdt["description"]))
	continue;	

	// <RightCheck> 
    $module_do_it=(!empty($vdt["id"])?"update":"insert");
	$return_valid=rights_validation($this->http_params["source_module"].$module_do_it,"ajax");

	if(!$return_valid["status"])
	return print_r(json_encode($return_valid));       
    // </RightCheck>

	if(!empty($vdt["id"])):
	$id=(!empty($vdt["id"]) )?strip_tags( $this->security->xss_clean( decode_id($vdt["id"]) ) ) :"";
	else:
	$id =0;
	endif;

	$group_link_detail[$k] =array(
	$module =>$id_record,
	"id"    =>(!empty($id)?$id:null),
	"description"  =>isset($vdt["description"])?trim( strip_tags( $this->security->xss_clean($vdt["description"]) ) ) :"",
	);


		if($this->link_model->get_pirabook_grups_link($module,$id,$id_record)){
		
		$data_depend=array("updated_by" =>$this->registred_by,"updated_on" =>$this->now);

		$data_process=array_merge($data_depend,$group_link_detail[$k]);	
		
			if(!$this->link_model->update_group_link($data_process,$id_record,$id))
			{ return array("status"=>0,"msg"=>"No se pudo actualizar el pago"); }

		}

		else{

		$data_depend=array("registred_by" =>$this->registred_by,"registred_on" =>$this->now,$module =>$id_record);
		
		$data_process=array_merge($data_depend,$group_link_detail[$k]);	

			if(!$last_reg_id=$this->link_model->insert_group_link($data_process) )
			{ return array("status"=>0,"msg"=>"No se pudo insertar el pago"); }
			else
			$group_link_detail=$this->link_model->get_pirabook_grups_link($module,$last_reg_id,$id_record);

		}


	}

	$data=array_merge(
		array(
		"group_link_detail"=>(!empty($group_link_detail)?$group_link_detail:array()),
		"sys"=>$this->sys,
		),
		$data
	); 

	// $data['hosting_servers']=$this->link_model->get_hosting_servers();
	// $data['publications_hosting_servers']=$this->link_model->get_publications_hosting_server($id_record);

	$_html = $this->load->view('recycled/link/group_link_inputs',$data,true);

	return print_r( json_encode( array("status"=>1,"msg"=>"Exito","html"=>$_html) ) );

	}

	public function delete_group_link(){
	
	$id =(!empty($_POST["id"])?strip_tags( $this->security->xss_clean(decode_id($_POST["id"])) ) :"");
	$id_record=$this->http_params["id_record"];
	$module=$this->http_params["module"];

    // <RightCheck> 
        $return_valid=rights_validation($this->http_params["source_module"]."delete","ajax");

        if(!$return_valid["status"])
        return print_r(json_encode($return_valid));       
    // </RightCheck>

	if($this->link_model->delete_group_link($id,$this->http_params["id_record"]) )
	return print_r( json_encode( array("status"=>1,"msg"=>"Se elimino") ) );
	else
	return print_r( json_encode( array("status"=>0,"msg"=>"Hubo un error al eliminar el pago") ) );

	}	

	public function rar_name(){
		
		set_time_limit(0);
		$this->load->helper("string");
		$root_path_music= "/media/pirabook/67F18E800D673AB3/zip3/pir6/rar_name/";
		// $root_path_music= "/media/pirabook/67F18E800D673AB3/zip3";
		$this->load->helper("file_helper");
		$directories=scandir_folders($root_path_music);
		$dir_files=dir_files($root_path_music);

		$rar=array();
		if(!empty($directories))
		foreach ($directories as $key => $dir){
			$explode=explode("/", $dir);

			$rar_names[$key]["rar_name"]=encript_name(end($explode))."_www.pirabook.com ";
			$texto = preg_replace('/\s+/', ' ', end($explode));  

			$rar_names[$key]["title"]=$texto;
		}

		foreach ($rar_names as $key => $value) {
			
			if($this->link_model->there_title_name($value["title"])){
			pr($value["title"]);

			$this->link_model->update_rar_name($rar_names[$key],$value["title"]);
				
			}

		}

	}	
}
?>