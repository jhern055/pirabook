<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function index(){
		

// $this->cart->destroy();

		$data['javascript_1_11_0'] = "<script src=".base_url()."js/jquery-1.11.0.js></script>";
		// $data['publications_categories'] = $this->home_model->get_categories();
		$data['main_content']='cart/cart';
		$this->load->view('includes/template',$data); 

	}
	public function getProducts(){
	$data="";
	$this->cart->insert();	

	}
	public function addToCart(){
	// $this->load->model("publication/publication_model");
	$this->load->model("catalog/product/product_model");

	$idrecord=strip_tags($this->security->xss_clean(decryptStringArray($_POST["idrecord"]))?:"");
	$qty=strip_tags($this->security->xss_clean($_POST["qty"])?:"");


	// $data_item=$this->publication_model->get_publication_id($idrecord);
	$data_item=$this->product_model->get_product_id($idrecord);
	// return print_r(json_encode($data_item ));

		$data = array(
				'id'      => $idrecord,
				'price'   => (!empty($data_item["price"])?$data_item["price"]:500000),
				// 'price'   => strip_tags($this->security->xss_clean(decryptStringArray($_POST["price"]))?:""),
				'qty'     => $qty,
				'name'    => $data_item["name"],
				'image'    => $data_item["image"],
				'options' => array()
		        // 'options' => array('Size' => 'L', 'Color' => 'Red')
		);

	if(!$idItemCart=$this->cart->insert($data)){
	$return=array("status"=>0,
		"msg"            =>"No se agrego",
		"data"           =>false,
		"cartItem"       =>0,
		"subtTotalItem"  =>number_format(0,0,".",","),
		"totalCart"      =>number_format(0,0,".",","),
		"textDetailCart" =>"0 Productos - $".number_format(0,0,".",","),
		"cartHeader"=>$this->load->view("cart/cart_header",$data,true),

		);
		
	}	


		if(!empty($return))
		return $return;			

	$cartItem=$this->cart->get_item($idItemCart);
	$subtTotalItem =$cartItem["subtotal"];
	$totalCart=$this->cart->total();
	$totalItems=$this->cart->total_items();

	$data["items_cart"]=$this->cart->contents();
	$data["subTotalCart"]=$this->cart->subtotal(); 
	$data["totalCart"]=$totalCart; 
	$data["totalItems"]=$totalItems;

	$totalCart=round($totalCart);
	return print_r(json_encode(array(
			"status"         =>1,
			"msg"            =>"Se agrego con exito",
			"data"           =>false,
			"cartItem"       =>$cartItem,
			"subtTotalItem"  =>number_format($subtTotalItem,0,".",","),
			"subTotalCart"  =>number_format($data["subTotalCart"],2,".",","),
			"totalCart"      =>number_format($totalCart,2,".",","),
			"textDetailCart" =>$totalItems." Productos - $".number_format($totalCart,2,".",","),
			"cartHeader"=>$this->load->view("cart/cart_header",$data,true),
			)));
 
	}

	public function updateToCart(){
	$idItemCart=strip_tags($this->security->xss_clean(decryptStringArray($_POST["idItemCart"]))?:"");
	$qty=strip_tags($this->security->xss_clean($_POST["qty"])?:"");
	$cartItem      =$this->cart->get_item($idItemCart);

		$data = array(
		        'rowid' => $idItemCart,
		        'qty'   => $qty
		);

		if($cartItem["qty"]!=$qty){

			if(!$this->cart->update($data)){
			$return=array("status"=>0,
				"msg"            =>"No se agrego",
				"data"           =>false,
				"cartItem"       =>0,
				"subtTotalItem"  =>number_format(0,0,".",","),
				"subTotalCart"  =>number_format(0,0,".",","),
				"totalCart"      =>number_format(0,0,".",","),
				"textDetailCart" =>"0 Productos - $".number_format(0,0,".",","),
				"cartHeader"=>$this->load->view("cart/cart_header",$data,true),

				);
			}	
		}

		if(!empty($return))
		return $return;			

	$cartItem      =$this->cart->get_item($idItemCart);
	$subtTotalItem =$cartItem["subtotal"];

	$totalCart     =$this->cart->total();
	$totalItems    =$this->cart->total_items();

	$data["items_cart"]=$this->cart->contents();
	$data["subTotalCart"]=$this->cart->subtotal(); 
	$data["totalCart"]=$totalCart; 
	$data["totalItems"]=$totalItems;
	$totalCart=round($totalCart);

	// return print_r(json_encode($cartItem));

	return print_r(json_encode(array(
		"status"         =>1,
		"msg"            =>"Se actualizo con exito",
		"data"           =>false,
		"cartItem"       =>$cartItem,
		"subtTotalItem"  =>number_format($subtTotalItem,0,".",","),
		"subTotalCart"   =>number_format($data["subTotalCart"],2,".",","),
		"totalCart"      =>number_format($totalCart,2,".",","),
		"textDetailCart" =>$totalItems." Productos - $".number_format($totalCart,2,".",","),
		"cartHeader"=>$this->load->view("cart/cart_header",$data,true),

			)));			
	}

	public function removeIdCart(){
	$idItemCart=strip_tags($this->security->xss_clean(decryptStringArray($_POST["idItemCart"]))?:"");

	$this->cart->remove($idItemCart);

	$subTotalCart=$this->cart->subtotal(); 
	$totalCart     =$this->cart->total();
	$totalItems    =$this->cart->total_items();

	return print_r(json_encode(array(
	"status"       =>1,
	"msg"          =>"Se elimino con exito",
	"data"         =>false,
	"subTotalCart" =>number_format($subTotalCart,2,".",","),
	"totalCart"    =>number_format($totalCart,2,".",","),
	"totalItems"   =>$totalItems,
	"textDetailCart" =>$totalItems." Productos - $".number_format($totalCart,2,".",","),

		)));		
	}

	public function destroyCart(){
		$this->cart->destroy();
		$this->session->set_userdata("order_info","");
	}

	public function checkout(){
		$data['main_content']='cart/checkout';
		$this->load->view('includes/template',$data);
	}

	public function save(){
		$user=$this->session->userdata("user");	
			
		$order_info=array(		
		"name"           =>(!empty($_POST["name"])?ucwords(strip_tags($this->security->xss_clean($_POST["name"])) ):"" ),
		"direction"      =>(!empty($_POST["direction"])?ucwords(strip_tags($this->security->xss_clean($_POST["direction"])) ):"" ),
		"email"          =>(!empty($_POST["email"])?strip_tags($this->security->xss_clean($_POST["email"])):"" ),
		"telephone"      =>(!empty($_POST["telephone"])?strip_tags($this->security->xss_clean($_POST["telephone"])):"" ),
		"payment_method" =>(!empty($_POST["payment_method"])?strip_tags($this->security->xss_clean($_POST["payment_method"])):"" ),
		
		);
	$this->session->set_userdata("order_info",$order_info);
	
	if(empty($order_info["email"]) and !empty($user["user_email"]) )
	$order_info["email"]=$user["user_email"];

	if(!$user & ( empty($order_info["email"]) or empty($order_info["name"]) ) or empty($order_info["payment_method"])){
	return print_r(json_encode(array(
		"status"         =>0, 
		"msg"            =>"Faltan parametros", 
		"data"           =>false,
		"name"           =>(!empty($order_info["name"])?"":1),
		"direction"      =>(!empty($order_info["direction"])?"":1),
		"email"          =>(!empty($order_info["email"])?"":1),
		"telephone"      =>(!empty($order_info["telephone"])?"":1),
		"payment_method" =>(!empty($order_info["payment_method"])?"":1),
		))); 
	}

	return print_r(json_encode(array(
		"status"         =>1, 
		"msg"            =>"Se actualizo con exito", 
		"data"           =>false,
		"name"           =>$order_info["name"],
		"direction"      =>$order_info["direction"],
		"email"          =>$order_info["email"],
		"telephone"      =>$order_info["telephone"],
		"payment_method" =>$order_info["payment_method"],
		))); 

	}

	public function confirm(){
	$this->load->model("admin/sale/remission/remission_model");
	return print_r(json_encode($this->session->userdata("order_info")));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */