<div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
    
        <div class="row">
        <div class="col-sm-12">

            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
            <thead>
                <tr role="row">
                <th>Id</th>
                <th >Nombre</th>
            </thead>
            <tbody>
            <?php if(!empty($records_array)): ?>  
            <?php foreach($records_array as $rows): ?> 

                <tr class="gradeA odd" role="row">
                    <td class="center"><?php echo (!empty($rows["id"])? anchor(base_url()."cinepixi/pathFile/pathFileView/".$rows["id"],$rows["id"]) :"&nbsp;") ?></td>
                    <td class="center">
                        <?php //echo (!empty($rows["name"])?$rows["name"]:"&nbsp;") ?>
                        <div id="cssmenu">
                        <?php echo $rows["menu_html"]; ?>
                         </div>
                        <?php //echo $rows["menu_html"]; ?>

                    </td>
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
<script type="text/javascript">
$(".audioDemo").trigger('load');
var audio;
        //jInit is my own site standard which is triggered after aynschronous loading of javascript
        //libraries. You can here use $(document).ready instead, in general case.
        function jInit(){
            audio = $(".audioDemo");
            addEventHandlers();
        }
 
        function addEventHandlers(){
            $("a.load").click(loadAudio);
            $("a.start").click(startAudio);
            $("a.forward").click(forwardAudio);
            $("a.back").click(backAudio);
            $("a.pause").click(pauseAudio);
            $("a.stop").click(stopAudio);
            $("a.volume-up").click(volumeUp);
            $("a.volume-down").click(volumeDown);
            $("a.mute").click(toggleMuteAudio);
        }
 
        function loadAudio(){
            audio.bind("load",function(){
                $(".alert-success").html("Audio Loaded succesfully");
            });
            audio.trigger('load');
        }
 
        function startAudio(){
            audio.trigger('play');
        }
 
        function pauseAudio(){
            audio.trigger('pause');
        }
 
        function stopAudio(){
            pauseAudio();
            audio.prop("currentTime",0);
        }
 
        function forwardAudio(){
            pauseAudio();
            audio.prop("currentTime",audio.prop("currentTime")+5);
            startAudio();
        }
 
        function backAudio(){
            pauseAudio();
            audio.prop("currentTime",audio.prop("currentTime")-5);
            startAudio();
        }
 
        function volumeUp(){
            var volume = audio.prop("volume")+0.2;
            if(volume >1){
                volume = 1;
            }
            audio.prop("volume",volume);
        }
 
        function volumeDown(){
            var volume = audio.prop("volume")-0.2;
            if(volume <0){
                volume = 0;
            }
            audio.prop("volume",volume);
        }
 
        function toggleMuteAudio(){
            audio.prop("muted",!audio.prop("muted"));
        }

</script>