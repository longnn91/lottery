<link href='../css/list_ticket_style.css' rel='stylesheet' type='text/css'>

<?php
session_start();
require('ticket.func.php');

if(isset($_SESSION['email']))
{
	$list = getListMyTicket($_SESSION['email']);

	if($row = $list->fetch_assoc())
	{
		echo "<table class='TFtable'>
			<tr><td>No.</td><td>Ticket</td></tr>";
		$count = 1;
		foreach ($list as $value) {
			echo "<tr><td>".$count."</td><td>".$value['ticket_number']."</td></tr>";
			$count++;
		}
		echo "</table>";
	}else
	{
		echo "<p>You have no ticket.</p>";
	}
}
?>



