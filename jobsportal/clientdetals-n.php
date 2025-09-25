<?php
 require_once("config.php");
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


  if(isset($_GET['show']))
  {
    $id=$_GET['show'];
    $sql4="SELECT * FROM `client` WHERE cid='$id'";
    $run=mysqli_query($connection,$sql4);
    $details=mysqli_fetch_array($run);
  }


  if(isset($_GET['update']))
    {
      echo"here it comes";
      echo $_GET['update'];
    $id=$_GET['update'];
    $sql5="UPDATE `client` SET `status` = 'approved' WHERE `client`.`cid` ='$id'";
    $run=mysqli_query($connection,$sql5);
    header('location:clientlist.php');
    }

    if(isset($_GET['decline']))
    {
      echo"here it comes";
      echo $_GET['decline'];
    $id=$_GET['decline'];
    $sql6="UPDATE `client` SET `status` = 'declined' WHERE `client`.`cid` ='$id'";
    $run=mysqli_query($connection,$sql6);
    header('location:clientlist.php');
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
    <h2>Details of <?php echo $details['name']; ?></h2>
  </div>
  <div class="w3-container">
    Name:<?php echo $details['name']; ?><br>
    Date of birth:<?php echo $details['dob']; ?><br>
    Gender:<?php echo $details['gender']; ?><br>
    Email:<?php echo $details['email']; ?><br>
    Username:<?php echo $details['username']; ?><br>
    Password:<?php echo $details['password']; ?><br>
    Phone:<?php echo $details['phone']; ?><br>
    Address:<?php echo $details['address']; ?><br>
    Profession:<?php echo $details['profession']; ?><br>
    Company Name:<?php echo $details['company']; ?><br>

  </div>





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