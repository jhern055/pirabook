<?php $cartItems=$this->cart->contents(); ?>
<?php if(empty($cartItems)): ?>
<?php redirect(""); ?>
<?php endif; ?>
<?php $totalCart=$this->cart->total(); ?>

<?php $order_info=$this->session->userdata("order_info"); 
      if(!empty($order_info))
      foreach ($order_info as $key => $value) {
        $$key=$value;
      }
?>
<?php $user=$this->session->userdata("user"); ?>
<div class="container">
  
<div class="stepwizard col-md-offset-3">
    <div class="stepwizard-row setup-panel">
      <div class="stepwizard-step">
        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
        <p>Paso 1</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
        <p>Paso 2</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
        <p>&Eacute;xito</p>
      </div>
    </div>
  </div>
  
  <form role="form" action="" method="post">
    <div class="row setup-content" id="step-1">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3> Datos de contacto</h3>

          <!-- Nombre -->
          <div class="form-group">
            <label class="control-label">Nombre</label>
            <input id="name" value="<?php echo (!empty($name)?$name:""); ?>" maxlength="100" type="text" required="required" class="form-control" placeholder="Teclea Tu Nombre"  />
          </div>
          
          <!-- Email -->
          <div class="form-group">
            <label class="control-label">Email</label>
            <input id="email" value="<?php echo (!empty($email)?$email:(!empty($user["user_email"])?$user["user_email"]:"")); ?>" maxlength="100" type="text" required="required" class="form-control" placeholder="Teclea Tu Email"  />
          </div> 

          <!-- Telefono -->
          <div class="form-group">
            <label class="control-label">Tel&eacute;fono (Opcional)</label>
            <input id="telephone" value="<?php echo (!empty($telephone)?$telephone:""); ?>" maxlength="100" type="text" class="form-control" placeholder="Teclea Tu Tel&eacute;fono"  />
          </div>       

          <!-- Direccion -->
          <div class="form-group">
            <label class="control-label">Direcci&oacute;n (solo si estas comprando objetos fisicos)</label>
            <textarea id="direction" required="required" class="form-control" placeholder="Teclea tu Direcci&oacute;n"><?php echo (!empty($direction)?$direction:""); ?></textarea>
          </div>

          <!-- Methodos de pago -->
          <h3> M&eacute;todos de pago</h3>
          <div class="form-group" id="payment_method" style="float:left;">
            <label class="control-label">Seleccione un metodo de pago</label>
          <ul>
            <!-- <li> -->
