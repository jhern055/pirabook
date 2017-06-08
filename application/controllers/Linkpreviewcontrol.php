<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Copyright (c) 2014 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.0
 */

include_once "classes/LinkPreview.php";

class linkpreviewcontrol extends CI_Controller {

	public $user_id="";
	public $registred_by="";

	// cargamos las librerias a usar 
	public function __construct() {

		parent:: __construct();
		$this->load->library('CI_Bcrypt');
		$this->load->model('link_preview_model');
		$this->load->helper('security');
		$this->load->model("login_model");

		$this->user_id      = $this->session->userdata('user_id');
		$this->registred_by = $this->session->userdata('user_id');
        $this->login_model->is_logged_in(current_url());
	}
	
	public function textCrawler() {

		SetUp::init();

		$text = $_POST["text"];
		$imageQuantity = $_POST["imagequantity"];
		$text = " " . str_replace("\n", " ", $text);
		$header = "";

		$linkPreview = new LinkPreview();
		$answer = $linkPreview->crawl($text, $imageQuantity, $header);

		echo $answer;

		SetUp::finish();
	}

	public function save() {

	// SetUp::headers();
	$now  = date("Y-m-d H:i:s");
	if(empty($_POST["parentid"]))
	{$return=array("status"=>0,"msg"=>"No especificaste la carpeta","folder"=>1); return print_r(json_encode($return));}

	$save = array(
			"text" => strip_tags($_POST["text"]),
			"image" =>  strip_tags($_POST["image"]),
			"title" =>  strip_tags($this->security->xss_clean($_POST["title"])),
			"canonicalUrl" =>  strip_tags($_POST["canonicalUrl"]),
			"url" =>  strip_tags($_POST["url"]),
			"description" =>  strip_tags($_POST["description"]),
			// "title" =>		str_replace('&lt;input type="text" value="Sin titulo" id="previewInputTitle_lp1" class="previewInputTitle inputPr',
			// 		"", 
			// 		$_POST["title"])?:"" ,
			"iframe" =>		str_replace(
							array("&lt;iframe","&gt;","&lt;/iframe>","&lt;object","&lt;/object>","&lt;param","&lt;embed"),
							array("<iframe",">","</iframe>","<object","</object>","<param","<embed"), 
							$_POST["iframe"])?:"" ,
			"users_favorites" => (!empty($_POST["parentid"])?$_POST["parentid"]:0),
			"registred_by" =>$this->registred_by,
			"registred_on" => $now,
	);

	$id=$this->link_preview_model->insert_url($save);
	return rt(true,"Se grabo el url",$save);	
	}

	public function highlightUrls() {

	SetUp::init();

	error_reporting(false);
	$text = $_GET["text"];
	$description = $_GET["description"];

	$answer = array("urls" => HighLight::url($text), "description" => HighLight::url($description));

	echo json_encode($answer);

	}

	public function retrieve() {

	SetUp::headers();

	$header= "";
	$answer = $this->link_preview_model->select();

	echo Json::jsonSafe($answer, $header);

	}
	
}