<?php $sessioMode=$this->session->userdata("sessionMode_publication");?>
<div class="dinamic_record">
    <?php echo $this->load->view($data['module_data']["link"]."dinamyc-inputs",$data,true); ?>
</div>
<style type="text/css">
input{width: auto;}
</style>
<!-- /.container-fluid -->
 <script type="text/javascript" src="<?php  echo base_url()."js/ckeditor/"; ?>ckeditor.js"></script>

<script>
form = Object();
form.submit=function(mode,item){
		var	url="<?php echo base_url(); ?>"
		id="<?php echo encode_id($id); ?>",
		formData=""
		;
		
		for (instance in CKEDITOR.instances) {
		CKEDITOR.instances[instance].updateElement();
		}

// subir las imagenes
var files ="";

$("div.mPublication > div.imgUp > div#files > tr").each(function(i){

	files+="&files["+i+"][file_name]="+$(this).find("td.file_name").text()
			;
});

		if(mode=="do_it")
		formData=$("form.formBasic").serialize()+files;

		if(mode=="cancel")
		formData={MODE:"cancel",id:id};

		if(mode=="add")
		formData={MODE:"add",id:null};
	
// envia la informacion
		$.ajax({
		    url: url+"<?php echo $data['module_data_method_do_it']; ?>",
		    // async:true,
		    type: 'POST',
		    dataType: 'json',
		    data: formData,
		    beforeSend: function(response){
		    	console.log(response);
// ajax
			$("input").prop("disabled",true);
			$("button").prop("disabled",true);
			$("div#ajax_loading").addClass("ajax_loading");
// ...		    	

		    },
		    success: function(response){

		    	if(response.status==1)
		    	$("div.dinamic_record").html(response.html); 
		    	else{

		    		if(response.redirect){
						$("#dialog > p").text(response.redirect);
						$("#dialog").html("<p></p>");
		    			return;
		    		}
						$("#dialog > p").text("");
						$("#dialog > p").text(response.msg);
						$("#dialog > p").dialog({
							resizable: false,
							modal: true,
								buttons: {
									Aceptar: function() {

										$("#dialog").append("<p></p>");
										$(this).dialog( "close" );
									}
								}
						});
		    	}

// ajax
		    $("input").prop("disabled",false);
		    $("button").prop("disabled",false);
		    $("div#ajax_loading").removeClass("ajax_loading");
// ...

		    }
		 });

	return false;	
};

$(document).on("click","div#submit",function(){
form.submit("do_it",$(this).get(0));
});
$(document).on("click","div#cancel",function(){
form.submit("cancel",$(this).get(0));
});
$(document).on("click","span#add",function(){
form.submit("add",$(this).get(0));
});

$(document).on("click","div#delete",function(){

var 	id="<?php echo encode_id($id); ?>",
		url="<?php echo base_url(); ?>"
		;

$("#dialog > p").text("");
$("#dialog > p").text("Realmente desea eliminar este registro");
$("#dialog > p").dialog({
resizable: false,
modal: true,
    buttons: {
        Si: function() {
        	
			$.ajax({

				    url: url+"publication/publication_delete",
				    type: 'POST',
				    dataType: 'json',
				    data: {
				    	id:id
				    },
				    beforeSend: function(response){

				    // ajax
				    $("input").prop("disabled",true);
				    $("button").prop("disabled",true);
				    $("div#ajax_loading").addClass("ajax_loading");
				    // ...

				    },
				    success: function(response){

				    		$("#dialog > p").text("");
							$("#dialog > p").text(response.msg);
							$("#dialog > p").dialog({
							resizable: false,
							modal: true,
							    buttons: {
							        Correcto: function() {
							        	
							        if(response.status)
            						{window.location.href="<?php echo base_url().'publication/'; ?>";}

							       	$("#dialog").append("<p></p>");
        							$(this).dialog( "close" );
							        }
							     }

							 });      		

					// ajax
					$("input").prop("disabled",false);
					$("button").prop("disabled",false);
					$("div#ajax_loading").removeClass("ajax_loading");
					// ...	

				    }
			 });


        $("#dialog").append("<p></p>");
        $(this).dialog( "close" );

        },
        No: function() {

        $("#dialog").append("<p></p>");
        $(this).dialog( "close" );
        }
    }
});




 });
    
