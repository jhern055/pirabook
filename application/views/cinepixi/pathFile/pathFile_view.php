<?php 
$CI=&get_instance();
$CI->load->library("CI_List");

// pr($CI->ci_list->contents());
// $CI->ci_list->remove("e4da3b7fbbce2345d7772b0674a318d5");
// $CI->ci_list->destroy();
 ?>
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <?php echo $this->load->view("recycled/menu/panel_heading","",true); ?>

            <!-- Espacio en discos  -->
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>S.ficheros</th>
                        <th>Tamaño</th>
                        <th>Usados</th>
                        <th>Disp</th>
                        <th>Uso%</th>
                        <th>Montado en</th>
                      </tr>
                    </thead>
                    <tbody>

                        <?php if(!empty($disk_space)): ?>

                            <?php foreach($disk_space as $k=>$val): ?>

                                  <tr>
                                    <td><?php echo (!empty($val[0])?$val[0]:"&nbsp;") ?></td>
                                    <td><?php echo (!empty($val[1])?$val[1]:"&nbsp;") ?></td>
                                    <td><?php echo (!empty($val[2])?$val[2]:"&nbsp;") ?></td>
                                    <td><?php echo (!empty($val[3])?$val[3]:"&nbsp;") ?></td>
                                    <td><?php echo (!empty($val[4])?$val[4]:"&nbsp;") ?></td>
                                    <td><?php echo (!empty($val[5])?$val[5]:"&nbsp;") ?></td>
                                  </tr>
                            <?php endforeach; ?>

                        <?php endif; ?>

                    </tbody>
                  </table>                
                <!-- /.panel-heading -->
                <div class="panel-body">

<?php $attributes_form = array('class' => 'formCineveloMovieAjax'); ?>
<?php  echo form_open("form",$attributes_form);?>

                    <div class="row">
                        <div class="col-sm-6">
                        <div class="dataTables_length" id="dataTables-example_length">
                        <label>Show 
                            <?php echo form_dropdown('show_amount_pathFile',$sys["forms_fields"]["show_amount"], '10',"id='show_amount_pathFile'"); ?>
                        </div>
                        </div>

                        <div class="col-sm-6">
                        <div id="dataTables-example_filter" class="dataTables_filter">
                        <label>Nombre Artista:<?php echo form_input("input_search_pathFile",$input_search_pathFile," id=input_search_pathFile"); ?></label>
                        </div>
                        </div>

                        <!-- own -->
                        <div class="col-sm-6">
                        <div id="dataTables-example_filter" class="dataTables_filter">
                        <label>Nombre Canción:<?php echo form_input("input_search_track",$input_search_track," id=input_search_track"); ?></label>
                        </div>
                        </div>
                        <!-- / own -->

<!--                         <div class="col-sm-6">
                        <div id="dataTables-example_filter" class="dataTables_filter">
                        <label><?php //echo form_button($data = '', "Pasar a Usb", $extra = ''); ?></label>
                        </div>
                        </div> -->

                    </div>

<?php  echo form_close();?>

                    <div class="dataTable_wrapper" id="div_table">

                            <?php echo $this->load->view("cinepixi/pathFile/ajax/table-pathFile-view",$records_array,true); ?>
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
$(document).on("change", "select#show_amount_pathFile", function() {

var formSearch=$("form.formCineveloMovieAjax").serialize()+"&ajax=1";

    $.ajax({

        type: "GET",
        data: formSearch,
        url: "<?php echo base_url().$this->uri->uri_string."/pathFile_ajax/"; ?>",
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

$(document).on("keyup", "input#input_search_pathFile", function() {

var formSearch=$("form.formCineveloMovieAjax").serialize()+"&ajax=1";
    $.ajax({

        type: "GET",
        data:formSearch,
        url: "<?php echo base_url().$this->uri->uri_string."/pathFile_ajax/"; ?>",
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

$(document).on("keyup", "input#input_search_track", function() {

var formSearch=$("form.formCineveloMovieAjax").serialize()+"&ajax=1&track=1";
    $.ajax({

        type: "GET",
        data:formSearch,
        url: "<?php echo base_url().$this->uri->uri_string."/pathFile_ajax/"; ?>",
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
// cargar los registros por ajax
// $(document).ready(function(){

//     $.ajax({

//         type: "GET",
//         data:{ajax:1},
//         url: "<?php echo base_url().$this->uri->uri_string."/pathFile_ajax/".(!empty($this->session->userdata('record_start_row_pathFile'))?$this->session->userdata('record_start_row_pathFile'):0 ); ?>",
//         beforeSend:function(html){
//         },
//         success: function(html) {

//         $('div#div_table').html(html);
//         $('div#div_table').focus();

//         }

//      });

// });

// paginacion de ajax 
$(document).on("click", "ul.cinepixi_pathFile_pathFile_ajax > li > a", function() {

var formSearch=$("form.formCineveloMovieAjax").serialize()+"&ajax=1";

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

$('form.formCineveloMovieAjax').submit(false);
</script>

<!-- own -->
<script>
$(document).on("click", "button.addList", function() {
var  this_it=$(this),
     id=$(this).data("id"); 

 $.ajax({

        type: "POST",
        data:{
            id:id,
            source_module:"music"
        },
        url: "<?php echo base_url().'Addlist/addList'; ?>",
        beforeSend: function(html) {

        // ajax
        $("input").prop("disabled",true);
        $("button").prop("disabled",true);
        $("div#ajax_loading").addClass("ajax_loading");
        // ...
        },
        success: function(html) {

        // ajax
        $("input").prop("disabled",false);
        $("button").prop("disabled",false);
        $("div#ajax_loading").removeClass("ajax_loading");
        // ...

        }

     });
    
    return false;    
});




</script>

<!-- <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <a class="btn btn-default load">Load Audio</a>
                        <a class="btn btn-success start">Start Audio</a>

                        <a class="btn btn-default back">&lt;&lt;</a>
                        <a class="btn btn-default forward"> &gt;&gt;</a>
                    </p>
                </div>
                <div class="col-md-5 col-md-pull-1">
                    <p>
                        <a class="btn btn-info pause">Pause Audio</a>
                        <a class="btn btn-danger stop">Stop Audio</a>
                    </p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <p>
                        <a class="btn btn-default volume-up">Volume Up</a>
                        <a class="btn btn-default volume-down">Volume down</a>
                    </p>
                </div>
                <div class="col-md-7">
                    <p>
                        <a class="btn btn-default mute">Toggle Volume On/Off</a>
                    </p>
                </div>
       
            </div>
        </div> -->
<!-- / own -->