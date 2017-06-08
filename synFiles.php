<?php
    // include_once (dirname(__FILE__)."/db.php");
    include  (dirname(__FILE__)).'/application/libraries/PHPExcel/Classes/PHPExcel.php';
    include  (dirname(__FILE__)).'/application/libraries/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';

    // include  (dirname(__FILE__)).'/PHPExcel/Classes/PHPExcel.php';
    // include  (dirname(__FILE__)).'/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
    // $obj= new DB();

    function pr($string){
        echo "<pre>";
        print_r($string);
        echo "</pre>";
    }
    function clean_string($string){
        $string=str_replace("'", "\'", $string);
        return $string;
    }
    function removeWhiteSpace($text) {
    $text = preg_replace('/[\t\n\r\0\x0B]/', '', $text);
    $text = preg_replace('/([\s])\1+/', ' ', $text);
    $text = trim($text);
    return $text;
    }
    function select_path_id($name){
        global $obj;
            if(!empty($name)):
            $select="SELECT * FROM exp.cinepixi_pathFile where name=\"".$name."\"";
            $data=$obj->get_one_result($select,false);
            return $data["id"];
            endif;
    }
    function insert_update_path_or_file($data) {
        global $obj;
        $select="SELECT * FROM exp.cinepixi_pathFile where name='".$data["name"]."' and parentid='".$data["parentid"]."'";
        $last_id=0;

        if($obj->num_rows($select)):
        $obj->update("exp.cinepixi_pathFile",$data,array("name"=>$data["name"],"parentid"=>$data["parentid"] ),1);
            
            $select="SELECT * FROM exp.cinepixi_pathFile where name=\"".$data["name"]."\"";
            $data=$obj->get_one_result($select,false);

            $last_id=$data["id"];

        else:
            $obj->insert("exp.cinepixi_pathFile", $data );
            $last_id=$obj->lastid();
        endif;

        return $last_id;
    } 

    function sync_PATHS($dir,$parentid=0,$last_path) { 
$dir_clean="/opt/lampp/htdocs/cinepixi/Musica/";
        
        $k=array();
        global $obj;

        $cdir = scandir($dir); 
        foreach ($cdir as $key => $value) {
            if (!in_array($value,array(".",".."))) {

                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {

                $dir_path=$dir . DIRECTORY_SEPARATOR . $value;
                $before="";
                $before=explode("/",substr($dir_path, 1));
                if(count($before)>2){
                array_pop($before);
   
                    if($name=end($before) and $name!=$last_path)
                    $parentid=select_path_id($name);

                }
                if($name==$last_path)
                $parentid=0;

                    $data=array(
                        "name"      =>clean_string($value),
                        "real_path" =>clean_string($dir_path),
                        "link"      =>clean_string(str_replace($dir_clean, "", $dir_path)),
                        "file"      =>"",
                        "parentid"  =>$parentid
                        );
                    $parentid=insert_update_path_or_file($data);
                    $k[$value]=sync_PATHS($dir_path,$parentid,$last_path);
                    // si el que inserto es path no modificar el parentid
                    $path_dir=str_replace(
                            array(" ","(",")"), 
                            array("\\ ","\(","\)"), 
                            $dir_path);
                    $_SESSION["paths"]["path_dir"][$parentid]=$path_dir;

                }else{
                
                $dir_path=$dir . DIRECTORY_SEPARATOR . $value;

                    // si no esta en este path uno mas arriba
                    if(!empty($_SESSION["paths"]["path_dir"][$parentid]) and !file_exists($_SESSION["paths"]["path_dir"][$parentid]."/".$value)){
                        $parentid-=1;
                    }

                    $k[] = $value; 
                    $data=array(
                         "name"      =>clean_string($value),
                         "real_path" =>"",
                         "link"      =>"",
                         "file"      =>1,
                         "parentid"  =>$parentid
                         );
                    insert_update_path_or_file($data);

                }
            
            }
        }

   return $k; 

    }

// $dir="/media/dell/67F18E800D673AB3/tmp_nueva";
// $dir="/media/dell/67F18E800D673AB3/tmp_nueva";
// $dir="/media/dell/67F18E800D673AB3/1-Musica";
// $dir="/opt/lampp/htdocs/cinepixi/Musica";
    
// $last_path=explode("/",$dir);
// example /DATA
// $last_path=end($last_path);
// $response=sync_PATHS($dir,0,$last_path);

// $response=fix_name($dir);
// print_r($_SESSION["paths"]);
// echo "<pre>";
// print_r($response);
// echo "</pre>";
// foreach ($response as $key => $value) {
//     // echo "<pre>";
//     echo $key;
//     echo "</br>";

