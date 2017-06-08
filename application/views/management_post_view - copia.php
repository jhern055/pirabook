<?php echo $keditor_js; ?>

<!-- esto es para hacer lo de subir imagenes IMGUPLOAD -->
<?php //echo $upload_site; ?>
<?php echo $upload_ajaxfileupload; ?>

<?php //echo $stylesheet_fileupload; ?>
<?php //echo $stylesheet_fileupload_ui; ?>
<script>
var url ="<?php echo base_url();?>";

$(function() {
   $('#form_file_upload').submit(function(e) {
   var url ="<?php echo base_url().'file/doUploadFile';?>";
      e.preventDefault();
      $.ajaxFileUpload({
         url         : url, 
         secureuri      :false,
         fileElementId  :'userfile',
         dataType    : 'json',
         data        : {
                     'title': $('#title').val()
         },
         success  : function (data, status){

            if(data.status != 0){

            $('#files').html('<p>Reloading files...</p>');
            refresh_files();
            $('#title').val('');

            }
            else
            alert(data.msg);
         },    
        error: function (data, status, e){

           alert('e: '+e);
        }

      });
      return false;
   });
});

function refresh_files(){
   $.get(url+'file/files/')
   .success(function (data){
      $('#files').html(data);
   });
}
refresh_files();

$(document).on('click', "a.delete_file_link",function(e) {

    e.preventDefault();

    if (confirm('Are you sure you want to delete this file?')){
   
    var link = $(this);
    
    $.ajax({

        url         : url+'file/delete_file/' + link.data('file_id'),
        dataType : 'json',
        success     : function (data){

        files = $("#files");

        if (data.status == 1){

            link.parents('li').fadeOut('fast', function() {
                $(this).remove();
                if (files.find('li').length == 0)
                files.html('<p>No Files Uploaded</p>');
            });

        }   else
            alert(data.msg);
        }

    });

    }
});

</script>
<div id="post">
<div class="col-sm-8 col-md-8 col-lg-9">
<?php $this->load->helper('security'); ?>
    <div class="well">
    <span style="color:#F00 "><?php echo validation_errors(); ?></span>
        <!-- subir imagenes IMGUPLOAD -->
        <?php $attributes_img = array("role"=>"form",'id'=>'form_file_upload',"name"=>'form_file_upload',"method"=>"POST","enctype"=>"multipart/form-data"); ?>
        <?php echo form_open(base_url().'file/doUploadFile/'.$this->uri->segment(3),$attributes_img); ?>   
        <!-- <form id="file_upload" action="upload.php" method="POST" enctype="multipart/form-data"> -->
        
        <div class="form-group imagesDiv">
<!--         <table id="files" align="center">
        <tr valign="baseline">
        <td colspan="2">
        </td>
        </tr>
        </table> -->



        <?php $data = array(
                'name'     => 'userfile',
                'type'     => 'button',
                'id'       => 'userfile',
                'tabindex' => 11,
                'class' => 'ui-button-text',
                'multiple' =>true
                );
          ?>

        <!-- <span class="btn btn-success fileinput-button"> -->
        <!-- <i class="glyphicon glyphicon-plus"></i> -->
        <!-- <span>Subir imagenes...</span> -->
        <?php echo form_upload($data); ?>
        <!-- </span> -->
        </div>
        
        <div class="form-group">
        <label for="title">Titulo</label>
        <?php $data = array(
                'name'        => 'title',
                'id'          => 'title',
                'title'       => 'titulo es requerido',
                'placeholder' => 'Escribe aquí el título del post',
                'class'       => 'form-control',
                'tabindex'    => 11,
                'value'       => ""
                );
          ?>
        <?php echo form_input($data); ?>
        </div>
        <?php echo form_submit('submit', 'Publish'); ?>

        <?php echo form_close(); ?>
        <h2>Files</h2>
        <div id="files"></div>


        <?php $attributes = array('role' => 'form','class'=>'Form3',"name"=>'Form3',"method"=>"POST"); ?>
        <?php //$hidden = array("publication_id"=>$this->uri->segment(3) ); ?>
     	<?php echo form_open(base_url().'post/create_and_edit/'.$this->uri->segment(3),$attributes); ?>   
		<div class="mandatory-fields-notice ">
		Todos los campos marcados con <span> son obligatorios</span>
        <?php if($this->session->userdata("user_id")==FALSE): ?>
        <div class="alert alert-info">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        Si no estas logueado necesitas especificar una contraseña para el post
        </div>
        <?php endif; ?>
		</div>
        <div class="form-group titleDiv">
        <label for="title" class="required">Titulo</label>
        <?php $data = array(
                'name'        => 'title',
                'id'          => 'title',
                'title'       => 'titulo es requerido',
                'placeholder' => 'Escribe aquí el título del post',
                'class'       => 'form-control',
                'tabindex'    => 11,
                'required'    => 'required',
                'value'       => ""
                );
          ?>
        <?php echo form_input($data); ?>
        </div>

        <div class="form-group descriptionDiv" title="Descripción es requerido">
        <label for="description" class="required">Descripción</label>
        <?php $data = array(
                'name'        => 'description',
                'id'          => 'description',
                'class'       => 'form-control',
                'rows'        => '3',
                'tabindex'    => 11,
                'value'       => ""
                );
        ?>
        <?php echo form_textarea($data); ?>
        </div>

        <div class="btn btn-success create" tabindex="12">Crear</div>

    </div>