</script>

<script>
function alert_danger(field,msg){
var error_html='<div class="alert alert-danger">'
                +'<a class="close" data-dismiss="alert" href="#">&times;</a>'
                +' <a href="#" class="alert-link not-active">'+field+'</a> '
                +'<p>'+msg+'.</p>'
                +'</div>'
                ;
    return error_html;
}
</script>
<!-- F5 -->
<?php if($sessioMode=="do_it" and !empty($id)){ ?>
<script> $(document).ready(function(){$("div#submit").focus().click(); }); </script>
<?php } ?>

<!-- SEND ENVIAR -->
<?php if(!empty($id)){ ?>
<script>
$(document).on("click","a#send",function(){

var client_email=$("input#client_email").val(),
	email="";
	
	email=prompt("Emails separados por comas",client_email);

	$.ajax({
        type: "POST",
        url: "<?php echo base_url().'email/send/';?>",
        // async:true,
        dataType:"json",
        data:{  
        
        id:"<?php echo encode_id($id);?>",
        source_module:"<?php echo encode_id('publication/');?>",
        email:email,
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

			$("#dialog > p").text("");
			$("#dialog > p").text(response.msg);
			$("#dialog > p").dialog({
			resizable: false,
			modal: true,
			    buttons: {
			        Aceptar: function() {
					$("#dialog").append("<p></p>");
					$(this).dialog( "close" );
					
					},
				}			
			});	        		
        }

	});

});

</script>
<?php } ?>


<!-- Agregar un link -->
<script>

$(document).on("click","div.add_link",function(){

// esconder el boton momentaneamente el de agregar
// $(this).hide();
var publication=$("form.formBasic").find("div#hidden").find("input[name='id']").val()

var url ="<?php echo base_url().'link/add_link';?>";

    $.ajax({
        type: "POST",
        url: url,
        // async:true,
        dataType:"json",
        data:{
        	MODE:"do_it",
        	id_record:publication
        }, 
        beforeSend:  function(response) {
// ajax
			$("input").prop("disabled",true);
			$("button").prop("disabled",true);
			$("div#ajax_loading").addClass("ajax_loading");
// ...        	
        },
        success: function(response){

	    	$("div.linkListContainer > div.area2 > div.data").append(response);
	    	$("input#import").focus();
// ajax
		    $("input").prop("disabled",false);
		    $("button").prop("disabled",false);
		    $("div#ajax_loading").removeClass("ajax_loading");
// ...
        }

    });

});

