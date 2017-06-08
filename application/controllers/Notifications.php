<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends CI_Controller {

	public $user_id;

	public function __construct() {

		parent:: __construct();
		$this->load->model("notifications_model");
		$this->user_id=$this->session->userdata("user_id");
	}

	public function getNotificationsNum(){

	 $q=$this->notifications_model->getNotificationsNum_get();
	 echo $q;
	//  if(!empty($q))
 //    return print_r($q);
	// else return print_r(099);

	}

	public function getNotifications_egg_html(){

	if(empty($this->user_id))
	return;

	if(!empty($_POST["amount_show"])){
		$amount_show=base64_decode($_POST["amount_show"]);
		$amount_show=$this->security->xss_clean($amount_show);

		$notifications_data["notifications_data"]=$this->notifications_model->getNotifications_get($amount_show);	
	    $html=$this->load->view("egg_view",$notifications_data,true);

	    return rt(true,":)",$html);
	}

	}

}
?>