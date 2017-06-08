 <?php if(!empty($publication) ):
            foreach ($publication as $key_three_before => $value_three_before) {
            if (isset($value_three_before["comments"])):
            $c=0;

            $comments_amount=$value_three_before["comments_amount"]?:"";
            foreach ($value_three_before["comments"] as $key_three => $value_three) {
            $c++;
        ?>

        <!-- Comment -->

        <div class="media" data-pcmt="<?php echo base64_encode($value_three['id_comment']); ?>">
            <a class="pull-left" href="#">
                <?php if(!$value_three["picture"]): ?>
                <img class="media-object" src="<?php echo base_url().'images/interface/user.png' ?>" alt="">

                <?php else: ?>
                <img class="media-object" src="<?php base_url().'images/user/'.$value_for[user_id].'/'.$value_for[img] ?>" alt="">
                <?php endif; ?>
            </a>
            <div class="media-body">
                <div class="commentId"><?php echo $value_three["id_comment"] ?: ""; ?></div>
                <h4 class="media-heading">
                    <span class="<?php echo $value_three['registred_name'] ?'name_comment_blue':'name_comment'; ?>">
                    <?php echo ($value_three["registred_name"] ?: ($value_three["name_comment"]?:"Anónimo")); ?>
                    </span>
                    <small title="<?php echo $value_three["registred_on_comment_title"] ?: "&nbsp;"; ?>">
                    <?php echo $value_three["registred_on_comment"] ?: "&nbsp;"; ?>
                    </small>

                    <?php if(!empty($value_three["own"])): ?>
                    <!-- botones de edicion comentarios -->
                    <div class="comment" data-idcomment="<?php echo  $value_three["id_comment"] ?encode_id($value_three["id_comment"]): ""; ?>" >

                    <div class="edit_small"></div>
                    <div class="delete_small"></div>

                    </div>

                    <?php endif; ?>
                </h4>

                <div class="comment in_form_comment">
                <?php echo $value_three["comment"] ?: "&nbsp;"; ?>
                </div>
                
                <!-- Responder -->

                <div class="responseComment">
                    <a href="javascript:void(0)">
                    Responder
                    </a>

                    <div id="comment" class="conteiner_likes" data-idcomment="<?php echo  $value_three["id_comment"] ?base64_encode($value_three["id_comment"]): ""; ?>" >

                    <div class="like">
                    <div class="gokuLike"></div>
                    <span class="Likes green_font">(<?php echo $value_three["likes"] ?: "0"; ?>)</span>
                    </div>

                    <div class="Nolike">
                    <div class="gokuNoLike"></div>
                    <span class="NoLikes green_font">(<?php echo $value_three["not_likes"] ?: "0"; ?>)</span>
                    </div>

                    </div>

                      
                    <div class="responseCommentToggle">  
                     <div class="data"></div>   
                    </div>
                </div>
                <!--  si tiene respuestas este comentario-->
                <div class="nestedComment">
                <?php if (isset($value_three["comments_response"])): ?>
                    
                 <?php  echo$this->load->view('nested_comment',$value_three,true);?>

                <?php endif ?>
                </div>

            </div>

        </div>

        <?php } ?>
        <?php endif; ?>
        <!-- el total de comentarios  -->
        <?php if(isset($comments_amount) and isset($c)): ?>
        <?php if($comments_amount>$c): ?>
        <div class="facebook_style more_comments" id="facebook_style"> 
            <a id="" href="javascript:void(0)" class="load_more">
                <img src="<?php echo base_url(); ?>images/interface/comments.png" /> <?php echo$comments_amount-$c; ?> respuestas <?php echo $value_three["registred_on_comment"] ?: "&nbsp;"; ?>
            </a> 
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <?php }
        endif;
        ?>

        <?php 
        /*
        sacar el id encriptado de respuesta o comentario que viene de 
        pcmt:id comentario 
        prmt:id respuesta 
        */
        if(!empty($_GET["pcmt"]))
        $pcmt=$this->security->xss_clean($_GET["pcmt"]);

        if(!empty($_GET["prmt"]))
        $prmt=$this->security->xss_clean($_GET["prmt"]);

         ?>
         <script>
         <?php if(!empty($_GET["pcmt"])): ?>
         var pcmt="<?php echo $pcmt; ?>";
         if(pcmt){
         $("#postedComments > div.media").each(function(i){

            if(pcmt==$(this).data("pcmt")){
                $(this).addClass('borderRequired');

                var thisss=$(this);

                setTimeout(function(){
                $(thisss).attr("tabindex",-1).focus();
                }, 1000);
                return false;

            }
         });
        }
         <?php endif; ?>

         <?php if(!empty($_GET["prmt"])): ?>

         var prmt="<?php echo $prmt; ?>";

        if(prmt){
         $(".nestedComment > div.media").each(function(i){

            if(prmt==$(this).data("prmt")){

                $(this).addClass('borderRequired');

                var thisss=$(this);

                setTimeout(function(){
                $(thisss).attr("tabindex",-1).focus();
                }, 1000);
                return false;

            }
         });
        }
         <?php endif; ?>

         </script>