//     foreach ($value as $keyB => $valueB) {

//     echo "-> ".$valueB;
//     echo "</br>";
    
//     }
//     echo "</br>";
//     // echo "</pre>";

// }
function  real_dir($dir_path){
                   $path_dir=str_replace(
                            array(" ","(",")","'","!","&","{","}","`","[","]",";","$"), 
                            array("\\ ","\(","\)","\'","\!","\&","\{","\}","\`","\[","\]","\;","\\$"), 
                            $dir_path);
return $path_dir;  
}

function clean_string_replace($dir_path){
                   $path_dir=str_replace(
                            array("(",")","-","'",".","`","´","-","_","$"), 
                            array(" "), 
                            $dir_path);

return $path_dir;  
}
function clean_string_replace_file($dir_path){
                   $path_dir=str_replace(
                            array("(",")","-","'","`","´","-","_","[","]","unplugged",";","$"), 
                            array(" "), 
                            $dir_path);

return $path_dir;  
}

function removeSlash($dir_path){
                   $path_dir=str_replace(
                            array("\\"), 
                            array(""), 
                            $dir_path);

return $path_dir;  
}
$ext_array       =array("jpg","JPG","png","PNG",".bmp",".BMP");
function fix_name($dir) { 
global $ext_array;

        $k=array();
        global $obj;

        $cdir = scandir($dir); 
        foreach ($cdir as $key => $value) {
            if (!in_array($value,array(".",".."))) {

                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {

                    $dir_path=$dir . DIRECTORY_SEPARATOR .$value;

                    $dir_path_orig=$dir . DIRECTORY_SEPARATOR . $value;
                    $dir_path_fix=$dir . DIRECTORY_SEPARATOR . ucwords(strtolower(clean_string_replace_file(removeWhiteSpace($value))));

                    if($dir_path_orig!=$dir_path_fix){
                    $cmd="sudo mv ".real_dir($dir_path_orig)." ".real_dir($dir_path_fix);
                    shell_exec($cmd);
                    // echo $cmd."\n";
                    // die();
                    $dir_path=removeSlash($dir_path_fix);

                    }

                    $k[$value]=fix_name($dir_path);

                }else{

                    $file_dir_path=$dir . DIRECTORY_SEPARATOR .$value;
                    $ext = pathinfo($value, PATHINFO_EXTENSION);

                    if(in_array($ext, $ext_array))
                    $file_dir_path_fix=$dir . DIRECTORY_SEPARATOR . ucwords(strtolower(str_replace(" ", "", clean_string_replace_file(removeWhiteSpace($value)))));
                    else
                    $file_dir_path_fix=$dir . DIRECTORY_SEPARATOR . ucwords(strtolower(clean_string_replace_file(removeWhiteSpace($value))));

                    if($file_dir_path!=$file_dir_path_fix){
                    $cmd="sudo mv ".real_dir($file_dir_path)." ".real_dir($file_dir_path_fix);
                        shell_exec($cmd);
                        // echo $cmd."\n";
                        // die();
                    }

                    $k[] = $value; 
                }
            
            }
        }

   return $k; 

}


 function array_paths($dir,$parentid=0,$last_path) { 
        
        $k=array();

        $cdir = scandir($dir); 
        foreach ($cdir as $key => $value) {
            if (!in_array($value,array(".",".."))) {

                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {

                $dir_path=$dir . DIRECTORY_SEPARATOR . $value;
                $k[$value]=array_paths($dir_path,$parentid,$last_path);

                }else{
                    $k[] = $value; 
                }
            
            }
        }

   return $k; 

    }

    // array_paths to only one path
    function array_flatten($array) { 
      if (!is_array($array)) { 
        return FALSE; 
      } 
      $result = array(); 
      foreach ($array as $key => $value) { 
        if (is_array($value)) { 
          $arrayList=array_flatten($value);
          foreach ($arrayList as $listItem) {
            $result[] = $listItem; 
          }
        } 
       else { 
        $result[] = $value; 
       } 
      } 

      return $result; 
    }

// $dir="/opt/lampp/htdocs/cinepixi/Musica";
// $dir="/home/pirabook/Música";
$dir="/media/pirabook/67F18E800D673AB3/1-Musica";
// $dir="/home/daniel/files";
    
$last_path=explode("/",$dir);
$last_path=end($last_path);
$data_regs=array_paths($dir,0,$last_path);


$data_records=array();
foreach ($data_regs as $key => $value) {
    $data_records[$key]=array_flatten($value);
    // foreach ($value as $keyA => $valueA) {
    //     if(is_array($valueA))
    //     echo $key." / ".$keyA."\n";
    // }
}

