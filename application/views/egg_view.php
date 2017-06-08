            <?php

            $c=0;
            $notifications_amount=0;
            // pr($notifications_data);

            if(!empty($notifications_data))
            foreach ($notifications_data["publications"] as $key => $value) {

                if(!empty($notifications_data["notifications_amount"]))
                $notifications_amount=$notifications_data["notifications_amount"];

                if(!is_numeric($key))
                    continue;
            $c++;

                $comment=false;
                $response=false;

                if(!empty($value["id_comment"]) and !empty($value["id_response"])):
                $response=true;
                else:
                    if(!empty($value["id_comment"])):
                    $comment=true;
                    endif; 
                endif;

                ?>
                <?php if($response): ?>
                <a href="<?php echo  base_url().'home/publication/'.$value['id_publication'].'/?prmt='.base64_encode($value['id_response']);?>">
                <?php else: ?>

                    <?php if($comment): ?>
                <a href="<?php echo  base_url().'home/publication/'.$value['id_publication'].'/?pcmt='.base64_encode($value['id_comment']);?>">
                    <?php endif; ?>

                <?php endif; ?>
                <div class="comment_ui">

                <div class="comment_text">
                    
                    <div  class="name_text">
                    <span>
                    <?php 
                        if($response){
                            
                            if($value["comment_response_nickname"])
                        echo $c."-".$value["comment_response_nickname"];
                            else if($value["comment_response_nickname"])
                        echo $c."-".$value["name_comment_response"];
                            else
                        echo $c."-"."Anónimo";
                            
                        }
                        else{

                            if($comment){

                                if($value["comment_nickname"])
                            echo $c."-".$value["comment_nickname"];
                                else if($value["comment_nickname"])
                            echo $c."-".$value["name_comment"];
                                else
                            echo $c."-"."Anónimo";
                            }

                        }

                     ?>    
                    </span>
           
                    <?php if($response): ?>
                    respondió
                    <?php else: ?>
                        <?php if($comment): ?>
                        comento
                        <?php endif; ?>
                    <?php endif; ?>:

                    </div>

                    <div  class="comment_actual_text">

                    <?php if($response): ?>
                    <?php echo $value["response"];?>
                    <?php else: ?>

                        <?php if($comment): ?>
                        <?php echo $value["comment"]; ?>
                        <?php endif; ?>

                    <?php endif; ?>

                    </div>

                    <div class="title">
                    <span class="title_publication"> en:</span>
                    <?php echo $value["title_publication"]; ?> 
                    </div>
                </div>

                </div>
                </a>
                <?php } ?>

                <?php if($notifications_amount > $c): ?>
                <div class="view_more_comments" id="facebook_style" data-amount_show="<?php echo base64_encode($c);?>"  style="border:1px solid #D8DFEA; background-color: #EDEFF4; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px; position: relative; z-index: 100; padding:8px; cursor:pointer;">
                    
                        <?php echo $c; ?> 
                        Comentarios ver más 
                </div>
                <?php endif; ?>