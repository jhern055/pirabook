<?php echo $keditor_js; ?>

<!-- esto es para hacer lo de subir imagenes IMGUPLOAD -->
<?php //echo $upload_site; ?>
<?php //echo $upload_ajaxfileupload; ?>

<?php echo $jquery_fileupload; ?>
<?php echo $jquery_fileupload_ui; ?>

<?php echo $stylesheet_fileupload; ?>
<?php echo $stylesheet_fileupload_ui; ?>

<?php if(!empty($data_publication)): ?>
<?php $submit="Modificar"; ?>
<?php else: ?>
<?php $submit="Crear"; ?>
<?php endif; ?>
<?php $button_submit='<div class="btn btn-success submit" tabindex="12">'.$submit.'</div>' ?>
<?php $button_not_submit='<div class="btn btn-danger not_submit" tabindex="12">No, '.$submit.'</div>' ?>
<?php if(!empty($data_publication)):?>
<?php foreach ($data_publication as $key => $value):?>
    <?php foreach ($value as $key_two => $value_two):?>
    <?php $$key_two=$value_two;?>
    <?php endforeach;?>
<?php endforeach;?>
<?php $id_publication=$id; ?>
<?php endif;?>

<!-- campos -->
<?php 

$data_title = array('name'=> 'title','id'=> 'title','title'=> 'titulo es requerido','placeholder'=> 'Escribe aquí el título del post','class'=> 'form-control','tabindex'=> 2);
(empty($title)? "": $data_title=array_merge($data_title,array("value"=> $title)) ); 

$data_description = array('name'=> 'description','id'=> 'description','class'=> 'form-control','rows'=> '3','tabindex'=> 3);
(empty($description)? "": $data_description=array_merge($data_description,array("value"=> $description)) ); 

// <!-- file //jQueryFileUpload 'id'       => 'userfile', 'id'       => 'userfile',-->
// $data_file = array('name'=> 'file','id'=> 'file', 'type'=> 'button','tabindex'=> 1,'class'=>'ui-button-text','multiple'=>true,);
$data_file_other = array('name'=> 'attachment','id'=> 'attachment', 'type'=> 'button','tabindex'=> 1,'class'=>'ui-button-text','multiple'=>true,);

$data_email = array('name'=> 'email','id'=> 'email','placeholder' =>'email','class'=> 'form-control','tabindex'=> 5);
(empty($email)? "":$data_email=array_merge($data_email,array("value"=> $email)) ); 

$data_password = array('name'=>'password','id'=>'password','title'=>'contraseña','placeholder'=>'password','class'=>'form-control','tabindex'=> 6,'value'=> "");

$data_url_facebook = array('name'=> 'url_facebook','id'=> 'url_facebook','placeholder' =>'url facebook','class'=> 'form-control','tabindex'=> 7);
(empty($url_facebook)? "":$data_url_facebook=array_merge($data_url_facebook,array("value"=> $url_facebook)) ); 

 ?>

<!--  ///.. -->
<div id="post">
<div class="col-sm-14 col-md-10 col-lg-10" >
<?php $this->load->helper('security'); ?>
    <div class="well">
    <span style="color:#F00 "><?php echo validation_errors(); ?></span>
        <!-- subir imagenes IMGUPLOAD -->
        <?php //$attributes_img = array("role"=>"form",'id'=>'form_file_upload',"name"=>'form_file_upload',"method"=>"POST","enctype"=>"multipart/form-data"); ?>
       
        <!-- jQueryFileUpload -->
        <?php //echo form_open(base_url().'file/upload/'.$this->uri->segment(3),$attributes_img); ?>   
        
<!--         <div class="form-group imagesDiv">
        <table id="files" align="center">
        <tr valign="baseline">
        <td colspan="2">
        </td>
        </tr>
        </table>    -->
        <!-- jQueryFileUpload editado para codeigniter -->
        <?php //echo form_open(base_url().'file/doUploadFile/'.$this->uri->segment(3),$attributes_img); ?>   
        <!-- <span class="btn btn-success fileinput-button"> -->
        <!-- <i class="glyphicon glyphicon-plus"></i> -->
        <!-- <span>Subir imagenes...</span> -->
        <?php //echo form_upload($data_file); ?>
        <!-- </span> -->

        <!-- </div> -->

        <?php //echo form_close(); ?>

        <!-- <div id="files"></div> -->

