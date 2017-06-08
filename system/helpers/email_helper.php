<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Email Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/email_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('valid_email'))
{
	/**
	 * Validate email address
	 *
	 * @deprecated	3.0.0	Use PHP's filter_var() instead
	 * @param	string	$email
	 * @return	bool
	 */
	function valid_email($email)
	{
		return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('send_email'))
{
	/**
	 * Send an email
	 *
	 * @deprecated	3.0.0	Use PHP's mail() instead
	 * @param	string	$recipient
	 * @param	string	$subject
	 * @param	string	$message
	 * @return	bool
	 */
	function send_email($recipient, $subject, $message)
	{
		return mail($recipient, $subject, $message);
	}
}

if ( ! function_exists('sendNotification'))
{
function sendNotification($msg,$subject){
	
	$string="";

	if(is_array($msg)){
	foreach ($msg as $key => $value) {
	$string.=$key."=".$value."</br>";
	}
	$msg=$string;
	}

	$ci = get_instance();
	$ci->load->library('email');

	$config = array(
		'smtp_timeout' =>7,
		'mailtype'     => 'html',
		'charset'      => 'utf-8',
		'newline'      => "\r\n",
		"wordwrap"     =>false,
		"crlf"         =>"\r\n"
	); 

	if($_SERVER['SERVER_NAME']!="localhost"){
	$config = array(
		'protocol'  => 'mail',
		'smtp_host' => "mail.pirabook.com",
		'smtp_user' => 'publicity@pirabook.com',
		'smtp_pass' => 'Dana2012.',
	);    
	}else{
	$config = array(
		'protocol'     => 'smtp',
		'smtp_host'    => 'ssl://smtp.gmail.com',
		'smtp_port'    => 465,
		'smtp_user'    => 'jhern055@gmail.com',
		'smtp_pass'    => 'Dana2012.uza4C3R0HP',
	);    
	}

	$ci->email->initialize($config);
	$ci->email->set_newline("\r\n"); 
	$ci->email->from("publicity@pirabook.com", "Pirabook");
	// $ci->email->from("publicity@pirabook.com", "Pirabook");
	$ci->email->to("jhern055@gmail.com");
	$ci->email->subject($subject);
	$ci->email->message($msg);

	if (!$msg=$ci->email->send())
	return array("status"=>0,"msg"=>$ci->email->print_debugger(array('headers'))."no se envio","data"=>false);
	else
	return array("status"=>1,"msg"=>"Se envió con éxito su información.\n
			Nosotros nos comunicaremos con usted lo mas pronto posible","data"=>false);
}
}
