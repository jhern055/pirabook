    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <?php echo $this->load->view("recycled/menu/panel_heading","",true); ?>
                <!-- /.panel-heading -->
                <div class="panel-body">

<?php $attributes_form = array('class' => 'formAdminSaleAjax'); ?>
<?php  echo form_open("form",$attributes_form);?>

                    <div class="row">
                        <div class="col-sm-6">
                        <div class="dataTables_length" id="dataTables-example_length">
                        <label>Show 
                            <?php echo form_dropdown('show_amount_publication',$sys["forms_fields"]["show_amount"], '10',"id='show_amount_publication'"); ?>
                        </div>
                        </div>

                        <div class="col-sm-6">
                        <div id="dataTables-example_filter" class="dataTables_filter">
                        <label>Nombre:<?php echo form_input("input_search_publication",$input_search_publication," id=input_search_publication"); ?></label>
                        </div>
                        </div>
                    </div>

<?php  echo form_close();?>

                    <div class="dataTable_wrapper" id="div_table">

                            <?php echo $this->load->view("publication/ajax/table-publication-view",$records_array,true); ?>
                    </div>
                    
                </div>
                <!-- /.panel-body -->
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
        
    </div>
<!-- /.row -->

<!-- esto es la paginacion  -->
<script>

// // paginacion de ajax 
$(document).on("change", "select#show_amount_publication", function() {

var formSearch=$("form.formAdminSaleAjax").serialize()+"&ajax=1";

    $.ajax({

        type: "GET",
        data: formSearch,
        url: "<?php echo base_url().$this->uri->uri_string."/publication_ajax/"; ?>",
        beforeSend:function (html) {
        // ajax
        $("div#ajax_loading").addClass("ajax_loading");
        // ...

        },
        success: function(html) {
        $('div#div_table').html(html);

        // ajax
        $("div#ajax_loading").removeClass("ajax_loading");
        // ...

        }

     });

});

$(document).on("keyup", "input#input_search_publication", function() {

var formSearch=$("form.formAdminSaleAjax").serialize()+"&ajax=1";

    $.ajax({

        type: "GET",
        data:formSearch,
        url: "<?php echo base_url().$this->uri->uri_string."/publication_ajax/"; ?>",
        beforeSend:function (html) {
            
        // ajax
        $("div#ajax_loading").addClass("ajax_loading");
        // ...

        },
        success: function(html) {

        $('div#div_table').html(html);

        // ajax
        $("div#ajax_loading").removeClass("ajax_loading");
        // ...
        
        }

     });

});

// paginacion de ajax 
$(document).on("click", "ul.publication_publication_ajax > li > a", function() {

var formSearch=$("form.formAdminSaleAjax").serialize()+"&ajax=1";

    $.ajax({

        type: "GET",
        data:formSearch,
        url: $(this).prop("href"),
        beforeSend: function(html) {

        // ajax
        $("input").prop("disabled",true);
        $("button").prop("disabled",true);
        $("div#ajax_loading").addClass("ajax_loading");
        // ...

        },
        success: function(html) {

        $('div#div_table').html(html);
        $('div#div_table').focus();

        // ajax
        $("input").prop("disabled",false);
        $("button").prop("disabled",false);
        $("div#ajax_loading").removeClass("ajax_loading");
        // ...

        }

     });
    
    return false;

});

$('form.formAdminSaleAjax').submit(false);
</script>

<!-- SEND ENVIAR -->
<script>
$(document).on("click","span.send",function(){

var client_email=$(this).parent().parent().data("client_email"),
    id=$(this).parent().parent().data("row_id"),
    item=$(this)
    ;

    var email=(prompt("Emails separados por comas",client_email)?client_email:"");

    if(!email)
    return false;
        
    $.ajax({
        type: "POST",
        async:true,
        url: "<?php echo base_url().'email/send/';?>",
        dataType:"json",
        data:{  
        
        id:id,
        source_module:"<?php echo encode_id('admin/sale/publication/');?>",
        email:email,

        }, 
        beforeSend:  function(response) {

        // ajax
        $("input").prop("disabled",true);
        $("button").prop("disabled",true);
        $("div#ajax_loading").addClass("ajax_loading");

        // ...
        
        },
        success: function(response){
        // ajax
        $("input").prop("disabled",false);
        $("button").prop("disabled",false);
        $("div#ajax_loading").removeClass("ajax_loading");
        // ...
        if(response.status)
        {$(item).removeClass("mail_not_sent");  $(item).addClass("mail_sent"); }

            $("#dialog > p").text("");
            $("#dialog > p").text(response.msg);
            $("#dialog > p").dialog({
            resizable: false,
            modal: true,
                buttons: {
                    Aceptar: function() {
                    $("#dialog").append("<p></p>");
                    $(this).dialog( "close" );
                    
                    },
                }           
            });                 
        }

    });

});

</script>