<!-- otro metodos  para subir archivos-->
        <div class="action_xml_up">

            <div class="xmlImport" title="Importar">
            
            <?php echo form_upload($data_file_other); ?>
            
            </div>
            <button type="submit" id="btn" style="display: none;">Upload Files!</button>
            <ul id="image-list">
<!--                 <li>
                <div class="img"> </div>
                <div class="delete"></div>
                <input type="hidden" class="fileName" value=""> -->
                <!-- <div class="preview"></div> -->
                <!-- </li>    -->
             </ul>
            <script>
(function () {
    var input = document.getElementById("attachment"), 
        formdata = false;

    function showUploadedItem (id,fileName) {
        var list = document.getElementById("image-list"),
            li   = document.createElement("li"),

            // div  = document.createElement("div");
            // div.className = "img";
            // li.appendChild(div);

        // img.src = source;
        
            div  = document.createElement("div");
            div.className = "imageDelete";
            div.setAttribute("data-file_id", id);
            li.appendChild(div);

        // preview
            // div  = document.createElement("div");
            // div.className = "preview";
            // li.appendChild(div);

        var imagen  = document.createElement("img");
        imagen.src = "<?php echo base_url();?>/images/uploads/imgPost/"+fileName;
        imagen.style = "width:200px; height:200px;";
        imagen.value = fileName;
        li.appendChild(imagen);

        // id
        var input  = document.createElement("input");
        input.type = "hidden";
        input.className = "id";
        input.value = id;
        li.appendChild(input);

        li.setAttribute("data-file_id", id);
        li.setAttribute("data-publication", $( "input[name='publication_id']" ).val());

        list.appendChild(li);
    }   

    if (window.FormData) {
        formdata = new FormData();
        document.getElementById("btn").style.display = "none";
    }
    
    input.addEventListener("change", function (evt) {

    formdata = false;
    formdata = new FormData();

        // document.getElementById("response").innerHTML = "Uploading . . ."
        var i = 0, len = this.files.length, img, reader, file;
    
        for (i = 0 ; i < len; i++ ) {
            file = this.files[i];
            // si quiero que sea imagen pongo image
            // if (!!file.type.match(/image.*/)) {
            // if (!!file.type.match(/text.xml/)) {
                if ( window.FileReader ) {
                    reader = new FileReader();
                    reader.onloadend = function (e) { 
                        // showUploadedItem(e.target.result, file.fileName);
                    };
                    reader.readAsDataURL(file);
                }
                if (formdata) {
                    formdata.append("attachment[]", file);
                }
            // }   
        }

        if (formdata) {
        var showContainer="div.action_excel_import > div.show_image";
        var id=$("form.dinamic > div.idContainer > div.area2 > input#id").val();

            $.ajax({
                url: "<?php echo base_url();?>file/doUploadFile",
                type: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend:function(res){
                    $(showContainer).addClass("ajax_loading");
                },
                success: function (res) {

                if(res.status){
                    for(k in res.multiple_array){
                    item=res.multiple_array[k];
                    showUploadedItem(item.file_id,item.file_name);
                        // attachedFiles.chargeData(item.id_reg,item.file_name); 
                    }
                }   

                }
            });
        }
        input.value="";
    }, false);
}());

            </script>

        </div>
