<?php 
	
	$db["db_host"] = "localhost";
	$db["db_user"] = "root";
	$db["db_pass"] = "";
    $db["db_name"] = "cms_blog";

    foreach ($db as $key => $value) {
    	#this takes the above array and convert its values to constants
    	# eg:- $key--db_host   $value--root 
    	define(strtoupper($key),$value);
    }

	$connection=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

	if($connection){
		//echo "Database Connected";
	}else{
		die("Error occured "+mysqli_error());
	}
?>