
<!--     <div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">

        <img src="http://placehold.it/320x150" alt="">
        <div class="caption">
        <h4 class="pull-right"></h4>
        <h4><?php //echo anchor(base_url().'home/publication/'.$value["id"], $value["title"], "title='".$value["title"]."'"); ?>
        </h4>
        <p><?php //echo $value["description"]?substr($value["description"], 0,110)."...":"&nbsp;"; ?></p>
        </div>
        <div class="ratings">
        <p class="pull-right"><?php //echo $value["views"]?:"0"; ?> Visitas</p>
        <p>
        <span class="glyphicon glyphicon-star"></span>
        <span class="glyphicon glyphicon-star"></span>
        <span class="glyphicon glyphicon-star"></span>
        <span class="glyphicon glyphicon-star"></span>
        <span class="glyphicon glyphicon-star-empty"></span>
        </p>
        </div>

    </div>

    </div> -->

<link href="<?php echo base_url(); ?>css/theme.css" rel="stylesheet">

<?php 
if(!empty($folder)):
foreach ($folder as $key => $value) {  ?>
<?php 
if(!empty($value["links"]))
$links= count($value["links"] );
?>
<section id="wdg_popular_games" class="wdg_popular_games grid grid-ui ">
    <div class="header">
        <a href="#">
            <h2 class="box-title"><?php echo !empty($value["folder_name"])?$value["folder_name"]:"" ?> <?php echo !empty($value["links_amount"])?" (".$value["links_amount"].")":""; ?></h2>
        </a>
        <div class="button-group">
            <!-- <a class="button blue more" href="#">Más</a> -->
            <?php if(!empty($value["links"]) and $value["links"] > $links): ?>
            <p><?php echo $pagination;?></p>
            <?php endif; ?>
        </div>
    </div>

    <?php 
                 
        if(!empty($value["links"]))
        foreach ($value["links"] as $key_two => $value_two) { ?>
    <div class="col-md-3 col-sm-6 hero-feature">
        <!-- <a class="tile" href="<?php echo $value_two["url"]; ?>" target="_blank"> -->

        <div class="thumbnail">
            <div class="delete_small" data-id="<?php echo encode_id($value_two['id']); ?>"> </div>

            <h3> <?php  echo  !empty($value_two["title"])?$value_two["title"]:"Sin titulo";?></h3>
            <h4> <?php  echo  anchor($value_two["url"],$value_two["url"],$attributes=null) ;?></h4>
            <div class="preview_div">
                <?php if(!empty($value_two["iframe"])): ?>
                <?php  echo  $value_two["iframe"];?>
                <?php else: ?>
                <img src="<?php  echo  $value_two["image"];?>">
                <?php endif; ?>
            </div>
            <div class="caption">
                <p><?php echo $value_two['description'] ?></p>
            </div>
        </div>

        <!-- </a> -->
    </div>
    <?php } ?>

        <div class="button-group">
            <!-- <a class="button blue more" href="#">Más</a> -->
            <?php if(!empty($value["links"]) and $value["links"] > $links): ?>
            <p><?php echo $pagination;?></p>
            <?php endif; ?>
        </div>

</section>
<?php } 
endif;
?>