<!--  -->
        <?php $attributes = array('role' => 'form','class'=>'Form3',"name"=>'Form3',"method"=>"POST"); ?>
        
        <?php if(empty($id)): ?>
        <?php $id=$this->uri->segment(3); ?>
        <?php endif; ?>

        <?php  $hidden = array("publication_id"=>encode_id($id) ); ?>

     	<?php echo form_open(base_url().'post/create_and_edit/'.$this->uri->segment(3),$attributes,$hidden); ?>   
		<div class="mandatory-fields-notice ">
		Todos los campos marcados con <span> son obligatorios</span>
        <?php if($this->session->userdata("user_id")==FALSE): ?>
        <div class="alert alert-info">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        Si no estas logueado necesitas especificar una contraseña para el post
        </div>
        <?php endif; ?>
		</div>

        <!-- boton crear o modificar -->
        <?php echo $button_submit; ?>

        <!-- boton no crear o modificar -->
        <?php echo $button_not_submit; ?>

        <div class="form-group titleDiv">
        <label for="title" class="required">Titulo</label>
        <?php echo form_input($data_title); ?>
        </div>

        <div class="form-group descriptionDiv" title="Descripción es requerido">
        <label for="description" class="required">Descripción</label>
        <?php echo form_textarea($data_description); ?>
        </div>

<!-- links -->
<?php if(!empty($hosting_servers) ){ ?>
<fieldset>
<legend><span style="font-family:trebuchet ms;">Links</span><br></legend>

<!-- este script se usa para el tab -->
  <script>
  $(function() {

    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );

  });
  </script>

<div id="tabs">
  <ul>

    <?php foreach ($hosting_servers as $key_host => $value_host) { ?>
    <li>
        <a href="#tabs-<?php echo $key_host; ?>">
         <img src="<?php echo base_url()."images/interface/hostingServers/".$value_host['logo']; ?>"> 
         <?php echo $value_host["hosting_servers_name"] ?>
        </a>
    </li>
    <?php } ?>

  </ul>

    <?php foreach ($hosting_servers as $key_host => $value_host) { ?>

    <div id="tabs-<?php echo $key_host; ?>" class="tabs">
    <?php foreach ($value_host["hosting_servers_array"] as $key_host_two => $value_host_two) { ?>

<?php 
$data_description = array('name'=> 'description_link','id'=> 'description_link','class'=> 'form-control','data-id_server_tab'=>"$key_host_two");
(empty($value_host_two["description"])? "": $data_description=array_merge($data_description,array("value"=> $value_host_two["description"])) ); 
 ?>
        <?php echo form_input($data_description); ?>

        <?php if(!empty($value_host_two["table_link_id"])){ ?>    
        <?php $c=1; ?>    

            <table class="table table-striped div<?php echo  $key_host_two; ?>">
            <thead>
            <tr> 
                <th>#</th> 
                <th>Link</th> 
            </tr>
            </thead>
            <tbody>
            <?php foreach ($value_host_two["table_link_id"] as $key_table_link_id => $value_table_link_id) { ?>
            <?php $data_link = array('name'=>'link','class'=>'form-control link','tabindex'=> 11,'value'=>$value_table_link_id["link"],"data-id_server"=>$key_host,"data-link_update_id"=>base64_encode($key_table_link_id));?>
            <?php $link_original = array('name'=>'link_original','class'=>'form-control link_original','tabindex'=> 11,'value'=>$value_table_link_id["link_original"],"data-id_server"=>$key_host,"data-link_update_id"=>base64_encode($key_table_link_id));?>
            <?php $data_description = array('name'=>'description','class'=>'form-control link_description','tabindex'=> 11,'value'=>$value_table_link_id["description"],"data-id_server"=>$key_host);?>
           
            <!-- eliminar link -->
            <?php $data_buttom = array('name'=> '','class'=> 'delete_link_button','value'=> 'true','type'=>'reset','data-file_id'=>base64_encode($key_table_link_id) ,'content'=> ''); ?>
            
            <tr>
            <td>
            <?php echo $c++; ?>
            </td>
            
            <!-- link -->
            <td>   
                <div class="form-group linkContainer">
                <?php echo "Link".form_input($data_link); ?>
                    </br>
                <?php echo "Descripción link ".form_input($data_description); ?>
                    </br>
                <?php echo "Link original".form_input($link_original); ?>



                </div>
            </td>
            <!-- Boton de eliminar link -->
            <td>   
            <?php echo form_button($data_buttom); ?>

            </td>
            
            <!-- link descripcion-->
 <!--            <td>   
            <div class="form-group descriptionContainer">
            <?php //echo form_input($data_description); ?>
            </div>
            </td> -->

            </tr>

            <?php } ?>
            <!-- links nuevos -->
            <tr>
            <td>
            <div class="datalinks"></div>
            </td>
            </tr>

            </tbody>
            </table>
        <?php } ?>

        <div class="btn btn-primary btn-sm addLink" data-id_server_tab="<?php echo  $key_host_two; ?>" tabindex="12">Agregar Link</div>
        </br>
        </br>
        <hr>
        <?php } ?>

    </div>

    <?php } ?>

