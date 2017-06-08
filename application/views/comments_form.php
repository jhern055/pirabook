<?php $this->load->helper('security'); ?>
<?php $user_id=$this->session->userdata("user_id"); ?>
        <div class="well">
        <span style="color:#F00 "><?php echo validation_errors(); ?></span>

<!-- campos para el form  -->
<?php $data_name = array('name'=> 'name','id'=> 'name','type'=> 'name','placeholder'=> 'Nombre:','class'=> 'form-control','value'=> $this->input->post("name"));?>
<?php $data_email = array('name'=> 'email','id'=> 'email','type'=> 'email','placeholder'=> 'Escribe tu correo:','class'=> 'form-control','value'=> $this->input->post("email"));?>
<?php $data_comment = array('name'=> 'comment','id'=> 'comment','type'=> 'comment','placeholder'=> 'Escribe un comentario...','class'=> 'form-control','rows'=> '3','value'=> $this->input->post("comment"));?>
<?php $data_captcha = array('name'=> 'captcha','id'=> 'captcha','type'=> 'name','placeholder'=> 'indroduce captcha','class'=> 'form-control','value'=> $this->input->post("captcha"));?>

<!-- estos vienen al actualizar el comentario :) -->

<?php (empty($comment_or_response)? "": $data_comment=array_merge($data_comment,array("value"=> $comment_or_response)) ); ?>

<?php $data_submit = array('name'=> 'submit','id'=> 'submit','class'=> 'btn btn-primary','content' => 'Enviar');?>

            <?php $attributes = array('role' => 'form','class'=>'Form1',"name"=>'Form1'); ?>
            <?php $publication_id = $this->uri->segment(3)?:$_POST["publication_id"]; ?>

            <!-- inputs HIDE -->
            <?php $hidden = array(
                            "publication_id"=>$this->security->xss_clean($publication_id)
                            );
                             ?>

                             <!-- campos que sirven para actualizar un comentario o respuesta -->
<?php (empty($type)? "": $hidden=array_merge($hidden,array("type"=> $type)) ); ?>
<?php (empty($id_com_resp)? "": $hidden=array_merge($hidden,array("id_com_resp"=> encode_id($id_com_resp) )) ); ?>

            <?php if(!empty($_POST["commentToResponse"])): ?>
            <?php $commentToResponse = array("commentToResponse"=>$this->security->xss_clean($_POST["commentToResponse"]) ); ?>
            <?php $hidden=array_merge($hidden,$commentToResponse); ?>
            <?php endif; ?>


             <?php echo form_open(base_url().'home/publication/'.$this->uri->segment(3),$attributes,$hidden); ?>   
                
                <?php if(empty($user_id) ): ?>
                <div class="form-group">
                <label for="name">Nombre:</label>
                    <?php echo form_input($data_name); ?>
                </div>

                <div class="form-group">
                <label for="email">Email:</label>
                    <div class="input-group">
                    <div class="input-group-addon">@</div>
                    <?php echo form_input($data_email); ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="form-group">
                <label for="comment">Comentario:</label>
                    <?php echo form_textarea($data_comment); ?>
                </div>
                <div class="form-group" class="captcha">
                <label for="captcha">Captcha:</label>
                    <?php 
                    echo '<img src="' . $captcha['image_src'] . '" alt="CAPTCHA code">';
                     ?>
                    <?php echo form_input($data_captcha);?>

                </div>
                    <?php echo form_button($data_submit); ?>
            <?php echo form_close(); ?>
        </div>

<script language="javascript">
// $(document).ready(function() {

//   $('textarea#comment').keypress(function(e){
//     // e.preventDefault();
//     // alert(e.which);
//     if(e.which == 13){
//     $(this).blur();
//     $(this).parent().parent().find("button#submit").focus().click();
//     }
//   });

// });
</script>