// Boton de ACEPTAR que deseo agregarlo
// $(document).on("click","div.linkListContainer > div.area2 > div.data > div.itemPayment > div.editionActions > button.accept",function() {
$(document).on("click","button.submit_link",function() {

var this_boton=$(this),
	this_boton_get=$(this).get(0)
	;

var url ="<?php echo base_url().'link/add_link_do';?>";

var c=0,
MODE=$(this).parent().parent().find("div#hidden").find("input[name='MODE']").val(),
publication=$("form.formBasic").find("div#hidden").find("input[name='id']").val()
;
// alert(publication);
var link_details=[];

// contar los divs para saber que key le pondre al arreglo 
$("div.linkListContainer > div.area2 > div.data > div.itemPayment").each(function(i){
	c++;
});

	// method:$(this).parent().parent().find("div.method").find("select#method").val(),
if(MODE=="do_it"){
	link_details[c]= {
	module :"<?php echo encode_id('publication'); ?>",
	id:$(this).parent().parent().find("div.id").data("id"),
	description:$(this).parent().parent().find("div.description").find("input#description").val(),
	link:$(this).parent().parent().find("div.link").find("input#link").val(),
	original:$(this).parent().parent().find("div.original").find("input#original").val(),
	hosting_servers_id:$(this).parent().parent().find("div.hosting_servers_id").find("#hosting_servers_id option:selected").val(),
	publications_hosting_server_id:$(this).parent().parent().find("div.publications_hosting_server_id").find("#publications_hosting_server_id option:selected").val(),

	};
}
else{
	link_details[c]= {
	module :"<?php echo encode_id('publication'); ?>",
	id:$(this).parent().parent().find("div.id").data("id"),
	description:$(this).parent().parent().find("div.description").text(),
	link:$(this).parent().parent().find("div.link").text(),
	original:$(this).parent().parent().find("div.original").text(),
	hosting_servers_id:$(this).parent().parent().find("div.hosting_servers_id").data("hostingserversid"),
	publications_hosting_server_id:$(this).parent().parent().find("div.publications_hosting_server_id").data("publicationshostingserverid"),

	};
}

    $.ajax({
        type: "POST",
        url: url,
        // async:true,
        dataType:"json",
        data:{
        	link_details:link_details,
        	MODE:MODE,
        	edit:true,
        	module:"<?php echo encode_id('publication'); ?>",
        	source_module:"<?php echo encode_id('publication/link/'); ?>",
        	id_record:publication,
        }, 
        beforeSend:  function(response) {

// ajax
			$("input").prop("disabled",true);
			$("button").prop("disabled",true);
			$("div#ajax_loading").addClass("ajax_loading");
// ...
        },
        success: function(response){

        	if(response.status){
		    	$(this_boton).parent().parent().html(response.html);

				// Mostrar el boton de agregar 
				$("div.buttonsContainer > div.area4 > div.add_link").show();

			}else{

	    		$("#dialog > p").text("");
				$("#dialog > p").text(response.msg);
				$("#dialog > p").dialog({
				resizable: false,
				modal: true,
				    buttons: {
				        Aceptar: function() {
				        	
				       	$("#dialog").append("<p></p>");
						$(this).dialog( "close" );
				        }
				     }

				 });  				
			}
// ajax
		    $("input").prop("disabled",false);
		    $("button").prop("disabled",false);
		    $("div#ajax_loading").removeClass("ajax_loading");
// ...
        }

    });

});

$(document).on("click","div.linkListContainer > div.area2 > div.data > div.item > div.ops > button.delete",function(){
var item=$(this).get(0),
	publication=$("form.formBasic").find("div#hidden").find("input[name='id']").val();

	$("#dialog > p").text("");
	$("#dialog > p").text("Realmente desea eliminar este pago");
	$(item).parent().parent().addClass("deleteStyle");
	$("#dialog > p").dialog({
	resizable: false,
	modal: true,
	    buttons: {
	        Si: function() {
			$("#dialog").append("<p></p>");
			$(this).dialog( "close" );
			$(item).parent().parent().removeClass("deleteStyle");

// -----------------------------------
    $.ajax({
        type: "POST",
        url: "<?php echo base_url().'link/delete_link'; ?>",
        // async:true,
        dataType:"json",
        data:{
			id:$(item).parent().parent().find("div.id").data("id"),
        	module:"<?php echo encode_id('publication'); ?>",
        	id_record:publication,
        	source_module:"<?php echo encode_id('publication/link/'); ?>",

        }, 
        beforeSend:  function(response) {
// ajax
			$("input").prop("disabled",true);
			$("button").prop("disabled",true);
			$("div#ajax_loading").addClass("ajax_loading");
// ...
        },
        success: function(response){

        	if(!response.status)
			{

	    		$("#dialog > p").text("");
				$("#dialog > p").text(response.msg);
				$("#dialog > p").dialog({
				resizable: false,
				modal: true,
				    buttons: {
				        Aceptar: function() {
				        	
				       	$("#dialog").append("<p></p>");
						$(this).dialog( "close" );
				        }
				     }

				 });  				
			}
// ajax
		    $("input").prop("disabled",false);
		    $("button").prop("disabled",false);
		    $("div#ajax_loading").removeClass("ajax_loading");
// ...
        }

    });

// -----------------------------------
			// elimina el item
			$(item).parent().parent().remove();
			
			},
			No: function() {
			$("#dialog").append("<p></p>");
			$(this).dialog( "close" );
			$(item).parent().parent().removeClass("deleteStyle");

			}
		}			
	});
});

