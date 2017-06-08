                <?php
             // pr($notifications_data);
            //exit(); 
            ?>
     <script type="text/javascript">
    // javascript de las notificaciones
    $(document).ready(function() {

        $('li.dropdown > ul').css({display: "none"});

        $('li.click_notifications').click(function(){

            if( $(this).find('ul').is(':visible')){
            $(this).find('ul.sub-menu').css({display: "none"});
            // $(this).parent().parent().find('ul').css({display: "none"});
            }
            else{
            $(this).find('ul.sub-menu').css({display: "block"});
            // $(this).parent().parent().find('ul').css({display: "block"});
            }

        });
    });
    </script>
        <ul class="" >

        <li role="notification" class="marginNotificationButton">
            <li class="dropdown click_notifications">
            <div class="user_notification"></div>
                <a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'>
                    <i class="fa fa-envelope"></i>
                    <span class="badge notifications"></span>
                </a>
                <!--  -->

            <ul class="sub-menu">
            <li class="egg" id="egg">
            <?php echo $this->load->view("egg_view",$notifications_data,true); ?>
            </li>

<!-- este es el de traer notificaciones  -->
        <script>
        var url="<?php echo base_url(); ?>";
        // $("span.notifications").load( url+'notifications/getNotificationsNum');
        $("span.notifications").load( url+'notifications/getNotificationsNum', function( response, status, xhr ){
        });
        var view_more_comments=new Object();
            view_more_comments_div="ul.sub-menu > li#egg > div.view_more_comments";
            li_egg="ul.sub-menu > li#egg";

            $(document).on("click",view_more_comments_div,function(){

               if( $(this).parent().parent().parent().find('ul').is(':visible')){
                // $(this).parent().parent().parent().find('ul.sub-menu').css({display: "none"});
                // $(this).parent().parent().parent().find('ul').css({display: "none"});
                }
                else{
                $(this).parent().parent().parent().find('ul.sub-menu').css({display: "block"});
                $(this).parent().parent().parent().find('ul').css({display: "block"});
                }

            var amount_show = $(this).data("amount_show"),
                this_funct=$(this);

            $.ajax({

            type: "POST",
            url: url+"notifications/getNotifications_egg_html",
            data: {"amount_show": amount_show}, 
            cache: false,
            dataType: "json",
            beforeSend: function(html){
            },
            success: function(html){
            $(li_egg).text("");
            $(li_egg).append(html.data);
            $('ul.sub-menu > li#egg > div.view_more_comments:last-child').attr("tabindex",-1).focus();

            }

            });

            return false;

            });


            $(document).ready(function(){

                $(document).keyup(function (e) {
                var key = (e.keyCode ? e.keyCode : e.charCode);

                switch (key) {
                case 113:
                $(view_more_comments_div).focus().click();
                // $("li.click_notifications").click();
                // $('li.click_notifications').focus().click(function(){

 

                // });

                break;


                default: ;
                }

                });

            });
            </script>

            </ul>

            </li>

        </li>

        </ul>