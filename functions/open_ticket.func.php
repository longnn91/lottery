<?php
require_once('db.php');

function getLuckyNumber($order)
{
    $sql = "SELECT $order FROM luckynumber WHERE result = '1'";
    $res = $GLOBALS['conn']->query($sql);

if($row = $res->fetch_assoc())
{
	return $row[$order];
}else
	return "XXX";

}

if(isset($_GET['number']))
{
	$ticket = getLuckyNumber($_GET['number']);
}
else
	$ticket = "FFF";

?>

<link href='../css/select_ticket_style.css' rel='stylesheet' type='text/css'>
<div>
  <em style="font-size: 40px;"><?php echo $ticket; ?></em>
</div>
