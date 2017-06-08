<!DOCTYPE html>
<html lang="en">

    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="<?php echo base_url(); ?>images/interface/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url(); ?>images/interface/favicon.ico" type="image/x-icon">

    <title>Bienvenido a Pirabook Monterrey :)</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>css/blog-post.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/blog-post-continue-1.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="<?php echo base_url(); ?>js/jquery-1.11.1.js"></script>
  
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

    <!-- fuente http://jqueryui.com/dialog/ -->
    <script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>

    <script src="<?php echo base_url(); ?>js/function.js"></script>

    <!-- social locker -->
    <script type="text/javascript" src="<?php echo base_url(); ?>js/social_locker/locklike.js"></script>

    <link href="<?php echo base_url(); ?>css/jquery-ui.min.css" rel="stylesheet" type="text/css" />

    <!-- librerias imagenes  -->

    <!-- CSS adjustments for browsers with JavaScript disabled -->
<!--     <noscript><link rel="stylesheet" href="<?php echo base_url(); ?>css/jQueryFileUpload/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="<?php echo base_url(); ?>css/jQueryFileUpload/jquery.fileupload-ui-noscript.css"></noscript>
 -->
</head>

<body>
<?php if($_SERVER["REMOTE_ADDR"]!="127.0.0.1"): ?>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '',                        // App ID from the app dashboard
      //channelUrl : '//www.yourwebsite.com/channel.html', // Channel file for x-domain comms
    // channelUrl: "pirabook.com", // link to like in Facebook button
        channelUrl: "https://www.facebook.com/pages/Pirabook/1650210071872986", // link to like in Facebook button

      status     : true,                                 // Check Facebook Login status
      xfbml      : true                                  // Look for social plugins on the page
    });

    // Additional initialization code such as adding Event Listeners goes here
  };

  // Load the SDK asynchronously
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/all.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<?php endif; ?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
                <a href="<?php echo base_url(); ?>" >
                    <img class="imgLogo" src="<?php echo base_url().'images/interface/skull.png'; ?>">
<!--                     <div class="imgDiv">
                    &nbsp;
                    </div> -->
                </a>

     
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Navegacion</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="<?php echo base_url(); ?>">Pirabook</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php $user=$this->session->userdata("user"); ?>

                <ul class="nav navbar-nav" >
                    <li>
                        <?php if($user): ?>
                        <a href="#">
                        <span class="user_text"><?php echo $user["nickname"]; ?></span>
                        </a>
                        <?php else: ?>
                        <a href="<?php echo base_url().'login/?redirect='.current_url(); ?>" id="myAccount">Entrar</a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <?php if($user): ?>
                        <a href="<?php echo base_url().'favorite/'; ?>" class="favorite">
                           <span class="addFav">Agrega una página</span>  
                            <div class="star"></div>
                        </a>
                        <?php endif; ?>
                    </li>
                </ul>
                        <?php if($user): ?>
                <ul class="nav navbar-nav">
                    <li class="menuUser">

                        <a href="javascript:void(0);" class="infinit"></a>
                        <div class="downArrow"></div>
                        <ul class="dropdown-menu">
                         <li><a href="<?php echo base_url().'login/out'; ?>">Salir</a></li>
                        </ul>

                    </li>
                </ul>
                        <?php endif; ?>

<!-- carrito -->
<!-- ###################### -->
<style type="text/css">
/* Dropdown Button */
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 100%;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
ul#main-menu{
    z-index: 1;
}

img.img_li{
    width: 50px;
    height: 50px;
}

/*span.item-info{
float: left;
}
span.item{

float: left;
}
span.item-left{
float: left;

}*/
.mini-cart-info {
    position: relative;
    overflow: auto;
    padding: 3px 12px 0 12px;
}
.mini-cart-info {
    max-height: 298px;
}
li {
    display: list-item;
    text-align: -webkit-match-parent;
}
div.content {
    /*visibility: hidden;*/
    list-style: none;
    /*opacity: 0;*/
    padding: 0;
    margin: 0;
    width: 360px;

    -ms-filter: 'progid:DXImageTransform.Microsoft.Alpha(Opacity=0)';
    position: relative;
    min-height: 125px;
    color: #333745;
    float: right;
    transition: opacity .3s;
}
td.image > a>img{width:50px; max-width:50px; }

div.delete_small{width:16px; height: 16px; float: left; margin-right: 10px; margin-left: 10px;}
/*div.delete_small{ background-image:url("../../images/interface/delete-small.png");  background-repeat: no-repeat;}*/
/*div.delete_small{ background-image:url("images/interface/delete-small.png");  background-repeat: no-repeat;}*/

