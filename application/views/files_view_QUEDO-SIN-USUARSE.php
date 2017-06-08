<?php       if (isset($files) && count($files)){ ?>
        <ul class="list-group">
            <?php    foreach ($files as $file){ ?>
                <li class="list-group-item">
                    <img src="<?php echo base_url().'images/uploads/imgPost/'.$file->filename ?>">
                    <a href="#" class="delete_file_link" data-file_id="<?php echo $file->id?>">
                    <img src="<?php echo base_url().'images/interface/ajax-fail.png'?>">
                    </a>
                    <strong><?php echo $file->title?></strong>
                    <br />
                    <div class="name_file">
                    <?php echo $file->filename?>
                    </div>
                </li>
                <?php } ?>
        </ul>
    </form>
    <?php   }   else{ ?>
    <!-- <p>No archivos subidos</p> -->
    <?php       } ?>