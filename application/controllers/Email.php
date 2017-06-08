<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

	// cargamos las librerias a usar 
	public function __construct() {

		parent:: __construct();
		$this->load->helper('security');
		$this->load->helper('smiley');
		$this->load->helper('date');
		$this->load->library("email");
		$this->load->helper('email');
        $this->load->model("email_model");

	}
	// metodo de inicio 
	public function index(){

		redirect("home/");

	}

	// traer el annuncio a ver por id
	public function send(){

		$id_publication=$this->security->xss_clean($_POST['id_publication']);
		$data = array();
		$data['publication'] = $this->home_model->get_publication_by($id_publication);
        $data["last_publications"]=$this->home_model->last_publications(7);
		
		$html=$this->load->view('publication_view_html_send',$data,true);

		$return=$this->send_publication($html);

		if(empty($return["status"]))
		return print_r(json_encode($return));	

		return print_r( 
					json_encode(
						array(
							"status"=>1,
							"msg"=>"",
							"data"=>false,
							"num_send_before_update"=>$return["num_send_before_update"]["email_sent"]
							)
					)
				);
	}

	/* esto es para enviar el HTML */
	public function send_publication($html){

		$id_publication=$this->security->xss_clean($_POST['id_publication']);
		if(!empty($_POST["name"])):
		$name=$this->security->xss_clean($_POST['name']) ;
		else:
		$name="Pirabook";
		endif;

		// validar el email
		if(empty($_POST["emailToSendFrom"]))
		$return=array("status"=>0,"msg"=>"Los emails a mandar son necesarios","emailToSendFrom"=>1);

		if(!empty($_POST["emailToSendFrom"])){

		$emailToSendFrom= trim($this->security->xss_clean($_POST['emailToSendFrom']));
		// return rt(true,"",$emailToSendFrom);
		
		$emailToSendFrom_explode=explode(",", $emailToSendFrom);
			foreach ($emailToSendFrom_explode as $key => $value) {

				if(!valid_email($value))
				$return=array("status"=>0,"msg"=>"Un email que proporcionaste no es valido","emailToSendFrom"=>1,"emailToSendFromBad"=>1);

			}
				
		}
		
		if(!empty($_POST["emailOwn"])):
		$emailOwn=$this->security->xss_clean($_POST['emailOwn']) ;
		else:
		$emailOwn="publicity@pirabook.com";
		endif;

		// forma de regresar
		if(!empty($return)){
			if(!empty($_POST["ajax"])):
			return print_r(json_encode($return));	
			else:
			return $return;	
			endif;
		}

	$ci = get_instance();
	$ci->load->library('email');
	$config['protocol']  = "mail";
	$config['smtp_host'] = "mail.pirabook.com";
	// $config['smtp_host'] = "ssl://smtp.ipage.com";
	// $config['smtp_port'] = "465";
	$config['smtp_user'] = "publicity@pirabook.com"; 
	$config['smtp_pass'] = "Dana2012.";
	// $config['smtp_user'] = "ing.daniel@admintuweb.com"; 
	// $config['smtp_pass'] = "Dana2012.";
	$config['charset']   = "utf-8";
	$config['mailtype'] = "html";
	$config['newline'] = "\r\n";
	$config['wordwrap'] = FALSE;
	$config['crlf'] = "\r\n";

	$ci->email->initialize($config);

	$ci->email->from($emailOwn, $name);
	// $list = array('bullterrie.ingles@gmail.com');
	$ci->email->to($emailToSendFrom_explode);
	// $this->email->reply_to('publicity@pirabook.com', '');
	$ci->email->subject('Hola te saluda Pirabook');
	$ci->email->message($html);

	if (!$ci->email->send())
	 $return=array("status"=>0,"msg"=>"no se envio","emailSmtp"=>1);	

		if(!empty($return)){
			if(!empty($_POST["ajax"])):
			return print_r(json_encode($return));	
			else:
			return $return;	
			endif;
		}

	// sumar las veces que se ha enviado esta publicacion
	if(!empty($emailToSendFrom_explode)){
	$num_send=count($emailToSendFrom_explode);	
	$num_send_before_update=$this->email_model->send_increment($id_publication,$num_send);

	}

	return array("status"=>1,"msg"=>"se envio correctamente","data"=>false,"num_send_before_update"=>$num_send_before_update);
	}

}