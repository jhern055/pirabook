<?php //$this->load->library('CI_Bcrypt');  echo$passwordHash = $this->ci_bcrypt->hash_password("1"); ?>
<?php echo $keditor_js; ?>
<?php echo $css_social_locker; ?>             
<?php 
$id_implode=(!empty($id)?implode("/",str_split($id)):"");

    if(is_array($publication[$id]))
    foreach ($publication[$id] as $key => $value){
        $$key=$value;
    }
 ?>

<?php 
// echo str_rot13(str_replace(" ", "_", "office 2007 profesional"));
// echo "</br>";
// echo str_rot13("bssvpr_2007_cebsrfvbany");
// $this->load->library("bcrypt");
// echo $this->ci_bcrypt->hash_password("*.S0p0rt3*.");

 ?>
 <!-- <script src='<?php echo base_url(); ?>js/jqueryLivePreview/jquery-live-preview.js' ></script>
  -->

<!-- <link href="<?php echo base_url(); ?>css/livepreview/livepreview.css" rel="stylesheet" type="text/css"> -->

    <script>
        // $(document).ready(function() {
        //     $('a').livePreview();
        // });
    </script>

    <link href="<?php echo base_url(); ?>css/full-slider.css" rel="stylesheet">
    <?php if( !empty($publication) ):?>
    <?php foreach ($publication as $key => $value) { ?>

    <!-- Blog Post -->
    <div class="col-sm-9 col-md-9 col-lg-9" id="containerPublication">

    <!-- fondo del post y descripcion -->
    <div class="containerPost">

    <div id="dateblock">
    <div id="month"><?php echo $value["month"]?:"&nbsp;"; ?></div>
    <div id="day"><?php echo $value["day"]?:"&nbsp;"; ?></div>
    <div id="year"><?php echo $value["year"]?:"&nbsp;"; ?></div>
    </div>
    <div id="postheader">

    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3 buttonsAdminPost">
    <?php 
    
    $data_modify = array('name'=>'modify','id'=>'modify','value'=>'true','content'=>'Modificar',"class"=>'btn btn-warning btn-xs');
    $data_password = array('name'=>'password','id'=>'password','value'=>'','type'=>'password','placeholder'=>'Constraseña','class'=>'form-control');
    $data_erase = array('name'=>'erase','id'=>'erase','value'=>'true','content'=>'Borrar :(',"class"=>'btn btn-danger btn-xs');
    ?>
        <div class="form-group buttonModifyDiv">
        <?php echo form_button($data_modify); ?>
        </div>
        <div class="form-group passwordModifyDiv">
        <div class="minimize"></div>
    <?php   echo form_password($data_password);     ?>
        </div>
        <div class="form-group buttonErase">
    <?php   echo form_button($data_erase); ?>
        </div>

    </div>

    <div class="col-sm-5 col-md-5 col-lg-5">
        <h1><a href="javascript:void(0)" rel="bookmark"><?php echo $value["title"]?:"&nbsp;"; ?></a> </h1>
        <div id="postdetails">
            Categoría: <a href="<?php echo base_url(); ?>category/<?php echo $value["category"]; ?>" title="Ver todas las entradas en <?php echo $value["category_name"]?:"&nbsp;"; ?>" rel="category tag"><?php echo $value["category_name"]?:"&nbsp;"; ?></a> por <a href="javascript:void(0)"><?php echo $value["nickname"]?:"&nbsp;"; ?></a>     
        </div>
    </div>


    </div> <!-- postheader -->

        <hr>
    <!--  -->
    <div class="col-sm-10 col-md-10 col-lg-10">

<?php if(!empty($value["pictures"])): ?>    
<!-- style="witdh:436px; height:600px;" -->
<div id="carousel-example-generic" class="carousel" style="witdh:436px; height:600px;" >

    <!-- poner los puntitos indicadores de la fotos -->
    <ol class="carousel-indicators">
    <?php $c=0; ?>
    <?php foreach ($value["pictures"] as $key_two => $value_two): ?>
    <?php $c++; ?>
    <?php if($value["registred_on"]<="2017-02-04 23:59:59"): ?>
    <?php $path_img=FCPATH."images/uploads/imgPost/".$value_two["filename"]; ?>
    <?php else: ?>
    <?php $path_img=FCPATH."img/".$id_implode."/".$value_two["filename"]; ?>
    <?php endif; ?>
        <?php if(file_exists($path_img)): ?>
        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $c; ?>" class="<?php echo(($c==1)?"active":""); ?>"></li>
        <?php endif; ?>

    <?php endforeach; ?>
    </ol>

    <!-- cargar las imagenes y poner en activa la  primera -->
    <div class="carousel-inner">
    <?php $c=0; $d=0; ?>
    <?php foreach ($value["pictures"] as $key_two => $value_two): ?>
    <?php $c++; $d++; ?>
        <?php if($value["registred_on"]<="2017-02-04 23:59:59"): ?>
        <?php $path_img=FCPATH."images/uploads/imgPost/".$value_two["filename"]; ?>
        <?php else: ?>
        <?php $path_img=FCPATH."img/".$id_implode."/".$value_two["filename"]; ?>
        <?php endif; ?>

        
        <?php if(file_exists($path_img)): ?>
        <div id="<?php echo $c; ?>" class="item <?php echo (($c==1)?"active":""); ?>">
            <?php if($value["registred_on"]<="2017-02-04 23:59:59"): ?>
            <img class="slide-image" src="<?php echo base_url()."images/uploads/imgPost/".$value_two['filename']; ?>" alt="">
            <?php else: ?>
            <img style="width:800px; height:600px;" class="slide-image" src="<?php echo base_url()."img/".$id_implode."/".$value_two['filename']; ?>" alt="">
            <?php endif; ?>
        </div>
        <?php endif; ?>

    <?php endforeach; ?>
    </div>

    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
<?php endif; ?>

    </div>

    <hr>
<fieldset>
<legend><span style="font-family:trebuchet ms;">Descripción</span><br>
</legend>
<div>   <?php echo $value["description"]?:"&nbsp;"; ?> </div>

<!-- Boton de Donar -->
<?php if( empty($is_sale)){ ?>

<h1 class="title_paypal" style="text-shadow: -1px 0px 6px rgba(59, 255, 255, 0.7);">Quieres ver los links sin publicidad?</h1>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

    <!-- <input type="hidden" name="business" value="9ZAS7FG8KFP8C"> -->

    <!-- Identify your business so that you can collect the payments. -->
    <input type="hidden" name="business" value="pirabook@hotmail.com">

    <!-- Specify a Donate button. -->
    <input type="hidden" name="cmd" value="_donations">

    <!-- Specify details about the contribution -->
    <input type="hidden" name="item_name" value="<?php echo $value["title"]?:"Pirabook";?>">
    <input type="hidden" name="item_number" value="ver_sin_publicidad_<?php echo $value["id"]?base64_encode($value["id"]):"";?>">

    <input type="hidden" name="amount" value="<?php echo !empty($value["price"])?$value["price"]:"1";?>">
    <input type="hidden" name="currency_code" value="USD">

    <!-- Display the payment button. -->
    <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif"alt="PayPal - The safer, easier way to pay online">
    <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
</form>
<?php } ?>
<!-- / Boton de Donar -->

<!-- prueba paypal button -->
<!-- <formq action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> -->

<!-- Identify your business so that you can collect the payments. -->
<!-- <input type="hidden" name="business" value="pirabook1-facilitator@gmail.com"> -->

<!-- Specify a Buy Now button. -->
<!-- <input type="hidden" name="cmd" value="_xclick"> -->

<!-- Specify details about the item that buyers will purchase. -->
<!-- <input type="hidden" name="item_name" value="Master de Rockola">
<input type="hidden" name="amount" value="5.95">
<input type="hidden" name="currency_code" value="USD">

<input type="hidden" name="return" value="<?php //base_url().'paypal/success'; ?>">
<input type="hidden" name="cancel_return" value="<?php //base_url().'paypal/cancel'; ?>">
 -->
<!-- Display the payment button. -->
<!-- <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"alt="PayPal - The safer, easier way to pay online">
<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form> -->
<!-- /paypal -->
</fieldset>
<!-- Precios -->
<?php if( !empty($is_sale)){ ?>
<fieldset>
    <legend><span style="font-family:trebuchet ms;">Precios</span><br> </legend>
</fieldset>
<?php } ?>
<?php if( !empty($is_sale)){ ?>
<fieldset>
    <legend><span style="font-family:trebuchet ms;">Acci&oacute;n</span><br> </legend>
<button type="button" id="addCart" data-idrecord="<?php echo encryptStringArray($id); ?>" class="btn btn-default">AÑADIR AL CARRITO</button>

</fieldset>
<?php } ?>
<!-- Si es venta no mostrar los links -->
<?php if( empty($is_sale)){ ?>
<?php if(!empty($value["hosting_servers"])){ ?>
<fieldset>
<legend><span style="font-family:trebuchet ms;">Links</span><br></legend>

<!-- este script se usa para el tab -->
  <script>
  $(function() {
    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );

    // MOVER LOS TABS CON SOLO PASAR EL MOUSE
    // $( "#tabs" ).tabs({
    //   event: "mouseover"
    // });
  });
  </script>
<!-- contar cuantos links y bloquear y solo mostrar algunos o uno o ninguno -->
<!-- Muestra los primeros links -->
<?php $attributes="target='_blank'"; ?>
<?php $count_link_amount=0; ?>
 <?php if($value["hosting_servers"] and empty($is_sale)):
    foreach ($value["hosting_servers"] as $key_host => $value_host) {
        foreach ($value_host["hosting_servers_array"] as $key_host_two => $value_host_two) {
        $count_link=0;

            foreach ($value_host_two["table_link_id"] as $key_table_link_id => $value_table_link_id)
            $count_link_amount++;
                
            foreach ($value_host_two["table_link_id"] as $key_table_link_id => $value_table_link_id) {
            $count_link++;
            if($count_link<=1 and $count_link_amount>2 and count($value_host_two["table_link_id"]) >1):
        echo "<b>";
        echo "Descripción:<font color='blue'>".($value_host_two["description"]?:"")."</font>";
        echo "</b>";
                
                unset($value_host_two["table_link_id"][$key_table_link_id]);?>
    
            <table class="table table-striped">
            <thead>
            <tr> 
                <th>#</th> 
                <th>Link</th> 
                <th> &nbsp;</th> 
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                <?php  echo $value_table_link_id["link"]?anchor($value_table_link_id["link"], $value_table_link_id["link"], $attributes):""; ?>
                </td>
                <td class="link_description">
                <?php  echo $value_table_link_id["description"]?ucwords($value_table_link_id["description"]) :""; ?>
                </td>
            </tr>
            </tbody>
            </table>
            <?php
            endif;
            }
        }
    }

        endif ?> 

<!-- lock-my-div -->
<div id="<?php echo ( ($count_link_amount and $like_sure)? 'lock-my-div':""); ?>">
<!-- <div id=""> -->
<div id="tabs">
  <ul>

    <?php foreach ($value["hosting_servers"] as $key_host => $value_host) { ?>
    <li>
        <a href="#tabs-<?php echo $key_host; ?>">
         <img src="<?php echo base_url()."images/interface/hostingServers/".$value_host['logo']; ?>"> 
         <?php echo $value_host["hosting_servers_name"] ?>
        </a>
    </li>
    <?php } ?>

  </ul>

    <?php foreach ($value["hosting_servers"] as $key_host => $value_host) { ?>

    <div id="tabs-<?php echo $key_host; ?>">
    
    <?php foreach ($value_host["hosting_servers_array"] as $key_host_two => $value_host_two) { ?>

<hr>
<!-- <div style="width:500px; height:500px;">&nbsp;</div> -->
</br>
    <?php //pr(rights_validation($value_host_two["rights_universal"],"link")); ?>
    <?php if(!empty($value_host_two["rights_universal"]) and rights_validation($value_host_two["rights_universal"],"link")==false): ?>
        <?php
        $login["redirect"]=current_url();
         echo $this->load->view("login_view",$login,true); ?>
        
        <div class="alert alert-warning">
            <?php echo  "Requisitos para ver links ".(!$user_id?"</br> tener una cuenta":""); $permission_text="";?>
            <?php foreach (explode(",", $value_host_two["rights_universal"]) as $key => $value) {

                if(in_array($value, $sys["config"]["permission_to_view"]))
                $permission_text.=$value.",";
            } 
            if($permission_text)
            echo " </br>tener persmisos ".$permission_text;
            ?>
        </div>
        <?php echo $value_host_two["description"]?:""; ?>
       
        <?php else: ?>
       
        <?php if(!empty($value_host_two["table_link_id"])){ ?>    
                
            <?php $c=1; ?>
        Descripción:<?php echo $value_host_two["description"]?:""; ?>

            <table class="table table-striped">
            <thead>
            <tr> 
                <th>#</th> 
                <th>Link</th> 
            </tr>
            </thead>
            <tbody>

    <?php if(isset($count_link_amount) and $count_link_amount>2 and count($value_host_two["table_link_id"]) >1): ?>             
    <?php array_shift($value_host_two["table_link_id"]); ?>
    <?php endif; ?>
            <?php foreach ($value_host_two["table_link_id"] as $key_table_link_id => $value_table_link_id) { ?>

            <?php $attributes="target='_blank'"; ?>
            <tr>
                <td class="link_description">
                <?php  echo $value_table_link_id["description"]?ucwords($value_table_link_id["description"]) :""; ?>
                </td>

                <td>
                <?php  echo $value_table_link_id["link"]?anchor($value_table_link_id["link"], $value_table_link_id["link"], $attributes):""; ?>
                </td>

            </tr>
         
            <?php } ?>
            </tbody>
            </table>

        <?php } ?> <!--  fin del foreach -->
        
        <?php endif; ?>
        
        <?php } ?>

        <!-- social locker 
        <div id="lock-my-div" style="display: none;">
            <p>
            </p>
        </div> -->



    </div>

    <?php } ?>

</div>
</div>
</fieldset>
<?php } ?>

<?php } ?> <!--  if( empty($is_sale)){ -->


    </div> <!-- fin contenido del post-->
    <!-- Blog Comments -->
    <div id="edit_post_management_html"></div>
   
    <div class="col-sm-6 col-md-6 col-lg-5" >

    <div class="cont-social">
    <?php //echo $this->load->view("cont_social_view",$publication,true); ?>
    </div>
    
    </div>

  <script>
  $(function() {

    $( "#tabs2" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs2 li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );

  });;
  </script>
<!-- -->

<div class="col-xs-13 col-sm-10 col-md-10 col-lg-10">

<div id="tabs2">
  <ul>

    <li><a href="#tabs2-1">Comentarios<em><?php echo (!empty($value["comments_amount"])?$value["comments_amount"]:""); ?></em></a></li>
    <li><a href="#tabs2-2">Comentarios por facebook <div class="tabFace"></div></a></li>

  </ul>
  <div id="tabs2-1">     <!-- comentarios del servidor -->
   
    <!-- Comments Form -->
    <div id="commentsForm">
    <?php  echo $this->load->view('comments_form','', true)?>
    </div>
    
    <!-- Posted Comments -->

    <div id="postedComments">
    <?php  echo$this->load->view('posted_comments',$publication, true)?>
    </div>

  </div>
    <?php if(!empty($value["url_facebook"])): ?>
  <div id="tabs2-2">
    <div class="fb-comments" data-href="<?php echo $value["url_facebook"]; ?>   " data-numposts="30" data-colorscheme="light"></div>
  </div>
    <?php endif; ?>

</div>

</div>

        <hr>

    </div>
    <?php } ?>
    <?php endif; ?>

