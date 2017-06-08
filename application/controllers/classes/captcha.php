<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Captcha  {

	public $rand;
	public $CI;

	public function __construct()
	{
		// parent::__construct();
		//creamos un random alfanumerico de longitud 6 
		//para nuestro captcha y sesión captcha
		$this->CI=&get_instance();
		$this->CI->load->helper('string');
		$this->rand = random_string('alnum', 6);
		$this->CI->load->model("captcha_model");
		$this->CI->load->library("session");

	}

    public function captcha(){

		//creamos una sesión con el string del captcha que hemos creado
		//para utilizarlo en la función callback
		$this->CI->session->set_userdata('captcha', $this->rand);

		//configuramos el captcha
		$conf_captcha = array(
			'word'   => $this->rand,
			'img_path' => './captcha/',
			'img_url' =>  base_url().'captcha/',
            //fuente utilizada por mi, poner la que tengáis
			'font_path' => './fonts/AlfaSlabOne-Regular.ttf',
			'img_width' => '250',
			'img_height' => '60', 
			//decimos que pasados 10 minutos elimine todas las imágenes
			//que sobrepasen ese tiempo
			'expiration' => 600 
		);

		//guardamos la info del captcha en $cap
		$cap = create_captcha($conf_captcha);

		//pasamos la info del captcha al modelo para 
		//insertarlo en la base de datos
		$this->CI->captcha_model->insert_captcha($cap);
		
		//devolvemos el captcha para utilizarlo en la vista
		return $cap;
	}

	public function send_form() {
		$this->CI->form_validation->set_rules('captcha', 'Captcha', 'callback_validate_captcha');
		if($this->CI->form_validation->run() == false) {
			$this->CI->index();

		}else{

			$expiration = time()-600; // Límite de 10 minutos 
			$ip = $this->CI->input->ip_address();//ip del usuario
			$captcha = $this->CI->input->post('captcha');//captcha introducido por el usuario

			//eliminamos los captcha con más de 2 minutos de vida
			$this->CI->captcha_model->remove_old_captcha($expiration);
			

			//comprobamos si es correcta la imagen introducida
			$check = $this->CI->captcha_model->check($ip,$captcha,$expiration);

			/*
			|si el número de filas devuelto por la consulta es igual a 1
			|es decir, si el captcha ingresado en el campo de texto es igual
			|al que hay en la base de datos, junto con la ip del usuario 
			|entonces dejamos continuar porque todo es correcto
			*/
			if($check == 1)
			{
				echo 'Validación pasada correctamente';
			}

		}		

	}

	//comprobamos si la sessión que hemos creado es igual que el captcha introducido
	//con una función callback
	public function validate_captcha() {

	    if($this->CI->input->post('captcha') != $this->CI->session->userdata('captcha'))
	    {
	        $this->CI->form_validation->set_message('validate_captcha', 'Error');
	        return false;
	    }else{
	        return true;
	    }

	}
}

//end application/controllers/captcha.php
?>