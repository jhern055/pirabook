<?php 

$data_folder = array(
    'name'=> 'title',
    'id'=> '',
    'title'=> '',
    'placeholder'=> 'carpeta1,carpeta2,carpeta3,',
    'class'=> 'form-control folder',
    'tabindex'=> 2
    );
(empty($folder)? "": $data_folder=array_merge($data_folder,array("value"=> $folder,"id"=>encode_id($id) )) ); 

$attributes = 'id="favorite" tabindex="2"';

$data_favorites= form_dropdown('sub_category',$users_favorites_select,null,$attributes);

 ?>
<?php if(!empty($data_publication)): ?>
<?php $submit="Modificar"; ?>
<?php else: ?>
<?php $submit="Guardar"; ?>
<?php endif; ?>
<div class="well">
  
  <h4 class="favorite">Agregar una carpeta o multiples separados por comas</h4>
  <div class="row favoriteRow">

      <div id="submit" class="btn btn-primary"><?php echo $submit; ?></div>
      <div class="form-group folderDiv" id="inputFolder">
      <label for="description"> 

        Carpeta</label>
        <div class="folderAdd"></div>
      <?php echo form_input($data_folder); ?>
      </div>

      <h4> En que carpeta meteras esta carpeta ?</h4>

      <div class="form-group folderDinamicDiv folderDiv selectDiv" id="father" data-num="1" data-parentid="0" >

      <label for="description">Carpeta</label>
      <div class="folder"></div>
        <?php echo $data_favorites; ?>
      </div>


  </div>
</div>
<script>
function alert_danger(field,msg){
var error_html='<div class="alert alert-danger">'
                +'<a class="close" data-dismiss="alert" href="#">&times;</a>'
                +' <a href="javascript:void(0)" class="alert-folder">'+field+'</a> '
                +'<p>'+msg+'.</p>'
                +'</div>'
                ;
    return error_html;
}

$(document).on("click","div.favoriteRow > div#submit",function(){

var element=$(this).parent().parent().find('div.folderDinamicDiv:last-child').get(0);
var url="<?php echo base_url(); ?>",
    folder=[],
    this_it=$(this),
    parentid=$(element).find('select#favorite').val()
    ;

    if(parentid==0)
    parentid=$(element).data('parentid');

$("div.folderDiv > input.folder").each(function(i){
      
      folder[i]={
      id:($(this).data('id')?$(this).data('id'):""),
      folder:$(this).val(),
      parentid:parentid
      };
});

    $.ajax({
        url: url+'favorite/Folder_it',
        type: 'POST',
        dataType: 'json',
        data: {folder_array:folder,parentid:parentid},
        beforeSend: function(response){
        },
        success: function(response){

          if(response.status==1){
            menu.refresh();

            $("div.folderDiv > input").val('');
            $("div.folderDiv > select#favorite").val(0);

            $("div#inputFolder > input").nextAll("").remove();
            $("div#inputFolder > input.folder").html('<input type="text" placeholder="Carpeta1,Carpeta2,Carpeta3" class="form-control folder" tabindex="2">');
            $("div.selectDiv").remove();

            var html='<div class="form-group folderDinamicDiv folderDiv selectDiv">'
                +'<label for="description">Carpeta</label>'
                +'<div class="folder"></div>'
                +response.select_favorite
                +'</div>';

            $('div.favoriteRow:last-child').append(html);
            // $("div.selectDiv").nextAll("").remove();

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
            else{

                if(response.folder==1){
                $(this_it).parent().find('div.folderDiv > input#folder').focus();
                $(this_it).parent().find('div.folderDiv').addClass("borderRequired");

                if(!$(this_it).parent().find('div.folderDiv').find("div.alert-danger").get(0))
                $(this_it).parent().find('div.folderDiv').append(alert_danger("",response.msg));

                }
                else { 
                $(this_it).parent().find('div.folderDiv').removeClass("borderRequired");
                $(this_it).parent().find('div.folderDiv').find("div.alert-danger").remove();
                }
              }
        }

    });

    return false;
});
</script>

<script>
$(document).on("blur","div.favoriteRow > div.folderDiv > input.folder",function(){

  var txt=$(this).val(),
      k=0,
      folder="",
      folders=[],
      html="",
      entro=""
      ;
  if(txt.split(","))
  folders = txt.split(",");

   html="";
   entro=false;

  if(folders.length > 1)
  for (k in folders) {

      folder=folders[k];
       html='<input type="text" name="title" value="'+folder+'" title="" placeholder="Escribe folder" class="form-control folder" tabindex="2">'
        ;
  $(this).parent().append(html);
  entro=true;
  };
  
  if(folders.length > 1)
  $(this).remove();

});
</script>
<script>

$(document).on("change","div.folderDinamicDiv > select#favorite",function(){

var url="<?php echo base_url(); ?>",
    id_favorite=$(this).val(),
    this_it=$(this),
    element=$(this).parent().get(0),
    id_father=$("div#father > select#favorite").val(),
    num=$(this).parent().data("num");
    parentid=$(this).val();
    ; 

    var c=0;
    $("div.folderDinamicDiv").each(function(i){c++; });
    if(c>num)
    {$(element).nextAll("").remove(); }

    $.ajax({
        url: url+'favorite/inputs',
        type: 'POST',
        dataType: 'json',
        data: {id_favorite:id_favorite},
        beforeSend: function(response){

        },
        success: function(response){

        num+=1;

        var html='<div class="form-group folderDinamicDiv folderDiv selectDiv" data-num="'+num+'" data-parentid="'+parentid+'">'
                +'<label for="description">Carpeta</label>'
                +'<div class="folder"></div>'
                +response.select_favorite
                +'</div>';

        $(this_it).parent().parent().parent().find('div.row:last-child').append(html);

        }
    });

});

</script>

<script>
var menu =new Object();
menu.refresh=function(){

      $.ajax({
        url: url+'favorite/buildMenu_favorite',
        type: 'POST',
        dataType: 'json',
        data: {ajax:1},
        beforeSend: function(response){
        },
        success: function(response){

            if(response.status==1)
            $("div#cssmenu").html(response.menu);
        }
    });

}
</script>