<script>
var url="<?php echo base_url(); ?>";
$("div#postedComments > div.media > div.media-body > div.responseComment > div.responseCommentToggle").hide();

// $("div#postedComments > div.media > div.media-body > div.responseComment > a").click(function() {
$(document).ready(function(){

$(document).on("click","div#postedComments > div.media > div.media-body > div.responseComment > a",function() {

    $(this).parent().find("div.responseCommentToggle").toggle("", function() {
     
    var  responseCommentToggleDir=$(this),
        url="<?php echo base_url(); ?>"
        publication_id="<?php echo $publication[$this->uri->segment(3)]['id']; ?>"
        commentToResponse=$(responseCommentToggleDir).parent().parent().find('div.commentId').text()
        ;

    $.ajax({
        url: url+'comment/comment_html',
        type: 'POST',
        dataType: 'json',
        data: {publication_id: publication_id,commentToResponse:commentToResponse},
        beforeSend: function(response){
        },
        success: function(response){
        $(responseCommentToggleDir).find("div.data").append(response.data);

        }
    });
    return false;

    });

});

});    

</script>

<script>
// comentario ajax
$(document).on("click", "form.Form1 > button#submit", function() {

    var  process=new Object();

    process.visualEffect=$("div#commentsForm > div.well").get(0);
    process.elementsDisabledByDefault=$("form.Form1 :input:disabled").get();

var name=$(this).parent().find("input#name").val(),
    email=$(this).parent().find("input#email").val(),
    comment=$(this).parent().find("textarea#comment").val(),
    publication_id=$(this).parent().find("input[name$='publication_id']").val(),
    commentToResponse=$(this).parent().find("input[name$='commentToResponse']").val()
    captcha=$(this).parent().find("input[name$='captcha']").val()
    ;

// campos que sirven para editar un comentario 
var type=$(this).parent().find("input[name$='type']").val(),
    id_com_resp=$(this).parent().find("input[name$='id_com_resp']").val()
    ;

    $.ajax({

    type: "POST",
    url: "<?php echo base_url().'home/publication/'; ?>",
    // data: data,
    data: {
        name:name,
        email:email,
        comment:comment,
        publication_id:publication_id,
        commentToResponse:commentToResponse,
        type:type,
        id_com_resp:id_com_resp,

        captcha:captcha
    },
    async:true,
    dataType: "json",
    beforeSend:function(data){
    $(process.visualEffect).css("opacity",0.5);
    $(process.visualEffect).addClass("imgAjax imgAjaxLoading3 imgAjaxCenterCenterPosition");
    $("form.Form1 :input").not(process.elementsDisabledByDefault).prop("disabled","disabled");

    },
    success: function(data){

    if(data.status==0){

    $("#validation > p").text("");
    $("#validation > p").text(data.msg);
    $("#validation").dialog("open");
    
    }
    
    if(data.status==1){
    $(".Form1").get(0).reset();
    $("div#postedComments").html(data.data);
    $("div#postedComments > div.media > div.media-body > div.responseComment > div.responseCommentToggle").hide();

    // alert(data.msg);
    }
    $(process.visualEffect).css("opacity",1);
    $(process.visualEffect).removeClass("imgAjax imgAjaxLoading3 imgAjaxCenterCenterPosition");
    $("form.Form1 :input").not(process.elementsDisabledByDefault).prop("disabled","");
    $("form.Form1 > button#submit").focus();

    },

    });
    return false;

});

