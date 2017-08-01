<style type="text/css">
/* onecheckout */
.onecheckout {
  width:32%;
  float:left;
  text-align:left;
}
.onecheckoutmid {
  width:28%;
  margin:0 3%;
  float:left;
  text-align:left;
}
.onecheckout #confirmorder{
  display:none;
}
.onecheckout-heading {
  border-bottom: 1px solid #000000;
  padding: 8px;
  padding-left:0;
  font-weight: bold;
  font-size: 16px;
  color: #000000;
  margin-bottom:15px;
  text-align:left;
}
.onecheckout-content {
  padding: 0px 0px 15px 0px;
  overflow: auto;
  color: #555555;
  text-align:left;
}
#checkout #login{
  padding-left:6px;
  margin: 15px 0 20px;
  display:none;
  width:98%;
  padding:10px;
  border:1px solid #ccc;
  margin-bottom:15px;
}
#checkout #login .close_la{
  position:relative;
  margin-bottom:-16px;
  top:-16px;
  right:-16px;
  cursor:pointer;
  float:right;
  width:16px;
  height:16px;
  background:url("../image/cancel.png") no-repeat scroll 0 0 transparent;
}
.onecheckout-content .left {
  float: left;
  width: 48%;
}
.onecheckout-content .right {
  float: right;
  width: 48%;
}
.onecheckout-content .small-field{
  width:90%;
}
.onecheckout-content .large-field{
  width:95%;
}
.onecheckout-content .divclear {
  clear: both;
}
.onecheckout-product table {
  width: 99%;
  border-collapse: collapse;
  border-top: 1px solid #DDDDDD;
  border-left: 1px solid #DDDDDD;
  border-right: 1px solid #DDDDDD;
  margin-bottom: 20px;
}
.onecheckout-product td {
  padding: 7px;
}
.onecheckout-product thead td {
  color: #4D4D4D;
  font-weight: bold;
  background-color: #F7F7F7;
  border-bottom: 1px solid #DDDDDD;
}
.onecheckout-product thead .name, .onecheckout-product thead .model {
  text-align: left;
}
.onecheckout-product thead .quantity, .onecheckout-product thead .price, .onecheckout-product thead .total {
  text-align: right;
}
.onecheckout-product tbody td {
  vertical-align: top;
  border-bottom: 1px solid #DDDDDD;
}
.onecheckout-product tbody .name, .onecheckout-product tbody .model {
  text-align: left;
}
.onecheckout-product tbody .quantity, .onecheckout-product tbody .price, .onecheckout-product tbody .total {
  text-align: right;
}
.onecheckout-product tfoot td {
  text-align: right;
  border-bottom: 1px solid #DDDDDD;
}
/*onecheckout end*/

</style>
  <div class="breadcrumb">
        <a href="https://pcel.com/index.php?route=common/home">Inicio</a>
         » <a href="https://pcel.com/index.php?route=checkout/cart">Carrito de Compras</a>
         » <a href="https://pcel.com/index.php?route=onecheckout/checkout">Checkout</a>
      </div>
  <h1 class="barra">Checkout</h1>
    <div id="checkout">
	<a id="login-show" style="color:#FF0000;">¿Ya tiene cuenta? Presione aquí para iniciar sesión</a>
	<div id="login"><div class="close_la"></div>
<table>
  <tbody><tr>
	<td width="30%"><b>E-Mail:</b>&nbsp;<input type="text" name="email" value=""><br></td>
	<td width="30%"><b>Contraseña:</b>&nbsp;<input type="password" name="password" value=""><br></td>
	<td width="15%" align="center"><a id="button-login" class="button"><span>Conectar</span></a><br></td>
	<td width="25%"><a href="https://pcel.com/index.php?route=account/forgotten">Contraseña olvidada</a></td>
  </tr>