</div>
</fieldset>
<?php } ?>
<!--  -->
    <!-- boton crear o modificar -->
    <?php echo $button_submit; ?>
    
    <!-- boton no modificar -->
    <?php echo $button_not_submit; ?>

    </div>
</div>

<div class="col-sm-6 col-md-6 col-lg-5" >
    <div class="well">

        <!-- nombres de las categorias -->
        <div class="form-group categoryDiv">
        <label for="category" class="required">Categoría</label>

        <?php $attributes = 'id="category" title="Categoria es requerida" tabindex="4" '; ?>

        <?php 
        if(!empty($category)):
        echo form_dropdown('category',$publications_categories_select,$category,$attributes);
        else:
        echo form_dropdown('category',$publications_categories_select,"",$attributes);
        endif;
        ?>
        </div>

        <div class="form-group subCategoryDiv">
        <label for="sub_category">Subcategoria</label>

        <?php $attributes = 'id="sub_category" tabindex="4" '; ?>

        <?php 
        if(!empty($sub_category)):
        echo form_dropdown('sub_category',$publications_sub_categories_select,$sub_category,$attributes);
        else:
        echo form_dropdown('sub_category',$publications_sub_categories_select,null,$attributes);
        endif;
        ?>
        </div>

        <?php if($this->session->userdata("user_id")==FALSE): ?>

        <!-- email -->
        <div class="form-group emailDiv">
        <div class="alert alert-danger">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
            <strong>¡Error!</strong> <a href="javascript:void(0)" class="alert-link">Email</a> no es correcto.
        </div>
        <label for="title">Email</label>
        <?php echo form_input($data_email); ?>
        <div class="alert alert-warning">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        Este serviria si se le pierde el password del anuncio
        </div>
        </div>

        <div class="form-group passwordDiv">
        <label for="title" class="required">Contraseña</label>

        <?php echo form_password($data_password); ?>
        <div class="alert alert-warning">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        Invente una contraseña para poder cambiar o borrar su anuncio. 
        </div>
        </div>
        <?php endif; ?>

        <!-- div URL de facebook publicacion -->
        <div class="form-group urlFacebookDiv">
        <label for="url_facebook"> Compartir</label>
        <span class="shareFacebook"></span>

        <?php echo form_input($data_url_facebook); ?>

        </div>

        <!-- links de descarga  -->
        <div class="addHostingServer">
            <div class="data"></div>
        <div class="btn btn-primary btn-sm addHostingServerLinks" tabindex="8">Agregar Servidor con Links</div>

        </div>
        <!--                                        -->

    </div>
</div>
    <?php echo form_close(); ?>
</div>
<!-- fin id="post" -->
<div class="containerPost"></div>

<!-- ajax crear post -->
<script>
$(".alert-danger").hide();
;
var validation=new Object(),
    TitleContainer="form.Form3 > div.form-group > input#title:eq(0)",
    descriptionContainer=CKEDITOR.instances.description,
    categoryContainer="select#category:eq(0)",
    subCategoryContainer="select#sub_category:eq(0)",
    emailContainer="div.well > div.emailDiv > input#email:eq(0)",
    passwordContainer="div.well > div.passwordDiv > input#password:eq(0)",
    urlFacebookDiv="div.well > div.urlFacebookDiv > input#url_facebook:eq(0)",

    hostingServerSelect="div.well > div.addHostingServer > div.data > div.server > div.form-group > select#hostingServers:eq(0)"
    ;

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

 <!-- boton para agregar mas links -->
<script>