</script>

<!-- mostrar mas comentarios-->
<script>
    $(document).on("click",'div.more_comments',function() {
    var c=0;
    $("div#postedComments > div.media").each(function(){
    c++;
    });
    var container=$(this).parent().parent();

    var last_msg_id = c,
        url="<?php echo base_url().'home/showMoreComments';?>",
        id_publication="<?php echo $this->uri->segment(3); ?>";
            
            $.ajax({
                type: "GET",
                url: url,
                async:true,
                dataType:"json",
                data: {"lastmsg": last_msg_id,"id_publication":id_publication}, 
                beforeSend:  function(html) {

                $('a.load_more').append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');

                },
                success: function(html){

                if(html.status==1){
                $(container).find("div#facebook_style").remove();

                $("#postedComments > div.media").remove();
                $("#postedComments").append(html.data);
                    
                }else{

                $(container).find("div.more_comments").remove();
                $("#dialog > p").text("");
                $("#dialog > p").text(html.msg);
                $("#dialog").dialog("open");

                }
                $('a.load_more > img.loading').remove();

                }
            });

    return false;


    });

</script>

<!-- mostrar mas respondidos comentarios-->
<script>
    $(document).on("click",'div.nestedComment > div.more_comments_response',function() {
    var c=0;
    $(this).parent().parent().parent().find("div.nestedComment").find("div.media").each(function(){
    c++;
    });

    var url="<?php echo base_url().'home/showMoreCommentsResponse';?>",
        id_publication="<?php echo $this->uri->segment(3); ?>",
        id_comment=$(this).parent().parent().parent().find("div.commentId").text()
        ;

         var container=$(this).parent().parent().parent().find("div.nestedComment");
            
            $.ajax({

                type: "GET",
                url: url,
                async:true,
                dataType:"json",
                data: {"lastmsg": c,"id_publication":id_publication,"id_comment":id_comment}, 
                beforeSend:  function(html) {
                $('a.load_more').append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');

                },
                success: function(html){

                if(html.status==1){
                $(container).find("div#facebook_style").remove();
                $(container).find("div.media").remove();
                $(container).append(html.data);
                    
                }else{

                $(container).find("div#facebook_style").remove();
                $("#dialog > p").text("");
                $("#dialog > p").text(html.msg);
                $("#dialog").dialog("open");

                }
                $('a.load_more > img.loading').remove();

                }
            });

    return false;


    });