// fix_name($dir);
createExcelPrestashop($data_records);
exit();

// GENERA importar productos PRESTASHOP
function createExcelPrestashop($data_records){
global $dir;

$rowMaster=2;
$columnMaster="B";
$columnDefaultWidth=12;
$columnHeaderDefaultStyle=array("fill"=>array("type"=>PHPExcel_Style_Fill::FILL_SOLID, "color"=>array("rgb"=>"") ), "font"=>array("color"=>array("rgb"=>"FFFFFF")));

$func_resetVars=function($primary_use) {

    global $rowMaster;
    global $rowStart;
    global $rowPointer;
    global $rowStartDataReport;

    global $columnMaster;
    global $columnStart;
    global $columnPointer;

    $columnStart=$columnMaster;
    $columnPointer=$columnMaster;

    if($primary_use) {

        $rowStart=$rowMaster;
        $rowPointer=$rowMaster;

    }

    if(!$primary_use)
     $rowStartDataReport=$rowPointer;

};


    $objPHPExcel = new PHPExcel();

    $objPHPExcel->getProperties()->setCreator("TuEmpresa");
    $objPHPExcel->getProperties()->setLastModifiedBy("TuEmpresa");
    $objPHPExcel->getProperties()->setTitle("Titulo");
    $objPHPExcel->getProperties()->setSubject("Asunto");
    $objPHPExcel->getProperties()->setDescription("Descripcion");
// $func_resetVars(true);

$objPHPExcelActiveSheet=$objPHPExcel->getActiveSheet();

$headers=array(
"A"=>"ID",
"B"=>"Active (0/1)",
"C"=>"Name *",
"D"=>"Categories (x,y,z...)",
"E"=>"Price tax excluded or Price tax included",
"F"=>"Tax rules ID",
"G"=>"Wholesale price",
"H"=>"On sale (0/1)",
"I"=>"Discount amount",
"J"=>"Discount percent",
"K"=>"Discount from (yyyy-mm-dd)",
"L"=>"Discount to (yyyy-mm-dd)",
"M"=>"Reference #",
"N"=>"Supplier reference #",
"O"=>"Supplier",
"P"=>"Manufacturer",
"Q"=>"EAN13",
"R"=>"UPC",
"S"=>"Ecotax",
"T"=>"Width",
"U"=>"Height",
"V"=>"Depth",
"W"=>"Weight",
"X"=>"Quantity",
"Y"=>"Minimal quantity",
"Z"=>"Visibility",
"BA"=>"Additional shipping cost",
"BB"=>"Unity",
"BC"=>"Unit price",
"BD"=>"Short description",
"BE"=>"Description",
"BF"=>"Tags (x,y,z...)",
"BG"=>"Meta title",
"BH"=>"Meta keywords",
"BI"=>"Meta description",
"BJ"=>"URL rewritten",
"BK"=>"Text when in stock",
"BL"=>"Text when backorder allowed",
"BM"=>"Available for order (0 = No, 1 = Yes)",
"BN"=>"Product available date",
"BO"=>"Product creation date",
"BP"=>"Show price (0 = No, 1 = Yes)",
"BQ"=>"Image URLs (x,y,z...)",
"BR"=>"Delete existing images (0 = No, 1 = Yes)",
"BS"=>"Feature(Name:Value:Position)",
"BT"=>"Available online only (0 = No, 1 = Yes)",
"BU"=>"Condition",
"BV"=>"Customizable (0 = No, 1 = Yes)",
"BW"=>"Uploadable files (0 = No, 1 = Yes)",
"BX"=>"Text fields (0 = No, 1 = Yes)",
"BY"=>"Out of stock",
"BZ"=>"ID / Name of shop",
"CA"=>"Advanced stock management",
"CB"=>"Depends On Stock",
"CC"=>"Warehouse"
);

$rowPointer=1;
$columnPointer="A";
foreach ($headers as $key => $value) {
    $objPHPExcelActiveSheet->getColumnDimension($key)->setWidth(30);
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$value);
}


$rowPointer=2;
$columnPointer="A";
    function copy_rr( $path, $dest )
    {
        if( is_dir($path) )
        {
            @mkdir( $dest );
            $objects = scandir($path);
            if( sizeof($objects) > 0 )
            {
                foreach( $objects as $file )
                {
                    if( $file == "." || $file == ".." )
                        continue;
                    // go on
                    if( is_dir( $path.DS.$file ) )
                    {
                        copy_rr( $path.DS.$file, $dest.DS.$file );
                    }
                    else
                    {
                        copy( $path.DS.$file, $dest.DS.$file );
                    }
                }
            }
            return true;
        }
        elseif( is_file($path) )
        {
            return copy($path, $dest);
        }
        else
        {
            return false;
        }
    }