<!--             <input style="width:20px; float:left; margin-top:22px;" type="radio" name="payment_method" class="payment_method" value="bank_transfer" checked>
            
            <img style="width:60px; height:33px; " src="<?php //echo base_url()."images/interface/oxxo.png"; ?>">
 -->
            <!-- </li> -->

            <li>
            <input required="required" style="width:20px; float:left; margin-top:22px;" type="radio" name="payment_method" class="payment_method form-control" value="oxxo" <?php echo ( (!empty($payment_method) and $payment_method=="oxxo")?"checked":""); ?>>
            &nbsp;
            <img style="width:60px; height:33px; margin-left:30px; " src="<?php echo base_url()."images/interface/oxxo.png"; ?>">
            </li>

            <li style="width:200px; float:left;">
            <input required="required" style="width:20px; float:left; margin-top:15px;" type="radio" name="payment_method" class="payment_method form-control" value="paypal" <?php echo ( (!empty($payment_method) and $payment_method=="paypal")?"checked":""); ?>>
            <img style="width:48px; height:48px; margin-left:30px; " src="<?php echo base_url()."images/interface/paypal.png"; ?>">
            </li>

           </ul>

          </div>

          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
        </div>
      </div>
    </div>
    <div class="row setup-content" id="step-2">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3>Tus datos</h3>

            <!-- Nombre -->
            <strong>Nombre:</strong> 
            <label class="control-label sub info_name">
            <?php echo (!empty($name)?$name:""); ?>
            </label>
            <br>

            <!-- Email -->
            <strong>Email:</strong> 
            <label class="control-label sub info_email">
            <?php echo (!empty($email)?$email:""); ?>
            </label>            
            <br>

            <!-- Telefono -->
            <strong>Tel&eacute;fono:</strong> 
            <label class="control-label sub info_telephone">
            <?php echo (!empty($telephone)?$telephone:""); ?>
            </label>            
            <br>

            <!-- Direccion -->
            <strong>Direcci&oacute;n:</strong> 
            <label class="control-label sub info_direction">
            <?php echo (!empty($direction)?$direction:""); ?>
            </label>            
            <br>
            <br>

        </div>

        <div class="col-md-12">
          <h3>Metodo de pago</h3>
            <label class="control-label info_payment_method">
              <?php if(!empty($payment_method)){ ?>
            <img style=" " src="<?php echo base_url()."images/interface/".$payment_method.".png"; ?>">
              <?php } ?>            
            </label>
            <br>
            <br>

        </div>        

        <div class="col-md-12">
          <h3>Resumen de su Pedido</h3>
        
    <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width:50%">Producto</th>
                            <th style="width:10%">Precio</th>
                            <th style="width:8%">Cantidad</th>
                            <th style="width:22%" class="text-center">Subtotal</th>
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
                                        <img src="<?php echo base_url()."images/uploads/imgPost/".$value["image"]; ?>" alt="..." class="img-responsive"/>
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
                            <td data-th="Price"><?php echo "$".$value["price"]; ?></td>
                            <td data-th="Quantity" style="text-align:center">
                                <?php echo $value["qty"]; ?>
                            </td>
                            <td data-th="Subtotal" class="text-center subtTotalItem"><?php echo "$".number_format($value["subtotal"],0,".",","); ?></td>
                        </tr>
                            <?php } ?>
                            <?php } ?>

                    </tbody>
                    <tfoot>
                        <tr class="visible-xs">
                            <td class="text-center" id="totalCart"><strong>Total $<?php echo number_format($totalCart,0,".",",");  ?></strong></td>
                        </tr>
                        <tr>
                            <td >&nbsp;</td>
                            <td colspan="2" class="hidden-xs"></td>
                            <td class="hidden-xs text-center" id="totalCart"><strong>Total $<?php echo number_format($totalCart,0,".",",");  ?></strong></td>
                        </tr>
                    </tfoot>
    </table>   
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

    
    table#cart tfoot td{display:block; }
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
    table#cart thead > tr >th {
    color: #fff;
    }
    table#cart tfoot > tr >td.text-center >strong {
    color: #fff;
    }    
/*table#cart tbody td.actions > */

    .form-control{
        padding: 0px;
    }
    .delete_small_color{background-color: red !important; }

h4.nomargin > a{
color: #4A366B;
}
strong{
  font-size: 12px;

}
label.sub{
    /* colores, fuentes, etc */
  text-decoration: underline; /* se subraya en los navegadores que no aceptan la propiedad */
  -moz-text-decoration-color: red;
  -moz-text-decoration-line: underline;
  -moz-text-decoration-style: wavy;
  font-size: 12px;
}
</style>
          <!-- <button class="btn btn-success btn-lg pull-right" type="submit">Finalizar Compra</button> -->

          <button id="confirm" class="btn btn-success btn-lg pull-right" type="button" >Finalizar Compra</button>

        </div>
      </div>
    </div>
    <div class="row setup-content" id="step-3">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3> Exito </h3>
          <h4>Su pedido se ha generado con exito,</h4>

          <!-- <button class="btn btn-success btn-lg pull-right" type="submit">Finalizar Compra</button> -->
        </div>
      </div>
    </div>
  </form>
  
</div>
<style type="text/css">

body {
    margin-top:40px;
}
.stepwizard-step p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 50%;
    position: relative;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
h3,label,p,strong{
  color: #fff;
}
h3{
  margin-bottom: 10px;
}
div#payment_method{
  color: #fff;
  font-size: 12px;
  font-weight: bold;
}
div.has-error-green{
  color:#3efe31 !important;
  /*color:rgb(62, 254, 49);*/
}

</style>
<script type="text/javascript">