</script>

<script type="text/javascript">
// <cancel>
// Boton de Cancelar (no agregar pago)
$(document).on("click","div.linkListContainer > div.area2 > div.data > div.itemPayment > div.editionActions > button.cancel",function() {
 obj=new Object();
 obj.id=$(this).parent().parent().find("div.id").data("id");
 obj.this_it=$(this);
 obj.url="<?php echo base_url();?>";
var publication=$("form.formBasic").find("div#hidden").find("input[name='id']").val();

	$.ajax({
        type: "POST",
        url: obj.url+"link/get_link_by",
        dataType:"json",
        data:{
        	id: obj.id,
        	id_record:"<?php echo encode_id($id); ?>",
        	source_module:"<?php echo encode_id('publication'); ?>"
        	 }, 
        beforeSend:  function(response) {
// ajax
			$("input").prop("disabled",true);
			$("button").prop("disabled",true);
			$("div#ajax_loading").addClass("ajax_loading");
// ...        	

        },
        success: function(response){
		chargeCancel(response);
		if(!response)
		msg(response);

// ajax
		    $("input").prop("disabled",false);
		    $("button").prop("disabled",false);
		    $("div#ajax_loading").removeClass("ajax_loading");
// ...
        }

    });

	function chargeCancel (link_details) {

	    $.ajax({
	        type: "POST",
	        url: obj.url+'link/add_link_do',
	        // async:true,
	        dataType:"json",
	        data:{
	        	link_details:link_details,
	        	MODE:"do_it",edit:true,
	        	source_module:"<?php echo encode_id('publication/'); ?>",
	        	module:"<?php echo encode_id('publication'); ?>",
        		id_record:$("form.formBasic").find("div#hidden").find("input[name='id']").val(),
	        }, 
	        beforeSend:  function(response) {

// ajax
			$("input").prop("disabled",true);
			$("button").prop("disabled",true);
			$("div#ajax_loading").addClass("ajax_loading");
// ...

	        },
	        success: function(response){
	        	if(response.status)
		    	$(obj.this_it).parent().parent().html(response.html);
		    	else{

				msg(response);
		    	$(obj.this_it).parent().parent().remove();
		    	}

				// Mostrar el boton de agregar 
				$("div.buttonsContainer > div.area4 > div.add_link").show();

				// sumatoria de el detalle
// ajax
		    $("input").prop("disabled",false);
		    $("button").prop("disabled",false);
		    $("div#ajax_loading").removeClass("ajax_loading");
// ...
	        }

	    });
	}

// Mostrar el boton de agregar 
$("div.buttonsContainer > div.area4 > div.add_link").show();

});
// </cancel>
</script>
<!-- F5 -->
<script>

function msg(response){

    		$("#dialog > p").text("");
			$("#dialog > p").text(response.msg);
			$("#dialog > p").dialog({
			resizable: false,
			modal: true,
			    buttons: {
			        Aceptar: function() {
			        	
			       	$("#dialog").append("<p></p>");
					$(this).dialog( "close" );
			        }
			     }

			 });

}
</script>

<script type="text/javascript">

