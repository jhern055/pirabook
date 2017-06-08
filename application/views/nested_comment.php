<!--  si tiene respuestas este comentario-->
<?php if(!empty( $comments_response) ):
      $c=0;

      foreach ($comments_response as $key_for => $value_for) {
      $c++;  
?>

<!-- Nested Comment -->
<div class="media" data-prmt="<?php echo base64_encode($value_for['id_comment_response']); ?>">
    <a class="pull-left" href="#">
        <?php if(!$value_for["picture"]): ?>
        <img class="media-object" src="<?php echo base_url().'images/interface/user.png' ?>" alt="">
        
        <?php else: ?>
        <img class="media-object" src="<?php base_url().'images/user/'.$value_for[user_id].'/'.$value_for[img] ?>" alt="">
        <?php endif; ?>
    </a>
    <div class="media-body">
        <h4 class="media-heading">
        <span class="<?php echo $value_for['registred_name'] ?'name_comment_blue':'name_comment'; ?>">
        <?php echo ($value_for["registred_name"] ?:($value_for["name_comment_response"]?: "Anónimo" )); ?>
        </span>
            <small title="<?php echo $value_for["registred_on_comment_response_title"] ?: "&nbsp;"; ?>">
            <?php echo $value_for["registred_on_comment_response"] ?: "&nbsp;"; ?>    
            </small>

            <?php if(!empty($value_for["own"])): ?>
            <div class="response" class="conteiner_likes" data-idcomment="<?php echo  $value_for["id_comment_response"] ?encode_id($value_for["id_comment_response"]): ""; ?>" >

            <div class="edit_small"></div>
            <div class="delete_small"></div>

            </div>
            <?php endif; ?>
            

        </h4>

        <div class="response in_form_response">
        <?php echo $value_for["response"] ?: "&nbsp;"; ?>    
        </div>

    </div>

            <div id="response" class="conteiner_likes" data-idcomment="<?php echo  $value_for["id_comment_response"] ?base64_encode($value_for["id_comment_response"]): ""; ?>" >

            <div class="like">
            <div class="gokuLike"></div>
            <span class="Likes green_font">(<?php echo $value_for["likes"] ?: "0"; ?>)</span>
            </div>

            <div class="Nolike">
            <div class="gokuNoLike"></div>
            <span class="NoLikes green_font">(<?php echo $value_for["not_likes"] ?: "0"; ?>)</span>
            </div>

            </div>
</div>
<!-- End Nested Comment -->
<?php } 
      endif;
?>
    <?php if($comments_response_amount>$c): ?>
    <!-- ver mas -->
    <div class="facebook_style more_comments_response" id="facebook_style"> 
        <a id="" href="javascript:void(0)" class="load_more_response">
           <img src="<?php echo base_url(); ?>images/interface/comments.png" />  <?php echo$comments_response_amount-$c; ?> respuestas <?php echo $value_for["registred_on_comment_response"] ?: "&nbsp;"; ?> 
        </a> 
    </div>
    <?php endif; ?>