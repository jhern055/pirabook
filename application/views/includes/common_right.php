            <!-- Blog Sidebar Widgets Column -->
<div class="col-sm-9 col-md-8 col-lg-8" style="display:none" id="div_search">
<div id="publications_divs_search"></div>
<div id="things_content_search"></div>
</div>

<!-- cuando selecciona una categoria -->
<!-- class=" col-md-10 col-lg-10" -->
<div class="col-xs-13 col-sm-13 col-sm-9 col-md-8 col-lg-8" style="display:none" id="div_category">
<div id="publications_divs_category"></div>
<div id="things_content_category"></div>
</div>

<?php

if(!empty($_POST["search"]))
$search=strip_tags($_POST["search"]);
$data_seach = array('name'=> 'search','id'=> 'search','title'=> 'buscar','placeholder'=> 'Que andas buscando?','class'=> 'form-control','tabindex'=> 1);
(empty($search)? "": $data_seach=array_merge($data_seach,array("value"=> $search)) ); 

?>

<!-- <div style="margin-top:58px;"></div> -->
            <div class="col-sm-3 col-md-3 col-lg-3">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Buscar</h4>
                    <div class="input-group">
                    <?php $attributes = array('role' => 'form','class'=>'FormSearch',"name"=>'FormSearch',"method"=>"POST"); ?>
                    <?php
                    if(!empty($id)):
                    $hidden = array("publication_id"=>$id);
                    else:
                    $hidden="";
                    endif;
                    ?>

                        <?php echo form_open(base_url(),$attributes,$hidden); ?>
                        <?php echo form_input($data_seach); ?>
                        <span class="input-group-btn">

                            <div class="btn btn-default submit button_search">
                                
                                <span class="glyphicon glyphicon-search"></span>
                            </div>

                        </span>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Donativos -->
                <?php if($_SERVER["REMOTE_ADDR"]!="127.0.0.1"): ?>
                <div class="well" >
                    <div class="row">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/es_XC/MX/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
<img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
</form>
                
                    </div>
                </div>
                <?php endif; ?>
                <!-- <div class="well" > -->
            <!-- Donativos PRUEBA -->
                    <!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> -->

                        <!-- Identify your business so that you can collect the payments. -->
                        <!-- <input type="hidden" name="business"value="pirabook1-facilitator@gmail.com"> -->

                        <!-- Specify a Donate button. -->
                        <!-- <input type="hidden" name="cmd" value="_donations"> -->

                        <!-- Specify details about the contribution -->
                        <!-- <input type="hidden" name="item_name" value="Amigos de pirabook donativo"> -->
                        <!-- <input type="hidden" name="item_number" value="Fall Cleanup Campaign"> -->
                        <!-- <input type="hidden" name="currency_code" value="USD"> -->

                        <!-- Display the payment button. -->
                        <!-- <input type="image" name="submit" border="0"src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif"alt="PayPal - The safer, easier way to pay online"> -->
                        <!-- <img alt="" border="0" width="1" height="1"src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" > -->

                    <!-- </form> -->

                <!-- </div> -->

                <!-- Megusta la pagina -->
                <div class="well">
                   
                    <div class="fb-like-box" data-href="https://www.facebook.com/pages/Pirabook/1650210071872986?pnref=lhc" data-width="300" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
                    
                    <!-- seguir -->
                    <div class="fb-follow" data-href="https://www.facebook.com/pages/Pirabook/1650210071872986?pnref=lhc" data-colorscheme="light" data-layout="button_count" data-show-faces="false"></div>
                        <div id="fb-root"></div>

                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Categorías</h4>

                        <?php if($publications_categories){ ?>
                        <?php foreach ($publications_categories as $key => $value) { ?>
                        <div class="row category">
                         <!-- <div class="col-lg-6"> -->
                       
                            <ul class="list-unstyled">
                                
                                <li data-id_category="<?php echo $value->id; ?>">
                                <img src="<?php echo base_url().'images/interface/categories/'.$value->photo ?>">
                                    <?php echo $value->name; ?> (<?php echo $value->publications_amount; ?>)
                                    <!-- <a href="#" data_id_category="<?php echo $key; ?>"></a>  -->
                                </li>
                            </ul>

                        <!-- </div> -->
                        </div>
                    <!-- /.row -->
                        <?php } ?>
                        <?php } ?>

                </div>

                <?php if($_SERVER["REMOTE_ADDR"]!="127.0.0.1"): ?>
                <div class="well">
                    <div class="row">
                        <!-- GOOGLE -->
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- AnuncioPIrabook -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:300px;height:600px"
                             data-ad-client="ca-pub-7361198353458719"
                             data-ad-slot="7085236580"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>                   
                    </div>
                </div>
                <?php endif; ?>

                <!-- Side Widget Well -->