$(document).on("click","div.addHostingServerLinks",function(){

    var url="<?php echo base_url().'post/hostingServersLinks'; ?>";

        $.ajax({    
            type:"GET",
            url:url,
            data:"",
            dataType:"json",
            beforeSend:function(data){     
            },
            success:function(data){

                if(data.status)
                $("div.addHostingServer > div.data").append(data.data);

            }

        });
});
</script>

 <script>

$(document).on("click",'form.Form3 > div.submit',function() {

    var title   =encodeURIComponent($(TitleContainer).val()),
    description =CKEDITOR.instances.description.getData(),
    // description =encodeURIComponent(CKEDITOR.instances.description.getData()),
    category    =encodeURIComponent($(categoryContainer).val()),
    sub_category    =encodeURIComponent($(subCategoryContainer).val()),

    email       =encodeURIComponent($(emailContainer).val()),
    password    =encodeURIComponent($(passwordContainer).val()),
    url_facebook=encodeURIComponent($(urlFacebookDiv).val()),
    url         ="<?php echo base_url().'post/create_and_edit';?>",
    publication_id=$( "input[name='publication_id']" ).val()
    ;

// vamos a preparar el arreglo a enviar de los  links
    var hostingServer =[],
    id_server         ="",
    description_links ="",
    links             =""
    ;

$("div.addHostingServer > div.data > div.server").each(function(i){

id_server         =$(this).find("div.form-group").find("select[id=hostingServers]").val();
description_links =$(this).find("div.form-group").find("input#description_links").val();
links             =$(this).find("div.form-group").find("textarea#links").val();

    hostingServer[i]= {
    'id_server'  : id_server,
    'description_links'  : description_links,
    'links' : links
    };

});

<?php //if($this->session->userdata('id_publication') == $this->uri->segment(3) and $this->session->userdata('modify')==true): ?>

// update servers
    var hostingServerUpdate  =[],
    id_server_update         ="",
    description_links_update ="",
    link_update              ="",
    link_update_id           ="",
    link_description_update  ="",
    descriptionHostSvrUpdate =[]
    ;


$("input#description_link").each(function(i){

var description_link =$(this).val(),
    id_server_update =$(this).data("id_server_tab")
    ;

    descriptionHostSvrUpdate[i]= {
    'id_server_update'  : id_server_update,
    'description_link'  : description_link
    }

});

$("div.linkContainer > input.link").each(function(i){
id_server_update =$(this).data("id_server");
link_update      =$(this).val();
link_description_update =$(this).parent().parent().find('input.link_description') .val();
link_original =$(this).parent().parent().find('input.link_original') .val();
link_update_id   =$(this).data("link_update_id");

if(!link_update_id)
link_update_id=0;

    hostingServerUpdate[i]= {
    'id_server_update'  : id_server_update,
    'link_update'       : link_update,
    'link_description_update' : link_description_update,
    'link_original' : link_original,
    'link_update_id'    : link_update_id
    };

});
<?php //endif; ?>
// ...
// ids de las fotos
var img_ids_upload=[];
// $("table#files > tbody > tr > td.delete > div.image").each(function(i){
$("ul#image-list > li").each(function(i){
    img_ids_upload[i]={
        'id_img'  : $(this).data("file_id")
    };

});

// envia la informacion
    $.ajax({
        type: "POST",
        url: url,
        async:true,
        dataType:"json",
        data:{  
        
        title:title,
        description:description,
        category:category,
        sub_category:sub_category,
        password:password,
        url_facebook:url_facebook,
        email:email,
        hostingServer:hostingServer,
        descriptionHostSvrUpdate:descriptionHostSvrUpdate,
        hostingServerUpdate:hostingServerUpdate,
        img_ids_upload:img_ids_upload,
        publication_id:publication_id

        }, 
        beforeSend:  function(html) {
        $('form.Form3').append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');

        },
        success: function(html){
        if(html.status==1){

        // eliminar los mensajes y bordes de validaciones
        $("div.alert-danger").remove();
        $("form.Form3 > div.titleDiv").removeClass("borderRequired");
        $("div.descriptionDiv").removeClass("borderRequired");
        $("div.well > div.categoryDiv").removeClass("borderRequired");
        $("div.well > div.emailDiv").removeClass("borderRequired");
        $("div.well > div.passwordDiv").removeClass("borderRequired");
        // ...

        $("#dialog > p").text("");
        $("#dialog > p").text(html.msg);
        $("#dialog > p").dialog({
        resizable: false,
        modal: true,
            buttons: {
            "Ir al post": function() {
            
            window.location.href="<?php echo base_url().'home/publication/'; ?>"+html.data;
            $("#dialog").append("<p></p>");
            $(this).dialog( "close" );
            },
            Cancel: function() {

            $("#dialog").append("<p></p>");
            $(this).dialog( "close" );
            }
            }
        });

        // reiniciar el form 
       $("form.Form3").get(0).reset();
       CKEDITOR.instances.description.setData('');

        }   else{

                if(html.title==1){
                $("form.Form3 > div.form-group > input#title").focus();
                $("form.Form3 > div.titleDiv").addClass("borderRequired");
                $(TitleContainer).tooltip();

                if(!$("div.titleDiv").find("div.alert-danger").get(0))
                $("div.titleDiv").append(alert_danger("",html.msg));

                }
                else { 
                $("form.Form3 > div.titleDiv").removeClass("borderRequired");
                $("div.titleDiv").find("div.alert-danger").remove();
                }

                if(html.description==1){

                $(".descriptionDiv").addClass("borderRequired");
                $("#description").focus().tooltip().addClass("borderRequired");

                if(!$("div.descriptionDiv").find("div.alert-danger").get(0))
                $("div.descriptionDiv").append(alert_danger("",html.msg));

                }
                else {
                $("div.descriptionDiv").removeClass("borderRequired");
                $("div.descriptionDiv").find("div.alert-danger").remove();

                }

                if(html.category==1){
                $(categoryContainer).focus().tooltip();
                $("div.well > div.categoryDiv").addClass("borderRequired");

                if(!$("div.well > div.categoryDiv").find("div.alert-danger").get(0))
                $("div.well > div.categoryDiv").append(alert_danger("",html.msg));

                }
                else {
                $("div.well > div.categoryDiv").removeClass("borderRequired");
                $("div.well > div.categoryDiv").find("div.alert-danger").remove();
                
                }
                <?php if($this->session->userdata("user_id")==FALSE): ?>

                if(html.email==1){

                $(emailContainer).focus().tooltip();
                $("div.well > div.emailDiv").addClass("borderRequired");

                if(!$("div.well > div.emailDiv").find("div.alert-danger").get(0))
                $("div.well > div.emailDiv").append(alert_danger("Email",html.msg));

                }
                else {

                    $("div.well > div.emailDiv").removeClass("borderRequired");
                    $("div.well > div.emailDiv").find("div.alert-danger").remove();

                }

                if(html.password==1){
                $(passwordContainer).focus().tooltip();
                $("div.well > div.passwordDiv").addClass("borderRequired");

                if(!$("div.well > div.passwordDiv").find("div.alert-danger").get(0))
                $("div.well > div.passwordDiv").append(alert_danger("",html.msg));

                }
                else {
                $("div.well > div.passwordDiv").find("div.alert-danger").remove();
                $("div.well > div.passwordDiv").removeClass("borderRequired");
                }
                <?php endif; ?> 
                // fin si no esta logueado

                // validar el servidor 
                if(html.hosting_servers==1){
                $(hostingServerSelect).focus().tooltip();
                $(hostingServerSelect).parent().addClass("borderRequired");

                if(!$(hostingServerSelect).parent().find("div.alert-danger").get(0))
                $(hostingServerSelect).parent().append(alert_danger("",html.msg));
            
                }
                else {
                $(hostingServerSelect).parent().find("div.alert-danger").remove();
                $(hostingServerSelect).parent().removeClass("borderRequired");
                }

            }

        // remover la imagen de loading
        $('form.Form3 > img.loading').remove();
        

        }
    });

return false;

});

