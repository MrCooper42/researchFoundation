<?php
if(isset($_POST) )
	{
		$folder		=	'../../languages/';
		if(!isset($_FILES['lang_file']) || !is_uploaded_file($_FILES['lang_file']['tmp_name']))
		{
			die('Image file is Missing!'); // output error when above checks fail.
		}
		//uploaded file info we need to proceed
		$lang_name = $_FILES['lang_file']['name']; //file name
		$lang_size = $_FILES['lang_file']['size']; //file size
		$lang_temp = $_FILES['lang_file']['tmp_name']; //file temp
		$file_path = $folder.$lang_name;  
		  if(move_uploaded_file($lang_temp, $file_path))  
		  {  
			   echo "File uploaded Success !";  
		  }  
		//mime_content_type(
	}
	
	die();