function fn_regRow($data_records,$category){

global $dir;
$numRowId=1;
$numimnnot=1;
$s=358;

foreach ($data_records as $key => $value) {

    // $ID=225465;
    $ID              =$s++;
    $id_split        = str_split($ID);
    
    $urlImage        =array();
    $files           =array();
    $pathCreate      =(dirname(__FILE__))."/img/".implode("/", $id_split)."/";
    $findName      =array();
    $num_row         =1;
    $ext_array       =array("jpg","JPG","png","PNG","bmp","BMP","jpeg","JPEG");

    $longDescription ="<ul>";

    if(is_array($value))
    foreach ($value as $keyb => $valueb) {
        
        $ext = pathinfo($valueb, PATHINFO_EXTENSION);

        if(!in_array($ext,$ext_array)){
        $longDescription.="<li>";
        $longDescription.=$num_row.". ".$valueb;
        $longDescription.="</li>";
        $num_row++;

        $files[]=$valueb;
        }

        if(in_array($ext, $ext_array)){
        $urlImage   []=$valueb;
        // $urlImage   []="/img/".implode("/", $id_split)."/".$valueb;
        // $urlImage   []="http://mercadosale.com/img/p/".implode("/", $id_split)."/".$valueb;
        $findName[]=' -name "*.'.$ext.'" ';
        }
    
    }

    // if(empty($urlImage)){
    // echo $key."\n";
    // $numimnnot++;
    // // die($key);
        
    // }

    $longDescription.="</ul>";

    // damos permisos ala carpeta del proyecto
    shell_exec("sudo chmod 777 -R ".dirname(__FILE__)); 
    // creamos los paths donde van a estar las imagenes
    // if(count($urlImage)>=1){
    if(!file_exists($pathCreate))
    mkdir($pathCreate, 0777,true);
    // }

    // find /home/daniel/files/folder1 -name "*.png" -o -name "*.jpg" -o -name "*.jpg" -o -name "*.jpg" | xargs cp -t /opt/lampp/htdocs/testing/img/p/1/
    if(!empty($findName)){
    $cmd="find ".$dir.DIRECTORY_SEPARATOR.real_dir($key)." ".implode(" -o ",$findName);
    $directories=shell_exec($cmd);
    $directories_array=explode("\n", $directories);
    }

    if(!empty($directories)){
        if($directories_array)
        foreach ($directories_array as $dirKey => $dirValue) {
            if(!empty($dirValue)){
                
                $cmd="sudo cp ".real_dir($dirValue)." ".$pathCreate;
                shell_exec($cmd);
                // pr($cmd);
                // echo $cmd."\n";
            // copy_rr(real_dir($dirValue), $pathCreate);
                // echo real_dir($dirValue)." ".$pathCreate."<br>";

            }
        }
    }

    // echo $cmd;
    // echo "<br>";
    $regs[$key]=array(
    "id"                      =>$ID, #ID,
    "active"                  =>"1", #Active (0/1),
    "name"                    =>substr(clean_string_replace($key), 0,64), #Name *, ->DINAMICO
    "categories"              =>$category, #Categories (x,y,z...), ->Dinamico
    "price"                   =>"30", #Price tax excluded or Price tax included,
    "taxId"                   =>"1", #Tax rules ID,
    "wholesalePrice"          =>"25", #Wholesale price,->Dinamico
    "onSale"                  =>"1", #On sale (0/1),
    "discountAmount"          =>"", #Discount amount,
    "discountPercent"         =>"", #Discount percent,
    "discountFrom"            =>"", #Discount from (yyyy-mm-dd),
    "discountTo"              =>"", #Discount to (yyyy-mm-dd),
    "reference"               =>"", #Reference #,
    "supplierReference"       =>"", #Supplier reference #,
    "supplier"                =>substr(clean_string_replace($key), 0,64), #Supplier, ->Dinamico
    "manufacturer"            =>substr(clean_string_replace($key), 0,64), #Manufacturer, ->Dinamico
    "ean"                     =>"", #EAN13,
    "upc"                     =>"", #UPC,
    "ecotax"                  =>"", #Ecotax,
    "width"                   =>"", #Width,
    "height"                  =>"", #Height,
    "depth"                   =>"", #Depth,
    "weight"                  =>"", #Weight,
    "quantity"                =>"1", #Quantity, ->Dinamico
    "minimalQuantity"         =>"1", #Minimal quantity,
    "visibility"              =>"", #Visibility,
    "shippingCost"            =>"", #Additional shipping cost,
    "unity"                   =>"", #Unity,
    "unityPrice"              =>"", #Unit price,
    "shortDescription"        =>substr(implode(",", $files),0, 155), #Short description, ->Dinamico
    "longDescription"         =>$longDescription, #Description, ->Dinamico
    "tags"                    =>"Musica", #Tags (x,y,z...),
    "metaTitle"               =>"Musica", #Meta title,
    "metaKeywords"            =>"Musica-".$key, #Meta keywords,
    "metaDescription"         =>"Musica-".$key."-".substr(implode(",", $files),0, 20), #Meta description,
    "urlRewritten"            =>"", #URL rewritten,
    "inStock"                 =>"In Stock", #Text when in stock,
    "currentSupply"           =>"", #Text when backorder allowed,
    "availableOrder"          =>"1", #Available for order (0 = No, 1 = Yes),
    "productAvailable"        =>"2013-03-01", #Product available date,
    "productCreation"         =>date("Y-m-d"), #Product creation date,
    "showPrice"               =>"1", #Show price (0 = No, 1 = Yes),
    "imagesUrl"               =>(!empty($urlImage)?implode(",", $urlImage):""), #Image URLs (x,y,z...),
    "deleteExistImage"        =>"0", #Delete existing images (0 = No, 1 = Yes),
    "feature"                 =>"", #Feature(Name:Value:Position),
    "availableOnlineOnly"     =>"1", #Available online only (0 = No, 1 = Yes),
    "condition"               =>"0", #Condition,
    "customizable"            =>"0", #Customizable (0 = No, 1 = Yes),
    "uploadableFiles"         =>"0", #Uploadable files (0 = No, 1 = Yes),
    "textFields"              =>"0", #Text fields (0 = No, 1 = Yes),
    "outOfStock"              =>"0", #Out of stock,
    "nameOfShop"              =>"0", #ID / Name of shop,
    "advancedStockManagement" =>"0", #Advanced stock management,
    "dependsOnStock"          =>"0", #Depends On Stock,
    "warehouse"               =>"0", #Warehouse"
);

}
    echo $numimnnot."\n";


return $regs;
}
// pr($regs);
$regs=fn_regRow($data_records,"Musica");
// pr($regs);
foreach($regs as $k=>$v) {
    $columnPointer="A";
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["id"]);                      
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["active"]);                  
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["name"]);                    
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["categories"]);              
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["price"]);                   
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["taxId"]);                   
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["wholesalePrice"]);          
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["onSale"]);                  
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["discountAmount"]);          
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["discountPercent"]);         
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["discountFrom"]);            
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["discountTo"]);              
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["reference"]);               
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["supplierReference"]);       
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["supplier"]);                
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["manufacturer"]);            
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["ean"]);                     
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["upc"]);                     
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["ecotax"]);                  
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["width"]);                   
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["height"]);                  
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["depth"]);                   
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["weight"]);                  
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["quantity"]);                
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["minimalQuantity"]);         
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["visibility"]);              
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["shippingCost"]);            
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["unity"]);                   
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["unityPrice"]);              
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["shortDescription"]);        
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["longDescription"]);         
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["tags"]);                    
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["metaTitle"]);               
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["metaKeywords"]);            
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["metaDescription"]);         
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["urlRewritten"]);            
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["inStock"]);                 
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["currentSupply"]);           
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["availableOrder"]);          
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["productAvailable"]);        
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["productCreation"]);         
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["showPrice"]);               
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["imagesUrl"]);               
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["deleteExistImage"]);        
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["feature"]);                 
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["availableOnlineOnly"]);     
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["condition"]);               
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["customizable"]);            
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["uploadableFiles"]);         
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["textFields"]);              
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["outOfStock"]);              
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["nameOfShop"]);              
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["advancedStockManagement"]); 
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["dependsOnStock"]);          
    $objPHPExcelActiveSheet->setCellValue(( $columnPointer++ )."$rowPointer",$v["warehouse"]);
    $rowPointer++;              
}
    $objPHPExcel->getActiveSheet()->setTitle('Reporte Enero');

// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment;filename="Reportedealumnos.xlsx"');
// header('Cache-Control: max-age=0');
// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// $objWriter->save('php://output');
// exit;
    // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    // $objWriter->save('nombredearchivo.xlsx');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
// $objWriter->setSheetIndex(1);   // Select which sheet.
$objWriter->setDelimiter(';');  // Define delimiter
$objWriter->save('testExportFile.csv'); 
}
?>