// no_submit
$(document).on("click",'form.Form3 > div.not_submit',function() {
<?php if(!empty($id_publication)): ?>
var id_publication="<?php echo $id_publication; ?>";
<?php endif; ?>
var url="<?php echo base_url(); ?>";    

    $.ajax({
        url: url+'home/publication_html',
        type: 'POST',
        dataType: 'json',
        data: {id_publication: id_publication},
        beforeSend: function(response){
        $("div#post").append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');

        },
        success: function(response){
            
            if(response.status)
               window.location.href=url+"home/publication/"+id_publication;

        }
    });
    
});

</script>

<script>

$(document).ready(function () {
    CKEDITOR.replace("description");
    // CKEDITOR.replace( "description", {
    // allowedContent: true
    // } );

} );
</script>

<script>
        // global $
        // $(function () { 
        //     $('#form_file_upload').fileUploadUI({

        //         uploadTable: $('#files'),
        //         downloadTable: $('#files'),
        //         buildUploadRow: function (files, index) {
        //             return $('<tr><td>' + files[index].name + '<\/td>' +
        //             '<td class     ="file_upload_progress"><div><\/div><\/td>' +
        //             '<td class     ="file_upload_cancel">' +
        //             '<button class ="ui-state-default ui-corner-all" title="Cancel">' +
        //             '<span class   ="ui-icon ui-icon-cancel">Cancel<\/span>' +
        //             '<\/button><\/td><\/tr>');
        //         },
        //         buildDownloadRow: function (file) {

        //             var url = "<?php echo base_url(); ?>";

        //             // return $('<tr>'
        //             //         +'<td nowrap align="right" class="texto" style="padding-top: 10px;">'
        //             //         +'<img src="'+url+file.name+'" style="width:100px; height:100px">'
        //             //         +'<\/td>' 
        //             //         +'<td class="delete">'
        //             //         + '<div class="image" data-file_id="'+file.file_id+'"><\/div>'
        //             //         +'</td>' 
        //             //         +'<td class="path_img" style="display:none">'
        //             //         + file.name 
        //             //         +'</td>' 
        //             //         +'<\/tr>'
        //             //         +'</table>');
        //         },
        //         parseResponse: function (file) {console.log(file);},

        //     });
        // });