$(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='radio'],input[type='url']"),

          isValid = true;
      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      // if (isValid){

        $.ajax({
          
          type: "POST",
          url: "<?php echo base_url().'cart/save'; ?>",
          async:true,
          dataType:"json",
          data:{
            name:$("input#name").val(),
            direction:$("textarea#direction").val(),
            email:$("input#email").val(),
            telephone:$("input#telephone").val(),
            payment_method:$('input[name =payment_method]:checked').val(),
          
          }, 
          beforeSend:  function(response) {
// ajax
      $("input").prop("disabled",true);
      $("button").prop("disabled",true);
      $("div#ajax_loading").addClass("ajax_loading");
// ... 
          },
          success: function(response){  

            if(response.status){

              if(response.name)
              $("label.info_name").html(response.name);

              if(response.email)
              $("label.info_email").html(response.email);

              if(response.telephone)
              $("label.info_telephone").html(response.telephone);

              if(response.direction)
              $("label.info_direction").html(response.direction);

              if(response.payment_method)
              $("label.info_payment_method").html("<img src='<?php echo base_url().'images/interface/';?>"+response.payment_method+".png'>");

            $("div.alert-danger").remove();

            $("input#name").parent().removeClass("borderRequired");
            $("input#email").parent().removeClass("borderRequired");

            nextStepWizard.removeAttr('disabled').trigger('click');
            }
            else{
              // name
                if(response.name==1){
                $("input#name").focus().tooltip();
                $("input#name").parent().addClass("borderRequired");

                if(!$("input#name").parent().find("div.alert-danger").get(0))
                $("input#name").parent().append(alert_danger("","Tu nombre es necesario"));
            
                }
                else {
                $("input#name").parent().find("div.alert-danger").remove();
                $("input#name").parent().removeClass("borderRequired");
                }    
              // 

              // email
                if(response.email==1){
                $("input#email").focus().tooltip();
                $("input#email").parent().addClass("borderRequired");

                if(!$("input#email").parent().find("div.alert-danger").get(0))
                $("input#email").parent().append(alert_danger("","Email necesario si no estas logueado"));
            
                }
                else {
                $("input#email").parent().find("div.alert-danger").remove();
                $("input#email").parent().removeClass("borderRequired");
                }    
              // 

              // payment_method
                if(response.payment_method==1){
                $("input.payment_method").parent().parent().parent().addClass("borderRequired");

                // if(!$("input.payment_method").parent().parent().parent().find("div.alert-danger").get(0))
                // $("input.payment_method").parent().parent().parent().append(alert_danger("","payment_method necesario si no estas logueado"));
            
                }
                else {
                // $("input.payment_method").parent().parent().parent().find("div.alert-danger").remove();
                $("input.payment_method").parent().parent().parent().removeClass("borderRequired");
                }    
              //               

            }
// ajax
        $("input").prop("disabled",false);
        $("button").prop("disabled",false);
        $("div#ajax_loading").removeClass("ajax_loading");
// ...

          }

        });

      // }

  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});

function alert_danger(field,msg){
var error_html='<div class="alert alert-danger">'
                +'<a class="close" data-dismiss="alert" href="#">&times;</a>'
                +' <a href="javascript:void(0)" class="alert-link">'+field+'</a> '
                +'<p>'+msg+'.</p>'
                +'</div>'
                ;
    return error_html;
}
</script>  

<script>  
$(document).on("click",'button#confirm',function() {
  var this_it=$(this);

  $.ajax({
    
    type: "POST",
    url: "<?php echo base_url().'cart/confirm'; ?>",
    async:true,
    dataType:"JSON",
    data:{
      name:$("input#name").val(),
      direction:$("textarea#direction").val(),
      email:$("input#email").val(),
      telephone:$("input#telephone").val(),
      payment_method:$('input[name =payment_method]:checked').val(),
    
    }, 
    beforeSend:  function(response) {

// // ajax
//       $("input").prop("disabled",true);
//       $("button").prop("disabled",true);
//       $("div#ajax_loading").addClass("ajax_loading");
// // ...     
    },
    success: function(response){ 
            // console.log(response);
      // return false;
      var curStep = $(this_it).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a");

            nextStepWizard.removeAttr('disabled').trigger('click');

// ajax
        $("input").prop("disabled",false);
        $("button").prop("disabled",false);
        $("div#ajax_loading").removeClass("ajax_loading");
// ...

    } 

  });

});

</script>  