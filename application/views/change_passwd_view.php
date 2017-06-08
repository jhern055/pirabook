<?php 
        $pass_tmp=$this->uri->segment(3);
        $id_user=$this->uri->segment(4);
        // $id_user=decode_url($this->uri->segment(4));

 ?>
<?php $data_password = array('name'=> 'password','id'=> 'password','type'=>'password','placeholder'=>'Establece tu contraseña','class'=>'form-control','value'=> $this->input->post("password") ); ?>
<?php $data_password_confirm = array('name'=> 'password_confirm','id'=> 'password_confirm','type'=>'password_confirm','placeholder'=>'Repita la contraseña','class'=>'form-control','value'=> $this->input->post("password_confirm") ); ?>

<?php $attributes = array('role' => 'form','class'=>'Form6',"name"=>'Form6'); ?>

<div class="col-sm-9 col-md-8 col-lg-8">
	<div class="container well" id="sha">
		<div class="row">
					<div class="col-xs-12">
                    <p><h2>Restablecer contraseña</h2></p>
					</div>
		</div>
        <div class="mandatory-fields-notice ">
        Todos los campos marcados con <span> son obligatorios</span>
        </div>

        <?php echo form_open(base_url().'login/reset_passwrd/',$attributes);?>   

				<div class="form-group">
                <label for="password" class="required">Contraseña</label>

                    <?php echo form_password($data_password); ?>

				</div>
                <div class="form-group">
                <label for="password" class="required">Confirmar</label>

                    <?php echo form_password($data_password_confirm); ?>

                </div>

				<div class="btn btn-lg btn-success btn-block submit">cambiar contraseña</div>
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

    $("form.Form6").keypress(function(e){

    if(e.which == 13){

    $(this).blur();
    $(this).parent().find("div.submit").focus().click();

    }

    });

});

$(document).on("click","form.Form6 > div.submit",function(){

    var url="<?php echo base_url(); ?>",
        form=$(this).parent(),
        containerDiv=$(this).parent().parent(),
        id_user="<?php echo (!empty($id_user)?$id_user:0 ); ?>",
        pass_tmp="<?php echo (!empty($pass_tmp)?$pass_tmp:0 ); ?>",

        password=$(this).parent().find("input#password").val(),
        password_confirm=$(this).parent().find("input#password_confirm").val()
        ;

    $.ajax({
        url: url+'login/reset_passwrd',
        type: 'POST',
        dataType: 'json',
        
        data: {
            password:password,
            password_confirm:password_confirm,
            id_user:id_user,
            pass_tmp:pass_tmp,
        },
        beforeSend: function(response){
        
        $(form).find('input').prop("disabled","disabled"); 
        $(form).find('div.submit').hide(); 
        $(containerDiv).append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');

        },
        success: function(response){

            if(response.status){

            $(form).append('<div class="alert alert-info">'+response.msg+'</div>');
            $(form).find('div.form-group').removeClass('borderRequired');
            $(form).find('div.alert-danger').remove();
            $(form).removeClass('borderRequired');
            $(form).find("div.alert-warning").remove();

            setTimeout(function(){
                
            $(form).find('div.alert-success').remove();
            $(containerDiv).find('img.loading').remove();    
            $(form).find('input').prop("disabled",""); 
            $(form).find('div.submit').show(); 
            $(form).get(0).reset();
            window.location.href="<?php echo base_url(); ?>";

            },2500);


            }else{

            $(form).find('div.alert-danger').remove();
            $(form).find("div.alert-warning").remove();
            
            $(form).find('input').prop("disabled",""); 
            $(form).find('div.submit').show(); 
            $(containerDiv).find('img.loading').remove();

            if(response.password_confirm==1){
            $(form).find('input#password_confirm').focus();
            $(form).find('input#password_confirm').parent().addClass("borderRequired");
            $(form).find('input#password_confirm').tooltip();

            if(!$(form).find('input#password_confirm').parent().find("div.alert-danger").get(0))
            $(form).find('input#password_confirm').parent().append(alert_danger("",response.msg));
            
            return;
            }
            else { 
            $(form).find('input#password_confirm').parent().removeClass("borderRequired");
            $(form).find('input#password_confirm').parent().find("div.alert-danger").remove();
            }

            if(response.password_not_equal==1){
            $(form).find('input#password').focus();
            $(form).find('input#password').parent().addClass("borderRequired");
            $(form).find('input#password_confirm').parent().addClass("borderRequired");

            if(!$(form).find('input#password_confirm').parent().find("div.alert-danger").get(0))
            $(form).find('input#password_confirm').parent().append(alert_danger("",response.msg));
            
            return;
            }
            else { 
            $(form).find('input#password_confirm').parent().removeClass("borderRequired");
            $(form).find('input#password_confirm').parent().find("div.alert-danger").remove();
            }
            
            if(response.password==1){
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

            } //fin del else

            return;

        } //success }

    });
});
</script>