</tbody></table>
   </div>
  </div>
    <div class="onecheckout">
        <div id="payment-address">
      <div class="onecheckout-heading"><span>Total y Detalles de Facturación</span></div>
      <div class="onecheckout-content">    <div class="left">
	<span class="required">*</span> Nombre:<br>
	<input type="text" name="firstname" value="" class="small-field"><br>
  </div>
  <div class="right">
	<span class="required">*</span> Apellidos:<br>
	<input type="text" name="lastname" value="" class="small-field"><br>
  </div>
  <div class="divclear"></div>
  <br>
    <div class="divclear">
	<span class="required">*</span> E-Mail:<br>
	<input type="text" name="email" value="" class="large-field"><br>
		<br>
	Empresa:<br>
	<input type="text" name="company" value="" class="large-field"><br>
	
	
	    <br>RFC:(Genérico=XAXX010101000)
	    <input type="text" name="rfc" value="XAXX010101000" class="large-field"><br>
	


		<br>
	<div class="left">
		<span class="required">*</span> Teléfono (c/lada):<br>
		<input type="text" name="telephone" value="" class="small-field"><br>
		<div id="telerrmsg"></div>
	</div>
	<div class="right">
		Teléfono oficina c/lada<br>
		<input type="text" name="office" value="" class="small-field"><br>
		<input type="hidden" name="fax" value="">
	</div>
	<br>
	<div class="divclear"></div>
	

	
		    <br>
	    <span class="required">*</span> Dirección:<br>
	    <input type="text" name="address_1" value="" class="large-field"><br><br>

	    <div class="left">
		    <span class="required">*</span> No. Exterior:<br>
		    <input type="text" name="no_ext" value="" size="5"><br>
	    </div>
	    <div class="right">
		    No. Interior:<br>
		    <input type="text" name="no_int" value="" size="5"><br>
	    </div>
	    <br>
	

		<br><br><br>
	<span class="required">*</span>Colonia:<br>
	<input type="text" name="address_2" value="" class="large-field"><br>
	<br>
	<span class="required">*</span> Entre calles:<br>
	<input type="text" name="entrecalles" value="" class="large-field"><br>

	  </div>


    <br>
  <div class="left">
	<span class="required">*</span> Ciudad:<br>
	<input type="text" name="city" value="" class="small-field"><br>
  </div>
  <div class="right">
	<span id="payment-postcode-required" class="required">*</span> Código Postal:&nbsp;<a id="postal-link-p" href="#" class="cboxElement">Buscar</a><br>
	<input type="text" id="id_postcode_p" name="postcode" value="" size="5"><br>
  </div>
  
  <div class="divclear">
		<br>
	<span class="required">*</span> País:<br>
	<select name="country_id" class="large-field">
	<option value=""> --- Por Favor Seleccione --- </option>
			<option value="138" selected="selected">Mexico</option>
			</select>
	<br>
			<br>
	<span class="required">*</span> Estado:<br>
	<select name="zone_id" class="large-field"><option value=""> --- Por Favor Seleccione --- </option><option value="3968">Aguascalientes</option><option value="2146">Baja California Norte</option><option value="2147">Baja California Sur</option><option value="2148">Campeche</option><option value="2149">Chiapas</option><option value="2150">Chihuahua</option><option value="2153">Ciudad de México</option><option value="2151">Coahuila</option><option value="2152">Colima</option><option value="2154">Durango</option><option value="2155">Guanajuato</option><option value="2156">Guerrero</option><option value="2157">Hidalgo</option><option value="2158">Jalisco</option><option value="2159">Mexico</option><option value="2160">Michoacan de Ocampo</option><option value="2161">Morelos</option><option value="2162">Nayarit</option><option value="2163" selected="selected">Nuevo Leon</option><option value="2164">Oaxaca</option><option value="2165">Puebla</option><option value="2166">Queretaro de Arteaga</option><option value="2167">Quintana Roo</option><option value="2168">San Luis Potosi</option><option value="2169">Sinaloa</option><option value="2170">Sonora</option><option value="2171">Tabasco</option><option value="2172">Tamaulipas</option><option value="2173">Tlaxcala</option><option value="2174">Veracruz</option><option value="2175">Yucatan</option><option value="2176">Zacatecas</option></select>
	<br>
			<input type="checkbox" name="account" value="1" id="account" checked="checked" style="display:none;">
	<br>
	  </div>
 <div id="reg-cpanle" class="divclear">
  <div class="left">
	<span class="required">*</span> Contraseña:<br>
	<input type="password" name="password" value="" class="small-field"><br>
  </div>
  <div class="right">
	<span class="required">*</span> Confirme Contraseña: <br>
	<input type="password" name="confirm" value="" class="small-field"><br>
  </div>
  <div style="clear: both; padding-top: 15px; border-top: 1px solid #EEEEEE;">
  <input type="checkbox" name="newsletter" value="1" id="newsletter">
  <label for="newsletter">Deseo suscribirme al PCEL boletín.</label>
  <br>
    <input type="checkbox" name="shipping_address" value="1" id="shipping" checked="checked">
  <label for="shipping">Mi dirección de Envío y Facturación es la misma.</label>
  <br>
    <br>
  </div>