</script>

<script>

    $(document).ready(function() {
        $('.carousel').carousel({
            interval: 2000,
            // cycle: true
        });
    });
</script>

<script>

    container=new Object();
    container.passwd="div.passwordModifyDiv"; 
    container.modify=false; 
    container.erase =false; 
    container.passwordBad =false; 

$(document).on("click","div.buttonModifyDiv > button#modify",function(){

    container.modify=true;
    container.erase=false;

    var url="<?php echo base_url(); ?>",
        id_publication="<?php echo $this->uri->segment(3); ?>",
        containerDiv=$(this).parent().parent(),
        passwordToModify=$(container.passwd).find("input#password").val()
        ;

// checar si puede editar sin necesidad del password
    var edit_true=$.ajax({
                    url: url+'post/check_password_function',
                    type: 'POST',
                    dataType: 'text',
                    data: {id_publication: id_publication,passwordToModify:passwordToModify,ajax:1},
                    async: false,
                    beforeSend:function(response){
                    }
                    }).responseText;

    edit_true=JSON.parse(edit_true);
    
    if(!edit_true.status){
    $(container.passwd).toggle("show");
    $(container.passwd).find("input#password").focus();

    if(!passwordToModify)
    return;
    }
// -...-

    $.ajax({
        url: url+'post/edit_post_management_html',
        type: 'POST',
        dataType: 'json',
        data: {id_publication: id_publication,passwordToModify:passwordToModify},
        beforeSend: function(response){
            
        $(containerDiv).append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');

        },
        success: function(response){

            if(response.status){
            $("div.containerPost").remove();
            $("div#edit_post_management_html").append(response.data);
                
            }else{

            $(container.passwd).addClass("borderRequired");
            if(!$(container.passwd).find("div.alert-danger").get(0))
            $(container.passwd).append(alert_danger("",response.msg));
            $(container.passwd).find("input#password").val("");
            $(container.passwd).toggle("show");

            }
            $(containerDiv).find('img.loading').remove();

        }
    });
    
 

});
 
