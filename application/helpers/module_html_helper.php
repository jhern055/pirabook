<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('modules_html_list')){

    function modules_html_list($modules,$html="",$hidden=false,$only_parent=false,$home_link=false,$module_array=array()) {

    if(!is_string($html))
     $html="";

    $html_tmp="";

    foreach($modules as $module_id):

        $is_parent=(substr_count($module_id,"/")===0);

        if($only_parent and !$is_parent)
         continue;

        $html_tmp.="<li class='item".( !$is_parent ? "" : " {$module_id}_item" )."'>";

        $html_tmp.="<div class='image'></div>";
        $html_tmp.="<a href='base_url()$module_id'>$module_id</a>";

        if($module_childrens=get_module_childrens($module_id,$module_array) and ($html_tmp2=modules_html_list($module_childrens))):

            $html_tmp.="<div class='haveChildrensMark'>&gt;</div>";
            $html_tmp.=$html_tmp2;

        endif;

        $html_tmp.="</li>";

    endforeach;

    // ...

    if($html_tmp) {

        $html.="<ul class='menu'".( !$hidden ? "" : " style=' display:none; '" ).">";
        $html.=$html_tmp;
        $html.="</ul>";

    }

    // ...

    return $html;

    }

}

if ( ! function_exists('get_module_childrens')){
    function get_module_childrens($module_id,$module_array) {

    $module_childrens=array();

    $module_separator="/";
    $to_search=$module_id.$module_separator;
    $module_separator_limit=substr_count($to_search,$module_separator);

    foreach($module_array as $module_tmp) {

        if(!(strpos($module_tmp["module"],$to_search)===0 and substr_count($module_tmp["module"],$module_separator)===$module_separator_limit)
                )
         continue;

        $module_childrens[$module_tmp["module"]]=$module_tmp["name"];

    }

     // sort

     ksort($module_childrens,SORT_STRING);

     // ...

     $module_childrens=array_values($module_childrens);

     // ...
     return $module_childrens;

    }
}

if ( ! function_exists('get_module_parents_children')){
    function get_module_parents_children($module_id,$module_array,$only_parent=false,$is_parent=false) {

    $module_childrens=array();

    $module_separator="/";
    $to_search=$module_id.$module_separator;
    $module_separator_limit=substr_count($to_search,$module_separator);

    foreach($module_array as $module_tmp) {
        $is_parent=(substr_count($module_tmp["module"],"/")===0);

        if($only_parent and !$is_parent)
         continue;

        if(!(strpos($module_tmp["module"],$to_search)===0 and substr_count($module_tmp["module"],$module_separator)===$module_separator_limit)
                )
         continue;

        $module_childrens[$module_tmp["module"]]=$module_tmp["name"];

    }

     // sort

     ksort($module_childrens,SORT_STRING);

     // ...

     $module_childrens=array_values($module_childrens);

     // ...
     return $module_childrens;

    }
}
if ( ! function_exists('get_module_vars')){
    function get_module_vars($module_array) {

    // $_MODULE=$sys["config"]["module"][$_MODULE_ID];
    if(!$module_array)
    return false;

    if($module_array)
    foreach ($module_array as $key => $value) {

        // ...
        // pr(get_module_parents_children($value["module"],$module_array,false));
        // $_MODULE["name_full"]=module_text_from_id($_MODULE_ID,"",0);
        $_MODULE[$key]["module"]=$value["module"];
        $_MODULE[$key]["name_full"]=$value["name"];

        // ...

        $_MODULE[$key]["childrens"]=get_module_childrens($value["module"],$module_array);

     }

        return $_MODULE;
    }
}

    // Create the main function to build milti-level menu. It is a recursive function.  