<div class="buttons">
    <input type="checkbox" name="agree" value="1">He leído y estoy de acuerdo con el  <a class="colorbox cboxElement" href="https://pcel.com/index.php?route=information/information/info&amp;information_id=3" alt="Aviso de Privacidad"><b>Aviso de Privacidad</b></a></div>

</div></div>
    </div>
            <div id="shipping-address" style="display: none;">
      <div class="onecheckout-heading">Detalles de Envío</div>
      <div class="onecheckout-content"><input type="radio" name="shipping_address" value="new" checked="checked" style="display:none;"><table class="form">
    <tbody><tr>
    <td style="color:#555;"><span class="required">*</span> Nombre:</td>
    <td><input type="text" name="firstname" value="" class="large-field"><br></td>
  </tr>
      <tr>
    <td style="color:#555;"><span class="required">*</span> Apellidos:</td>
    <td><input type="text" name="lastname" value="" class="large-field"><br></td>
  </tr>
  
  <tr>
    <td style="color:#555;">Teléfono c/lada</td>
    <td><input type="text" name="telephone" value="" class="large-field"></td>
  </tr>


    <tr style="display:none;">
    <td>Empresa:</td>
    <td><input type="hidden" name="company" value="" class="large-field"></td>
  </tr>
      <tr>
    <td style="color:#555;"><span class="required">*</span> Dirección:</td>
    <td><input type="text" name="address_1" value="" class="large-field"><br></td>
  </tr>
  <tr>
    <td style="color:#555;"><span class="required">*</span> No. Exterior:</td><td style="color:#555;">No. Interior:<br></td>
  </tr>
  <tr>
    <td><input type="text" name="no_ext" value="" size="5"><br></td>
    <td><input type="text" name="no_int" value="" size="5"><br></td>
  </tr>


      <tr>
    <td style="color:#555;"><span class="required">*</span>Colonia:</td>
    <td><input type="text" name="address_2" value="" class="large-field"></td>
  </tr>

  <tr>
    <td style="color:#555;"><span class="required">*</span> Entre calles:</td>
    <td><input type="text" name="entrecalles" value="" class="large-field"><br></td>
  </tr>

      <tr>
    <td style="color:#555;"><span class="required">*</span> Ciudad:</td>
    <td><input type="text" name="city" value="" class="large-field"><br></td>
  </tr>
      <tr>
    <td style="color:#555;"><span id="shipping-postcode-required" class="required">*</span> Código Postal:&nbsp;<a id="postal-link-s" href="#" class="cboxElement">Buscar</a></td>
    <td><input type="text" id="id_postcode_s" name="postcode" value="" class="large-field"><br></td>
  </tr>
      <tr>
    <td style="color:#555;"><span class="required">*</span> País:</td>
    <td><select name="country_id" class="large-field">
	<option value=""> --- Por Favor Seleccione --- </option>
			<option value="138" selected="selected">Mexico</option>
		      </select><br></td>
  </tr>
      <tr>
    <td style="color:#555;"><span class="required">*</span> Estado:</td>
    <td><select name="zone_id" class="large-field"><option value=""> --- Por Favor Seleccione --- </option><option value="3968">Aguascalientes</option><option value="2146">Baja California Norte</option><option value="2147">Baja California Sur</option><option value="2148">Campeche</option><option value="2149">Chiapas</option><option value="2150">Chihuahua</option><option value="2153">Ciudad de México</option><option value="2151">Coahuila</option><option value="2152">Colima</option><option value="2154">Durango</option><option value="2155">Guanajuato</option><option value="2156">Guerrero</option><option value="2157">Hidalgo</option><option value="2158">Jalisco</option><option value="2159">Mexico</option><option value="2160">Michoacan de Ocampo</option><option value="2161">Morelos</option><option value="2162">Nayarit</option><option value="2163" selected="selected">Nuevo Leon</option><option value="2164">Oaxaca</option><option value="2165">Puebla</option><option value="2166">Queretaro de Arteaga</option><option value="2167">Quintana Roo</option><option value="2168">San Luis Potosi</option><option value="2169">Sinaloa</option><option value="2170">Sonora</option><option value="2171">Tabasco</option><option value="2172">Tamaulipas</option><option value="2173">Tlaxcala</option><option value="2174">Veracruz</option><option value="2175">Yucatan</option><option value="2176">Zacatecas</option></select><br></td>
  </tr>
  </tbody></table>
