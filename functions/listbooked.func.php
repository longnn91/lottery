<link href='../css/list_ticket_style.css' rel='stylesheet' type='text/css'>

<?php
session_start();
require('ticket.func.php');


function getShortEmail($email)
{
	if(isset($email))
	{
		$shortEmail = substr($email,0,(strlen($email)-13));
		return $shortEmail;
	}else{
		return "None";
	}
}

	$list = getListBooked();

	if($row = $list->fetch_assoc())
	{
		echo "<table class='TFtable'>
			<tr><td>No.</td><td>Ticket</td><td>Account</td></tr>";
		$count = 1;
		foreach ($list as $value) {

			$shortEmail = getShortEmail($value['account_email']);
			echo "<tr><td>".$count."</td><td>".$value['ticket_number']."</td><td>".$shortEmail."</td></tr>";
			$count++;
		}
		echo "</table>";
	}
?>
