<?php
    include_once (dirname(__FILE__)."/db.php");
    $obj= new DB();


function pr($data) {

    echo "<pre>";
    print_r($data);
    echo "</pre>";  
}

// $file_string = file_get_contents("testExportFile_little.csv");
$file_string = file_get_contents("testExportFile.csv");
$data_ln = str_getcsv($file_string, "\n");

foreach($data_ln as &$row) $row = str_getcsv($row, ";"); 

array_shift($data_ln);
function removeWhiteSpace($text) {
    $text = preg_replace('/[\t\n\r\0\x0B]/', '', $text);
    $text = preg_replace('/([\s])\1+/', ' ', $text);
    $text = trim($text);
    return $text;
}
// pr($data_ln);
$data_sql=array();
foreach ($data_ln as $key => $value) {
	// $data_sql[]=array(
	//  	"id"=>$value[0],
	//  	"title"=>removeWhiteSpace($value[2]),
	//  	"category"=>"37", //Mus
	//  	"description"=>$value[30], 
	//  	"email"=>"pirabook@hotmail.com",
	//  	"status"=>"0",
	//  	"images"=>explode(",", $value[42]),
	//  	"registred_by"=>"2",
	//  	);
}

// pr($data_ln);
// pr($data_sql);
// exit();

foreach ($data_ln as $kB=> $valB) {

// publicaciones
		$data_sql_publication=array(
			"id"           =>$valB[0],
			"title"        =>removeWhiteSpace($valB[2]),
			"category"     =>"37", //Mus
			"description"  =>$valB[30], 
			"email"        =>"pirabook@hotmail.com",
			"status"       =>"0",
			"like_sure"    =>"0",
			"registred_by" =>"2",
	 	);

	$data_sql_depend=array();
	$select="SELECT * FROM pirabook_pirabook.publications where title = '".$data_sql_publication["title"]."';";

	if($obj->get_one_result($select)):

		$data_sql_depend=array_merge($data_sql_publication,array("updated_on"=>date("Y-m-d H:m:s") ));
        $obj->update("pirabook_pirabook.publications", $data_sql_depend,array("title"=>$data_sql_publication["title"]),1 );

	else:
		$data_sql_depend=array_merge($data_sql_publication,array("registred_on"=>date("Y-m-d H:m:s") ));
        $obj->insert("pirabook_pirabook.publications", $data_sql_depend );

	endif;


	// # IMAGES
	$data_sql_depend=array();

	if(!empty($valB[42]) and !empty($valB[0])){
	 	$data_images_explode=explode(",", $valB[42]);
	 	if(!empty($data_images_explode))
		foreach ($data_images_explode as $kC=> $valC):

		if(empty($valC))
			continue;

			$data_sql_image=array(
		 	"filename"=>$valC,
		 	"publication_id"=>$valB[0], 
		 	);
			$select="SELECT * FROM pirabook_pirabook.publications_file where filename = '".$data_sql_image["filename"]."' and publication_id = '".$data_sql_image["publication_id"]."';";

			if($obj->num_rows($select)):

	        	$obj->update("pirabook_pirabook.publications_file", $data_sql_image,array("filename"=>$data_sql_image["filename"]),1 );
			else:

		        $obj->insert("pirabook_pirabook.publications_file", $data_sql_image );	
	        		
			endif;

		endforeach;	
	}

}
 ?>