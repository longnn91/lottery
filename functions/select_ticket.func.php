<?php

if(isset($_GET['ticket']))
{
	$ticket = $_GET['ticket'];
}
else
	$ticket = "none";

?>

<link href='../css/select_ticket_style.css' rel='stylesheet' type='text/css'>
<h1>
  <em> tic</em>
  <em class="planet left">O</em>
  <em><?php echo $ticket; ?></em>
  <em class="planet right">O</em>
  <em>ket</em>
</h1>
