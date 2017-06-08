<?php 
$MODE=(empty($MODE)?"view":$MODE);
$edit=(empty($edit)?false:$edit);
$hd["MODE"]=form_hidden("MODE",$MODE);
// print_r(json_encode($publications_hosting_server));

if($group_link_detail)
foreach ($group_link_detail as $k0 => $v0) {

$id=(!empty($v0["id"])?$v0["id"]:'');

// $hd["id"] =(!empty($v0["id"])?trim(base64_encode($v0["id"])):'');
$hd["publication_id"]=form_hidden("publication_id",(!empty($v0["publication_id"])?encode_id($v0["publication_id"]):''));
$hd["id"]=form_hidden("id_group_link",(!empty($v0["id"])?encode_id($v0["id"]):''));

	if($MODE=="do_it"):

	$hd["description"] =form_input("description",(!empty($v0["description"])?$v0["description"]:'pass:www.pirabook.com')," id='description'  placeholder='P.Descripción' tabindex='15'" );

	else:

	$hd["description"] =(!empty($v0["description"])?$v0["description"]:'');

	endif;

?>
<?php if($edit==false): ?>
<div class='item itemPayment success groupClass'>
<?php endif; ?>
	<div class="form-group" style='display:none' id="hidden">
        <?php echo $hd["MODE"]."/"; ?>
        <?php echo $hd["publication_id"]; ?>
        <?php echo $hd["id"]; ?>

    </div>
	<div class="id">
		<?php echo $id."-"; ?>
	</div>
	<div class="description">
		<?php echo $hd["description"]; ?>
	</div>

	<?php if($MODE=="do_it"): ?> <!--|Aceptar| o |Cancelar|  -->
	<div class='editionActions'>
	<button type='button' class='submit_group_link UStyle' tabindex='15'>aceptar</button>
	<button type='button' class='group_link_cancel UStyle' tabindex='15'>cancelar</button>
	</div>
	<?php endif; ?>	
	<?php if($MODE=="view"): ?> <!--|Editar| lapiz o |Eliminar|  -->

	<div class='ops'>
	<button type='button' class='submit_group_link edit' tabindex='15' title='editar detalle'></button>
	<button type='button' class='delete_group_link delete' tabindex='15' title='eliminar detalle'></button>
	</div>
	
	<?php endif; ?>	

<?php if($edit==false): ?>
</div>
<?php endif; ?>

<?php 	
}
?>

<script type="text/javascript">
$(document).ready(function(){

<?php if($MODE=="do_it"){ ?>
	$("div.linkListContainer > div.area2 > div.data > div.item > div.link > input#link").focus();
	$("div.add_group_link").hide();
<?php } else {?>
	$("div.add_group_link").show();
<?php } ?>

});
</script>