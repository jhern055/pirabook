<?php
$CI =& get_instance();
$CI->load->model("notifications_model");
$CI->load->model("home_model");
$data['publications_categories'] = $this->home_model->get_categories();

// comentarios y comentarios respuestas de tus publicaciones
$data["notifications_data"]=$CI->notifications_model->getNotifications_get();


$data["user_id"]=$CI->session->userdata("user_id");

// variables de sistema
$CI->load->model("vars_system_model");
$data["sys"]=$CI->vars_system_model->_vars_system();


$segment =(!empty($this->uri->segment(3)) ? strip_tags( $this->security->xss_clean( $this->uri->segment(3) ) ) :0);

$this->load->helper("module_html");
$data['css_menu_category'] =buildMenuCategory(0,$this->home_model->get_menu_category());
$data["breadcrumbs"] = make_parent_list($segment);


$this->load->view('includes/header',$data);
$this->load->view($main_content);

if(!empty($common_right))
$this->load->view('includes/common_right');

$this->load->view('includes/footer');
?>
