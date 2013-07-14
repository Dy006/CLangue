<?php
session_start();
if ($_GET['w'] != null && $_GET['u'] != null)
{
	$filename = 'record_'.$_GET['w'].'_'.$_GET['u'].'.wav';
	$path = '../../userFiles/wav/';
	$pathTofilename = $path.$filename;
	//echo $pathTofilename;
	
	if (is_uploaded_file($_FILES['userfile']['tmp_name'])) 
	{
	echo 'success';
  	move_uploaded_file ($_FILES['userfile'] ['tmp_name'], $pathTofilename);
	}
	else
	{
	echo "faild";
	}
}
else
{
	echo 'faild';
	exit();
} 