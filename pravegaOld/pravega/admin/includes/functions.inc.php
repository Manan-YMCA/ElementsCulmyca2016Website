<?php
date_default_timezone_set('Asia/Kolkata');
/*	SERVER database connection

	*/

function db_connect(){	

$connection_server=mysql_connect('localhost','root','');

if(!$connection_server){

   return false;	}

$connection_db=mysql_select_db('ayur');

if(!$connection_db){

	return false;

}	return $connection_server;

}	

	/* To protect from SQL injection */

	

	function escape_data($data) { 

	db_connect();

	//global $dbc; // Database connection.	

	// Strip the slashes if Magic Quotes is on:

	//if (get_magic_quotes_gpc()) 

	$data = stripslashes($data);	

	// Apply trim() and mysqli_real_escape_string():

	return htmlspecialchars(mysql_real_escape_string(trim($data)));

	

} // End of the escape_data() function.

	/*

	Query Executor for display function and returns result in array

    $query - sql query [even multiple query works]

	*/

	function basic_display($query){

    	db_connect();		

		$result = mysql_query($query) or die("query failed ".mysql_error());

		$result = db_results($result);

		return $result;	

	}	





	/*

	Basic Display

	$table - Table Name

	$Order - Order by which field

	$by - ASC or DESC0

	*/

	function display($table,$order,$by){

		db_connect();

		$query = "SELECT * FROM $table ORDER BY $table.$order $by";

		$result = mysql_query($query) or die("query failed ".mysql_error());

		$result = db_results($result);

		return $result;

	}



		function user_details($table1,$table2,$where){

		db_connect();

		$query = "SELECT * FROM $table1 A,

		                        $table2 B

							    $where";  //echo $query;														

    	$result = mysql_query($query)or die("query failed ".mysql_error());

		$result = db_results($result);

        return $result;

		}



	/*

	Display selected

	Need to upgrade this function with count

	$table - Table Name

	$where - Where Query

	*/



	



		function display_selected($table,$where){



		db_connect();



		 $query = "SELECT * FROM $table $where"; 

     

		$result = mysql_query($query)or die("query failed ".mysql_error());



		//$result = mysql_fetch_array($result);

		$result = db_results($result);



		return $result;







	}



	
	//Map code
 	function display_selected_assoc_map($table,$lat,$long,$field1,$field2,$type,$distance,$limit,$country_id){
		db_connect();
		$query = "SELECT * , ( 6371 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS( $field1 ) ) * COS( RADIANS( $field2 ) - RADIANS( $long ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS( $field1 ) ) ) ) AS distance FROM stores where type=$type and country_id=$country_id HAVING distance < $distance ORDER BY distance"; 
		//echo $query;
		//die();
		$result = mysql_query($query)or die("query failed  ".mysql_error());
		$result = db_results_assoc($result);
		return $result;
 	}



	/*



	Result pop



	Required for display function



	*/



	function db_results($result){



	



		$res_array = array();



		for($count=0;$row = mysql_fetch_array($result);$count++)



			{



				$res_array[$count] = $row;



			}



		return $res_array;



	}



	



	/*



	Universal Insert System



	*/



	function insert($info, $table) {



		db_connect();



   		if (!is_array($info)) { die("insert failed, info must be an array"); }



      	$sql = "INSERT INTO ".$table." (";



      	for ($i=0; $i<count($info); $i++) {



     		$sql .= key($info);



     		if ($i < (count($info)-1)) {



        		$sql .= ", ";



     		} else $sql .= ") ";



        next($info);



     }



     reset($info);



     $sql .= "VALUES (";



     for ($j=0; $j<count($info); $j++) {



        $sql .= "'".current($info)."'";



        if ($j < (count($info)-1)) {



           $sql .= ", ";



        } else $sql .= ") ";



        next($info);



     }


  $sql;
         //execute the query

     mysql_query($sql) or die("query failed ".mysql_error());



         return mysql_insert_id();



      } 



	  



	  /*



	  Basic update Function



	  



	  */



	  	function update_simple($table,$data,$where) {

		 db_connect();

	 $query = "UPDATE $table SET $data $where"; 

		 $result = mysql_query($query)or die("query failed ".mysql_error());

		//$result = db_results($result);

		return $result;



      } 



	  

