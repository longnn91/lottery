<?php
require('db.php');

if(isset($_POST['login'])){

	$GLOBALS['login_error'] = array();
	$account = array('email'=>$_POST['email'], 'password'=>$_POST['password']);
	$email = $_POST['email'];
	$password = $_POST['password'];

	checkLoginError($account);

	if(empty($GLOBALS['login_error'])){

		$sql = "SELECT * FROM account WHERE account_email = '$email' AND account_password = '$password'";

		$result = $GLOBALS['conn']->query($sql);

		if($row = $result->fetch_assoc())
		{
			if($row['account_active']=="false")
				$login_message = "This account was not active. Please check email to active your account.";
			else
			{
				$_SESSION['email'] = $row['account_email'];
				header("Refresh:0");
			}
		}else
			$login_message = "Email or password is incorrect!";

	}

}

function checkLoginError($account)
{
	//Analysic email
	if(empty($account['email']))
	{
		//echo "Enter Email is empty";
		$GLOBALS['login_error']['email']="Email field is required.";
	}elseif (strlen($account['email'])>50)
		$GLOBALS['login_error']['email']="Please enter correct email, don't try to do a test.";

	//Analysic password
	if(empty($account['password']))
	{
		$GLOBALS['login_error']['password']="Password field is required.";
	}elseif (strlen($account['password'])>30)
		$GLOBALS['login_error']['password']="Password is too long, don't try to do a test.";
}

?>

<?php 
	if(isset($_SESSION['email']))
	{
?>

<ul>
 <p style="text-align: right; margin-right: 25px; color: #FF851B; font-style: italic;"> Welcome <?php echo " ".$_SESSION['email']; ?></p>
<ul>
<?php
}else
{
?>
<form method="post"  ">
	<div class="el-form">
		<input class="form-control" style="margin-top: 5px;" type="text" name="email" placeholder="Email... " value="<?php echo isset($account['email']) ? $account['email'] :""?>">
		 <p class="error_mss"><?php if(isset($GLOBALS['login_error']['email'])) echo $GLOBALS['login_error']['email'];?></p>
	</div>
	<div class="el-form">
		<input class="form-control" style="margin-top: 5px;" type="password" name="password" placeholder="Password...">
		 <p class="error_mss"><?php if(isset($GLOBALS['login_error']['password'])) echo $GLOBALS['login_error']['password'];?></p>
	</div>
	<button style="height: 21px; float:left; margin: 10px" class="button_1" type="submit" name="login">LOGIN</button>
</form>
<p class="error_mss"><?php echo isset($login_message) ? $login_message : ""; ?></p>
</ul>
<?php
}
?>