// eliminar imagen jQueryFileUpload
// $(document).on("click","table#files > tbody > tr > td.delete > div.image",function(){
//         var url  ="<?php echo base_url().'file/delete';?>",
//         path_img =$(this).parent().parent().find("td.path_img").text(),
//         img=$(this)
//         ;

//         $.ajax({
//             url: url,
//             type: 'POST',
//             dataType: 'json',
//             data: {path_img: path_img},
//             beforeSend:function(){

//             },
//             success:function(msg){
//                 $(img).parent().parent().remove();
//             }
//         });
        
// });

$(document).on("click","div.imageDelete",function(){
        var url  ="<?php echo base_url().'file/delete_file';?>",
        img=$(this)
        file_id =img.data("file_id")
        ;

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {file_id: file_id},
            beforeSend:function(){

            },
            success:function(msg){
                $(img).parent().remove();
            }
        });
        
});
</script>

<script>

/* cargar las imagenes :) */
<?php if(!empty($pictures)): ?>

var html="",
    url = "<?php echo base_url().'images/uploads/imgPost/'; ?>";

<?php foreach ($pictures as $key => $value) { ?>
var fileName=<?php echo json_encode($value['filename']);?>;
var fileId=<?php echo json_encode(encode_id($value['id']));?>;
var publication_id=$( "input[name='publication_id']" ).val();

html='<li data-file_id="'+fileId+'" data-publication="'+publication_id+'">'
+'<div class="imageDelete" data-file_id="'+fileId+'"></div>'
+'<img src="../../images/uploads/imgPost/'+fileName+'" style="width: 200px; height: 200px;">'
+'<input type="hidden" class="id" value="'+fileId+'">'
+'</li>';

$("ul#image-list").append(html);

<?php } ?>
<?php endif; ?>
</script>

