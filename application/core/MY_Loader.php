<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {

    public function template($template_name, $vars = array(), $return = FALSE) {
    
    $CI =& get_instance();
    $CI->load->model("vars_system_model");

    //validacion
    if(!empty($CI->uri->uri_string) and $CI->uri->segment(1)!="login"){
        
        // $CI->load->helper("login");
        $module_read=$vars["module"]."read";
        
        // funcion para validar los read
        $return_valid=rights_validation($module_read,"javascript");

        if(!$return_valid["status"]){

            echo $return_valid["redirect"];

            // die($return_valid["msg"]." ".$module_read);
        }
    }
    // ..

    // $menu = new menu();
    $vars["menu"]=$this->getDynamicMenu();

    $vars["sys"]=$CI->vars_system_model->_vars_system();
    $vars["jquery_1_11_1"]='<script type="text/javascript" src="'.base_url().'js/jquery-1.11.1.js"></script>';

    /// ****** TOKEN INPUT ***** ///
    $vars['tokeninput_js'] ="<script type='text/javascript' src='".base_url()."js/libraries/token_input/jquery.tokeninput.js'></script>";
    $vars['tokeninput_css'] ="<link rel='stylesheet' href='".base_url()."css/libraries/token_input/token-input.css' type='text/css' />";
    
    /// ****** jquery redirect ***** ///
    // $vars['jquery_redirect'] ="<script src='".base_url()."js/libraries/jRedirect/jquery.redirect.js'></script>";
    
    // accesos rapidos de padres
    if(!empty($vars["module"]))
    $vars["modules_quick"]=$this->get_back_access($vars["module"]);
    // 

        if($return):

        $content  = $this->view('templates/header', $vars, $return);
        $content  = $this->view('templates/navBar', $vars, $return);
        $content  = $this->view('templates/leftWidget', $vars, $return);
        $content .= $this->view($template_name, $vars, $return);
        $content .= $this->view('templates/footer', $vars, $return);

        return $content;
    else:
        $this->view('templates/header', $vars);
        $this->view('templates/navBar', $vars);
        $this->view('templates/leftWidget', $vars);
        $this->view($template_name, $vars);
        $this->view('templates/footer', $vars);
    endif;

    }

    public function getDynamicMenu($input_search=null){

    $CI =& get_instance();
    $CI->load->model("dynamic_menu_model");

        $menu_html="";
        $menu_html.='<link rel="stylesheet" type="text/css" href="'.base_url().'css/dynamic_menu_favorite/styles.css" />';
        $menu_html.='<script type="text/javascript" src="'.base_url().'css/dynamic_menu_favorite/script.js"></script>';
        $menu_html.=$this->buildMenu(0, $CI->dynamic_menu_model->get_menu($input_search));

        if(!empty($_POST["ajax"]))
        return print_r(json_encode( array("status"=>1,"menu"=>$menu_html ) ) ) ;
        else
        return $menu_html;
    }

    public function buildMenu($parent, $menu) {
    $CI =& get_instance();
    $CI->load->model("vars_system_model");
    $sys=$CI->vars_system_model->_vars_system();
    $CI->load->helper('load_controller');

    $html = "";
    if (isset($menu['parent_menus'][$parent])) {
        $html .= '<ul class="nav" id="side-menu">';

        foreach ($menu['parent_menus'][$parent] as $menu_id) {
            $controller=explode("/", substr($menu['menus'][$menu_id]['link'],0, -1));

            if (!isset($menu['parent_menus'][$menu_id])) {
                $html .= "<li data-id_menu='".encode_id($menu_id) ."'>";
                $html .= "<a id='a_menu_click' class='a_menu' href=javascript:void(0); data-href=".substr($menu['menus'][$menu_id]['link'],0, -1).">";
                // $html .= "<a id='a_menu_click' class='a_menu' href='".(!empty(substr($menu['menus'][$menu_id]['link'],0, -1))?base_url().substr($menu['menus'][$menu_id]['link'],0, -1):"javascript:void(0);")."' data-href=".substr($menu['menus'][$menu_id]['link'],0, -1).">";
                $html  .= "     <span style='margin-left: -10px; margin-right: -10px;' class='icon_menu ".(!empty($menu['menus'][$menu_id]['class'])?$menu['menus'][$menu_id]['class']:"")."'></span>
                                <span class='module_text'>"
                                . $menu['menus'][$menu_id]['name'] ."
                                <span>
                            </a>";

                            if(!empty($sys["config"]["no_roulette_mouse"])):
                    $html .="<a href=".base_url().$menu['menus'][$menu_id]['link']." target='_blank' class='a_new_tab'><span style='margin-left: -10px;' class='new_tab'></span></a>";
                            else:

                                // if(!empty($sys["config"]["no_click_right_mouse"]))
                                if(controller_exists(ucwords($controller[0])) and count(explode("/", substr($menu['menus'][$menu_id]['link'],0, -1))) > 1)
                                $html .="<a href='".base_url().substr($menu['menus'][$menu_id]['link'],0, -1)."View'  class='add_record'><span style='margin-left: -10px;' class='add_record'></span></a>";

                            endif;

                $html .="</li>";
            }

            if (isset($menu['parent_menus'][$menu_id])) {

                $html .= "<li class='has-sub' data-id_menu='".encode_id($menu_id) ."'>";
                $html .=  "<a id='a_menu_click' class='a_sub_menu' href=".base_url().$menu['menus'][$menu_id]['link']." data-href=".substr($menu['menus'][$menu_id]['link'],0, -1).">";

                $html .= "  <span style='margin-left: -10px; margin-right: -10px;' class='icon_menu ".(!empty($menu['menus'][$menu_id]['class'])?$menu['menus'][$menu_id]['class']:"")."' ></span>
                            <span class='module_text'>
                            ".$menu['menus'][$menu_id]['name']."
                            <span>
                            </a>";
                
                    if(!empty($menu['menus'][$menu_id]['name'])){
                            if(!empty($sys["config"]["no_roulette_mouse"])):
                            $html .="<a href=".base_url().$menu['menus'][$menu_id]['link']." target='_blank' class='a_new_tab'><span style='margin-left: -10px;' class='new_tab'></span></a>";
                            else: 

                                if(controller_exists(ucwords($controller[0])) and count(explode("/", substr($menu['menus'][$menu_id]['link'],0, -1))) > 1 )
                                $html .="<a href='".base_url().substr($menu['menus'][$menu_id]['link'],0, -1)."View'  class='add_record'><span style='margin-left: -10px;' class='add_record'></span></a>";
                            
                            endif;
                    }

                $html .= $this->buildMenu($menu_id, $menu);

                $html .= "</li>";
            }
        }

        // foreach ($menu['parent_menus'][$parent] as $menu_id) {
        //     if (!isset($menu['parent_menus'][$menu_id])) {
        //         $html .= "<li><a href='" . $menu['menus'][$menu_id]['link'] . "'>" . $menu['menus'][$menu_id]['name'] . "</a></li>";
        //     }
        //     if (isset($menu['parent_menus'][$menu_id])) {
        //         $html .= "<li class='has-sub'><a href='" . $menu['menus'][$menu_id]['link'] . "'>" . $menu['menus'][$menu_id]['name'] . "</a>";
        //         $html .= buildMenu($menu_id, $menu);
        //         $html .= "</li>";
        //     }
        // }

        $html .= "</ul>";
    }
    
    return $html;

    }

    public function module_text_from_id($module) {
    
    $name="";
    $CI =& get_instance();
    $CI->load->model("dynamic_menu_model");
    $name=$CI->dynamic_menu_model->module_name($module);

    return $name;
    }

    public function get_module_childrens($module_id) {

    $module_childrens=array();
    $CI =& get_instance();
    $CI->load->model("dynamic_menu_model");
    $module_childrens=$CI->dynamic_menu_model->module_childrens($module_id);

    return $module_childrens;
    }
 
    // <LinkinModule>
    public function get_back_access($source_module,$id=null){
    $CI =& get_instance();
    $CI->load->model("config/config_model");

        $source_module_pro=explode("/", substr($source_module,0, -1)); // quitamos el ultimo caracter /
        array_pop($source_module_pro);
        $module_tmp="";
        $modules_quick="";
        foreach ($source_module_pro as $key => $module_row){

        $module_tmp.=$module_row."/";

        $modules_quick[$module_tmp]=$CI->config_model->m_name($module_tmp);
        
        @$module=end(explode("/", substr($modules_quick[$module_tmp]["link"],0, -1)));
        $modules_quick[$module_tmp]["link_sub"]=substr($modules_quick[$module_tmp]["link"],0, -1);
        $modules_quick[$module_tmp]["module"]=$module;
        $link_module=$modules_quick[$module_tmp]["link"];
        // $link_module=substr($modules_quick[$module_tmp]["link"],0, -1);

        // pr($modules_quick);
        // if(count(explode("/", $module_tmp)) > 2)
        // $modules_quick[$module_tmp]["link_view"]=$link_module."View";
        // else if(count(explode("/", $module_tmp)) >= 2)
        // $modules_quick[$module_tmp]["link_view"]=$link_module."/".$link_module."View";
        // else
        $modules_quick[$module_tmp]["link_view"]=$link_module;

        }
        return $modules_quick;
    }
    // </LinkinModule> 
    public function buildMenuFile($parent, $menu,$pathFather=null) {
    $CI =& get_instance();
    $CI->load->model("vars_system_model");
    $CI->load->helper('download');
    $sys=$CI->vars_system_model->_vars_system();
    $CI->load->helper('load_controller');
    $dir="/opt/cinepixi/files";

    $html = "";
    $play = "";
    if (isset($menu['parent_menus'][$parent])) {
        $html .= '<ul class="nav" id="side-menu" style="float:left; width:250px">';

        foreach ($menu['parent_menus'][$parent] as $menu_id) {
            $controller=explode("/", substr($menu['menus'][$menu_id]['link'],0, -1));
            // <div class='btn btn-lg btn-primary btn-block submit'>add playList</div>
                            // <input type='checkbox' name='to_usb' style='float:left; width:15px !important; height:15px; margin-right:10px;'/>

            if (!isset($menu['parent_menus'][$menu_id])) {
            $ext = pathinfo($menu['menus'][$menu_id]['name'], PATHINFO_EXTENSION);
                if($ext=="mp3"){
                // $html .= "<li data-id_menu='".encode_id($menu_id) ."'>";
                $html .= "<li style='float:left; width:250px'>";
                // $html .= "<a id='a_menu_click' class='a_menu' href=javascript:void(0); data-href=".substr($menu['menus'][$menu_id]['link'],0, -1).">";
                $html .= "<a class='a_menu' href=javascript:void(0); style='float:left; width:250px'>";
                $html  .= "<span class='module_text' style='float:left; width:250px'>"
                            . $menu['menus'][$menu_id]['name'] ."
                            </span>";

                // $html .="<button data-id='".$menu_id."' syle='float:left;' type='button' class='addList btn btn-primary btn-sm'>Agregar a Lista</button>";
                
                $html .="</a>";

                $html .= "<a class='download_music_a' href='".base_url()."file/download_file/?path_file=http://cinepixi.com".(!empty($pathFather)?$pathFather:$menu['menus'][$menu_id]['linkFather'])."/".$menu['menus'][$menu_id]['name']."&name_file=".$menu['menus'][$menu_id]['name']."';>";
                $html .="<span class='download_music'></span>";
                $html .="</a>";

                // $html .=$pathFather."/"., "Descargas");
                
//                 $html .="<script type='text/javascript'>
//                             $(document).ready(function(){
//                                 var myOtherOne = new CirclePlayer('#jquery_jplayer_".$menu_id."',
//                                 {
//                                     mp3:'http://cinepixi.com".$pathFather."/".$menu['menus'][$menu_id]['name']."',
//                                 }, {
//                                     cssSelectorAncestor: '#cp_container_".$menu_id."'
//                                 });
//                             });                                
//                         </script>
//                         <div id='jquery_jplayer_".$menu_id."' class='cp-jplayer'></div>

// <div class='prototype-wrapper'>
//             <div id='cp_container_".$menu_id."' class='cp-container'>
//                 <div class='cp-buffer-holder'>
//                     <div class='cp-buffer-1'></div>
//                     <div class='cp-buffer-2'></div>
//                 </div>
//                 <div class='cp-progress-holder'>
//                     <div class='cp-progress-1'></div>
//                     <div class='cp-progress-2'></div>
//                 </div>
//                 <div class='cp-circle-control'></div>
//                 <ul class='cp-controls'>
//                     <li><a class='cp-play' tabindex='1'>play</a></li>
//                     <li><a class='cp-pause' style='display:none;' tabindex='1'>pause</a></li> 
//                 </ul>
//             </div>
// </div> ";
                $html .="<audio class='audioDemo' controls preload='none'>
                            <source src='http://cinepixi.com".(!empty($pathFather)?$pathFather:$menu['menus'][$menu_id]['linkFather'])."/".$menu['menus'][$menu_id]['name']."' type='audio/mpeg'>
                         </audio>";
                $html .="</li>";
                }
            }

            if (isset($menu['parent_menus'][$menu_id])) {

                // $html .= "<li class='has-sub' data-id_menu='".encode_id($menu_id) ."'>";
                $html .= "<li class='has-sub' style='float:left; width:250px'>";
                // $html .=  "<a id='a_menu_click' class='a_sub_menu' href=".base_url().$menu['menus'][$menu_id]['link']." data-href=".substr($menu['menus'][$menu_id]['link'],0, -1).">";
                $html .=  "<a class='a_sub_menu' href=javascript:void(0); style='float:left; width:250px'>";
                $html .= "  <span style='margin-left: -10px; margin-right: -10px; width:250px;' class='icon_menu ".(!empty($menu['menus'][$menu_id]['class'])?$menu['menus'][$menu_id]['class']:"")."' ></span>
                            <span class='module_text'>
                            
                            ".$menu['menus'][$menu_id]['name']."
                            </span>
                            </a>";
                
                // $html .="<button data-id='".$menu_id."' type='button' class='addList btn btn-primary btn-sm'>Agregar a Lista</button>";
                $html .= $this->buildMenuFile($menu_id, $menu,$menu['menus'][$menu_id]['link']);

                $html .="</li>";
            }
        }

        $html .= "</ul>";
    }
    
    return $html;

    }        
}

 ?>