<!--                 <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div> -->

            </div>

        </div>
        <!-- /.row -->        <hr>
        <!-- esto lo uso para mostrar un mensaje  -->
        <div id="dialog" title="Mensaje">
        <p></p>
        </div>

        <div id="validation" title="El campo está vacío">
        <p></p>
        </div>
        
        <script>
        $("#dialog").dialog({
            autoOpen: false,
            width: 400,
            buttons: [
                {
                    text: "Ok",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }
            ]
        });

        $("#validation").dialog({
            autoOpen: false,
            width: 400,
            buttons: [
                {
                    text: "Ok",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }
            ]
        });

        </script>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; <?php echo base_url(); ?> 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>
       

 
    </div>
    <!-- /.container -->

    <!-- search -->
<script>
button_search=new Object();
button_search.input="form.FormSearch > span.input-group-btn > div.button_search";
button_search.input_text_search="form.FormSearch > input#search";

$(document).ready(function(){

    $(button_search.input_text_search).keypress(function(e){
         // e.preventDefault();
        if(e.which == 13){
            $(this).blur();
            $(button_search.input).focus().click();
            return false;
        }
    });

});

$(document).on("click",button_search.input,function(){
 // quite la validacion de la paginacion en el search 
 // url: "<?php echo base_url().'home/show_ajax/'.$this->session->userdata('things_publications_start_row'); ?>",

 var input_search=$(this).parent().parent().find('input#search').val(),
        data_array=[],
        order_by="ids",
        div_search=$("div#div_search")
        ;

        // esconder los divs del main 
        hide_divs();

$(div_search).show();
        data_array={
            input_search: input_search,
        };

     // $.ajax({

     //    type: "POST",
     //    data: data_array,
     //    url: "<?php echo base_url().'home/show_ajax/' ?>",
     //    beforeSend:function(html){
     //    },
     //    success: function(html) {

     //    $('div#things_content_search').html(html);

     //    }

     // });

    $.ajax({

        type: "POST",
        data: data_array,
        url: "<?php echo base_url().'home/show_ajax_div/' ?>",
        beforeSend:function(html){
            
        },
        success: function(html) {
        $('div#publications_divs_search').html(html);

        }

     });

    $("form.FormSearch > input#search").focus();

});
</script>    

<script>

$(document).on("click","div.category > ul.list-unstyled > li",function(){

var id_category =$(this).data("id_category"),
        div_category=$("div#div_category"),
        div_search=$("div#div_search")
    ;
    
    hide_divs();
    $(div_search).hide();
    $(div_category).show();

     $.ajax({

        type: "POST",
        data: {id_category:id_category},
        url: "<?php echo base_url().'home/show_ajax/' ?>",
        beforeSend:function(html){
        },
        success: function(html) {

        $('div#things_content_category').html(html).focus();

        }

     });

    $.ajax({

        type: "POST",
        data: {id_category:id_category},
        url: "<?php echo base_url().'home/show_ajax_div/'; ?>",
        beforeSend:function(html){
            
        },
        success: function(html) {

        $('div#publications_divs_category').html(html).focus();

        }

     });


});
</script>

</body>

</html>