<?php 

$GLOBALS['conn'] = mysqli_connect('localhost', 'root','','lottery');

if(!$GLOBALS['conn'])
{
	echo ("Connection Failed: ".mysqli_connect_error());
}else
{
	//echo "Connect data succesfully";
}

?>