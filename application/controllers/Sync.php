<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sync extends CI_Controller {

	public function __construct() {

	parent::__construct();

	}

	public function index() {
		$scv_array=str_getcsv(file_get_contents(FCPATH."testExportFile.csv"));
		pr($scv_array);
		echo ":)";
	}
}