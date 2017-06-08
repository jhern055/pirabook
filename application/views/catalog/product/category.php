<link href="<?php echo base_url(); ?>css/theme.css" rel="stylesheet">
<style type="text/css">
p{

	position:inherit;
}
.product-desc {margin-left: 5px; margin-right: 5px; 

 }
 span.product-price{
 	display: inline-block; 
    border-top-width: 1px;
    border-bottom-width: 1px;
    border-style: solid;
    border-color: rgb(228, 228, 228);
    padding-top: 5px;
    padding-right: 5px;
    padding-bottom: 5px;
    padding-left: 5px;
    display: inline-block;
 }

div.content_price{
	margin-top: 10px;
	text-align: center;
	margin-bottom:5px;
}
button#addCart{
	/*text-align: center;*/
	margin-left: 5px; margin-right: 5px;
}
</style>
<div class="col-lg-12 col-sm-12 col-md-12">
    <?php if (!empty($products_category)) { ?>
<section id="wdg_popular_games" class="wdg_popular_games grid grid-ui ">
<span><?php echo (!empty($text_pagination)?$text_pagination:0) ?> </span>
<ul class="grid-row col-2 col-s-4 col-m-4 col-l-6">
    <?php foreach ($products_category as $key => $value) { ?>
        <li class="grid-col">
            <div class="tile" title="<?php echo $value['name']; ?>">
                <!-- Imagen -->
                <div class="tile-thumbnail">
                    <a href="<?php echo base_url().'home/publication/'.$value["id"]; ?>" title="<?php echo $value['name']; ?>">
                    <img src="<?php echo base_url().'images/'.$value["image"]; ?>" alt="">
                    </a>
                </div>
				
				<h5 itemprop="name"> 
					<a class="product-name" href="https://demo4leotheme.com/prestashop/leo_digital/index.php?id_product=22&amp;controller=product&amp;id_lang=1" title="Donec magna diam" itemprop="url"> Donec magna diam </a>
				</h5>

				<p class="product-desc" itemprop="description"> 
                     <?php echo (!empty($value['description'])?cutText($value['description'],10):""); ?> 
				</p>

				<div class="content_price"> 
					<span class="price product-price"> <?php echo (!empty($value['price'])?"$".$value['price']:""); ?> </span> 
					<!-- <span class="old-price product-price"> $450.00 </span>  -->
					<!-- <span class="price-percent-reduction">-20%</span> -->
				</div>
<!-- 				<div class="product-flags">
					<span class="discount">Reduced price!</span>
				</div> -->
	
			<span>
				<button type="button" id="addCart" data-idrecord="<?php echo encryptStringArray($value['id']); ?>" class="btn btn-default cart divider">
					AÑADIR AL CARRITO
					<i class="fa fa-shopping-cart"></i>
				</button>

			</span>

<!--         <div id="product_payment_logos">
          <div class="box-security"><h5 class="product-heading-h5"></h5>
          <img src="<?php //echo base_url(); ?>images/interface/payment-logo.png" alt="">
          </div>
        </div>   -->    
                <!-- Title -->
                <!-- <div class="tile-title"> -->
<!--                     <a href="<?php //echo base_url().'home/publication/'.$value["id"]; ?>" title="<?php echo $value['name']; ?>">
                    <?php //echo $value['description'] ?>
                    </a>

                </div> -->
                <?php
                $c=1;
                // if(!empty($value["links"]))
                // foreach ($value["links"] as $key => $rowLink) { ?>
                <div class='tile-download'>
                    <?php //echo (!empty($rowLink['link'])? anchor($rowLink['link'],"Descarga (".$c++.")"," style='font-color=blue;' target='_blank'"):"") ?>
                </div>
               <?php // } ?>          
            </div>
        </li>
    <?php } ?>
    <div class="button-group">
    <p><?php echo $pagination;?></p> 
    </div>

        <div id="product_payment_logos">
          <div class="box-security"><h5 class="product-heading-h5"></h5>
          <img src="<?php echo base_url(); ?>images/interface/payment-logo.png" alt="">
          </div>
        </div>    

</ul>

</section>
    <?php } ?>	
</div>

<script>
$(document).on("click","button#addCart",function(){
    var idrecord=$(this).data("idrecord");
        // quantity_wanted=$(this).parent().parent().parent().parent().find("div.product_attributes > p#quantity_wanted_p > input#quantity_wanted").val();
    $.ajax({
            url: '<?php echo base_url(); ?>cart/addToCart',
            type: 'POST',
            dataType: 'json',
            data: {
                idrecord: idrecord,
                qty: 1,
            },
            beforeSend: function(response) {
            },
            success: function(response) {

                // $("button#textDetailCart").html(response.textDetailCart);
                $("div.dropdown").html(response.cartHeader);
                if(!$('div.dropdown-content').is(':visible')){
                }


//                 setTimeout(// function(){//                 $('div.dropdown-content').click(); // } //, 2000); // window.location.href="<?php echo base_url(); ?>cart";
            }
    });
});

</script>