/*

					ACTION: Upload Files

					$filename = Passess the FILE ARRAY

					$uploaddir = DIRECTORY to upload the file

					$filter = To filter file type images, documents, videos, all

					*/

					function upload_simple_files($filename,$uploaddir,$filter){

							//FILE TYPES FILTER

							$ftype1 = array("png","jpg","jpeg","gif","JPEG");

							$ftype2 = array("txt","doc","pdf","xml","xls","docx");

							$ftype3 = array("mp4","avi","mp3","3gb","fla","swf","flv");

							$ftype4 = array("png","jpg","jpeg","gif","txt","doc","pdf","xml","xls","docx","mp4","avi","mp3","3gb","fla","swf");

							

							//UPLOAD DIRECTORY TO BE PASSED

							$filelocation = $uploaddir;				

							//print_r($filename[0]); die();

							

							//GRAB EXTENSION AND VALID THE FILTER MODE

						    $extension = findexts($filename[0]['name']);	
							$randomname = rand(0,99999999999999);							$newfilename = $randomname.".".$extension;
							//FILTER VALIDATION							
							if($filter == "images"){   
							//$f = in_array($extension,$ftype1); print_r($f); die();                   

								if(in_array($extension,$ftype1)){									

											 $flag = 1;  

		                                     

											}

											else

											{

											$flag = 0;	

											}

							}

							else

							if($filter == "documents"){

								if(in_array($extension,$ftype2)){

											$flag = 1;

											}

											else

											{

											$flag = 0;	

											}

							}

							else

							if($filter == "videos"){

								if(in_array($extension,$ftype3)){

											$flag = 1;

											}

											else

											{

											$flag = 0;	

											}

								

							}

							else

							if($filter == "all"){

								if(in_array($extension,$ftype4)){

											$flag = 1;

											}

											else

											{

											$flag = 0;	

											}

							}

							else

							{

							$message = "FILTER MODE NOT SELECTED";

							return $message;

							}

							//echo $newfilename;

							//die();

							

							$target_path = $filelocation.$newfilename;   

							if($flag==1){ 							//print_r($filename); echo $target_path;// die();

						    	if(move_uploaded_file($filename[0]['tmp_name'], $target_path)){ 

								 // echo "HERE";

								  //die();

								  //echo $target_path;

								  $message = $newfilename;

								   return $message;

							     }

							    else

							    {

									//echo $filename;

									//die();

									$error = "No File Selected";

									return $error; 	

								}

							}

							else

							{

								$message = "Invalid File type. Please upload supported file types";

								return $message;

							}

						

					}

	   /*



	  Basic delete Function



	  



	  */



	  



	  function delete_simple($table,$where) {



		 db_connect();



		 $query = "DELETE FROM $table $where";



		 $result = mysql_query($query)or die("query failed ".mysql_error());



		//$result = db_results($result);



		return $result;



      } 

	  

	  

	   function randomcode($length)

{

$random= "";

srand((double)microtime()*1000000);



$data = "AbcDE123IJKLMN67QRSTUVWXYZ";

$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";

$data .= "0FGH45OP89";



for($i = 0; $i < $length; $i++)

{

$random .= substr($data, (rand()%(strlen($data))), 1);

}



return $random;

}



//function for selecting all rows from table without order

function select_all($table){

		db_connect();



		$query = "SELECT * FROM $table";



		$result = mysql_query($query) or die("query failed ".mysql_error());



		$result = db_results($result);



		return $result;



	}



//function to return fieldnames used in database

