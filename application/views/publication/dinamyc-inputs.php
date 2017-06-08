<?php
$MODE=(empty($MODE)?"view":$MODE);

$form["MODE"]=form_hidden("MODE",$MODE);
$form["id"]=form_hidden("id",encode_id($id));
$id_implode=(!empty($id)?implode("/",str_split($id)):"");
$friendly_path=base_url().$sys["storage"]["publication_config"].$id_implode."/";

if($MODE=="do_it"):

$add_other = array(
    'name'        => 'add_other',
    'id'          => 'add_other',
    'checked'     => false
    );

$form["add_other"]=form_checkbox($add_other);
$form["title"]        =form_input("title",$title," id='title'  placeholder='title'" );
$form["description"]  =form_textarea(array('name'=>'description', 'id'=>'description', 'rows'=>'3', 'value'=>$description,"placeholder"=>"Descripcion" ) );
$form["category"]     =form_dropdown('category',(!empty($categories)?$categories:null),$category,"id='category'");
$form["sub_category"] =form_dropdown('sub_category',(!empty($sub_categories)?$sub_categories:null),$sub_category,"id='sub_category'");
$form["email"]        =form_input("email",$email," id='email'  placeholder='email'" );
$form["password"]     =form_password("password",""," id='password'  placeholder='password'" );
$form["url_facebook"] =form_input("url_facebook",$url_facebook," id='url_facebook'  placeholder='url_facebook'" );
// $form["status"] =form_dropdown('status',(!empty($sys["forms_fields"]["publication_status"])?$sys["forms_fields"]["publication_status"]:null),$status,"id='status'");
$form["status"] =form_dropdown('status',(!empty($sys["forms_fields"]["publication_status"])?$sys["forms_fields"]["publication_status"]:null),1,"id='status'");

$form["is_sale"] =form_checkbox($is_sale);
	$is_sale = array(
	'name'        => 'is_sale',
	'id'          => 'is_sale',
	'value'          => 'true',
	'checked'     => (!empty($is_sale)?true:false) 
	);
$form["is_sale"] =form_checkbox($is_sale);

$form["price"]        =form_input("price",$price," id='price'  placeholder='price'" );
$like_sure = array(
	'name'        => 'like_sure',
	'id'          => 'like_sure',
	'value'          => 'true',
	'checked'     => (!empty($like_sure)?true:false) 
	);
$form["like_sure"] =form_checkbox($like_sure);


$txt_boton="Guardar";

else:

$form["title"]=!empty($title)?$title:"";        
$form["description"]=!empty($description)?$description:"";  
$form["category"]=!empty($categories)?array_search($category, array_flip($categories)):"";     
$form["sub_category"]=!empty($sub_categories)?array_search($sub_category, array_flip($sub_categories)):"";     
$form["email"]=!empty($email)?$email:"";        
$form["password"]=!empty($password)?"":"";     
$form["url_facebook"]=!empty($url_facebook)?$url_facebook:""; 
$form["is_sale"] =(!empty($is_sale)?"Si":"No");
$form["price"]=!empty($price)?$price:"";        
$form["like_sure"] =(!empty($like_sure)?"Si":"No");
$form["status"]=!empty($sys["forms_fields"]["publication_status"])?array_search($status, array_flip($sys["forms_fields"]["publication_status"])):"";     

$txt_boton="Editar";

endif;

$form["registred_by"] =$registred_by?$registred_by:"";
$form["updated_by"]   =$updated_by?$updated_by:"";
$form["views"]        =$views?$views:"";
$form["ip"]           =$ip?$ip:"";
$form["email_sent"]   =$email_sent?$email_sent:"";


$add_link='<div class="btn-primary btn-sm add_link" tabindex="12">Agregar articulo</div>';
$add_group_link='<div class="btn-primary btn-sm add_group_link" tabindex="12">Agregar P.Descripción</div>';

 ?>
    <div class="row">
       	<div class="panel panel-default">
            <?php echo $this->load->view("recycled/menu/panel_heading","",true); ?>

	        <!-- /.panel-heading -->