if ( ! function_exists('buildMenu')){
    function buildMenu($parent, $menu) {

    $html = "";
    // $html.='<link rel="stylesheet" type="text/css" href="'.base_url().'/css/dynamic_menu_favorite/styles.css" />';
    // $html.='<script type="text/javascript" src="'.base_url().'/css/dynamic_menu_favorite/script.js"></script>';

    if (isset($menu['parent_menus'][$parent])) {
        $html .= "<ul>";


        foreach ($menu['parent_menus'][$parent] as $menu_id) {
            if (!isset($menu['parent_menus'][$menu_id])) {
                $html .= "<li data-id_menu='".encode_id($menu_id) ."'><a href=javascript:void(0);><div class='delete_small' data-id_menu='".encode_id($menu_id) ."'></div>" . $menu['menus'][$menu_id]['title'] . "</a></li>";
            }
            if (isset($menu['parent_menus'][$menu_id])) {
                $html .= "<li class='has-sub' data-id_menu='".encode_id($menu_id) ."'> <a href='javascript:void(0);'> <div class='delete_small' data-id_menu='".encode_id($menu_id) ."'></div>" . $menu['menus'][$menu_id]['title'] . "</a>";
                $html .= buildMenu($menu_id, $menu);
                $html .= "</li>";
            }
        }

        // foreach ($menu['parent_menus'][$parent] as $menu_id) {
        //     if (!isset($menu['parent_menus'][$menu_id])) {
        //         $html .= "<li><a href='" . $menu['menus'][$menu_id]['link'] . "'>" . $menu['menus'][$menu_id]['title'] . "</a></li>";
        //     }
        //     if (isset($menu['parent_menus'][$menu_id])) {
        //         $html .= "<li class='has-sub'><a href='" . $menu['menus'][$menu_id]['link'] . "'>" . $menu['menus'][$menu_id]['title'] . "</a>";
        //         $html .= buildMenu($menu_id, $menu);
        //         $html .= "</li>";
        //     }
        // }

        $html .= "</ul>";
    }
    

    return $html;

    }
}


###########
### EL MENU DE LAS CATEGORIAS DE VENTA
###
if ( ! function_exists('buildMenuCategory')){
    function buildMenuCategory($parent, $menu) {

    $html = "";

    if (isset($menu['parent_menus'][$parent])) {
        $html .= "<ul id='main-menu' class='sm sm-blue'>";

        foreach ($menu['parent_menus'][$parent] as $menu_id) {
        //     $arr = array();
 
        // $all_categories=make_parent_list($menu['menus'][$menu_id]['id']);

        // foreach ($all_categories as $category) {
        //     $arr[] = $category['parent_id'];
        // }  

        // $path="&path"=implode('_', $arr);

            if (!isset($menu['parent_menus'][$menu_id])) {
                $html .= "<li><a href=".base_url()."product/category/".$menu['menus'][$menu_id]['id'].">" . $menu['menus'][$menu_id]['name'] . "</a></li>";
            }
            if (isset($menu['parent_menus'][$menu_id])) {
                $html .= "<li> <a href=".base_url()."product/category/".$menu['menus'][$menu_id]['id'].">". $menu['menus'][$menu_id]['name'] . "</a>";
                $html .= buildMenuCategory($menu_id, $menu);
                $html .= "</li>";
            }
        }

        $html .= "</ul>";
    }

    return $html;

    }
}

if ( ! function_exists('make_parent_list')){

 function make_parent_list($id) {
    $CI=&get_instance();
    $forum_data = array();

    $forum_query = $CI->db->query("SELECT *,(SELECT name FROM category where category.id=cm.category_id) as name  FROM category_multiparent as cm 
                                    WHERE 
                                    cm.category_id = '" . (int)$id . "'
                                    ");
    
    if(empty($forum_query->result())){

        $forum_query = $CI->db->query("SELECT * FROM category c 
                                        WHERE 
                                        c.id = '" . (int)$id . "'
                                        ");  
    }

    foreach ($forum_query->result() as $forum) {

        if ($forum->parent_id > 0) {

            $forum_data[] = array(
                'parent_id' => $forum->parent_id,
                'name' => $forum->name,
            );

            $forum_children = make_parent_list($forum->parent_id);

            if ($forum_children) {
                $forum_data = array_merge($forum_children, $forum_data);
            }           

        }
        else{

            $forum_data[] = array(
                'parent_id' => $forum->parent_id,
                'name' => $forum->name,
            );
            // $forum_children = make_parent_list($forum->category_id);

            // $forum_data = array($forum_data, $forum_data);

        }

    }

    return $forum_data;
}
}
##################################
if ( ! function_exists('r_implode')){

    function r_implode( $glue, $pieces )
    {
        foreach( $pieces as $r_pieces )
        {
                if( is_array( $r_pieces ) )
                {
                    $retVal[] = r_implode( $glue, $r_pieces );
                }
                else    
                {
                    $retVal[] = $r_pieces;
                }
        }
        return implode( $glue, $retVal );
    } 
} 
 ?>