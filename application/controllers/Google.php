<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/api/google-api-php-client/src/Google/autoload.php';
include_once APPPATH."libraries/api/adfly/PHP/example.php";

class Google extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// exit();
	}


	public function logout(){
		session_destroy();
		redirect("/google");

	}
	public function real_dir($dir_path){
                   $path_dir=str_replace(
                            array(" ","(",")","'","!","&","{","}","`","[","]",";","$"), 
                            array("\\ ","\(","\)","\'","\!","\&","\{","\}","\`","\[","\]","\;","\\$"), 
                            $dir_path);
	return $path_dir;  
	}
	
	public function index(){
	$response=$this->getFiles();

	// delete already found
	function delete_rar_already_uploaded($response){
	$path_files="/media/daniel/67F18E800D673AB3/zip3/pira10/";

		foreach ($response as $key => $value) {
			shell_exec("rm ".$path_files.$value["getName"]);
			// pr("rm ".$path_files.$value["getName"]);
		}
	}
	// delete_rar_already_uploaded($response);
	// pr(count($response));
	// pr($response);
	// exit();
	$this->load->model("api/googlee_model");
	$this->load->model("link/link_model");
	$this->load->helper("string");

	#primero revisar que todas existan
	# si no se encontraron los RAR_NAMES
	if(!empty($response))
	foreach ($response as $file) {
		$tmp=$this->googlee_model->select_rar_name($file["getName"]);
		if(empty($tmp)){
		$not_found[$file["getId"]]["getName"]=$file["getName"];
		$file["getName"]=trim(str_replace("_www.pirabook.com","", $file["getName"]));
		$not_found[$file["getId"]]["title"]=ucwords(desencript_name($file["getName"]));
		$not_found[$file["getId"]]["getId"]=$file["getId"];
		}
	}

	if(!empty($not_found))
	foreach ($not_found as $key => $value) {

			$texto = preg_replace('/\s+/', ' ', $value["title"]);  

		# TRAER EL ID DE LA PUBLICACION CON EL TEXTO TITLE
		$row=array();
		if($row=$this->link_model->there_title_name_rows($texto)){
				$data=array();

				// $data["original"]="https://drive.google.com/open?id=".$value["getId"]."delete";
				$data["original"]="https://drive.google.com/open?id=".$value["getId"];

			# SI NO EXISTE EL LINK
			if(!$this->link_model->there_link($data["original"],$row["id"])){
			// if("s"){
				$publications_hosting_server_id=$this->googlee_model->hosting_server_id($row["id"]);
	
				$data["publications_hosting_server_id"]=$publications_hosting_server_id;
				$data["publication"]=$row["id"];
				$data["hosting_servers_id"]=4;
				$data["description"]=1;				

				// Acortadores
				$ex = new PhpAfly();
				$res = $ex->shorten(array($data["original"]), 'adfly.local');
				
					if(!empty($res['data'][0]["short_url"])){
					$linkshrink_response=curl_api(array("key"=>"btz","url"=>$res['data'][0]["short_url"]),"https://linkshrink.net/api.php","",false);
					
					$data["link"]=$linkshrink_response;
					}

				// activa la publicacion
				$this->link_model->publication_update(array("status"=>1),$row["id"]);
				$this->link_model->link_insert_sinc($data);		


			}

		}
		else{
			
			$thing="";
			if($thing=$this->googlee_model->select_rar_name($value["getName"])){
				if(empty($thing))
				$not_found_title[]=$value["getName"];
			}		
		}

		sleep(2);

	}

	if(!empty($not_found_title)){
	pr($not_found_title);
	pr("not_found_title");
	}

// die("stop");
	# ####################################

		if(!empty($response))
		foreach ($response as $file) {

		# Traer la publicacion con el nombre del RAR_NAME
		$tmp="";
		$tmp=$this->googlee_model->select_rar_name($file["getName"]);
		// pr($tmp);
		// pr($file["getName"]);

			if(!empty($tmp)){
				$data=array();
				$publications_hosting_server_id=$this->googlee_model->hosting_server_id($tmp["id"]);
				if(!empty($publications_hosting_server_id)){

				// $data["original"]="https://drive.google.com/open?id=".$file["getId"]."delete";
				$data["original"]="https://drive.google.com/open?id=".$file["getId"];

				# REVISAR QUE NO EXISTA EL LINK YA 
					if(!$this->link_model->there_link($data["original"],$tmp["id"])){
					// if("s"){
					$data["publications_hosting_server_id"]=$publications_hosting_server_id;
					$data["publication"]=$tmp["id"];
					$data["hosting_servers_id"]=4;
					$data["description"]=1;

					// Acortadores
						if(!empty($file["getId"])){
						$ex = new PhpAfly();
						$res = $ex->shorten(array($data["original"]), 'adfly.local');
							if(!empty($res['data'][0]["short_url"])){
							$linkshrink_response=curl_api(array("key"=>"btz","url"=>$res['data'][0]["short_url"]),"https://linkshrink.net/api.php","",false);
							$data["link"]=$linkshrink_response;
							}
							
						}
					}

				// activa la publicacion
				$this->link_model->publication_update(array("status"=>1),$tmp["id"]);
				
				$this->link_model->link_insert_sinc($data);
				// pr($data);
				// pr("data_found_rar_name");

				}
			}
			else{
				
				if(!$this->googlee_model->real_not_found_rar_name($file["getName"])){
				$not_found_rar_name[]=$file["getName"];
				pr("https://drive.google.com/open?id=".$file["getId"]);
				}
			}
			
		sleep(2);

		}

		if(!empty($not_found_rar_name)){
		pr($not_found_rar_name);
		pr("not_found_rar_name");
		}
	}

	public function getFiles(){

		$client = new Google_Client();
		$client->setAuthConfigFile(APPPATH.'libraries/api/google-api-php-client/clients/client_secret.json');
		$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

		if (isset($_GET['code'])) {
		$client->authenticate($_GET['code']);  
		$_SESSION['token'] = $client->getAccessToken();
		header('Location: http://localhost/pirabook/google');
		}

		  if (!$client->getAccessToken() && !isset($_SESSION['token'])) {
		        $authUrl = $client->createAuthUrl();
		        print "<a class='login' href='$authUrl'>Conectar</a>";
		    }  

		   if (isset($_SESSION['token'])) {

		       print "<a class='logout' href='https://localhost/pirabook/google/logout'>Salir</a><br>";
		       // print "<a class='logout' href='".$_SERVER['PHP_SELF']."?logout=1'>Salir</a><br>";
		       $client->setAccessToken($_SESSION['token']);
				$service = new Google_Service_Drive($client);

				$optParams = array(
				  'pageSize' => 1000,
				  'fields' => 'nextPageToken, files(id, name)'
				);
				$results = $service->files->listFiles($optParams);
				if (count($results->getFiles()) == 0){

				}
				else {

				        // foreach ($results->getFiles() as $file) {
				        //   printf("<tr><td>%s</td><td> %s</td></tr>", $file->getName(), $file->getId());
				        // }
				}
		    }

		    $data=array();
		   if(!empty($results)){
			foreach ($results->getFiles() as $file) {
				$data[$file->getId()]["getName"]=$file->getName();
				$data[$file->getId()]["getId"]=$file->getId();
			}
		   	return $data;
		   }
	}
}
 ?>