<?php $col="col-sm-3 col-md-3 col-lg-3 border_bottom"; ?>
	        <div class="panel-body">
	            <div class="row">

			                <!-- <imagen Importar> -->
	                        <div class="form-group mPublication">

			                <?php 
			            $data_file = array(
			                'name'     => 'file',
			                'id'       => 'file', 
			                'type'     => 'button',
			                'tabindex' => 1,
			                'class'    =>'ui-button-text',
			                'multiple' =>true,
			                );
			            $attributes_img = array(
			                "role"=>"form",
			                'id'=>'form_file_upload',
			                "name"=>'form_file_upload',
			                "method"=>"POST",
			                "enctype"=>"multipart/form-data"
			                );
			                 ?>

	                        <?php echo form_label("Subir </br> .Imagenes"); ?>

			                <div class="imgUp">
			                        <?php echo form_open(base_url().'file/doUploadFileBack/?process='.encode_id("publication")."&id=".encode_id($id),$attributes_img); ?>   
			                   
			                    <div class="upload">

			                        <?php echo form_upload($data_file); ?>

			                    </div>
			                        <?php echo form_close(); ?>

			                    
			                    <div id="files"></div>

			                </div>

	                        </div>

	                        <div class="form-group">
	                        	<table>

							<?php if(!empty($images)): ?>
							<?php $full_path=$_SERVER["DOCUMENT_ROOT"]."/".$sys["storage"]["publication_config"]; ?>
							<?php foreach($images as $ĸ => $row): ?>
							<?php $full_path_file=$full_path.$row["filename"]; ?>
							<tr>
								<td>
									<span class="name_encode"  style="display:none"><?php echo encode_id($row["filename"]); ?></span>
									<span class="file_id"  style="display:none"><?php echo encode_id($row["id"]); ?></span>
									<span class="process"  style="display:none"><?php echo encode_id("publication"); ?></span>
									<span class="delete" style='margin-top:20px;'></span>

								</td>
								<td>
								<?php if(file_exists(FCPATH."img/".$id_implode."/".$row['filename'])): ?>
                               	<img style="width:100px; height:100px;" class="slide-image" src="<?php echo base_url()."img/".$id_implode."/".$row['filename']; ?>" alt="">
								<?php endif; ?>
								</td>
								<?php if(file_exists($friendly_path.$row["filename"])){ ?>
								<td class="file_see">
									<img src="<?php echo $friendly_path.$row["filename"]; ?>" />
								</td>
								<?php } ?>
								<td>
									<a href="<?php echo $friendly_path.$row["filename"]; ?>" target="_blank">
									ver
									</a>									
								</td>
								<td>
								<a style="margin-left:10px;" href="<?php echo $full_path_file? base_url().'file/download_file/?name_file='.encode_id($row['filename']).'&file_path='.encode_id($full_path_file):'javascript:void(0);' ?>" <?php echo file_exists($full_path_file)?"":""; ?>>
								Descargar
								</a>
								</td>
							</tr>
							<?php endforeach; ?>
							<?php endif; ?>

	                        	</table>
	                        </div>
			                <!-- </imagen Importar> -->	 

<?php $attributes_form = array('class' => 'formBasic'); ?>
<?php  echo form_open("form",$attributes_form);?>

							<div class="form-group" style='display:none' id="hidden">
	                            <?php echo $form["MODE"]."/"; ?>
	                            <?php echo $form["id"]; ?>czxcz
	                        </div>
							<div class="form-group">
								<div id="message"></div>
	                        </div>

							<!-- .col -->
							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Titulo:"); ?>
	                            <?php echo $form["title"]; ?>
		                        </div>
							</div>
							<!-- /.col -->

							<div class="col-sm-12 col-md-12 col-lg-12 border_bottom">
			                    <div class="form-group">
	                            <?php echo form_label("Descripción:"); ?>
	                            <?php echo $form["description"]; ?>
		                        </div>
							</div>
							<!-- /.col -->

							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Categoria:"); ?>
	                            <?php echo $form["category"]; ?>
		                        </div>
							</div>
							<!-- /.col -->
							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Sub categoria:"); ?>
	                            <?php echo $form["sub_category"]; ?>
		                        </div>
							</div>

							<!-- /.col -->
							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Email:"); ?>
	                            <?php echo $form["email"]; ?>
		                        </div>
							</div>

							<!-- /.col -->
							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Password:"); ?>
	                            <?php echo $form["password"]; ?>
		                        </div>
							</div>
							<!-- /.col -->

							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Url Face:"); ?>
	                            <?php echo $form["url_facebook"]; ?>
		                        </div>
							</div>

							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Estatus"); ?>
	                            <?php echo $form["status"]; ?>
		                        </div>
							</div>

							<!-- /.col -->
							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Venta"); ?>
	                            <?php echo $form["is_sale"]; ?>
		                        </div>
							</div>	

							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Precio:"); ?>
	                            <?php echo $form["price"]; ?>
		                        </div>
							</div>
							<!-- /.col -->

							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Proteger con like:"); ?>
	                            <?php echo $form["like_sure"]; ?>
		                        </div>
							</div>
							<!-- /.col -->							

							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Vistas:"); ?>
	                            <?php echo $form["views"]; ?>
		                        </div>
							</div>
							<!-- /.col -->

							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Ip:"); ?>
	                            <?php echo $form["ip"]; ?>
		                        </div>
							</div>
							<!-- /.col -->

							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Email send:"); ?>
	                            <?php echo $form["email_sent"]; ?>
		                        </div>
							</div>
							<!-- /.col -->

							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Registrado por:"); ?>
	                            <?php echo $form["registred_by"]; ?>
		                        </div>
							</div>
							<!-- /.col -->
							<div class="<?php echo $col; ?>">
			                    <div class="form-group">
	                            <?php echo form_label("Actualizado por:"); ?>
	                            <?php echo $form["updated_by"]; ?>
		                        </div>
							</div>
							<!-- /.col -->

	                        <?php if($MODE=="do_it" and !$id): ?>
	                        <div class="form-group">
	                            <?php echo form_label("Agregar otro?:"); ?>
	                            <?php echo $form["add_other"]; ?>
	                        </div>
	                    	<?php endif; ?>
