<?php
include 'header.php';
require('functions/ticket.func.php');


if(isset($_POST['chose_ticket'])){

  $number = $_POST['inputNumber'];

  $number_error = null;

  //Check error
  if(empty($number)){
      $number_error = "Please enter your expected number ticket.";
  }
  else
  {
      if(!is_numeric($number)){
        $number_error = "Only accept number.";
      }else
      {
        if(!($number>=0 && $number<1000))
        {
          $number_error = "Number should be 0 <= Number < 1000";
        }
      }
  }
      $number = correctNumber($number);

  //Add ticket if no error
  if($number_error==null)
  {
      $checkAddTicket = addTiket($number, $_SESSION['email']);
  }
  else
      $checkAddTicket = null;

}

if(isset($_POST['book'])){

$checkAddTicket = addTiket($_POST['ticketvalue'], $_SESSION['email']);

$tempTicket = $_POST['ticketvalue'];

$ticket = getFreeTicket();

}else{
  $ticket = getFreeTicket();
}

?>
<script>
function reloadFunction() {
    location.reload();
}

</script>

<!--
    <section id="newslette" style="background-color:white;">
      <div class="container">
        <h1 style="text-align: center; color: #2C333A;">B0oK TicKet</h1>
      </div>
    </section>

    <section id="main" style="background-color: white">
      <div class="container">
        <article id="main-col">
          <h1 class="page-title"></h1>
          <table border="0">
            <tr>
              <td>
                  <iframe height="250" width="400" src="functions/select_ticket.func.php?ticket=<?php echo $ticket; ?>"></iframe>
              </td>
              <td>   
                  <button style="width: 140px; margin-bottom: 15px; margin-left:15px; " class ="button_1" onclick="reloadFunction()">Change Ticket</button>
                  <?php 

                      if(!isset($_SESSION['email']))
                      {
                        echo "<p class ='error_mss' style =' margin-left:15px; color: #FF851B; font-style: italic;'> Please login to book ticket! </p>";
                      }else{
                  ?>

                  <form method="post">
                        <input type="hidden" name="ticketvalue" value="<?php echo $ticket; ?>">
                        <button style="width: 140px; margin-left:15px; " class ="button_1" type="submit" name="book">Book Ticket</button>
                  </form>
                  <?php
                      }
                  ?>

              </td>
            </tr>
            <tr>
              <form method="post">
              <td style="padding-top: 0px">
                    <label style="margin-right: 20px; color: #0074D9">Book with expection number!</label>
                    <input type="text" name="inputNumber" placeholder="" style="width: 100px; height: 30px; margin-right: 0px; margin-top: 35px; font-size: 20px;">
                    <p class="error_mss" style="margin-left:0px; ">
                    <?php echo isset($number_error) ? $number_error : ""; ?> <p>

              </td>
              <td>
                   <?php 

                      if(!isset($_SESSION['email']))
                      {
                        echo "<p class ='error_mss' style =' margin-left:15px; color: #FF851B; font-style: italic;'> Please login to book ticket! </p>";
                      }else{
                  ?>
                        <button style="width: 140px; margin-left:15px; " class ="button_1" type="submit" name="chose_ticket">Book Ticket</button>
                  <?php
                    }
                  ?>
                 
              </td>
               </form>
            </tr>
          </table>
        </article>

        <aside id="sidebar">
          <div class="dark">

          <?php 
            if(isset($_POST['book']) || isset($_POST['chose_ticket']) ){

                    $t_number = isset($_POST['book'])? correctNumber($_POST['ticketvalue']) : correctNumber($_POST['inputNumber']);

                  if($checkAddTicket){
               ?>

                  <h3>Book ticket sucessfully</h3>
                  <p style ='color: #FF851B; font-style: italic;'>Ticket Number: <?php echo $t_number; ?></p>

                  <?php 
                  }else{
                      if(empty($number_error)){
                          
          ?>      
                  <h3>Failed book ticket</h3>
                  <p style ='color: #FF851B; font-style: italic;'>The ticket number (<?php echo $t_number; ?>) was booked already, please choose another ticket.</p>

            <?php }}}else{?>

                   <h3>NOTE</h3>
                  <p style ='color: #FF851B; font-style: italic;'>Please consider before booking ticket because you can't cancel a ticket. Please contact admin if you really want to cancel a ticket.</p>
            <?php }?>

            <?php 
              if(isset($_SESSION['email'])){
            ?>
            <h3 style="text-align: center; margin-bottom: 5px;">My Ticket</h3>
            <iframe src="functions/myticket.func.php" style="width:98%;"></iframe>
            <?php } ?>
          </div>
        </aside>
      </div>
    </section>

-->

<h1 style="margin: 20px;"> Booking time is expired. Please click <a href="openticket.php"> HERE </a> to see LUCKY TICKET will be opened in 11h15 AM. Or you can visist 9th foor to watch directly.

<?php 
include 'footer.php';
?>

