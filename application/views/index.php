<div class="col-sm-9 col-md-8 col-lg-8" >
<div id="publications_divs"></div>
<div id="things_content"></div>
</div>
<!-- esto es la paginacion  -->
<script>

// si el usuario quiere ordenar las publicaciones
// paginacion de ajax 
$(document).on("click", "table.publicationsTable > tbody > tr.header > td", function() {

// var order_by=$(this).prop("class");
//     $.ajax({

//         type: "GET",
//         url: "<?php echo base_url().'home/show_ajax/'; ?>",
//         data:{order_by:order_by},
//         beforeSend: function(html) {
//         },
//         success: function(html) {
//         $('div#things_content').html(html);

//         }

//      });

});

// cargar los anuncios por ajax
$(document).ready(function(){

    // $.ajax({

    //     type: "GET",
    //     url: "<?php echo base_url().'home/show_ajax/'; ?>",
    //     beforeSend:function(html){
    //     },
    //     success: function(html) {

    //     $('div#things_content').html(html);

    //     }

    //  });

    $.ajax({

        type: "GET",
        url: "<?php echo base_url().'home/show_ajax_div/'; ?>",
        beforeSend:function(html){
            
        },
        success: function(html) {
        $('div#publications_divs').html(html);

        }

     });

});

// paginacion de ajax 
$(document).on("click", "ul.things_pagination > li > a", function() {

    var thisClick=$(this),
        id_category=$(this).parent().parent().data("id_catery")
        input_search=$("input#search").val()
        ;
    hide_divs();

    $.ajax({

        type: "GET",
        data:{
            id_category:id_category,
            input_search:input_search
        },
        url: $(this).prop("href"),
        beforeSend: function(html) {
        },
        success: function(html) {

        if($(thisClick).parent().parent().data("paginations_div")){
        $('div#publications_divs').html(html);
        $('div#publications_divs').focus();
            
        }
        else{
        $('div#things_content').html(html);
        $('div#things_content').focus();

            
        }


        }

     });
    
    return false;

});

</script>