$(document).on("click","div.add_group_link",function(){

// esconder el boton momentaneamente el de agregar
// $(this).hide();
var publication=$("form.formBasic").find("div#hidden").find("input[name='id']").val()

var url ="<?php echo base_url().'link/add_group_link';?>";

    $.ajax({
        type: "POST",
        url: url,
        dataType:"json",
        data:{
        	MODE:"do_it",
        	id_record:publication
        }, 
        beforeSend:  function(response) {
// ajax
			$("input").prop("disabled",true);
			$("button").prop("disabled",true);
			$("div#ajax_loading").addClass("ajax_loading");
// ...        	
        },
        success: function(response){

	    	$("div.groupLinkContainer > div.area2 > div.data").append(response);

// ajax
		    $("input").prop("disabled",false);
		    $("button").prop("disabled",false);
		    $("div#ajax_loading").removeClass("ajax_loading");
// ...
        }

    });

});
// div.groupLinkContainer > div.area2 > div.data > div.itemPayment > div.editionActions > 
$(document).on("click","button.submit_group_link",function() {

var this_boton=$(this),
	this_boton_get=$(this).get(0)
	;

var url ="<?php echo base_url().'link/add_group_link_do';?>";

var c=0,
MODE=$(this).parent().parent().find("div#hidden").find("input[name='MODE']").val(),
publication=$("form.formBasic").find("div#hidden").find("input[name='id']").val()
;

var group_link_detail=[];

// contar los divs para saber que key le pondre al arreglo 
$("div.groupLinkContainer > div.area2 > div.data > div.itemGroupLink").each(function(i){
	c++;
});

if(MODE=="do_it"){
	group_link_detail[c]= {
	module :"<?php echo encode_id('publication'); ?>",
	id:$(this).parent().parent().find("div#hidden").find("input[name='id_group_link']").val(),
	description:$(this).parent().parent().find("div.description").find("input#description").val(),
	};
}
else{
	group_link_detail[c]= {
	module :"<?php echo encode_id('publication'); ?>",
	id:$(this).parent().parent().find("div#hidden").find("input[name='id_group_link']").val(),
	description:$(this).parent().parent().find("div.description").text(),
	};
}

    $.ajax({
        type: "POST",
        url: url,
        dataType:"json",
        data:{
        	group_link_detail:group_link_detail,
        	MODE:MODE,
        	edit:true,
        	module:"<?php echo encode_id('publication_id'); ?>",
        	source_module:"<?php echo encode_id('publication/group/link/'); ?>",
        	id_record:publication,
        }, 
        beforeSend:  function(response) {
        	
// ajax
			$("input").prop("disabled",true);
			$("button").prop("disabled",true);
			$("div#ajax_loading").addClass("ajax_loading");
// ...
        },
        success: function(response){

        	if(response.status){
		    	$(this_boton).parent().parent().html(response.html);

				// Mostrar el boton de agregar 
				$("div.add_group_link").show();

			}else{

	    		$("#dialog > p").text("");
				$("#dialog > p").text(response.msg);
				$("#dialog > p").dialog({
				resizable: false,
				modal: true,
				    buttons: {
				        Aceptar: function() {
				        	
				       	$("#dialog").append("<p></p>");
						$(this).dialog( "close" );
				        }
				     }

				 });  				
			}
// ajax
		    $("input").prop("disabled",false);
		    $("button").prop("disabled",false);
		    $("div#ajax_loading").removeClass("ajax_loading");
// ...
        }

    });

});

