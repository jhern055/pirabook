<!DOCTYPE html>
<html lang="es">    
    <head>
        <meta charset="utf-8" />
        <script src=" http://code.jquery.com/jquery-1.9.1.js"></script>
        <style type="text/css">
            #paginacion{
                border: 1px solid #eee;
                background: #f6c604;
                color #fff;
                font-size: 20px; 
                padding: 10px;
                width: 250px;
                font-size: 14px;
                text-align: center;
            }
        
            #paginacion table{
                background: #2e1d24;
                color: #fff;
                width: 250px;
                padding: 20px;
            }
            .page_link{
                /*css para los links*/
            }
        </style>
    </head>
    <body>
        
        <?php echo $table; ?>
        
    </body>
</html>