
<?php foreach ($ads as $key => $value) { ?>
    <div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">

        <img src="http://placehold.it/320x150" alt="">
        <div class="caption">
        <h4 class="pull-right"></h4>
        <h4><?php echo anchor(base_url().'home/ad/'.$value->id, $value->title, "title='".$value->title."'"); ?>
        </h4>
        <p><?php echo $value->description?substr($value->description, 0,110)."...":"&nbsp;"; ?></p>
        </div>
        <div class="ratings">
        <p class="pull-right"><?php echo $value->views?:"0"; ?> Visitas</p>
        <p>
        <span class="glyphicon glyphicon-star"></span>
        <span class="glyphicon glyphicon-star"></span>
        <span class="glyphicon glyphicon-star"></span>
        <span class="glyphicon glyphicon-star"></span>
        <span class="glyphicon glyphicon-star-empty"></span>
        </p>
        </div>

    </div>

    </div>
<?php } ?>
        <p><?php echo $pagination;?></p>