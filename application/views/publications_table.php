<?php if(!empty($publications)): ?>
<table class="table table-responsive publicationsTable">
<tr class="header"> 
    <td class="ids" title="Ultimos post">post<img src="<?php echo base_url().'images/interface/down-arrow.png' ?>"></td> 
    <td class="title">
    	<!-- <a href="<?php echo base_url().'post/create_and_edit' ?>" class="createPost">Crear post</a> -->
    </td>
    <td class="views">Visto  <img src="<?php echo base_url().'images/interface/down-arrow.png' ?>"></td>
    <td class="comments" title="Comentarios">Com.<img src="<?php echo base_url().'images/interface/down-arrow.png' ?>"></td>
</tr>
<?php $c=0;?>
<?php foreach ($publications as $key => $value) { ?>
<?php $c++; ?>
	<tr class="body" onclick="window.location.href='<?php echo base_url()."home/publication/".$value["id"]?>';" title="<?php echo $value['title']; ?>">
	<td class="ids"><?php echo $value["photo"]?'<img src="'.base_url()."images/interface/categories/".$value["photo"].'" alt="">':"&nbsp;"; ?></td>
	<td class="title"><?php echo $value["title"]?substr($value["title"], 0,60)."...":""; ?></td>
	<td class="views"><?php echo $value["views"]?:"0"; ?></td>
	<td class="comments"><?php echo $value["amount_comments"]?:"0"; ?></td>
	</tr>
<?php } ?>

</table>
        <?php if($publications_amount> $c): ?>
        <p><?php echo $pagination;?></p>
        <?php endif; ?>

<?php else: ?>
<div id="contentArea" role="main">
	<div>
		<div id="pagelet_search_results_objects" data-referrer="pagelet_search_results_objects">
			<div id="pagelet_search_no_results" data-referrer="pagelet_search_no_results">
				<div class="pam uiBoxYellow">
				<div class="fsl fwb fcb">
				No se encontraron resultados.
				</div>
				<div class="fsm fwn fcg">
				Comprueba que el término de búsqueda no contiene errores o busca otro término.
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>