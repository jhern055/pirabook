<div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
    
        <div class="row">
        <div class="col-sm-12">

            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
            <thead>
                <tr role="row">
                <th>Folio</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Importe</th>
                <th>Divisa</th>
                <th>Env.</th>
                </tr>
            </thead>
            <tbody>

            <?php //pr($records_array); ?>  
            <?php if(!empty($records_array)): ?>  
            <?php foreach($records_array as $rows): ?> 

                <tr class="gradeA odd" role="row" data-row_id="<?php echo encode_id($rows["id"]); ?>" data-client_email="<?php echo (!empty($rows["client_email"])?$rows["client_email"]:""); ?>">
                    <td class="center"><?php echo (!empty($rows["folio"])? anchor(base_url()."admin/sale/request/requestView/".$rows["id"],$rows["folio"]) :"&nbsp;") ?></td>
                    <td class="center"><?php echo (!empty($rows["client_name"])?anchor(base_url()."client/clientView/".$rows["client_id"],$rows["client_id"]."-".$rows["client_name"]):"&nbsp;") ?></td>
                    <td class="center"><?php echo (!empty($rows["date"])?$rows["date"]:"&nbsp;") ?></td>
                    <td class="center greenBalance-s"><?php echo (!empty($rows["import"])?"$".number_format($rows["import"],2,".",","):number_format(0,2,".",",")) ?></td>
                    <td class="center"><?php echo (!empty($rows["type_of_currency_text"])?$rows["type_of_currency_text"]:"&nbsp;") ?></td>
                    <td class="center"><span class='send <?php echo (!empty($rows["emails_sent"])?'mail_sent':'mail_not_sent'); ?>'></span></td>
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