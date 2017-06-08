<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('array_sort_by_column'))
{
function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    if($arr)
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    if($sort_col)
    array_multisort($sort_col, $dir, $arr);
 }

}
if ( ! function_exists('rights_validation')){
    function rights_validation($module_right,$return=false){
   
    $CI =& get_instance();
    $CI->load->model("login/login_model");

    if($CI->session->userdata("user")):

    $user=$CI->login_model->get_user_by_id( $CI->session->userdata("user_id"));
    $user["rights"]=explode(",", $user["rights"]);
    
    endif;

    $status=false; // por default no tiene 
    $msg="No tienes acceso: ";
    $do_it="No tienes el permiso: ";
            // <script>alert('debe loguearse primero');window.location.href='".base_url()."login?redirect=".current_url()."'; </script>
    // no esta logueado
    if(empty($user)){

        $user["rights"]=array();

        $ret=array(
            "status"=>$status,
            "msg"=> $msg." debe loguearse primero",
            "redirect"=>"
            <script>alert('debe loguearse primero');window.location.href='".base_url()."login?redirect=".current_url()."'; </script>
            "
            );

        return $ret;
    }

    if(in_array($module_right, $user["rights"]))
    $status=true;

    switch ($return) {

        case $return=="javascript":
        $ret=array("status"=>$status,"msg"=>$msg,"redirect"=>"<script>alert('No tienes acceso a este modulo:{".$module_right."}');window.location.href='".base_url()."';</script>");
        break;
        
        case $return=="ajax":
        $ret=array("status"=>$status,"msg"=>$do_it."{ ".$module_right." }","redirect"=>"");
        break;

        default:
        $ret =array("status"=>$status,"msg"=>"default switch case ","redirect"=>"");
        break;
    }
        return $ret;
    }

}

if ( ! function_exists('cutText')){

function cutText($texto,$caracteresMax=140) { 
   $texto=substr($texto, 0,$caracteresMax);
   $index=strrpos($texto, " ");
   $texto=substr($texto, 0,$index); 
   $texto.="...";
   return $texto;
}

}
 ?>