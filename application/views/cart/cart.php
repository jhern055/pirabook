<!-- traer los productos del carrito -->
<?php $cartItems=$this->cart->contents(); ?>
<?php if(empty($cartItems)): ?>
<?php redirect(""); ?>
<?php endif; ?>
<?php $totalCart=$this->cart->total(); ?>
<?php 
// pr($cartItems);

 ?>
 <script type="text/javascript">
var url="<?php echo base_url(); ?>";

 </script>
<div class="container">
    <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width:50%">Producto</th>
                            <th style="width:10%">Precio</th>
                            <th style="width:8%">Cantidad</th>
                            <th style="width:22%" class="text-center">Subtotal</th>
                            <th style="width:10%"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if(!empty($cartItems)){ ?>
                        <?php foreach ($cartItems as $key => $value) { ?>
                        <tr>
                      
                            <td data-th="Producto">
                                <div class="row">
                                    <div class="col-sm-2 hidden-xs">
                                        <a href="<?php echo base_url().'home/publication/'.$value["id"]; ?>" target="_blank">
                                        <img src="<?php echo base_url()."images/".$value["image"]; ?>" alt="..." class="img-responsive"/>
                                        </a>
                                    </div>

                                    <div class="col-sm-10">
                                        <h4 class="nomargin">
                                            <a href="<?php echo base_url().'home/publication/'.$value["id"]; ?>" target="_blank">
                                            <?php echo $value["name"]; ?>
                                            </a>
                                        </h4>
                                        <!-- <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p> -->
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price"><?php echo (!empty($value["price"])?"$".number_format($value["price"],0,"",""):""); ?></td>
                            <td data-th="Quantity">
                                <input type="text" 

                                data-idrecord="<?php echo encryptStringArray($value["id"]); ?>" 
                                data-price="<?php echo encryptStringArray($value["price"]); ?>"
                                data-iditemcart="<?php echo encryptStringArray($value["rowid"]); ?>"

                                class="form-control text-center qty" value="<?php echo $value["qty"]; ?>">
                            </td>
                            <td data-th="Subtotal" class="text-center subtTotalItem"><?php echo "$".number_format($value["subtotal"],0,"",""); ?></td>
                            <td class="actions" data-th="">
                                <span id="more" 
                                data-idrecord="<?php echo encryptStringArray($value["id"]); ?>" 
                                data-price="<?php echo encryptStringArray($value["price"]); ?>"
                                data-iditemcart="<?php echo encryptStringArray($value["rowid"]); ?>"
                                 ></span>
                                <span id="less"
                                data-idrecord="<?php echo encryptStringArray($value["id"]); ?>" 
                                data-price="<?php echo encryptStringArray($value["price"]); ?>"
                                data-iditemcart="<?php echo encryptStringArray($value["rowid"]); ?>"
                                ></span>
                                <span id="delete"
                                data-iditemcart="<?php echo encryptStringArray($value["rowid"]); ?>"

                                ></span>
                            </td>
                        </tr>
                            <?php } ?>

                            <!-- TOTALES -->
            <tr>
            <td class="text-right right">&nbsp;</td>
            <td class="text-right right">&nbsp;</td>
            <td class="text-right right">&nbsp;</td>
            <td class="text-right right"><strong>Sub-Total</strong></td>


            <td class="text-right right subTotalCart"><?php echo (!empty($subTotalCart)?"$".number_format($subTotalCart,2,".",","):"") ?></td>
            </tr>
            
            <tr>
            <td class="text-right right">&nbsp;</td>
            <td class="text-right right">&nbsp;</td>
            <td class="text-right right">&nbsp;</td>                
            <td class="text-right right"><strong>Total</strong></td>
            <td class="text-right right totalCart"><?php echo (!empty($totalCart)?"$".number_format($totalCart,2,".",","):"") ?></td>
            </tr>

            <tr>

                <td class="text-right right">
                    <a class="button continue" href="<?php echo base_url();?>">
                        Continuar Comprando
                    </a>
                </td>
            <td class="text-right right">&nbsp;</td>
            <td class="text-right right">&nbsp;</td>
            <td class="text-right right">&nbsp;</td>
                <td class="text-right right">
                    <a class="button buy" href="<?php echo base_url().'checkout';?>">
                    Comprar
                    </a>
                </td>
            </tr>       
                            <!-- </TOTALES> -->

                            <?php } ?>

                    </tbody>

    </table>