<?php  echo form_close();?>

	                        <div class="form-group">

	                        	<div class="area3 containerButtons buttonsActions">
		                        	<a class="button" href="javascript:void(0)" id="send">
										Enviar
									<span class='at'></span>
									</a>
	                        		
	                        		<?php if(!empty($id)):?>
									<a class="button" href="<?php echo base_url().'pdf/?source_module='.encode_id($module_data["link"]).'&id='.encode_id($id);?>">
										Imprimir
									<span class='pdf'></span>
									</a>
									<?php endif; ?>

	                        	</div>


	                        	<div class="area3 containerButtons">

	                        	<div class="btn btn-primary" id="submit"><?php echo $txt_boton; ?></div>
	                        	<?php if(!empty($id)): ?>
	                        	    <?php if($MODE=="do_it"): ?>
	                        		<div class="btn btn-warning" id="cancel"><?php echo "Cancelar"; ?></div>
	                        		<?php endif; ?>
	                        	<div class="btn btn-danger" id="delete"><?php echo "Eliminar"; ?></div>
	                        	<?php endif; ?>

								</div>

	                        	<?php if($MODE=="do_it" and !empty($id)): ?>

	                        	<div class="area4 containerButtons">
						    	<?php echo $add_link; ?>
							    <?php echo $add_group_link; ?>
							    	
								</div>
	                    		<?php endif; ?>

	                        </div>

							<div class="groupLinkContainer col-sm-12 col-md-12 col-lg-12">
								<div class="area2">
		                        	<div class="data">
									</div>
								</div>
	                        </div>
								
							<div class="linkListContainer linkDocumentViewDefault col-sm-12 col-md-12 col-lg-12">
								<div class="area1">
									detalle
								</div>
								<div class="area2">
									<div class="header">
										<div class="description">Desc.</div>
										<div class="link">Link</div>
										<div class="original">Original</div>
										<div class="hosting_servers_id">Tipo</div>
										<div class="publications_hosting_server_id">P.Descripción</div>
									</div>
									<div class="data">
										<!-- modified dinamically with js-->
									</div>
								</div>
							</div>
                </div>
	            <!-- /.row (nested) -->
	        </div>
	        <!-- /.panel-body -->
	    </div>
		<!-- /.panel-default -->
       	</div>
		<!-- /.row -->

<script>

  $(function() {

     $( "#date" ).datepicker();

  });
</script>
<!-- TOKEN INPUT PROVEEDOR -->
<?php if($MODE=="do_it"):?>
<script>


