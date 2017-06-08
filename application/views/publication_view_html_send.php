<div>
<div style="margin:0 2em;font-family:Trebuchet MS,Arial,sans-serif;line-height:140%;font-size:14px;color:#000066">

<table style="border:0;padding:0;margin:0;width:100%">
<tbody><tr>
<td style="vertical-align:top" width="99%">
<h1 style="margin:0;padding-bottom:6px">
<a style="color:#888;font-size:22px;font-family:Trebuchet MS,Arial,sans-serif;font-weight:normal;text-decoration:none" href="<?php echo base_url();?>" title="(<?php echo base_url();?>)" target="_blank">
<?php echo base_url(); ?>
</a>
</h1>
</td>
<td width="1%">
<a href="<?php echo base_url();?>" target="_blank">
<img src="<?php echo base_url().'images/interface/pirabook.png'; ?>" alt="Link to Pirabook" style="padding:0 0 10px 3px;border:0" class="CToWUd">
</a>
</td>
</tr>
</tbody>
</table>

<hr style="border:1px solid #ccc;padding:0;margin:0">
<ul style="clear:both;padding:0 0 0 1.2em;width:100%">
    <?php if(!empty($last_publications)): ?>
    <?php foreach ($last_publications as $key => $value) { ?>

    <li>
    <a href="<?php echo base_url().'home/publication/'.$value['id']; ?>"><?php echo $value["title"]; ?></a>
    </li>

    <?php } ?>
    <?php endif; ?>