$(document).ready(function() {

$(container.passwd).find("input#password").keypress(function(e){

// e.preventDefault();
// alert(e.which);
if(e.which == 13){
$(this).blur();

    if(container.modify)
    $(this).parent().parent().find("button#modify").focus().click();

    if(container.erase)
    $(this).parent().parent().find("button#erase").focus().click();
}
});

    $(document).on("click","div.passwordModifyDiv > div.minimize",function(){
         $(container.passwd).toggle("hide");
    });

});  
// boton borrar

$(document).on("click","div.buttonErase > button#erase",function(){

    container.modify=false;
    container.erase=true;

    $(container.passwd).toggle("show");
    $(container.passwd).find("input#password").focus();

    var url="<?php echo base_url(); ?>",
        id_publication="<?php echo $this->uri->segment(3); ?>",
        containerDiv=$(this).parent().parent()
        passwordToModify=$(container.passwd).find("input#password").val();
        ;

    if(!passwordToModify)
    return;

    $.ajax({
        url: url+'post/check_password_function',
        type: 'POST',
        dataType: 'json',
        data: {id_publication: id_publication,passwordToModify:passwordToModify,ajax:1},
        beforeSend: function(response){

        $(containerDiv).append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');

        },
        success: function(response){

           if(response.status){

                $("#dialog > p").text("");
                $("#dialog > p").text("Seguro que desea borrar esta publicación?");
                $("#dialog > p").dialog({
                resizable: false,
                modal: true,
                    buttons: {
                        "Borrar": function() {

                // mandar a borrar 
               $.ajax({
                url: url+'post/delete',
                type: 'POST',
                dataType: 'json',
                data: {id_publication: id_publication,passwordToModify:passwordToModify},
                beforeSend: function(response){

                $(containerDiv).append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');

                },                
                success: function(response){

                    if(response.status){

                    $("#dialog > p").text("");
                    $("#dialog > p").text(response.msg);
                    $("#dialog > p").dialog({
                        modal: true,
                        focus: true,
                        buttons: {
                            Ok: function() {
                            $( this ).dialog( "close" );
                            $(containerDiv).find('img.loading').remove();

                            window.location.href=url;
                            }
                        }
                    });
                    $("#dialog").append("<p></p>");

                    }


                }

                });
                        $("#dialog").append("<p></p>");
                        $(this).dialog( "close" );

                        },
                        "No borrar": function() {

                        $("#dialog").append("<p></p>");
                        $(this).dialog( "close" );
                        }
                    }
                });
                
            }else{

            container.passwordBad =true; 
            $(container.passwd).addClass("borderRequired");
            if(!$(container.passwd).find("div.alert-danger").get(0))
            $(container.passwd).append(alert_danger("",response.msg));
            $(container.passwd).find("input#password").val("");
            $(container.passwd).toggle("show");

            }
            $(containerDiv).find('img.loading').remove();

        }
    });

    
});