</div>

<div class="col-sm-4 col-md-4 col-lg-3">
    <div class="well">

        <!-- nombres de las categorias -->
        <div class="form-group categoryDiv">
        <label for="category" class="required">Categoría</label>

        <?php $attributes = 'id="category" title="Categoria es requerida"'; ?>
        <?php echo form_dropdown('category',$publications_categories_select,'',$attributes); ?>
        </div>

        <?php if($this->session->userdata("user_id")==FALSE): ?>

        <!-- email -->
        <div class="form-group emailDiv">
        <div class="alert alert-danger">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
            <strong>¡Error!</strong> <a href="javascript:void(0)" class="alert-link">Email</a> no es correcto.
        </div>
        <label for="title">Email</label>

        <?php $data = array(
                'name'        => 'email',
                'id'          => 'email',
                'placeholder' => 'email',
                'class'       => 'form-control',
                'tabindex'    => 11,
                'value'       => ""
                );
          ?>
        <?php echo form_input($data); ?>
        <div class="alert alert-warning">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        Este serviria si se le pierde el password del anuncio
        </div>
        </div>

        <div class="form-group passwordDiv">
        <label for="title" class="required">Contraseña</label>
        <?php $data = array(
                'name'        => 'password',
                'id'          => 'password',
                'title'       => 'contraseña',
                'placeholder' => 'password',
                'class'       => 'form-control',
                'tabindex'    => 11,
                'value'       => ""
                );
          ?>
        <?php echo form_password($data); ?>
        <div class="alert alert-warning">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        Invente una contraseña para poder cambiar o borrar su anuncio. 
        </div>
        </div>
        <?php endif; ?>

        <!-- links de descarga  -->
        <div class="addHostingServer">
        <div class="btn btn-primary btn-sm create addHostingServerLinks" tabindex="12">Agregar Links</div>
            <div class="data">
            </div>

        </div>
        <!--                                        -->

    </div>
</div>
    <?php echo form_close(); ?>
</div>

<!-- ajax crear post -->
<script>
$(".alert-danger").hide();
var validation=new Object(),
    TitleContainer="form.Form3 > div.form-group > input#title:eq(0)",
    descriptionContainer=CKEDITOR.instances.description,
    categoryContainer="select#category:eq(0)",
    emailContainer="div.well > div.emailDiv > input#email:eq(0)",
    passwordContainer="div.well > div.passwordDiv > input#password:eq(0)",
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
$(document).on("click",'form.Form3 > div.create',function() {

    var title   =$(TitleContainer).val(),
    description =CKEDITOR.instances.description.getData(),
    category    =$(categoryContainer).val(),
    email       =$(emailContainer).val(),
    password    =$(passwordContainer).val(),
    url         ="<?php echo base_url().'post/create_and_edit';?>"
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
links             =$(this).find("div.form-group").find("input#links").val();

    hostingServer[i]= {
    'id_server'  : id_server,
    'description_links'  : description_links,
    'links' : links
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
                password:password,
                email:email,
                hostingServer:hostingServer
            } , 
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
            $(this).dialog( "close" );
            },
            Cancel: function() {
            
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

</script>

<script>

$(document).ready(function () {
    CKEDITOR.replace("description");
});

</script>

<script>
        // global $
        /*$(function () { 
            $('#form_file_upload').fileUploadUI({
                uploadTable: $('#files'),
                downloadTable: $('#files'),
                buildUploadRow: function (files, index) {
                    return $('<tr><td>' + files[index].name + '<\/td>' +
                    '<td class     ="file_upload_progress"><div><\/div><\/td>' +
                    '<td class     ="file_upload_cancel">' +
                    '<button class ="ui-state-default ui-corner-all" title="Cancel">' +
                    '<span class   ="ui-icon ui-icon-cancel">Cancel<\/span>' +
                    '<\/button><\/td><\/tr>');
                },
                buildDownloadRow: function (file) {
                    var url = "<?php echo base_url(); ?>";

                    return $('<tr>'
                            +'<td nowrap align="right" class="texto" style="padding-top: 10px;">'
                            +'<img src="'+url+file.name+'" style="width:100px; height:100px">'
                            +'<\/td>' 
                            +'<td class="delete">'
                            + '<div class="image">X<\/div>'
                            +'</td>' 
                            +'<td class="path_img" style="display:none">'
                            + file.name 
                            +'</td>' 
                            +'<\/tr>'
                            +'</table>');
                }
            });
        });
*/
// eliminar imagen
$(document).on("click","table#files > tbody > tr > td.delete >div.image",function(){

        var url  ="<?php echo base_url().'file/delete';?>",
        path_img =$(this).parent().parent().find("td.path_img").text()
        ;

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {path_img: path_img},
            beforeSend:function(){

            },
            success:function(msg){
            }
        });
        
});
</script>