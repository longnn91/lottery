<?php
require('db.php');

function correctNumber($number){

	$temp = (string)$number;

	while(strlen($temp)<3)
	{
		$temp = '0'.$temp;
	}
	return $temp;
}

function addTiket($ticket_number, $account_email)
{
	if($ticket_number!=''&&$account_email!='')
	{
		$sql = "SELECT * FROM ticket WHERE ticket_number = $ticket_number";
		$result = $GLOBALS['conn']->query($sql);

		if($row = $result->fetch_assoc())
		{
			return false;
		}else
		{
			$sql = "INSERT INTO ticket (ticket_number, account_email) VALUES ('$ticket_number','$account_email')";
			$GLOBALS['conn']->query($sql);
			return true;
		}
	}else
	{
		return false;
	}
}

function getTableData($table_name)
{
	$table_array = array();

	$sql = "SELECT * FROM $table_name";

	$result = $GLOBALS['conn']->query($sql);

	$count=0;
	foreach ($result as $value) {

		$input = (int)$value['ticket_number'];

		$table_array[$count] = $input;
		$count++;
	}

	return $table_array;
}

function getLuckyTicket()
{
	$temp_array = getTableData('ticket');
	$temp = array_rand($temp_array,1);
	return correctNumber($temp_array[$temp]);

}

function getFreeTicket()
{
	$free_array = array();
	$temp_array = array();

	$booked_array = getTableData('ticket');

//Get array for ticket table
	for($count = 0; $count<1000; $count++)
	{
		$temp_array[$count] = $count;
	}
	$free_array = array_diff($temp_array,$booked_array);

	if(isset($free_array))
	{

		$rand_number = array_rand($free_array, 1);

		return correctNumber($rand_number);
	}else
	{
		echo "<h3 class= 'error_mss'>All tickets are booked. You can not book ticket anymore</h3>";
		return null;
	}

}

function getListMyTicket($account_email){

		$sql = "SELECT * FROM ticket WHERE account_email = '$account_email'";
		$result = $GLOBALS['conn']->query($sql);
		return $result;
}

function getListBooked(){

		$sql = "SELECT * FROM ticket ORDER BY account_email";
		$result = $GLOBALS['conn']->query($sql);
		return $result;
}

?>