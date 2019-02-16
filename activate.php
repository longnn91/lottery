<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebbok https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */
require_once './db.php';

if (isset($_GET["email"])) {
  $email = $_GET["email"]; 
  $sql = "SELECT * FROM account WHERE account_email ='$email'";
  $result = $GLOBALS['conn']->query($sql); 
  if($row = $result->fetch_assoc()){    
     if ($row["account_active"] == "true") {
      $msg = "Your account has already been activated.";      
    
    } else {
      $sql1 = "UPDATE account SET account_active = 'true' WHERE account_email = '$email'";      
      $result1 = $GLOBALS['conn']->query($sql1);

      if ($result1 > 0) {
        $msg = "Your account has been activated.";
      }else {
        $msg = "An error!";
      }
    }
  }  else {
    $msg = "No account found";     
  }
 
 
}

include './header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-lg-9">

      <?php if ($msg <> "") { ?>  
        <h3><?php echo $msg; ?></h3>
      
    <?php } ?>
      <h1>Thank you for registering with us.</h1>
    </div>
  </div>
</div>

<script type="text/javascript">
  function validateForm() {

    var your_name = $.trim($("#uname").val());
    var your_email = $.trim($("#uemail").val());
    var pass1 = $.trim($("#pass1").val());
    var pass2 = $.trim($("#pass2").val());


    // validate name
    if (your_name == "") {
      alert("Enter your name.");
      $("#uname").focus();
      return false;
    } else if (your_name.length < 3) {
      alert("Name must be atleast 3 character.");
      $("#uname").focus();
      return false;
    }

    // validate email
    if (!isValidEmail(your_email)) {
      alert("Enter valid email.");
      $("#uemail").focus();
      return false;
    }

    // validate subject
    if (pass1 == "") {
      alert("Enter password");
      $("#pass1").focus();
      return false;
    } else if (pass1.length < 6) {
      alert("Password must be atleast 6 character.");
      $("#pass1").focus();
      return false;
    }

    if (pass1 != pass2) {
      alert("Password does not matched.");
      $("#pass2").focus();
      return false;
    }

    return true;
  }

  function isValidEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }


</script>

<?php
include './footer.php';
?>