function select_field($table){

		db_connect();

		$query = "SELECT * FROM $table";

		$result = mysql_query($query) or die("query failed ".mysql_error()) ;

		$count = mysql_num_rows($result);

		$row = mysql_fetch_row($result); 

		$columncount = count($row);

		$i=0;

		$result_array= array();

		while($i<$columncount){

		 $result_array[$i]= mysql_field_name($result,$i);

		 $i++;

		}

		return $result_array;

  }

  

  function custom_pagination($tbl_name,$where,$limit,$path,$style){

		$query = "SELECT COUNT(*) as num FROM $tbl_name $where"; 

		$total_pages = mysql_fetch_array(mysql_query($query));

		$total_pages = $total_pages['num'];

		$adjacents = "2";

		$page = @$_GET['page'];

		if($page)

		  $start = ($page - 1) * $limit;

		else

		  $start = 0;

		$sql = "SELECT id FROM $tbl_name $where LIMIT $start, $limit"; 

		$result = mysql_query($sql);

		

		if ($page == 0) $page = 1;

		 $prev = $page - 1;

		 $next = $page + 1;

		 $lastpage = ceil($total_pages/$limit);

		 $lpm1 = $lastpage - 1;							

		 $pagination = "";

		 if($lastpage > 1){   

			$pagination .= "<div class='".$style."'>";

		    if ($page > 1)

				 $pagination.= "<a href='".$path."page=$prev' class='buttonPrev'>Prev Page</a>";

			else

				 $pagination.= "<span  class='buttonPrev'>Prev Page</span>";	

				 

          //dropdown with page numbers.

		  $pagination .= " <select name='pageno1' id='pageno1' onchange=\"javascript:var x= '".$path."page='+document.getElementById('pageno1').value;window.location= x;\" >";				 

		  for ($counter = 1; $counter <= $lastpage; $counter++){

				$pagination .= "<option";

			     if($page==$counter){

			       $pagination .= " selected='selected' ";	

			     }

				$pagination .=">";

				$pagination .= $counter."</option>";								                  

		  }		

		  $pagination = $pagination."</select> ";

		  //end of pagenumber				

		if ($page < $lastpage)

					$pagination .= "<a href='".$path."page=$next' class='buttonNext'>Next Page</a>";

		else

				$pagination.= "<span  class='buttonNext'>Next Page</span>";

				$pagination.= "</div>\n";       

		}

		 return $pagination;

	}

  

  					

						/*

						PAGINATION SYSTEM (SIMPLE PAGINATION)

						$table = $table name

						$limit = how many rows to show

						$pagepath = the link for navigation

						$style = style code for pagination. Only master style code needs to be changed

						*/

						

						function pagination($tbl_name,$limit,$path,$style)

						{

							 $query = "SELECT COUNT(*) as num FROM $tbl_name";

							$total_pages = mysql_fetch_array(mysql_query($query));

							$total_pages = $total_pages['num'];

							$adjacents = "2";

							$page = @$_GET['page'];

							if($page)

							$start = ($page - 1) * $limit;

							else

							$start = 0;

						

							 $sql = "SELECT id FROM $tbl_name LIMIT $start, $limit";

							$result = mysql_query($sql);

							

								if ($page == 0) $page = 1;

								$prev = $page - 1;

								$next = $page + 1;

								$lastpage = ceil($total_pages/$limit);

								$lpm1 = $lastpage - 1;

							

								$pagination = "";

							if($lastpage > 1){   

								$pagination .= "<div class='".$style."'>";

							if ($page > 1)

								$pagination.= "<a href='".$path."page=$prev'>previous</a>";

							else

								$pagination.= "<span class='disabled'>previous</span>";   

							

							if ($lastpage < 7 + ($adjacents * 2)){   

								for ($counter = 1; $counter <= $lastpage; $counter++){

									if ($counter == $page)

										$pagination.= "<span class='current'>$counter</span>";

									else

										$pagination.= "<a href='".$path."page=$counter'>$counter</a>";                   

								}

							}

							elseif($lastpage > 5 + ($adjacents * 2))

							{

								if($page < 1 + ($adjacents * 2)){

									for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){

										if ($counter == $page)

											$pagination.= "<span class='current'>$counter</span>";

										else

											$pagination.= "<a href='".$path."page=$counter'>$counter</a>";                   

									}

									$pagination.= "...";

									$pagination.= "<a href='".$path."page=$lpm1'>$lpm1</a>";

									$pagination.= "<a href='".$path."page=$lastpage'>$lastpage</a>";       

								}

								elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)){

									$pagination.= "<a href='".$path."page=1'>1</a>";

									$pagination.= "<a href='".$path."page=2'>2</a>";

									$pagination.= "...";

									for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++){

											if ($counter == $page)

												$pagination.= "<span class='current'>$counter</span>";

											else

												$pagination.= "<a href='".$path."page=$counter'>$counter</a>";                   

									}

									$pagination.= "..";

									$pagination.= "<a href='".$path."page=$lpm1'>$lpm1</a>";

									$pagination.= "<a href='".$path."page=$lastpage'>$lastpage</a>";       

								}

								else{

									$pagination.= "<a href='".$path."page=1'>1</a>";

									$pagination.= "<a href='".$path."page=2'>2</a>";

									$pagination.= "..";

									for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++){

										if ($counter == $page)

											$pagination.= "<span class='current'>$counter</span>";

										else

											$pagination.= "<a href='".$path."page=$counter'>$counter</a>";                   

									}

								}

							}

							

							if ($page < $counter - 1)

								$pagination.= "<a href='".$path."page=$next'>next</a>";

							else

								$pagination.= "<span class='disabled'>next</span>";

								$pagination.= "</div>\n";       

							}



							

							return $pagination;

						}  



                   //TO FIND FILE EXTENSION

					function findexts ($filename) { 

					$filename = strtolower($filename) ;

					$exts = @split("[/\\.]", $filename) ; 

					$n = count($exts)-1; 

					$exts = $exts[$n]; 

					return $exts;

					}

                 //functions for getting current url

                

					/*function curPageURL() {

					 $pageURL = 'http://';

					 if(isset($_SERVER["HTTPS"]) == "on") {$pageURL .= "s";}



					 if (@$_SERVER["SERVER_PORT"] != "80") {

					  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

					 } else {

					  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

					 }

					 return $pageURL;

					}*/

	//Function to display with array assoc
 	function display_selected_assoc($table,$fields,$where){
		db_connect();
		$query = "SELECT $fields FROM $table $where"; 
		$result = mysql_query($query)or die("query failed  ".mysql_error());
		$result = db_results_assoc($result);
		return $result;
 	}

 	//result by using assoc
 	function db_results_assoc($result){
		$res_array = array();
		for($count=0;$row = mysql_fetch_assoc($result);$count++)
			{
				$res_array[$count] = $row;
			}
		return $res_array;
	}

	function db_display_selected($table,$fields,$where){
		db_connect();
		$query = "SELECT $fields FROM $table $where"; 
		$result = mysql_query($query)or die("query failed ".mysql_error());
		$result = mysql_fetch_array($result);
		return $result;
	}

	
	function getMaxId($table,$field)
	{
	db_connect();
	$query = "SELECT max($field) as maxid FROM $table "; 
	$result = mysql_query($query)or die("query failed ".mysql_error());
	$result = mysql_fetch_array($result);
	if($result['maxid']==0)
	{
	$max=1;
	}
	else
	{
	$max=$result['maxid']+1;
	}
	return $max;
	}
	
 //function to send email.
 function mailsend($to,$subject,$message,$frommail){
 	$flag= false;
	$headers = "From:  $frommail \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$message = '<html><body>'.$message.'</body></html>';
	$sendmail = mail($to,$subject,$message,$headers);
	if($sendmail){
		$flag= true;	
	}
	return $flag;
 }

 
 //function for selecting bocked id addresses 
 
  function block_ip_list()
  {
  	db_connect();
  	
  	$sql="select ipaddress from blockip where status = 1";
  	$res=mysql_query($sql) or die (mysql_error());
  	$block_ips=array();
  	while($data=mysql_fetch_array($res))
  	{
  		$block_ips[$i]=$data['ipaddress'];
  		$i++;
  	}
  	
  	return $block_ips;
  }
  
  //function for get visitor ip address	
	function getip()
 {

	  if (getenv(HTTP_X_FORWARDED_FOR)) {
	        $ip_address = getenv(HTTP_X_FORWARDED_FOR);
	    } else {
	        $ip_address = getenv(REMOTE_ADDR);
	    }
	return $ip_address;
}
function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){ 
if(!isset($pct)){ 
        return false; 
    } 
    $pct /= 100; 
    // Get image width and height 
    $w = imagesx( $src_im ); 
    $h = imagesy( $src_im ); 
    // Turn alpha blending off 
    imagealphablending( $src_im, false ); 
    // Find the most opaque pixel in the image (the one with the smallest alpha value) 
    $minalpha = 127; 
    for( $x = 0; $x < $w; $x++ ) 
    for( $y = 0; $y < $h; $y++ ){ 
        $alpha = ( imagecolorat( $src_im, $x, $y ) >> 24 ) & 0xFF; 
        if( $alpha < $minalpha ){ 
            $minalpha = $alpha; 
        } 
    } 
    //loop through image pixels and modify alpha for each 
    for( $x = 0; $x < $w; $x++ ){ 
        for( $y = 0; $y < $h; $y++ ){ 
            //get current alpha value (represents the TANSPARENCY!) 
            $colorxy = imagecolorat( $src_im, $x, $y ); 
            $alpha = ( $colorxy >> 24 ) & 0xFF; 
            //calculate new alpha 
            if( $minalpha !== 127 ){ 
                $alpha = 127 + 127 * $pct * ( $alpha - 127 ) / ( 127 - $minalpha ); 
            } else { 
                $alpha += 127 * $pct; 
            } 
            //get the color index with new alpha 
            $alphacolorxy = imagecolorallocatealpha( $src_im, ( $colorxy >> 16 ) & 0xFF, ( $colorxy >> 8 ) & 0xFF, $colorxy & 0xFF, $alpha ); 
            //set pixel with the new color + opacity 
            if( !imagesetpixel( $src_im, $x, $y, $alphacolorxy ) ){ 
                return false; 
            } 
        } 
    } 
    // The image copy 
    imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h); 
	}
	
	function drawBorder(&$img, &$color, $thickness = 1) 
{
    $x1 = 0; 
    $y1 = 0; 
    $x2 = ImageSX($img) - 1; 
    $y2 = ImageSY($img) - 1; 

    for($i = 0; $i < $thickness; $i++) 
    { 
        ImageRectangle($img, $x1++, $y1++, $x2--, $y2--, $color); 
    } 
}