function alert_danger(field,msg){
var error_html='<div class="alert alert-danger">'
                +'<a class="close" data-dismiss="alert" href="#">&times;</a>'
                +' <a href="javascript:void(0)" class="alert-link">'+field+'</a> '
                +'<p>'+msg+'.</p>'
                +'</div>'
                ;
    return error_html;
}
</script>

<script>
<?php if($this->session->userdata('id_publication') == $this->uri->segment(3) and $this->session->userdata('modify')==true): ?>

$(document).ready(function(){

    var url="<?php echo base_url(); ?>",
    id_publication="<?php echo $this->uri->segment(3); ?>";
    
    $.ajax({

        url: url+'post/edit_post_management_html',
        type: 'POST',
        dataType: 'json',
        data: {id_publication: id_publication},
        beforeSend: function(response) {

        $("div.containerPost").append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');

        },
        success: function(response) {

        if(response.status){
        $("div.containerPost").remove();
        $("div#edit_post_management_html").append(response.data);
        $("div.containerPost").find('img.loading').remove();
        }


        }

     });

});
<?php endif; ?>
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>css/assets/js/shareIt.js"></script>
<link href="<?php echo base_url(); ?>css/assets/css/shareIt.css" rel="stylesheet"/>

<script>
var options = {
        title: "Para ver los demás links ", //Heading of Content Locker
        text: 'Por favor apoyenos, dando clic en alguno de los botónes. (usa firefox si no lo desbloquea)', //Subheading of Content Locker
        facebook:{
            url: "http://www.pirabook.com/",  //Your Content Page Url
            pageId: "https://www.facebook.com/pages/Pirabook/1650210071872986",  //Your Facebook Page Url
            appId: "796252563762722"  //Your Facebook App ID
        },
        twitter:{
            title: "Tweet", 
            via: 'PirabookWeb', //Twitter Username
            // url: window.location.href,
            url: "http://www.pirabook.com/", //tweet link
            text: "Musica, Karaokes, Peliculas, Videos" // tweet text
            // text: document.title
                // tweet: {
                //     via: 'PirabookWeb', //Twitter Username
                //     title: "Tweet", 
                //     text: "Musica, Karaokes, Peliculas, Videos", // tweet text
                //     url: "http://www.pirabook.com/" //tweet link
                // },
                // follow: {
                //     title: "Follow us", 
                //     url: "https://twitter.com/PirabookWeb" // Twitter profile to follow 
                // }

        },
        googleplus:{
            // apikey: 'AIzaSyD_H_TgxVsG0jMy6dMTKjkhHilxIk_bQBk', //Google App API key
            // url: window.location.href,
                url: "http://www.pirabook.com/" // Google plus link for +1
            // plus: {
                // title: "Plus +1",
                // url: "http://www.pirabook.com/" // Google plus link for +1
            // }
        },
        linkedIn:{
            url: "http://www.pirabook.com/",      // LinkedIn url to share 
                share: {
                    title: "Share"
                }
        },
        buttons:["facebook_share","facebook_like","googleplus","linkedin"]
        // buttons:["facebook_share","facebook_like","twitter_tweet","twitter_follow","googleplus","linkedin"]
    };

