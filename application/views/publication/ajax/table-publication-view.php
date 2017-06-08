<div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
    
        <div class="row">
        <div class="col-sm-12">

            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
            <thead>
                <tr role="row">
                <th>id</th>
                <th>title</th>
                </tr>
            </thead>
            <tbody>

            <?php if(!empty($records_array)): ?>  
            <?php foreach($records_array as $rows): ?> 
            <?php  
                $class="red";

                if($rows["status"]==1)
                $class="green";

                if($rows["status"]==2)
                $class="blue";
            
            ?>
                <tr class="gradeA odd <?php echo !empty($class)? $class:''; ?>" role="row" data-row_id="<?php echo !empty($rows["id"])? encode_id($rows["id"]):''; ?>">
                    <td class="center"><?php echo (!empty($rows["id"])? anchor(base_url()."publication/publicationView/".$rows["id"],$rows["id"]) :"&nbsp;") ?></td>
                    <td class="center"><?php echo (!empty($rows["name"])?$rows["name"]:"&nbsp;") ?></td>
                </tr>

            <?php endforeach; ?>  
            <?php endif; ?>  


            </tbody>
            </table>
        </div>
        </div>

    <div class="row">
            <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                <?php echo $pagination; ?>
            </div>
    </div>

</div>