<?php  
echo $host = 'http://'.$_SERVER['HTTP_HOST'].'/pirabook';
if ( ! defined('BASEPATH')) 
header("Location: ".$host."");
exit();
 ?>