<br>
</div>
    </div>
	  </div>

  <div class="onecheckoutmid">
        <div id="shipping-method">
      <div class="onecheckout-heading">Método de Entrega</div>
      <div class="onecheckout-content" style=""><p>Por favor seleccione su método preferido de envío.</p>
<table class="form">
      <tbody><tr>
    <td colspan="3"><b>Envío Terrestre</b></td>
  </tr>
    
  <tr>
    <td style="width: 1px;">            <input type="radio" name="shipping_method" value="terrestre.terrestre" id="terrestre.terrestre" checked="checked">
      </td>
    <td><label for="terrestre.terrestre">Envío Terrestre a todo México (de 2 a 6 días)          
      	</label></td>
    <td style="text-align: right;"><label for="terrestre.terrestre">$0</label></td>
  </tr>
          <tr>
    <td colspan="3"><b>Envío Aéreo</b></td>
  </tr>
    
  <tr>
    <td style="width: 1px;">      <input type="radio" name="shipping_method" value="aereo.aereo" id="aereo.aereo">
      </td>
    <td><label for="aereo.aereo">Envío Aéreo a todo México (de 1 a 2 días)          
      	</label></td>
    <td style="text-align: right;"><label for="aereo.aereo">$729.58</label></td>
  </tr>
      </tbody></table>
<!--? echo $insurance_fee; ?-->
  
  </div>
    </div>
        <div id="payment-method">
      <div class="onecheckout-heading">Método de Pago</div>
      <div class="onecheckout-content" style=""><p>Por favor seleccione su forma preferida de pago.</p>
<table class="form">
    <tbody><tr>
    <td style="width: 1px;">      <input type="radio" name="payment_method" value="banamex" id="banamex">
      </td>
    <td><label for="banamex">Pagos en línea Tarjeta VISA/MC </label></td>
  </tr>
    <tr>
    <td style="width: 1px;">      <input type="radio" name="payment_method" value="pp_standard" id="pp_standard">
      </td>
    <td><label for="pp_standard">PayPal (Aplica 24hrs hábiles). Por su seguridad, solamente se aceptarán operaciones en donde la dirección de ENVÍO coincida con la dirección predeterminada registrada en Paypal.</label></td>
  </tr>
    <tr>
    <td style="width: 1px;">            <input type="radio" name="payment_method" value="deposito" id="deposito" checked="checked">
      </td>
    <td><label for="deposito">Depósito en ventanilla o transferencia electrónica en Banamex </label></td>
  </tr>
    <tr>
    <td style="width: 1px;">      <input type="radio" name="payment_method" value="oxxo" id="oxxo">
      </td>
    <td><label for="oxxo">Pago en Tiendas OXXO  del país.</label></td>
  </tr>
  </tbody></table>