function createimagewithproduct($imp,$centerimg,$product1,$product2,$p1img,$p2img,$border)
{


imagecopymerge($imp,$centerimg, 0, 0, 0, 0, 500, 500, 100);//merge the user image 

$color = imagecolorallocate($product1, 224, 183, 121);
drawBorder($product1,$color, $border);//add border for bag image 
imagecopymerge($imp,$product1, 505, 0, 0, 0, 163, 120, 100);
$color = imagecolorallocate($product2, 224, 183, 121);
drawBorder($product2,$color, $border);//add border for dress image 
imagecopymerge($imp,$product2, 505, 131, 0, 0, 163, 369, 100);


imagecopymerge($imp,$p1img, 508, 3, 0, 0, 157, 115, 100);//add bag image
imagecopymerge($imp,$p2img, 508, 155, 0, 0, 157, 240, 100);//add dress image

//imagecopymerge($imp,$p2img, 505, 0, 0, 0, 163, 120, 100);

//$save_dir='uploads/final_p/bala.jpg';
//imagejpeg($imp,$save_dir,80);
}	

function resizewithquality($source,$target_path,$width,$height)
	{
	 // include the class

	
    // create a new instance of the class
    $image = new Zebra_Image();

	

    // indicate a source image
    $image->source_path = $source;

    /**
     *
     *  THERE'S NO NEED TO EDIT BEYOUND THIS POINT
     *
     */

    $ext = substr($image->source_path, strrpos($image->source_path, '.') + 1);

    // indicate a target image
    $image->target_path = $target_path;
    // resize
    // and if there is an error, show the error message
    if (!$image->resize($width, $height, ZEBRA_IMAGE_BOXED, -1)) 
	{
	
	show_error($image->error, $image->source_path, $image->target_path);
	}
	else
	{
	
	return true;
	}    
	}
		 function show_error($error_code, $source_path, $target_path)
    {

        // if there was an error, let's see what the error is about
        switch ($error_code) {

            case 1:
                echo 'Source file "' . $source_path . '" could not be found!';
                break;
            case 2:
                echo 'Source file "' . $source_path . '" is not readable!';
                break;
            case 3:
                echo 'Could not write target file "' . $source_path . '"!';
                break;
            case 4:
                echo $source_path . '" is an unsupported source file format!';
                break;
            case 5:
                echo $target_path . '" is an unsupported target file format!';
                break;
            case 6:
                echo 'GD library version does not support target file format!';
                break;
            case 7:
                echo 'GD library is not installed!';
                break;

        }

    }
	
		function imagecreatewithurl($url,$image1,$desc,$name)
	{
	$desc = str_replace("&quot;", '"', $desc);
	  $ch = curl_init($url);
	  curl_setopt($ch, CURLOPT_POST, 1);
	  curl_setopt($ch, CURLOPT_POSTFIELDS,"image=".$image1."&desc=".$desc."&name=".$name);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	  $data = curl_exec($ch);
	  return $data;
	}