<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



#catalog 
	#product
$route["product/category/(:num)"]          ="catalog/product/product/category/$1";            
$route["product/category/(:num)/(:num)"]          ="catalog/product/product/category/$1";            

	#checkout
$route["checkout/"]          ="catalog/checkout/checkout/index";            
$route["checkout"]          ="catalog/checkout/checkout/index";            


// Cienevelo
	$route["cinepixi"]          ="cinepixi/Cinepixi/index";            
	$route["cinepixi/children"] ="cinepixi/Cinepixi/index"; 
	
	$route["cinepixi/movie"]                   ="cinepixi/movie/movie/index";            
	$route["cinepixi/movie/children"]          ="cinepixi/movie/movie/children";            
	$route["cinepixi/movie/movie_ajax"]        ="cinepixi/movie/movie/movie_ajax";       
	$route["cinepixi/movie/movie_ajax/(:num)"] ="cinepixi/movie/movie/movie_ajax/$1";
	$route["cinepixi/movie/movieView"]         ="cinepixi/movie/movie/movieView";        
	$route["cinepixi/movie/movieView/(:num)"]  ="cinepixi/movie/movie/movieView/$1"; 
	$route["cinepixi/movie/movie_delete"]      ="cinepixi/movie/movie/movie_delete";

	$route["cinepixi/movie/category"]                      ="cinepixi/movie/category/Category/index";            
	$route["cinepixi/movie/category/children"]             ="cinepixi/movie/category/Category/children";            
	$route["cinepixi/movie/category/category_ajax"]        ="cinepixi/movie/category/Category/category_ajax";       
	$route["cinepixi/movie/category/category_ajax/(:num)"] ="cinepixi/movie/category/Category/category_ajax/$1";
	$route["cinepixi/movie/category/categoryView"]         ="cinepixi/movie/category/Category/categoryView";        
	$route["cinepixi/movie/category/categoryView/(:num)"]  ="cinepixi/movie/category/Category/categoryView/$1"; 
	$route["cinepixi/movie/category/category_delete"]      ="cinepixi/movie/category/Category/category_delete";
	$route["cinepixi/movie/category/category_tokeninput?(:any)"] ="cinepixi/movie/category/category/category_tokeninput";            

	$route["cinepixi/pathFile"]                            ="cinepixi/pathFile/pathFile/index";
	$route["cinepixi/pathFile/children"]                   ="cinepixi/pathFile/pathFile/children";            
	$route["cinepixi/pathFile/pathFile_ajax"]              ="cinepixi/pathFile/pathFile/pathFile_ajax";       
	$route["cinepixi/pathFile/pathFile_ajax/(:num)"]       ="cinepixi/pathFile/pathFile/pathFile_ajax/$1";
	$route["cinepixi/pathFile/pathFileView"]               ="cinepixi/pathFile/pathFile/pathFileView";        
	$route["cinepixi/pathFile/pathFileView/(:num)"]        ="cinepixi/pathFile/pathFile/pathFileView/$1"; 
	$route["cinepixi/pathFile/pathFile_delete"]            ="cinepixi/pathFile/pathFile/pathFile_delete";
	$route["cinepixi/pathFile/pathFile_tokeninput?(:any)"] ="cinepixi/pathFile/pathFile/pathFile_tokeninput";            