$("#lock-my-div").shareIt(options);

// jQuery.noConflict();                    
//     jQuery(document).ready(function () {

//         jQuery("#lock-my-div").sociallocker({

//             text: {
//                 header: "Para ver los demás links (usa firefox si no lo desbloquea)", // replace content with this heading
//                 message: "Por favor apoyenos, haga clic en alguno de los botónes de abajo para desbloquear el contenido." // hidden content message
//             },
 
//             theme: "secrets", // Theme
 
//             locker: {
//                 close: false,
//                 timer: 0
//             },
 
//             buttons: {   // Buttons you want to show on box
//                 order: ["facebook-like", "twitter-tweet", "twitter-follow", "google-plus", "linkedin-share"] 
//             },
 
//             facebook: {  
//                 // appId: "796252563762722",    
//                 like: {
//                     title: "Like us",
//                     url: "https://www.facebook.com/pages/Pirabook/1650210071872986" // link to like in Facebook button
//                 }
//             },
 
//             twitter: {
//                 tweet: {
//                     title: "Tweet", 
//                     text: "Musica, Karaokes, Peliculas, Videos", // tweet text
//                     url: "http://www.pirabook.com/" //tweet link
//                 },
//                 follow: {
//                     title: "Follow us", 
//                     url: "https://twitter.com/PirabookWeb" // Twitter profile to follow 
//                 }
//             },
 
//             google: {                                
//                 plus: {
//                     title: "Plus +1",
//                     url: "http://www.pirabook.com/" // Google plus link for +1
//                 }
//             },
 
//             linkedin: {
//                 url: "http://www.pirabook.com/",      // LinkedIn url to share 
//                 share: {
//                     title: "Share"
//                 }
//             }
//         });
//     });
          
    </script> 

    <!-- LIKE DEL PUBLICACION -->
<script>

$(document).on("click","div.conteiner_likes > div.like",function() {

    var url="<?php echo base_url(); ?>",
    id_publication="<?php echo $this->uri->segment(3); ?>",
    this_it=$(this).get(0)
    type=$(this).parent().attr('id');

var id_comm=$(this).parent().data('idcomment');

    $.ajax({

        url: url+'like/in',
        type: 'POST',
        dataType: 'json',
        data: {id_publication: id_publication,id_comm:id_comm,type:type},
        beforeSend: function(response) {

        },
        success: function(response) {

        $(this_it).find("span.Likes").text('');
        $(this_it).find("span.Likes").text("("+response.data.likes+")");
        
        $(this_it).parent().parent().find("div.Nolike > span.NoLikes").text('');
        $(this_it).parent().parent().find("div.Nolike > span.NoLikes").text("("+response.data.Nolikes+")");

        $(this_it).find("span.Likes").get(0).focus();

        }

     });

});