</div>
<style type="text/css">
.table{
background-color: #4A366B;

}
.table>tbody>tr>td, .table>tfoot>tr>td{
    vertical-align: middle;
}
@media screen and (max-width: 600px) {
    table#cart tbody td .form-control{
        width:20%;
        display: inline !important;
    }
    .actions .btn{
        width:36%;
        margin:1.5em 0;
    }
    
    .actions .btn-info{
        float:left;
    }
    .actions .btn-danger{
        float:right;
    }
    


    table#cart thead { display: none; }
    table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
    table#cart tbody tr td:first-child a{ color: #fff; }
    table#cart tbody tr td:first-child { background: #333; color: #fff; }
    table#cart tbody td:before {
        content: attr(data-th); font-weight: bold;
        display: inline-block; width: 8rem;
    }

    

    table#cart tfoot td .btn{display:block;}
    h4.nomargin > a{
    color: white;
    }
    
}

    .table-hover > tbody > tr{
        background-color: #f5f5f5;
    }
    .table-hover > tbody > tr:hover{
        background-color: #f2e6ff;
    }    
    table#cart thead > tr >th {color: #fff; }
    table#cart tfoot > tr >td.text-center >strong {color: #fff; }
    
    table#cart{margin-top: 10px !important; } 
    /*table#cart tbody td.actions > */
    span#more{
    background: url("images/interface/more.png");
    background-size: 16px 16px;
    background-repeat: no-repeat;
    /*background-color: #fff;*/
    height: 16px;
    width: 16px;
    display: block;
    float: left;
    margin-left: 10px;
    cursor: pointer;
    }
    span#less{
    background: url("images/interface/less.png");
    background-size: 16px 16px;
    background-repeat: no-repeat;
    /*background-color: #fff;*/
    height: 16px;
    width: 16px;
    display: block;
    float: left;
    margin-left: 10px;
    cursor: pointer;
    }
    span#delete{
    background: url("images/interface/delete-small.png");
    background-size: 16px 16px;
    background-repeat: no-repeat;
    /*background-color: #fff;*/
    height: 16px;
    width: 16px;
    display: block;
    float: left;
    margin-left: 10px;
    cursor: pointer;
    }
    .form-control{
        padding: 0px;
    }
    .delete_small_color{background-color: red !important; }

