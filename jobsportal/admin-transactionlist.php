<?php
 require_once("config.php");
 session_start();
if(isset($_SESSION['username'])){


}
else{
  header('location:index.php');
}
  $sql="SELECT * FROM `freelancer` WHERE status='waiting'";
  $sql2="SELECT * FROM `client` WHERE status='waiting'";
  $req=mysqli_query($connection,$sql);
  $req2=mysqli_query($connection,$sql2);
  $n1=mysqli_num_rows($req);
  $n2=mysqli_num_rows($req2);
  $nt=$n1+$n2;

  $sql3="SELECT * FROM `freelancer` WHERE status='approved'";
  $sql4="SELECT * FROM `client` WHERE status='approved'";
  $req3=mysqli_query($connection,$sql3);
  $req4=mysqli_query($connection,$sql4);
  $n5=mysqli_num_rows($req3);
  $n6=mysqli_num_rows($req4);
  $nt1=$n5+$n6;

  $sql23="SELECT * FROM `transaction_table` WHERE status='pending'";
  $run23=mysqli_query($connection,$sql23);
  $n4=mysqli_num_rows($run23);


     
      
      if(isset($_GET['status'])){
        if ($_GET['status']=='logout') {
          session_destroy();
        header('location:index.php');
        }
    
      }

      // Handle confirmed transfers via POST (from admin-transfer.php)
      if(isset($_POST['confirm_transfer']) && $_POST['confirm_transfer'] == '1'){
        $tid = intval($_POST['trnid']);
        $sql27 = "SELECT * FROM `transaction_table` WHERE trnid=$tid";
        $run27 = mysqli_query($connection,$sql27);
        if ($run27 && mysqli_num_rows($run27) > 0) {
          $req27 = mysqli_fetch_array($run27);
          $rat2f = $req27['c_to_f'];
          $flancer = $req27['freelancer'];
          $tk = $req27['money'];
          $sql24 = "UPDATE `transaction_table` SET `status` = 'completed' WHERE `transaction_table`.`trnid` = $tid";
          $run24 = mysqli_query($connection,$sql24);
          $sql26 = "SELECT * FROM `freelancer` WHERE username='$flancer'";
          $run26 = mysqli_query($connection,$sql26);
          $req26 = mysqli_fetch_array($run26);
          $review = $req26['review']+1;
          $trat = $req26['total_rat']+$rat2f;
          $finalrate = $trat/$review;
          $sql25 = "UPDATE `freelancer` SET `review`=review+1,`total_rat`=total_rat+$rat2f,`rating`=$finalrate,`balance`=balance+$tk,jobs_completed=jobs_completed+1 WHERE username='$flancer'";
          $run25 = mysqli_query($connection,$sql25);
        }

        header("location:admin-transactionlist.php");
        exit;
      }
      


  
  
?>
<html>

<head>
  <title>Jobs here</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="css/w3.css">
  <link rel="stylesheet" href="css/font.css">
  <link rel="shortcut icon" href="images/logo.png">
</head>

<body>


  <!-------------------------header design--------------------->
  <?php include_once __DIR__ . '/admin-header.php'; ?>
  <!---------------------body starts from here------------------------------------->

  <div class="w3-container w3-green" style="padding: 1%; text-align: center;">
    <h2>Freelancer needed approval</h2>
  </div>
  <div class="w3-container" style="padding-left: 20%;padding-right: 20%;">
  </div>
  <table class="w3-table w3-bordered w3-centered" style="padding-left: 5%;padding-right: 5%">
    <tr>
      <th>Trans. No</th>
      <th>Job Id</th>
      <th>Client</th>
      <th>Freelancer</th>
      <th>Amount</th>
      <th>Client to Freelancer Rating</th>
      <th>Action</th>
      <?php while($vari=mysqli_fetch_array($run23)) {?>
    <tr>
      <td><?php echo $vari['trnid']; ?></td>
      <td><?php echo $vari['postid']; ?></td>
      <td><?php echo $vari['client']; ?></td>
      <td><?php echo $vari['freelancer']; ?></td>
      <td><?php echo $vari['money']; ?></td>
      <td><?php echo $vari['c_to_f']; ?></td>
      <td>
        <a href="admin-transfer.php?trnid=<?php echo $vari['trnid']; ?>" class="w3-button w3-light-blue">Transfer</a>
        <a href="create-local-checkout.php?trnid=<?php echo urlencode($vari['trnid']); ?>&postid=<?php echo urlencode($vari['postid']); ?>&client=<?php echo urlencode($vari['client']); ?>&freelancer=<?php echo urlencode($vari['freelancer']); ?>&amount=<?php echo urlencode($vari['money']); ?>"
          class="w3-button w3-orange" style="margin-left:8px;">Simulate Payment</a>
      </td>

    </tr>
    <?php } ?>
  </table>

  <!-------------------------footer design--------------------->
  <?php include_once __DIR__ . '/footer.php'; ?>



  <script>
  function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
  }

  function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
  }
  </script>

</body>

</html>