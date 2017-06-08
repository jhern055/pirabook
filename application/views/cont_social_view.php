<!-- facebook -->
<div id="fb-root"></div>
<!-- me gusta -->
<!-- <div class="fb-like" data-href="https://www.facebook.com/permalink.php?story_fbid=1380802698886563;id=100008705374912" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> -->

<div class="containerContSocial">

<fieldset>
<legend><span style="font-family:trebuchet ms;"> Recomienda este post a tus amigos. </span><br></legend>
<!-- compartir -->
	 <?php 	if(!empty($publication) ):
       		foreach ($publication as $key_for_before => $value_for_before) {
     ?>

    <!-- me gusta boton FACEBOOK -->
    <div class="fb-like" data-href="https://www.facebook.com/pages/Pirabook/1650210071872986" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
	<!-- <div class="pluginCountButtonNub"> -->
	<!-- email -->
	<div class="email_send">&nbsp;</div>
	<div class="post_body"><?php echo $value_for_before["email_sent"]?:"0"; ?></div>

    <div class="col-sm-9 col-md-5 col-lg-5">
	<div class="emailContainer">
	<div class="minimize"></div>
        <div class="alert alert-info">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        Vas a enviar esta publicación por correo
        </div>
		<?php $this->load->helper('security'); ?>

        <?php $attributes = array('role' => 'form','class'=>'FormEmailSend',"name"=>'FormEmailSend'); ?>
        <?php $publication_id = $this->uri->segment(3)?:$_POST["publication_id"]; ?>
        <?php $hidden = array("publication_id"=>$this->security->xss_clean($publication_id)); ?>
		<?php $data_name = array('tabindex'=>'1','name'=> 'name','id'=> 'name','type'=> 'name','placeholder'=> 'Tu nombre:','class'=> 'form-control','value'=> $this->input->post("name"));?>
		<?php $data_email = array('tabindex'=>'2','name'=> 'email','id'=> 'email','type'=> 'email','placeholder'=> 'Escribe tu correo:','class'=> 'form-control','value'=> $this->input->post("email_own"));?>
		<?php $data_comment = array('tabindex'=>'3','name'=> 'emailsSend','id'=> 'emailsSend','type'=> 'emailsSend','placeholder'=> 'emails separados por comas','class'=> 'form-control','rows'=> '3','value'=> $this->input->post("emailsSend"));?>

		 <?php echo form_open(base_url().'email/send/'.$this->uri->segment(3),$attributes,$hidden); ?>   
                <div class="form-group">
                    <?php echo form_input($data_name); ?>
                </div>

                <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-addon">@</div>
                    <?php echo form_input($data_email); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo form_textarea($data_comment); ?>
                </div>

                <div class="btn btn-success submitSendEmail" tabindex="4">Enviar</div>
            <?php echo form_close(); ?>

	</div>
	</div>
<script>
$(document).ready(function() {



	sendEmail=new Object();
	sendEmail.form="form.FormEmailSend";
	sendEmail.emailContainer="div.emailContainer";
	sendEmail.submit="";
	sendEmail.id_publication=$(sendEmail.form).find("input[name=publication_id]").val();
	sendEmail.url="<?php echo base_url(); ?>";

	$(sendEmail.form).find("div.form-group").find("textarea#emailsSend").keypress(function(e){
	if(e.which == 13){
    $(this).blur();
    $(this).parent().parent().find("div.submitSendEmail").focus().click();

	}

	});

	$(document).on("click","div.containerContSocial > fieldset > div.email_send",function(){
	
	$(sendEmail.emailContainer).toggle("show");
	$(sendEmail.form).find("div.form-group").find("input#name").focus();

	});

	$(document).on("click","div.emailContainer > div.minimize",function(){
		
	$(sendEmail.emailContainer).toggle("hide");

	});

	$(sendEmail.form).find("div.submitSendEmail").click(function(){
			
		var	name=$(sendEmail.form).find("div.form-group").find("input#name").val(),
			emailOwn=$(sendEmail.form).find("div.form-group").find("div.input-group").find("input#email").val(),
			emailToSendFrom=$(sendEmail.form).find("div.form-group").find("textarea#emailsSend").val()
			;

		$.ajax({

				type:"POST",
				url:sendEmail.url+"email/send",
				dataType:"json",
				type:"POST",
				data:{
					id_publication:sendEmail.id_publication,
					name:name,
					emailOwn:emailOwn,
					emailToSendFrom:emailToSendFrom,
				},
				beforeSend:function(response){

				$(sendEmail.form).find('input').prop( "disabled", true);
				$(sendEmail.form).find('textarea').prop( "disabled", true);
				$(sendEmail.form).find('div.submitSendEmail').hide();

        		$(sendEmail.form).append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');
				
				},
				success:function(response){

	                if(response.status==0){

		                if(response.emailToSendFrom==1)	{
			           	$(sendEmail.form).find("div.form-group").find("textarea#emailsSend").focus();
			           	$(sendEmail.form).find("textarea#emailsSend").parent().addClass("borderRequired");

				           	if(response.emailToSendFromBad==1){
	           					$(sendEmail.form).find("textarea#emailsSend").parent().find("div.alert-danger").remove();
								$(sendEmail.form).find("textarea#emailsSend").parent().append(alert_danger("",response.msg));
        						$(sendEmail.form).find("img.loading").remove();


				           	}else{

	           					$(sendEmail.form).find("textarea#emailsSend").parent().find("div.alert-danger").remove();
				       			if(!$(sendEmail.form).find("textarea#emailsSend").parent().find("div.alert-danger").get(0))
				            	$(sendEmail.form).find("textarea#emailsSend").parent().append(alert_danger("",response.msg));
        						$(sendEmail.form).find("img.loading").remove();
				        	
				           	}

			        	}
			        	else{

							$(sendEmail.form).find("textarea#emailsSend").parent().find("div.alert-danger").remove();
							$(sendEmail.form).find("textarea#emailsSend").parent().removeClass("borderRequired");
			        	}

			        	// error de SMTPEMAIL
		                if(response.emailSmtp==1){
		                $("#data > p").text("");
		                $("#data > p").text(response.msg);
		                $("#data").dialog("open");
			        	}

		            }
		            else {
		            	
					$("div.containerContSocial > fieldset > div.post_body").text(response.num_send_before_update);
		            $(sendEmail.form).get(0).reset();
		           	$(sendEmail.form).find("textarea#emailsSend").parent().find("div.alert-danger").remove();
		           	$(sendEmail.form).find("textarea#emailsSend").parent().removeClass("borderRequired");
        			$(sendEmail.form).find("img.loading").remove();
					$(sendEmail.form).append('<div class="alert alert-success">Enviado con exito</div>');
					

					setTimeout(function(){

					$(sendEmail.emailContainer).toggle("hide"); 
					$(sendEmail.form).find('div.submitSendEmail').show(); 
					$(sendEmail.form).find('div.alert-success').remove();

					}, 3000);

		            }

					$(sendEmail.form).find('input').prop( "disabled", false);
					$(sendEmail.form).find('textarea').prop( "disabled", false);

				} // hasta aqui el success


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

});
</script>
	<!--  fin email -->


	 <!-- boton compartir FACEBOOK -->
	 <?php if(!empty($value_for_before["url_facebook"]) ): ?>
	<div class="fb-share-button" data-href="<?php echo $value_for_before["url_facebook"] ?>" data-layout="button_count"> </div>
	<?php  endif;?>

	<?php  }?>
	<?php  endif;?>
</fieldset>
</div>



<!-- enviar -->
<!-- <div class="fb-send" data-href="https://www.facebook.com/permalink.php?story_fbid=1380802698886563;id=100008705374912" data-colorscheme="light"></div> -->

<script>
// (function(d, s, id) {
//   var js, fjs = d.getElementsByTagName(s)[0];
//   if (d.getElementById(id)) return;
//   js = d.createElement(s); js.id = id;
//   js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=796252563762722&version=v2.3";
//   fjs.parentNode.insertBefore(js, fjs);
// }(document, 'script', 'facebook-jssdk'));
</script>
