	<?php
require('db.php');
$data =array();

if(isset($_POST['register'])){

	$GLOBALS['error'] = array();

	$data = array(
			'email'=>trim($_POST['email']),
			'password'=>trim($_POST['password']),
			're-password'=>trim($_POST['re-password'])
		);
	checkError($data);

	if(empty($GLOBALS['error'])){
		$register_message = saveAccount($_POST['email'], $_POST['password']);
		$data = array();
	}
}

function checkError($data)
{
	//Analysic email
	if(empty($data['email']))
	{
		$GLOBALS['error']['email']="Email field is required.";
	}elseif (strlen($data['email'])>50) {
		$GLOBALS['error']['email']="Please enter correct email, don't try to do a test.";
	}elseif (!checkLogigearEmail((string)$data['email'])) {
		$GLOBALS['error']['email']="We only accept LogiGear email( @logigear.com)";
	}

	//Analysic password
	if(empty($data['password']))
	{
		$GLOBALS['error']['password']="Password field is required.";
	}elseif (strlen($data['password'])>30) {
		$GLOBALS['error']['password']="Password is too long, don't try to do a test.";
	}

	//Analysic password
	if(empty($data['re-password']))
		$GLOBALS['error']['re-password']="Re-password field is required.";
	elseif(empty($GLOBALS['error']['password']))
	{
		if($data['password']!=$data['re-password'])
		{
			 $GLOBALS['error']['re-password'] = "Password is not matched";
		}
	}
}

function checkLogigearEmail($email)
{
	$domain = substr($email, -13);
	if($domain =="@logigear.com")
		return true;
	else
		return false;
}

function saveAccount($email, $password)
{
	$code = "293wiq3ihsAURye".rand(0,10000);
	require_once "../phpmailer/class.phpmailer.php";

  // $name = trim($_POST["uname"]);
  // $pass = trim($_POST["pass1"]);
  // $email = trim($_POST["uemail"]);
  //$sql = "SELECT COUNT(*) AS count from tbl_users where email = :email_id";
	$sql = "SELECT * FROM account WHERE account_email ='$email'";
	$result = $GLOBALS['conn']->query($sql);

	if($row = $result->fetch_assoc()){
		return "This email was registered already...";
	}else
	//Step2: Add account
	{
		$sql = "INSERT INTO account(account_email, account_password, account_code, account_active) VALUES
		('$email', '$password','$code','false')";
		$result = $GLOBALS['conn']->query($sql);
		 if ($result > 0) {
       
        //$lastID = $DB->lastInsertId();

        $message = '<html><head>
                <title>Email Verification</title>
                </head>
                <body>';
        $message .= '<h1>Hi ' . $name . '!</h1>';
        $message .= '<p><a href="192.168.188.144/activate.php?id=' . base64_encode($code) . '">CLICK TO ACTIVATE YOUR ACCOUNT</a>';
        $message .= "</body></html>";
        

        // php mailer code starts
        $mail = new PHPMailer(true);
        $mail->IsSMTP(); // telling the class to use SMTP

        $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        $mail->SMTPAutoTLS = false;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;                 // set the SMTP port for the GMAIL server

        $mail->Username = 'tannt.itedu@gmail.com';
        $mail->Password = 'tanhanhong';

        $mail->SetFrom('tannt.itedu@gmail.com', 'Tan Nguyen');
        $mail->AddAddress($email);

        $mail->Subject = trim("Email Verifcation - www.thesoftwareguy.in");
        $mail->MsgHTML($message);

        try {
          $mail->send();
          $msg = "An email has been sent for verfication.";
          $msgType = "success";
        } catch (Exception $ex) {
          $msg = $ex->getMessage();
          $msgType = "warning";
        }
      } else {
        $msg = "Failed to create User";
        $msgType = "warning";
      }
	//Step3: Send link to email
		return "Submit successfully! Please click activation link on your email to active account...";
	} 
	return "System get an error, please wait for a while then submit again";
}

function activeAccount($email, $code)
{

}
?>