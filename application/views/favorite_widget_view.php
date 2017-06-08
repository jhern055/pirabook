   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

<div class="col-sm-4 col-md-4 col-lg-4">
    <!-- favorites Well -->
    <div class="well">

        <!-- AGREGAR CARPTA -->
        <div class="row addFolder" title="Agregar carpeta"></div>

        <h4 class="favorite">Mis favoritos</h4>

            <div class="row category">
             <!-- <div class="col-lg-6"> -->
            <div id='cssmenu'>

            <?php echo $my_favorites; ?>
            </div>

            <!-- </div> -->
            </div>

    </div>

</div>
<div class="col-sm-8 col-md-8 col-lg-8">
            <?php echo $favorite_view_add_link; ?>
</div>

<script>
$(document).on("click","div.well > div.addFolder",function(){
window.location.href="addFolder/";
});
</script>

<script>
$(document).on("click","a > div.delete_small ",function(){

var url="<?php echo base_url(); ?>",
    id_menu=$(this).data("id_menu"),
    text_diag="Seguro que desea eliminar ",
    name_fav=$(this).parent().text(),
    this_it=$(this).get(0)
    ; 

    $("#dialog > p").text("");
    $("#dialog > p").text("Deseas eliminar "+name_fav+" ?");

    $("#dialog > p").dialog({
    resizable: false,
    modal: true,

    buttons: {
       "Si": function() {
         $.ajax({
                url: url+'favorite/delete',
                type: 'POST',
                dataType: 'json',
                data: {id_menu:id_menu},
                beforeSend: function(response){
                },
                    success: function(response){

                        if(response.status==1)
                        $(this_it).parent().parent().remove();
                        else{

                        $("#dialog > p").text("");
                        $("#dialog > p").text(response.msg);
                            
                        $("#dialog > p").dialog({
                            resizable: false,
                            modal: true,

                              buttons: {
                              "Bien": function() {
                              
                              $("#dialog").append("<p></p>");
                              $(this).dialog( "close" );
                              },

                              }

                        });
                        
                        }

                    }
                    });

        $("#dialog").append("<p></p>");
        $(this).dialog( "close" );
        },

                   "No": function() {
                             $("#dialog").append("<p></p>");
                            $(this).dialog( "close" );
                            },
        }

});        
       

});

</script>

<script>
$(document).on("click","ul > li > a ",function(){

var url="<?php echo base_url(); ?>",
    id_menu=$(this).parent().data("id_menu"),
    this_it=$(this).get(0)
    ; 

         $.ajax({
                url: url+'favorite/get_links',
                type: 'POST',
                dataType: 'json',
                data: {id_menu:id_menu},
                beforeSend: function(response){
                },
                success: function(response){
                
                $('div.well > div.favoriteRow').html(response.data);
                $('div.well > div.favoriteRow').focus();
            

                }
          });
});

// paginacion de ajax 
$(document).on("click", "ul.things_pagination > li > a", function() {
    var thisClick=$(this)
        id_menu=$(this).parent().parent().data("id_favorite")
        ;

    $.ajax({
        type: 'POST',
        dataType: 'json',
        data:{id_menu:id_menu},
        url: $(this).prop("href"),
        beforeSend: function(html) {
        },
        success: function(html) {

        $('div.well > div.favoriteRow').html(html.data);
        $('div.well > div.favoriteRow').focus();

        }

     });
    
    return false;

});

</script>

<script>
$(document).on("click","div.thumbnail > div.delete_small",function(){

        var url="<?php echo base_url(); ?>",
        id_url=$(this).data("id"),
        text_diag="Seguro que desea eliminar este url ",
        title=$(this).parent().find("h3").text(),
        this_it=$(this).get(0)
        ; 

        $("#dialog > p").text("");
        $("#dialog > p").text("Deseas eliminar "+title+" ?");

        $("#dialog > p").dialog({
        resizable: false,
        modal: true,

        buttons: {
           "Si": function() {
             $.ajax({
                    url: url+'favorite/delete_url',
                    type: 'POST',
                    dataType: 'json',
                    data: {id_url:id_url},
                    beforeSend: function(response){
                    },
                        success: function(response){

                            if(response.status==1)
                            $(this_it).parent().parent().remove();
                            else{

                            $("#dialog > p").text("");
                            $("#dialog > p").text(response.msg);
                                
                            $("#dialog > p").dialog({
                                resizable: false,
                                modal: true,

                                  buttons: {
                                  "Perfecto": function() {
                                  
                                  $("#dialog").append("<p></p>");
                                  $(this).dialog( "close" );
                                  },
                                  }

                            });
                            
                            }

                        }
                        });

            $("#dialog").append("<p></p>");
            $(this).dialog( "close" );
            },

           "No": function() {
             $("#dialog").append("<p></p>");
            $(this).dialog( "close" );
            },

            }

        });        
       
});

</script>