h4.nomargin > a{color: #4A366B; }
div.mini-cart-total > table.table-bordered > tbody > tr{
    color: #fff;
}

table > tbody > tr > td > a.continue {
background-color: #eea236;
color: #fff !important;
padding: 5px;
font-weight: bold;
border-radius: 10px;    
}
table > tbody > tr > td > a.buy {
background-color: #4CAF50;
color: #fff !important;
padding: 5px;
font-weight: bold;
border-radius: 10px;
}
</style>

<script>
$(document).on("click","table#cart tbody td.actions > span#more",function(){
    var idrecord=$(this).data("idrecord"),
        price=$(this).data("price"),
        idItemCart=$(this).data("iditemcart"),
        qty= parseInt( $(this).parent().parent().find("input.qty").val() )+1,
        this_item=$(this)
        ;

    $.ajax({
            url: url+'cart/updateToCart',
            type: 'POST',
            dataType: 'json',
            data: {
                idrecord: idrecord,
                qty: qty,
                price:price,
                idItemCart:idItemCart
            },
            beforeSend: function(response) {
                // console.log(response);

            },
            success: function(response) {
                if(response.status){
                    if(qty)
                    $(this_item).parent().parent().find("input.qty").val(qty);
                    else
                    $(this_item).parent().parent().find("input.qty").val(0);
                }
                $(this_item).parent().parent().find("td.subtTotalItem").html("$"+response.subtTotalItem);
                $(this_item).parent().parent().parent().find("td.subTotalCart").html("$"+response.subTotalCart);

                $("td.totalCart").html("$"+response.totalCart);                
                
                // $("button#textDetailCart").html(response.textDetailCart);
                $("div.dropdown").html(response.cartHeader);

            
            }
    });
});

$(document).on("click","table#cart tbody td.actions > span#less",function(){
    var idrecord=$(this).data("idrecord"),
        price=$(this).data("price"),
        idItemCart=$(this).data("iditemcart"),
        qty= parseInt( $(this).parent().parent().find("input.qty").val() )-1,
        this_item=$(this)
        ;
    if(qty<=0)
    return false;
    $.ajax({
            url: url+'cart/updateToCart',
            type: 'POST',
            dataType: 'json',
            data: {
                idrecord: idrecord,
                qty: qty,
                idItemCart:idItemCart
            },
            beforeSend: function(response) {
            },
            success: function(response) {
                if(response.status){
                if(qty)
                $(this_item).parent().parent().find("input.qty").val(qty);
                else
                $(this_item).parent().parent().find("input.qty").val(0);
                }

                $(this_item).parent().parent().find("td.subtTotalItem").html("$"+response.subtTotalItem);
                $(this_item).parent().parent().parent().find("td.subTotalCart").html("$"+response.subTotalCart);
                
                $("td.totalCart").html("$"+response.totalCart);                
                

                // $("span#textDetailCart").html(response.textDetailCart);
                $("div.dropdown").html(response.cartHeader);

            
            }
    });

});

// delete
$(document).on("click","table#cart tbody td.actions > span#delete",function(){
    var idItemCart=$(this).data("iditemcart")
        this_item=$(this)
        ;
     
    $(this_item).parent().parent().addClass("delete_small_color");

    $("#dialog > p").text("");
    $("#dialog > p").text("¿Seguro desea eliminar este elemento ?");

    $("#dialog > p").dialog({
     resizable: true,
     modal: true,
         buttons: {
         Si: function() {
            
        $.ajax({
            dataType: 'json',
            url: url+'cart/removeIdCart',
            type: 'POST',
            data: {
                idItemCart:idItemCart
            },
            beforeSend: function(response){
                console.log(response);

            },
            success: function(response){
                if(response.status)
                $(this_item).parent().parent().remove();

                $("td.subTotalCart").html("$"+response.subTotalCart);
                $("td.totalCart").html("$"+response.totalCart);                
                $("button#textDetailCart").html(response.textDetailCart);

            }
        });
        
        $("#dialog").append("<p></p>");
        $(this).dialog( "close" );

         },
         No: function() {
        $(this_item).parent().parent().removeClass("delete_small_color");
        
        $("#dialog").append("<p></p>");
        $(this).dialog( "close" );
        // $("div.linkContainer").removeClass('backgroundDelete');

         }
         }
     });

});

$(document).on("blur","table#cart tbody > tr > td > input.qty",function(){

    var idrecord=$(this).data("idrecord"),
        price=$(this).data("price"),
        idItemCart=$(this).data("iditemcart"),
        qty= parseInt( $(this).val() ),
        this_item=$(this)
        ;

    if(qty<=0)
    return false;
    $.ajax({
            url: url+'cart/updateToCart',
            type: 'POST',
            dataType: 'json',
            data: {
                idrecord: idrecord,
                qty: qty,
                idItemCart:idItemCart
            },
            beforeSend: function(response) {
            },
            success: function(response) {

                $(this_item).parent().parent().find("td.subtTotalItem").html("$"+response.subtTotalItem);
                $(this_item).parent().parent().parent().find("td.subTotalCart").html("$"+response.subTotalCart);

                $("td.totalCart").html("$"+response.totalCart);                
                $("span#textDetailCart").html(response.textDetailCart);
            
            }
    });

});
</script>