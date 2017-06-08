
<?php $subTotalCart=$this->cart->subtotal(); ?>
<?php $totalCart=$this->cart->total(); ?>

<?php $totalItems=$this->cart->total_items(); ?>
<?php $items_cart=$this->cart->contents();  ?>

 <button class="dropbtn" id="textDetailCart">
    <?php echo (!empty($totalItems)?$totalItems:"")." Productos - $".(!empty($totalCart)?number_format($totalCart,0,".",","):""); ?>
  </button>

  <div class="dropdown-content">
<div class="content">
    <ul class="cart-wrapper">
        <li class="mini-cart-info">
        <table>

            <tbody>
<?php 
foreach ($items_cart as $k=> $v) { ?>
    <tr>
    <td class="text-center image">
        <a href="<?php echo base_url().'publication/product/'.(!empty($v["id"])?$v["id"]:""); ?>">
            <img src="<?php echo base_url().'images/'.(!empty($v["image"])?$v["image"]:"no_image.jpg")?>" alt="<?php echo (!empty($v["name"])?$v["name"]:""); ?>" title="<?php echo (!empty($v["name"])?$v["name"]:""); ?>">
        </a>
    </td>
    <td class="text-left name">
        <a href="<?php echo base_url().'publication/product/'.(!empty($v["id"])?$v["id"]:""); ?>">
        <?php echo (!empty($v["name"])?cutText($v["name"],50):""); ?>
        </a>
    <div></div>
    </td>
    
        <td class="text-right quantity">x <?php echo (!empty($v["qty"])?$v["qty"]:"") ?> &nbsp; </td>
        <td class="text-right total"><?php echo (!empty($v["price"])?"$".number_format($v["price"],2,".",","):"") ?></td>
        <td class="text-center remove">
            <div id="delete" class="delete_small" data-iditemcart="TjFxB0W8ejSPR1gLusTS-7org1XM4LlJx2y7Fbg6ba8AkMOoCGoOgdnvDeHW_5BxP4v44kK9B0kQuaVD1CCP_g,,"></div>
        </td>
    </tr>
<?php } ?>            	
            </tbody>

        </table>
        </li>

    <li>


      <div class="mini-cart-total">
        <table class="table table-bordered">
        <tbody>
            <tr>
            <td class="text-right right"><strong>Sub-Total</strong></td>
            <td class="text-right right"><?php echo (!empty($subTotalCart)?"$".number_format($subTotalCart,2,".",","):"") ?></td>
            </tr>
            
            <tr>
            <td class="text-right right"><strong>Total</strong></td>
            <td class="text-right right"><?php echo (!empty($totalCart)?"$".number_format($totalCart,2,".",","):"") ?></td>
            </tr>

            <tr>
                <td class="text-right right">
                    <a class="button" href="<?php echo base_url().'cart';?>">
                        Ver Carrito
                    </a>
                </td>
                <td class="text-right right">
                    <a class="button" href="<?php echo base_url().'checkout';?>">
                    Comprar
                    </a>
                </td>
            </tr>
        </tbody>
        </table>

      </div>

    
    </li>
    </ul>
</div>

  </div>

  <img  style=" width:45px; height:45px; float:right; border-radius:10px; background-color:#fff;" src="<?php echo base_url()."images/interface/cart.png"; ?>">