// no like
$(document).on("click","div.conteiner_likes > div.Nolike",function() {

    var url="<?php echo base_url(); ?>",
    id_publication="<?php echo $this->uri->segment(3); ?>",
    type=$(this).parent().attr('id'),
    this_it=$(this).get(0)
    ;

var id_comm=$(this).parent().data('idcomment');

    $.ajax({

        url: url+'like/out',
        type: 'POST',
        dataType: 'json',
        data: {id_publication: id_publication,id_comm:id_comm,type:type},
        beforeSend: function(response) {

        },
        success: function(response) {

        $(this_it).parent().parent().find("div.like > span.Likes").text('');
        $(this_it).parent().parent().find("div.like > span.Likes").text("("+response.data.likes+")");

        $(this_it).find("span.NoLikes").text('');
        $(this_it).find("span.NoLikes").text("("+response.data.Nolikes+")");


        $(this_it).find("span.NoLikes").get(0).focus();

        }

     });

});

</script>

<script>

// <!-- edita  -->
$(document).on("click","div.edit_small",function(){

    var url="<?php echo base_url(); ?>",
    publication_id="<?php echo $this->uri->segment(3); ?>",
    type=$(this).parent().attr('class'),
    this_it=$(this).get(0)
    ;

// puede ser comentario o respuesta el id_comm
var id_comm=$(this).parent().data('idcomment');

    $.ajax({

        url: url+'comment/comment_html',
        type: 'POST',
        dataType: 'json',
        data: {publication_id: publication_id,id_comm:id_comm,type:type},
        beforeSend: function(response) {
        
        },
        success: function(response) {
            
        if(type=="comment"){
        $(this_it).parent().parent().parent().find("div.in_form_comment").text("");
        $(this_it).parent().parent().parent().find("div.in_form_comment").append(response.data);
        }
        else{
        $(this_it).parent().parent().parent().find("div.in_form_response").text("");
        $(this_it).parent().parent().parent().find("div.in_form_response").append(response.data);
        }
        // $(this_it).parent().parent().find("div.like > span.Likes").text('');
        // $(this_it).parent().parent().find("div.like > span.Likes").text("("+response.data.likes+")");

        // $(this_it).find("span.NoLikes").text('');
        // $(this_it).find("span.NoLikes").text("("+response.data.Nolikes+")");


        // $(this_it).find("span.NoLikes").get(0).focus();

        }

     });
});

// eliminar comentario o respuesta 
$(document).on("click","div.delete_small",function(){

    var url="<?php echo base_url(); ?>",
    publication_id="<?php echo $this->uri->segment(3); ?>",
    type=$(this).parent().attr('class'),
    this_it=$(this).get(0),
    this_it_txt=""
    ;

    if(type=="comment"){
        this_it_txt="comentario";
        $(this).parent().parent().parent().find("div.in_form_comment").addClass('delete_small_color');
    }
    else{
        this_it_txt="respuesta";
        $(this).parent().parent().parent().find("div.in_form_response").addClass('delete_small_color');
    }

// puede ser comentario o respuesta el id_comm
var id_comm=$(this).parent().data('idcomment');

    $("#dialog > p").text("");
    $("#dialog > p").text("Desea eliminar "+this_it_txt);
    $("#dialog > p").dialog({
    resizable: false,
    modal: true,
        buttons: {
            "Borrar": function() {
    // mandar a borrar comentario o respuesta

        $.ajax({

            url: url+'comment/delete',
            type: 'POST',
            dataType: 'json',
            data: {publication_id: publication_id,id_comm:id_comm,type:type},
            beforeSend: function(response) {
            },
            success: function(response) {
                
            if(type=="comment"){
            $(this_it).parent().parent().parent().find("div.in_form_comment").removeClass('delete_small_color');
            }
            else{
            $(this_it).parent().parent().parent().find("div.in_form_response").removeClass('delete_small_color');
            }

            $(this_it).parent().parent().parent().parent().remove();

            }

            });

            $("#dialog").append("<p></p>");
            $(this).dialog( "close" );

            },
            "No borrar": function() {

            $(this_it).parent().parent().parent().find("div.in_form_comment").removeClass('delete_small_color');

            $("#dialog").append("<p></p>");
            $(this).dialog( "close" );
            }
        }
    });


});
</script>

<!-- agregar al caro -->
<script>
$(document).on("click","button#addCart",function(){
    var idrecord=$(this).data("idrecord"),
        price="<?php echo encryptStringArray($price);?>"
        ;

    $.ajax({
            url: url+'cart/addToCart',
            type: 'POST',
            dataType: 'json',
            data: {
                idrecord: idrecord,
                qty: "1",
                price:price,
            },
            beforeSend: function(response) {
            },
            success: function(response) {
                $("span#textDetailCart").html(response.textDetailCart);
                window.location.href="<?php echo base_url(); ?>cart";
            }
    });
});

</script>