td{border-top:1px solid #d6d4d4; }
td.total{
font-weight: bold;
 }

ul.cart-wrapper > li.mini-cart-info > table{width: 340px !important; }
/******SECOND*********/
/******SECOND*********/

</style>
<?php //$this->cart->destroy(); ?>
<?php $data["subTotalCart"]=$this->cart->subtotal(); ?>
<?php $data["totalCart"]=$this->cart->total(); ?>

<?php $data["totalItems"]=$this->cart->total_items(); ?>
<?php $data["items_cart"]=$this->cart->contents();  ?>
<?php $items_cart=$this->cart->contents();  ?>

<a href="<?php echo base_url()."cart"; ?>">
<div class="dropdown">
                <?php echo $this->load->view("cart/cart_header",$data,true); ?>
</div>

</a>
<!-- ###################### -->
            </div>
            <!-- /.navbar-collapse -->
            <script>

            <?php if(!empty($user)): ?>
            
            $(document).on("click","a#myAccount",function(){

            var url="<?php echo base_url(); ?>",
                nickname="<?php echo base_url().$user['nickname']; ?>",
                user_id="<?php echo encode_url($this->session->userdata('user_id')); ?>";

            ref = url+"account/";
            $(location).attr("href", ref);

            // $.ajaxSetup({

            // type: "POST",
            // url: url+"account/my",
            // data: {"user_id": user_id}, 
            // dataType: "json",
            // beforeSend: function(response){
            // },
            // success: function(response){
            // }

            // });

            return false;

            });
            <?php endif; ?>

            </script>

             <script type="text/javascript">
             $(document).ready(function() {
             $('li.menuUser > ul').css({display: "none"});
                $('li.menuUser').click(function(){

                if( $(this).find('ul').is(':visible')){
                $(this).parent().find('div.downArrow').css({display: "none"});
                $(this).find('ul').css({display: "none"});
                }
                else{
                $(this).parent().find('div.downArrow').css({display: "block"});
                $(this).find('ul').css({display: "block"});
                }

                });
             });
             </script>
        </div>
        <!-- /.container -->

    </nav>
    <nav class="notifications">
    <?php if($user): ?>

      <div class="container" style="float:left;">
        <?php  echo $this->load->view("notifications_view","",true);?>
      </div>
    <?php endif; ?>
    </nav>

<!-- banner roku -->
<!-- <div style="margin:10px; float:left;" class="imgLogo"> -->

    <!-- <img style="margin:10px; float:left;" class="imgLogo" src="<?php echo base_url().'images/commerce/roku.png'; ?>"> -->
    <!-- </br> -->

    <!-- <div style="float:left;"> -->
        <?php // echo form_open(); ?>
        <!-- <div class="form-group" style="float:left; width:280px; "> -->
        <?php // echo form_label("Nombre:","",array(
                                    // "style"=>"float:left;
                                    //  color:white;
                                    //  font-size:18px;
                                    //  margin-left:13px;
                                    // cursor:default;
                                     // ")); ?>

        <?php // echo form_input("name","",array("style"=>"float:left;","placeholder"=>"Tu nombre") ); ?>
        <!-- </div>         -->

        <!-- <div class="form-group" style="float:left; width:650px; "> -->
        <?php // echo form_label("WhatsApp o Correo:","",array(
                                    // "style"=>"float:left;
                                    //  color:white;
                                    //  font-size:18px;
                                    //  margin-left:5px;
                                    // cursor:default;
                                     //")); ?>

        <?php // echo form_input("contact_info","",array("style"=>"float:left;","placeholder"=>"Tel. o Correo") ); ?>            
<!--         <button type="button" id="send_info" class="btn btn-primary btn-sm" style="margin-left:10px; margin-top:-2px;">Enviar</button>
        </div>  --> 


<!--         <div class="form-group success_msg" style="float:left; margin-left:500px; font-size:18px;">
            
        </div> -->        
        <?php // echo form_close(); ?>

    <!-- </div> -->
<!-- </div> -->

<script type="text/javascript">
/*
$("button#send_info").on("click",function(){
 var url="<?php echo base_url();?>";

    $.ajax({
        type: "POST",
        url: url+"home/sendInfo",
        async:true,
        dataType:"json",
        data:{
            name:$("input[name=name]").val(),
            contact_info:$("input[name=contact_info]").val(),
             }, 
        beforeSend:  function(response) {
// ajax
            $("input").prop("disabled",true);
            $("button").prop("disabled",true);
            $("div#ajax_loading").addClass("ajax_loading");
// ...                      
        },
        success: function(response){
// ajax
            $("input").prop("disabled",false);
            $("button").prop("disabled",false);
            $("div#ajax_loading").removeClass("ajax_loading");
// ...

        $("input[name=name]").val("");
        $("input[name=contact_info]").val("");

            if(response.status){
                $("div.success_msg").html("<div class='alert alert-success'> "+response.msg+"</div>");
                setTimeout(function () { 

                location.reload();
                },10000);
            }


        }

    });
});
*/
</script>
<!-- banner roku -->

<!-- categorias -->
<!-- <script type="text/javascript" src="../libs/jquery/jquery.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>/js/smartmenu/jquery.smartmenus.js"></script>
<script type="text/javascript">
    $(function() {
        $('#main-menu').smartmenus({
            subMenusSubOffsetX: 1,
            subMenusSubOffsetY: -8
        });
    });
</script>

<link href="<?php echo base_url(); ?>css/smartmenu/sm-core-css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/smartmenu/sm-blue/sm-blue.css" rel="stylesheet" type="text/css" />
<!-- YOU DO NOT NEED THIS - demo page content styles -->
<!-- <link href="../libs/demo-assets/demo.css" rel="stylesheet" type="text/css" /> -->


<div class="container-fluid" >
    <div class="row">

<nav id="main-nav" role="navigation">
<?php echo (!empty($css_menu_category)?$css_menu_category:""); ?>
</nav>        

<?php if(!empty($breadcrumbs)){ ?>
<div class="col-lg-12 col-sm-12 col-md-12">

    <section id="breadcrumb" class="clearfix">
    <div class="container">
      <div class="row">
      <div class="breadcrumb clearfix"> 
            <a class="home" href="<?php echo base_url(); ?>" title="Return to Home">
              <i class="icon-home"></i>
            </a>         
        <?php  
$lastElement = end($breadcrumbs);
// pr($lastElement);     
foreach ($breadcrumbs as $k => $value) {
        ?>
            <?php if($value["parent_id"]!= $lastElement["parent_id"]){ ?>
            <span class="navigation-pipe">&gt;</span> 
            <a href="<?php echo base_url().'product/category/'.$value['parent_id']; ?>" title="<?php echo (!empty($value["name"])?$value["name"]:""); ?>">
              <?php echo (!empty($value["name"])?$value["name"]:""); ?>
            </a>
            <?php } else{ ?>
            <span class="navigation-pipe">&gt;</span>
                <a href="javascript:void(0);">
                <?php echo (!empty($value["name"])?$value["name"]:""); ?>
                </a>
            <?php } ?>
<?php } ?>

      </div>

      </div>
    </div> 
    </section>

</div>
<?php } ?>
<!-- <nav id="main-nav" role="navigation"> -->
<!--   <ul id="main-menu" class="sm sm-blue">
    <li><a href="http://www.smartmenus.org/">Home</a></li>
    <li><a href="http://www.smartmenus.org/about/">About</a>
      <ul>
        <li><a href="http://www.smartmenus.org/about/introduction-to-smartmenus-jquery/">Introduction to SmartMenus jQuery</a></li>
        <li><a href="http://www.smartmenus.org/about/themes/">Demos + themes</a></li>
        <li><a href="http://vadikom.com/about/#vasil-dinkov">The author</a></li>
        <li><a href="http://www.smartmenus.org/about/vadikom/">The company</a>
          <ul>
            <li><a href="http://vadikom.com/about/">About Vadikom</a></li>
            <li><a href="http://vadikom.com/projects/">Projects</a></li>
            <li><a href="http://vadikom.com/services/">Services</a></li>
            <li><a href="http://www.smartmenus.org/about/vadikom/privacy-policy/">Privacy policy</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="http://www.smartmenus.org/download/">Download</a></li>
    <li><a href="http://www.smartmenus.org/support/">Support</a>
      <ul>
        <li><a href="http://www.smartmenus.org/support/premium-support/">Premium support</a></li>
        <li><a href="http://www.smartmenus.org/support/forums/">Forums</a></li>
      </ul>
    </li>
    <li><a href="http://www.smartmenus.org/docs/">Docs</a></li>
    <li><a href="#">Sub test</a>
      <ul>
        <li><a href="#">Dummy item</a></li>
        <li><a href="#">Dummy item</a></li>
        <li><a href="#" class="disabled">Disabled menu item</a></li>
        <li><a href="#">Dummy item</a></li>
        <li><a href="#">more...</a>
          <ul>
            <li><a href="#">A pretty long text to test the default subMenusMaxWidth:20em setting for the sub menus</a></li>
            <li><a href="#">Dummy item</a></li>
            <li><a href="#">more...</a>
              <ul>
                <li><a href="#">Dummy item</a></li>
                <li><a href="#" class="current">A 'current' class item</a></li>
                <li><a href="#">Dummy item</a></li>
                <li><a href="#">more...</a>
                  <ul>
                    <li><a href="#">subMenusMinWidth</a></li>
                    <li><a href="#">10em</a></li>
                    <li><a href="#">forced.</a></li>
                  </ul>
                </li>
                <li><a href="#">Dummy item</a></li>
                <li><a href="#">Dummy item</a></li>
              </ul>
            </li>
            <li><a href="#">Dummy item</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="#">Mega menu</a>
      <ul class="mega-menu">
        <li>
          <div style="width:400px;max-width:100%;">
            <div style="padding:5px 24px;">
              <p>This is a mega drop down test. Just set the "mega-menu" class to the parent UL element to inform the SmartMenus script. It can contain <strong>any HTML</strong>.</p>
              <p>Just style the contents as you like (you may need to reset some SmartMenus inherited styles - e.g. for lists, links, etc.)</p>
            </div>
          </div>
        </li>
      </ul>
    </li>
  </ul>
</nav> -->

        
    </div>
</div>

<!-- menu -->
  

     <!-- Page Content -->
    <div class="container-fluid" >
        <div id="ajax_loading"></div>
    <div class="row">
    <!-- <div style="margin-top:50px;"></div> -->