$(document).ready(function() {

	category_information= new Object();
	category_information.get=function(id){

		var id=id;
	 	// d0!!
		$("div#clientSubsidiaryInformationContainer").text("");

		// ...query string
		$.ajax({
			type: "POST",
			dataType:"json",
			url:"<?php echo base_url().'client/category_info'; ?>",
			data:{
			id:id,

			},
		beforeSend:function(response) {
		},
		complete:function(response) {

			var request=JSON.parse(response.responseText),
				request=request["data"];
				
				html="<span><a href='<?php echo base_url()."admin/client/clientView/";?>"+request.fk_client+"' target=_blank>";
				html+="<span "+(request.city?"style='color:black' ":"style='color:red'")+"> Ciudad: </span> "+request.city;
				html+="<span "+(request.colony?"style='color:black' ":"style='color:red'")+">  Colonia: </span>"+request.colony;
				html+="<span "+(request.delegation?"style='color:black' ":"style='color:red'")+">  Delegación: </span>"+request.delegation;
				html+="<span "+(request.street?"style='color:black' ":"style='color:red'")+">  Calle: </span>"+request.street;
				html+="<span "+(request.outside_number?"style='color:black' ":"style='color:red'")+">  # exterior: </span>"+request.outside_number;
				
				html+="<span "+(request.inside_number?"style='color:black' ":"style='color:red'")+">  # interior: </span>"+request.inside_number;
				
				html+="<span "+(request.zip_code?"style='color:black' ":"style='color:red'")+">  # c.p.: </span>"+request.zip_code;
				
				html+="<span "+(request.email?"style='color:black' ":"style='color:red'")+">  email: </span>"+request.email;
				html+="<span "+(request.phone?"style='color:black' ":"style='color:red'")+">  telefono:</span> "+request.phone;
				html+="</span>";
				html+="</a><span>";


			$("div#clientSubsidiaryInformationContainer").html("");
			$("div#clientSubsidiaryInformationContainer").html(html);
			$("input#client_email").val("");
			
			if(request.email)
			$("input#client_email").val(request.email);

			// alert(request.msg);
		}
		});

	 };

	$(document).on("change","select#category",function(){

		category_information.get($(this).val());
	});

	// TOKEN INPUT DEL PROVEEDOR
    $("#client").tokenInput("<?php echo base_url().'client/client_tokeninput'; ?>", {
        queryParam:"request[name]",
		hintText:"escribe para buscar coincidencias",
		noResultsText:"no hubo coincidencias",
		searchingText:"buscando...",
		tokenLimit:1,
		onAdd:function(item){

			var jqueryObj=$("#category");
				
				jqueryObj.children().remove();

				if(item.subsidiaries.length>1)
				 jqueryObj.append($("<option />").val("").text(""));

				$.each(item.subsidiaries,function() {

					jqueryObj.append($("<option />").val(this.id).text(this.name));

				});

				if(item.subsidiaries.length>1) {

					jqueryObj.prop("disabled",false);
					jqueryObj.get(0).focus();

				}

				if(item.subsidiaries.length==1)
				category_information.get(item.subsidiaries[0].id);
				else
				$(category_information.container).text("");

		},
		<?php if(($MODE=="do_it") and !empty($client) ): ?>
			prePopulate:[
				{id:<?php echo json_encode($client); ?>,name:<?php echo json_encode( (!empty($client)?array_search($client, array_flip($clients) ) :'' ) ); ?>,},
			],
		<?php endif; ?>

    });

});
</script>
<?php endif; ?>

<!-- Cargar los links -->
<script>

$(document).ready(function(){

 	link_details=new Object();

 	link_details.get=function(){
	var url ="<?php echo base_url().'link/link_details';?>",
		id ="<?php echo encode_id($id); ?>",
		module =$("div#hidden > input[name=module]").val()
		;

	    $.ajax({
	        type: "POST",
	        url: url,
	        async:true,
	        dataType:"json",
	        data:{  
	        
	        id_record:id,
	        source_module:"<?php echo encode_id('publication/link/'); ?>",
	        module:"<?php echo encode_id('publication'); ?>",

	        }, 
	        beforeSend:  function(response) {
	        	// console.log(response);
	        },
	        success: function(response){

	    	if(response.status==1)
	    	$("div.linkListContainer > div.area2 > div.data").append(response.html);

	        }

	    });


	return false;

	};


 	link_details.get();	

});
</script>

<!-- Cargar los group links -->
<script>

$(document).ready(function(){

 	group_links=new Object();

 	group_links.get=function(){
	var url ="<?php echo base_url().'link/group_links';?>",
		id ="<?php echo encode_id($id); ?>",
		module =$("div#hidden > input[name=module]").val()
		;

	    $.ajax({
	        type: "POST",
	        url: url,
	        async:true,
	        dataType:"json",
	        data:{  
	        
	        id_record:id,
	        source_module:"<?php echo encode_id('publication/group/link/'); ?>",
	        module:"<?php echo encode_id('publication_id'); ?>",

	        }, 
	        beforeSend:  function(response) {
	        	// console.log(response);
	        },
	        success: function(response){

	    	if(response.status==1)
	    	$("div.groupLinkContainer > div.area2 > div.data").append(response.html);

	        }

	    });


	return false;

	};


 	group_links.get();	

});
</script>

<script type="text/javascript">
   $(function() {

     var $editors = $('#description');
     // var $editors = $('textarea');
     if ($editors.length) {

       $editors.each(function() {
         var editorID = $(this).attr("id");
         var instance = CKEDITOR.instances[editorID];
         if (instance) { CKEDITOR.remove(instance); }
         CKEDITOR.replace(editorID);
       });
     }

   });
</script>
<script src='<?php echo base_url() ?>js/jQueryFileUpload/jquery.fileupload.js'></script>
<script src='<?php echo base_url() ?>js/jQueryFileUpload/jquery.fileupload-ui.js'></script>
<!-- para subir archivos por ajax -->
<?php require_once(FCPATH."js/upload-ajax.php"); ?>
<script type="text/javascript">
// Scroll down scrolldown
<?php if(($MODE=="do_it") ): ?>

$("body, html").animate({
    scrollTop: $(document).height()
}, 400);
<?php else: ?>
 $("html, body").animate({ scrollTop: 0 }, "slow");
<?php endif; ?>
</script>