// <cancel>
// Boton de Cancelar
$(document).on("click","button.group_link_cancel",function() {
 obj=new Object();
 obj.id=$(this).parent().parent().find("div#hidden").find("input[name='id_group_link']").val();
 obj.this_it=$(this);
 obj.url="<?php echo base_url();?>";

	$.ajax({
        type: "POST",
        url: obj.url+"link/get_group_by",
        dataType:"json",
        data:{
        	id: obj.id,
        	id_record:"<?php echo encode_id($id); ?>",
        	source_module:"<?php echo encode_id('publication_id'); ?>"
        	 }, 
        beforeSend:  function(response) {
        	// console.log(response);
// ajax
			$("input").prop("disabled",true);
			$("button").prop("disabled",true);
			$("div#ajax_loading").addClass("ajax_loading");
// ...        	

        },
        success: function(response){

		chargeCancel(response);
		if(!response)
		msg(response);

// ajax
		    $("input").prop("disabled",false);
		    $("button").prop("disabled",false);
		    $("div#ajax_loading").removeClass("ajax_loading");
// ...
        }

    });

	function chargeCancel (group_link_detail) {

	    $.ajax({
	        type: "POST",
	        url: obj.url+'link/add_group_link',
	        dataType:"json",
	        data:{
	        	group_link_detail:group_link_detail,
	        	// MODE:"do_it",
	        	edit:true,
	        	source_module:"<?php echo encode_id('publication/'); ?>",
	        	module:"<?php echo encode_id('publication_id'); ?>",
        		id_record:"<?php echo encode_id($id); ?>",
        		MODE:"view"

	        }, 
	        beforeSend:  function(response) {

// ajax
			$("input").prop("disabled",true);
			$("button").prop("disabled",true);
			$("div#ajax_loading").addClass("ajax_loading");
// ...

	        },
	        success: function(response){
		    	$(obj.this_it).parent().parent().html(response);
	        	
	        	// if(response.status)
		    	// else{

				// msg(response);
		    	// $(obj.this_it).parent().parent().remove();
		    	// }

				// Mostrar el boton de agregar 
				$("div.buttonsContainer > div.area4 > div.add_group_link").show();

				// sumatoria de el detalle
// ajax
		    $("input").prop("disabled",false);
		    $("button").prop("disabled",false);
		    $("div#ajax_loading").removeClass("ajax_loading");
// ...
	        }

	    });
	}

// Mostrar el boton de agregar 
$("div.buttonsContainer > div.area4 > div.add_group_link").show();

});
// </cancel>

// delete group link
$(document).on("click","button.delete_group_link",function(){
var item=$(this).get(0),
	publication=$("form.formBasic").find("div#hidden").find("input[name='id']").val();

	$("#dialog > p").text("");
	$("#dialog > p").text("Realmente desea eliminar este grupo link");
	$(item).parent().parent().addClass("deleteStyle");
	$("#dialog > p").dialog({
	resizable: false,
	modal: true,
	    buttons: {
	        Si: function() {
			$("#dialog").append("<p></p>");
			$(this).dialog( "close" );
			$(item).parent().parent().removeClass("deleteStyle");

// -----------------------------------
    $.ajax({
        type: "POST",
        url: "<?php echo base_url().'link/delete_group_link'; ?>",
        dataType:"json",
        data:{
			id:$(item).parent().parent().find("div#hidden").find("input[name='id_group_link']").val(),
        	module:"<?php echo encode_id('publication_id'); ?>",
        	id_record:publication,
        	source_module:"<?php echo encode_id('publication/group/link/'); ?>",

        }, 
        beforeSend:  function(response) {
// ajax
			$("input").prop("disabled",true);
			$("button").prop("disabled",true);
			$("div#ajax_loading").addClass("ajax_loading");
// ...
        },
        success: function(response){

        	if(!response.status)
			{

	    		$("#dialog > p").text("");
				$("#dialog > p").text(response.msg);
				$("#dialog > p").dialog({
				resizable: false,
				modal: true,
				    buttons: {
				        Aceptar: function() {
				        	
				       	$("#dialog").append("<p></p>");
						$(this).dialog( "close" );
				        }
				     }

				 });  				
			}else {
			// elimina el item
			$(item).parent().parent().remove();				
			}
// ajax
		    $("input").prop("disabled",false);
		    $("button").prop("disabled",false);
		    $("div#ajax_loading").removeClass("ajax_loading");
// ...
        }

    });

// -----------------------------------
			},
			No: function() {
			$("#dialog").append("<p></p>");
			$(this).dialog( "close" );
			$(item).parent().parent().removeClass("deleteStyle");

			}
		}			
	});
});

// / delete group link
</script>