</ul>

 <?php foreach ($publication as $key => $value) { ?>
<table>
<tbody>

<tr>
<td style="margin-bottom:0;line-height:1.4em">
<p style="margin:1em 0 3px 0">
<a name="14b0c5fb56a59356_1" style="font-family:Trebuchet MS,Arial,sans-serif;font-size:16px" href="<?php echo base_url().'home/publication/'.$value['id']; ?>" target="_blank">
<?php echo $value["title"]; ?>
</a>

</br>
Categoría: <a href="<?php echo base_url().'home/publication/'.$value['id']; ?>" title="Ver todas las entradas en <?php echo $value["category_name"]?:"&nbsp;"; ?>" rel="category tag"><?php echo $value["category_name"]?:"&nbsp;"; ?></a> 
por <a href="javascript:void(0);">
<?php echo $value["nickname"]?:"&nbsp;"; ?>
</p>

<p style="font-size:14px;color:#555;margin:9px 0 3px 0;font-family:Trebuchet MS,Arial,sans-serif;line-height:140%;font-size:14px">
<span>Publicado:</span><?php echo nicetime($value["registred_on"]); ?>
</p>

<div style="margin:0;font-family:Trebuchet MS,Arial,sans-serif;line-height:140%;font-size:14px;color:#000066">

<fieldset>
<div>
<div style="clear:both;text-align:center">

<a href="<?php echo base_url().'home/publication/'.$value['id']; ?>" style="margin-left:1em;margin-right:1em" target="_blank">
<?php if( !empty($value["pictures"]) ): ?>
	<?php //foreach ($value["pictures"] as $key_two => $value_two) { ?>
	<?php $img=end($value["pictures"]); ?>
	<img border="0" src="<?php echo base_url().'images/uploads/imgPost/'.$img['filename']; ?>" height="325" width="400" class="CToWUd">

	<?php	//} ?>
<?php endif; ?>
</a>

</div>
</div>
</fieldset>

<!-- <fieldset>
<legend><span style="font-family:trebuchet ms">Datos Técnicos</span></legend>
<div>
<div style="text-align:center">
<span style="font-family:trebuchet ms"><span style="font-weight:bold">Harvey Deitel: Cómo Programar C# (2da edición) (2007)</span><br>
<span style="font-style:italic">17Mb | En español | True PDF | ISBN-10: 9702610567 / ISBN-13: 978-9702610564 | 1080 págs. | Pearson Alhambra | Segunda edición, 1 de marzo de 2007 | Rar | Contraseña: <span style="color:red"><b>jamespoetrodriguez </b></span></span></span></div>
</div>
</fieldset> -->

<fieldset>
<legend><span style="font-family:trebuchet ms">Descripción</span></legend>
<div style="text-align:justify">
    <span style="font-family:trebuchet ms">
    <?php echo $value["description"]; ?>
    </span>
</div>
</fieldset>

<p>
<span>
</span>
<span style="font-weight:bold;color:rgb(102,0,204)">
    VISITA 
    <a href="<?php echo base_url(); ?>" target="_blank">
    <?php echo base_url(); ?>
    </a>
     PARA VER EL RESTO DEL CONTENIDO
</span>
</p>

<p>
© 2015 
<a href="<?php echo base_url(); ?>" target="_blank">
<?php echo base_url(); ?>
</a> Todos los Derechos Reservados.
</p>

<div>
<!-- <a href="http://feeds.feedburner.com/~ff/jimmy_criptoy?a=zkEFYh-86RY:YtR4Wj-4vs4:dnMXMwOfBR0" target="_blank"><img src="https://ci6.googleusercontent.com/proxy/iVo929A6HNYWro9G6WEiTKgA80uDMJ1l_in7JcBu3JmuzYdVhM_tefxjuwvtmLA8R1wo6590D5kwNVHVseFlcgMhkzev__LFCnIG2i3lDmGW=s0-d-e1-ft#http://feeds.feedburner.com/~ff/jimmy_criptoy?d=dnMXMwOfBR0" border="0" class="CToWUd"></a> <a href="http://feeds.feedburner.com/~ff/jimmy_criptoy?a=zkEFYh-86RY:YtR4Wj-4vs4:D7DqB2pKExk" target="_blank"><img src="https://ci6.googleusercontent.com/proxy/F6sMbfKAf7oqor3dPTWRJMZDQpqpTXXqq2jAj_ea-4eRvnGW6hSsH6MKQjWghS1gl2NQQDv7di8fIJn2j0YCKlhtMnPpp2mbNHaf_6iE9Yeu1q5AYtRwLEmijLgwHumBsexJwFZGyDgl=s0-d-e1-ft#http://feeds.feedburner.com/~ff/jimmy_criptoy?i=zkEFYh-86RY:YtR4Wj-4vs4:D7DqB2pKExk" border="0" class="CToWUd"></a> <a href="http://feeds.feedburner.com/~ff/jimmy_criptoy?a=zkEFYh-86RY:YtR4Wj-4vs4:3QFJfmc7Om4" target="_blank"><img src="https://ci5.googleusercontent.com/proxy/Cj-DG4g9vW0A82TgQLvx69CcOBnVcMNTCp30xhlUXVVE1Dh3ixtq0ewapJbMIIw7ZWH6E_tSOih88eI_3nImhJZSig18TxFfbF11qZM31d7cVbhl7vuCF2wkXomWWAldQk7X3wi_26cT=s0-d-e1-ft#http://feeds.feedburner.com/~ff/jimmy_criptoy?i=zkEFYh-86RY:YtR4Wj-4vs4:3QFJfmc7Om4" border="0" class="CToWUd"></a> -->
</div>

<p></p>
</div>

</td>
</tr>

<tr>

</tbody>
</table>

 <?php } ?>

<table style="border-top:1px solid #999;padding-top:4px;margin-top:1.5em;width:100%">
<tbody>

<tr>
<td style="text-align:left;font-family:Helvetica,Arial,Sans-Serif;font-size:11px;margin:0 6px 1.2em 0;color:#333">You are subscribed to email updates from <a href="<?php echo base_url();?>" target="_blank"><?php echo base_url();?></a>
<br>To stop receiving these emails, you may <a href="https://feedburner.google.com/fb/a/mailunsubscribe?k=i3v5N0RinfHGCIH9pUogkUEARpE" target="_blank">unsubscribe now</a>.</td>
<td style="font-family:Helvetica,Arial,Sans-Serif;font-size:11px;margin:0 6px 1.2em 0;color:#333;text-align:right;vertical-align:top">Email delivery powered by Google</td>
</tr>
<tr>
<td colspan="2" style="text-align:left;font-family:Helvetica,Arial,Sans-Serif;font-size:11px;margin:0 6px 1.2em 0;color:#333">Google Inc., 1600 Amphitheatre Parkway, Mountain View, CA 94043, United States</td>
</tr>

</tbody>
</table>

<div class="yj6qo"></div>
<div class="adL"></div>

</div>

<div class="adL"></div>

</div>