<script>
/* eliminar una imagen */  
var url = "<?php echo base_url().'post/delete_link_hosting_server/'; ?>";
$(document).on("click","button.delete_link_button",function(){

    var id_link=$(this).data("file_id");
    $(this).parent().addClass('backgroundDelete');
    var containerDivLink=$(this).parent().parent();

    $("#dialog > p").text("");
    $("#dialog > p").text("¿Seguro desea eliminar el link ?");

    $("#dialog > p").dialog({
     resizable: true,
     modal: true,
         buttons: {
         Si: function() {
            
        $.ajax({
            dataType: 'json',
            url: url,
            type: 'POST',
            data: {id_hosting_server:id_link},
            beforeSend: function(response){

            $(containerDivLink).append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');

            },
            success: function(response){

            $(containerDivLink).remove();

            }
        });
        
        $("#dialog").append("<p></p>");
        $(this).dialog( "close" );

         },
         No: function() {
        
        $("#dialog").append("<p></p>");
        $(this).dialog( "close" );
        $("div.linkContainer").removeClass('backgroundDelete');

         }
         }
     });

});

</script>

<script>
// addLink agregar link a un tab a un servidor
$(document).on("click","div.addLink",function(){

    var publications_hosting_server_id=$(this).data("id_server_tab"),
        html;

        html='<tr>'
            +'<td>'
            +'&nbsp;'
            +'</td>'
            
            +'<td>' 
            +'<div class="form-group linkContainer">'
            +'Link <input type="text" name="link" value="" class="form-control link" tabindex="11" data-id_server="'+publications_hosting_server_id+'"></div>'
            +'</br>'
            +'Descripción link <input type="text" name="description" value="" class="form-control link_description" tabindex="11">'
            +'</br>'
            +'Link  Original <input type="text" name="link_original" value="" class="form-control link_original" tabindex="11" data-id_server="'+publications_hosting_server_id+'">'
            +'</div>'
            +'</br>'
            
            +'</td>'
            +'<td>'  
            +'<button name="" type="reset" class="delete_link_button" value="true"></button>'
            +'</td>'

            +'</tr>';
    // var html='<div class="form-group linkContainer">'
    //     +'<input type="text" name="link" class="form-control link" tabindex="11" data-id_server="'+publications_hosting_server_id+'">'     
    //     +'<input type="text" name="link_description" class="form-control link" tabindex="11" data-id_server="'+publications_hosting_server_id+'">'     
    //     +'<button name="" type="reset" class="delete_link_button" value="true"></button>'
    //     +'</div>';
    $(this).parent().find('table.div'+publications_hosting_server_id).find("tbody").append(html);    
});
</script>
 
<script>
// <!-- subir imagen IMG -->
/*
var url ="<?php echo base_url();?>";

 function upload_imgage(){

   // $('#userfile').on("change",function(e) {
   var url ="<?php echo base_url().'file/doUploadFile';?>";
      // e.preventDefault();
      $.ajaxFileUpload({
         url         : url, 
         secureuri      :false,
         fileElementId  :'userfile',
         dataType: "json",
         // multiple:true,
         type: "POST",
         data        : {
                     'title': 6
         },
         success  : function (data, status){
            if(data.status){

            $('#files').html('<p>Recargando imagenes...</p>');
            refresh_files();
            $('#title').val('');
            $('#userfile').val('');

            }
            else
            alert(data.msg);
         },
        error: function (data, status){

           // alert('e: '+e);

        }

      });
      return false;
   // });
// });
}

function refresh_files(){
   $.get(url+'file/files/')
   .success(function (data){
      $('#files').html(data);
   });
}
refresh_files();

$(document).ready(function() {
$("body").on('click', "a.delete_file_link",function(e) {
    
    var link = $(this);

    e.preventDefault();
    
    $.ajax({

        url         : url+'file/delete_file/' + link.data('file_id'),
        dataType : 'json',
        beforeSend  : function (data){},
        success     : function (data){
        files = $("#files");

            if (data.status == 1){

                link.parents('li').fadeOut('fast', function() {
                    $(this).remove();
                    
                    // if (files.find('li').length == 0)
                    // files.html('<p>No imagenes subidas</p>');
                });

            }   else
                alert(data.msg);
        }

    });

});

});
*/
</script>