<h2 style="border-bottom:1px #000000 solid; padding-bottom:6px;font-family: Arial, Helvetica, sans-serif;font-weight: bold;font-size: 16px;color: #000000;">Comentarios de su orden:</h2>
<p style="padding-top:10px;">Introduzca sus comentarios.</p>
<textarea name="comment" rows="8" style="width: 90%;"></textarea>
<br>
 </div>
    </div>
  </div>
  <div class="onecheckout">
    <div id="confirm">
      <div class="onecheckout-heading">Confirmar Pedido</div>
      <div class="onecheckout-content" style="display: block;"><div class="onecheckout-product">
  <table>
    <thead>
      <tr>
	<td class="name">Producto</td>
	<td class="quantity">Cantidad</td>
	<td class="price">Precio</td>
	<td class="total">Total</td>
      </tr>
    </thead>
    <tbody>
            <tr>
	<td class="name"><a href="https://pcel.com/Power-amp-Co-X10-126986">
		Antena HD Ultra delgada HD Flat X10 para interiores.
	    </a>
	  </td>
	<td class="quantity">1</td>
	<td class="price">$85.34</td>
	<td class="total">$85.34	    
	</td>
      </tr>
            <tr>
	<td class="name"><a href="https://pcel.com/Acer-UM-UX6AA-B02-115310">
		Monitor LED Acer K242HQL BBD de 23.6", Resolución 1920 x 1080 (Full HD), 5 ms
	    </a>
	  </td>
	<td class="quantity">1</td>
	<td class="price">$2,240.52</td>
	<td class="total">$2,240.52	    
	</td>
      </tr>
                </tbody>
    <tfoot>
            <tr>
	<td colspan="2" class="price"><b>Sub-Total:</b></td>
	<td colspan="2" class="total">$2,325.86</td>
      </tr>
            <tr>
	<td colspan="2" class="price"><b>Envío Terrestre a todo México (de 2 a 6 días):</b></td>
	<td colspan="2" class="total">$0</td>
      </tr>
            <tr>
	<td colspan="2" class="price"><b>IVA (16%):</b></td>
	<td colspan="2" class="total">$372.14</td>
      </tr>
            <tr>
	<td colspan="2" class="price"><b>Total:</b></td>
	<td colspan="2" class="total">$2,698</td>
      </tr>
          </tfoot>
  </table>
</div>

<div class="cart-module">
  <div class="cart-heading">Aplicar Nota de Crédito</div>
  <div class="cart-content" id="ncredito">Intoduzca Nota&nbsp;<br>
    <input type="text" name="ncredito" value="">
    &nbsp;<a id="button-ncredito" class="button"><span>Aplicar Nota</span></a></div>
</div>

<style type="text/css">
.cart-module > div {
	display: block;
}
.cart-module .cart-heading {
	border: 1px solid #DBDEE1;
	padding: 8px 8px 8px 22px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #555555;
	margin-bottom: 15px;
	cursor: pointer;
	background: #F8F8F8 url('catalog/view/theme/default/image/cart-right.png') 10px 50% no-repeat;
}
.cart-module .active {
	background: #F8F8F8 url('catalog/view/theme/default/image/cart-down.png') 7px 50% no-repeat;
}
.cart-module .cart-content {
	padding: 0px 0px 15px 0px;
	display: none;
	overflow: auto;
	font-family: Arial, Helvetica, sans-serif;
	font-size:12px;
}
</style>


<div class="buttons">
  <div class="right"><a id="button-confirmorder" class="button"><span>Verificar</span></a></div>
</div>
</div>
    </div>
  </div>
  <div id="confirmorder" style="clear:both"></div>
  </div>