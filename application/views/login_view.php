
<?php $user_id=$this->session->userdata("user_id");?>


<?php if(empty($user_id)): ?>

<?php $data_nickname = array('name'=> 'nickname','id'=> 'nickname','type'=>'nickname','placeholder'=>'Nickname','class'=>'form-control','value'=> $this->input->post("nickname"),'autofocus'=>'autofocus'); ?>
<?php $data_password = array('name'=> 'password','id'=> 'password','type'=>'password','placeholder'=>'Contraseña','class'=>'form-control','value'=> $this->input->post("password") ); ?>
<?php $data_checkbox = array('name'=> 'remember','id'=> 'remember','type'=>'checkbox','value'=> $this->input->post("remember") ); ?>

<?php $attributes = array('role' => 'form','class'=>'Form5',"name"=>'Form5'); ?>

<div class="col-sm-9 col-md-8 col-lg-8">
	<div class="container well" id="sha">
		<div class="row">
					<div class="col-xs-12">
						<img src="<?php echo base_url(); ?>images	/interface/avatar.png" class="img-responsive" id="avatar">
					</div>
		</div>
		<?php echo form_open(base_url().'login/in/',$attributes);?>   
				<div class="form-group">

                    <?php echo form_input($data_nickname); ?>

				</div>
				<div class="form-group">

                    <?php echo form_password($data_password); ?>

				</div>

				<div class="btn btn-lg btn-primary btn-block submit">iniciar sesión</div>

				<div class="checkbox">
					<label class="checkbox">
				    <?php echo form_checkbox($data_checkbox); ?>
				        No cerrar sesión
				    </label>
				       <p class="help-block"><a href="<?php echo base_url().'login/recovery'; ?>">¿No puedes acceder a tu cuenta?</a></p>
				       <p class="help-block createAccount"><a href="<?php echo base_url().'login/create_account'; ?>">Crear una cuenta</a></p>
				</div>
		<?php echo form_close(); ?>
	</div>
</div>

<script>

function alert_danger(field,msg){
var error_html='<div class="alert alert-danger">'
                +'<a class="close" data-dismiss="alert" href="#">&times;</a>'
                +' <a href="javascript:void(0)" class="alert-link">'+field+'</a> '
                +'<p>'+msg+'.</p>'
                +'</div>'
                ;
    return error_html;
}

$(document).ready(function(){

$("form.Form5").keypress(function(e) {
    if(e.which == 13){
    $(this).blur();
    $(this).find("div.submit").focus().click();
    }

});

});

$(document).on("click","form.Form5 > div.submit",function(){

    var url="<?php echo base_url(); ?>",
        form="form.Form5",
        containerDiv=$(this).parent().parent(),
        nickname=$(this).parent().find("input#nickname").val(),
        password=$(this).parent().find("input#password").val(),
        registred_by="<?php echo $this->session->userdata('user_id'); ?>"
        ;

    $.ajax({
        url: url+'login/in',
        type: 'POST',
        dataType: 'json',
        data: {
            nickname: nickname,
            password:password,
            registred_by:registred_by,
        },
        beforeSend: function(response){

        $(form).find('input').prop("disabled","disabled"); 
        $(form).find('div.submit').hide(); 
        $(containerDiv).append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');

        },
        success: function(response){

            if(response.status){

            $(form).append('<div class="alert alert-success">'+response.msg+'</div>');
            $(form).find('div.form-group').removeClass('borderRequired');
            $(form).find('div.alert-danger').remove();
            $(form).find("div.alert-warning").remove();

            setTimeout(function(){
                
            $(form).find('div.alert-success').remove();
            $(containerDiv).find('img.loading').remove();    
            $(form).find('input').prop("disabled",""); 
            $(form).find('div.submit').show(); 
            $(form).get(0).reset();

            <?php if(!empty($_GET["redirect"])): ?>
            window.location.href="<?php echo decode_url($_GET['redirect']); ?>";
            <?php else: ?>
                <?php if(!empty($redirect)): ?>
            window.location.href="<?php echo decode_url($redirect); ?>";
                <?php else: ?>
            window.location.href="<?php echo base_url(); ?>";
                 <?php endif; ?>
            <?php endif; ?>

            },10);

            }else{


            $(form).find('input').prop("disabled",""); 
            $(form).find('div.submit').show(); 
            $(containerDiv).find('img.loading').remove();

            // validar nickname 
            if(response.nickname==1 || response.thereNickName==1){
            $(form).find('input#nickname').focus();
            $(form).find('input#nickname').parent().addClass("borderRequired");

            if(!$(form).find('input#nickname').parent().find("div.alert-danger").get(0))
            $(form).find('input#nickname').parent().append(alert_danger("",response.msg));
            
            return;
            }
            else { 
            $(form).find('input#nickname').parent().removeClass("borderRequired");
            $(form).find('input#nickname').parent().find("div.alert-danger").remove();
            }

            // validar password 
            if(response.password==1 || response.passwordBad==1){
            $(form).find('input#password').focus();
            $(form).find('input#password').parent().addClass("borderRequired");

            if(!$(form).find('input#password').parent().find("div.alert-danger").get(0))
            $(form).find('input#password').parent().append(alert_danger("",response.msg));
            
            return;
            }
            else { 
            $(form).find('input#password').parent().removeClass("borderRequired");
            $(form).find('input#password').parent().find("div.alert-danger").remove();
            }

            }  //fin else de errores

            $(containerDiv).find('img.loading').remove();
            return;

        }
    });
});
</script>

<?php endif; ?>