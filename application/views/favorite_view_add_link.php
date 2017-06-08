<?php 

echo $linkPreview_css;
echo $stylesheet_css; 

$data_link = array(
    'name'=> 'title',
    'id'=> '',
    'title'=> '',
    'placeholder'=> 'link1,link2,link3',
    'class'=> 'form-control link',
    'tabindex'=> 2
    );
(empty($link)? "": $data_link=array_merge($data_link,array("value"=> $link,"id"=>encode_id($id) )) ); 

$attributes = 'id="favorite" tabindex="2"';

$data_favorites= form_dropdown('sub_category',$users_favorites_select,null,$attributes);

 ?>
<?php if(!empty($data_publication)): ?>
<?php $submit="Modificar"; ?>
<?php else: ?>
<?php $submit="Guardar"; ?>
<?php endif; ?>
<div class="well">
  
  <div class="row favoriteRow">
  <h4 class="favorite"><!-- Agregar un link o varios separados por comas --></h4>

      <div id="submit" class="btn btn-primary"><?php echo $submit; ?></div>
      <div class="form-group linkDiv">
      <label for="description" class="required">Link</label>
      <?php //echo form_input($data_link); comentado porque uso el preview ?>
  
      <div class="linkPreview" id="lp1"></div>

      </div>

      <div class="form-group favoriteDiv" id="father" data-num="1" data-parentid="0" >
      <label for="description" class="required">Carpeta</label>
      <?php echo $data_favorites; ?>
      </div>

            <div id="retrieveFromDatabase" ></div>

  </div>
</div>
<script>
function alert_danger(field,msg){
var error_html='<div class="alert alert-danger">'
                +'<a class="close" data-dismiss="alert" href="#">&times;</a>'
                +' <a href="javascript:void(0)" class="alert-link">'+field+'</a> '
                +'<p>'+msg+'.</p>'
                +'</div>'
                ;
    return error_html;
}

$(document).on("click","div.favoriteRow > div#submitDESCOPADO",function(){

var element=$(this).parent().parent().find('div.favoriteDiv:last-child').get(0);
var url="<?php echo base_url(); ?>",
    link=[],
    this_it=$(this),
    parentid=$(element).find('select#favorite').val()
    ;

    if(parentid==0)
    parentid=$(element).data('parentid');

$("div.linkDiv > input.link").each(function(i){
      
      link[i]={
      id:($(this).data('id')?$(this).data('id'):""),
      link:$(this).val(),
      parentid:parentid
      };
});

    $.ajax({
        url: url+'favorite/link',
        type: 'POST',
        dataType: 'json',
        data: {link_array:link,parentid:parentid},
        beforeSend: function(response){
        // $(this_it).parent().find("div.row").append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');

        },
        success: function(response){

          if(response.status==1){

            $("div.linkDiv > input").val('');
            $("div.favoriteDiv > select#favorite").val(0);

            $("div.linkDiv > input").nextAll("").remove();
            $("div.linkDiv > input.folder").html('<input type="text" placeholder="link1,link2,link3" class="form-control link" tabindex="2">');
            $("div.favoriteDiv").remove();

            var html='<div class="form-group favoriteDiv" id="father" data-num="1" data-parentid="0">'
                      +'<label for="description" class="required">Carpeta</label>'
                      +response.select_favorite
                      +'</div>';

            $('div.favoriteRow:last-child').append(html);

          }
            else{

                if(response.link==1){
                $(this_it).parent().find('div.linkDiv > input#link').focus();
                $(this_it).parent().find('div.linkDiv').addClass("borderRequired");

                if(!$(this_it).parent().find('div.linkDiv').find("div.alert-danger").get(0))
                $(this_it).parent().find('div.linkDiv').append(alert_danger("",response.msg));

                }
                else { 
                $(this_it).parent().find('div.linkDiv').removeClass("borderRequired");
                $(this_it).parent().find('div.linkDiv').find("div.alert-danger").remove();
                }

                    // if(response.folder==1){
                       
                    //     $("#dialog > p").text("");
                    //     $("#dialog > p").text(response.msg);
                    //     $("#dialog > p").dialog({
                    //     resizable: false,
                    //     modal: true,

                    //       buttons: {
                    //          "Esta bien": function() {
                    //           $("#dialog").append("<p></p>");
                    //           $(this).dialog( "close" );
                    //           },
                    //       }

                    //    });
                    // }
              }
        }

      });
    return false;
});
</script>

<script>
$(document).on("blur","div.favoriteRow > div.linkDiv > input.link",function(){

  var txt=$(this).val(),
      k=0,
      link="",
      links=[],
      html="",
      entro=""
      ;
  if(txt.split(","))
  links = txt.split(",");

   html="";
   entro=false;

  if(links.length > 1)
  for (k in links) {

      link=links[k];
       html='<input type="text" name="title" value="'+link+'" title="" placeholder="Escribe link" class="form-control link" tabindex="2">'
        ;
  $(this).parent().append(html);
  entro=true;
  };
  
  if(links.length > 1)
  $(this).remove();

});
</script>
<script>

$(document).on("change","div.favoriteDiv > select#favorite",function(){

var url="<?php echo base_url(); ?>",
    id_favorite=$(this).val(),
    this_it=$(this),
    element=$(this).parent().get(0),
    id_father=$("div#father > select#favorite").val(),
    num=$(this).parent().data("num");
    parentid=$(this).val();
    ; 

    var c=0;
    $("div.favoriteDiv").each(function(i){c++; });
    if(c>num)
    {$(element).nextAll("").remove(); }

    $.ajax({
        url: url+'favorite/inputs',
        type: 'POST',
        dataType: 'json',
        data: {id_favorite:id_favorite},
        beforeSend: function(response){
        $(this_it).parent().find("div.row").append('<img class="loading" src="<?php echo base_url(); ?>/images/interface/facebook_style_loader.gif" />');

        },
        success: function(response){

        num+=1;

        var html='<div class="form-group favoriteDiv" data-num="'+num+'" data-parentid="'+parentid+'">'
                +'<label for="description" class="required">Carpeta</label>'
                +response.select_favorite
                +'</div>';

        $(this_it).parent().parent().parent().find('div.row:last-child').append(html);

        }
    });

});

</script>

<?php echo $linkPreview; ?>
<?php echo $linkPreviewRetrieve; ?>

  <script>
      $(document).ready(function() {
          $('#lp1').linkPreview({placeholder: "Aqui pon tu url"});
          // $('#retrieveFromDatabase').linkPreviewRetrieve();

      });
  </script>