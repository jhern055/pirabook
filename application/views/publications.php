
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
<style type="text/css">
a{ color:#4A366B;}
a:hover{ color:blue;}
</style>
    <?php if (!empty($publications)) { ?>
<section id="wdg_popular_games" class="wdg_popular_games grid grid-ui ">
<h2>Total de publicaciones: <?php echo $total_rows ?> </h2>
<ul class="grid-row col-2 col-s-3 col-m-4 col-l-6">
    <?php foreach ($publications as $key => $value) {  ?>
        <li class="grid-col">
            <div class="tile" title="<?php echo $value['title']; ?>">
                <!-- Imagen -->
                <div class="tile-thumbnail">
                    <a href="<?php echo base_url().'home/publication/'.$value["id"]; ?>" title="<?php echo $value['title']; ?>">
                    <img src="<?php echo $value["gif_path"]; ?>" alt="">
                    </a>
                </div>
                <!-- Title -->
                <div class="tile-title">
                    <a href="<?php echo base_url().'home/publication/'.$value["id"]; ?>" title="<?php echo $value['title']; ?>">
                    <?php echo $value['title'] ?>
                    </a>

                </div>
                <?php
                $c=1;
                if(!empty($value["links"]))
                foreach ($value["links"] as $key => $rowLink) { ?>
                <div class='tile-download'>
                    <?php echo (!empty($rowLink['link'])? anchor($rowLink['link'],"Descarga (".$c++.")"," style='font-color=blue;' target='_blank'"):"") ?>
                </div>
               <?php } ?>          
            </div>
        </li>
    <?php } ?>
    <div class="button-group">
    <p><?php echo $pagination;?></p> 
    </div>
</ul>

</section>
    <?php } ?>