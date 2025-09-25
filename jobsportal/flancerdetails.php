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
    $sql4="SELECT * FROM `freelancer` WHERE fid='$id'";
    $run=mysqli_query($connection,$sql4);
    $detals=mysqli_fetch_array($run);
  }


  if(isset($_GET['update']))
    {
      echo"here it comes";
      echo $_GET['update'];
    $id=$_GET['update'];
    $sql5="UPDATE `freelancer` SET `status` = 'approved' WHERE `freelancer`.`fid` ='$id' ";
    $run=mysqli_query($connection,$sql5);
    header('location:admin.php');
    }

    if(isset($_GET['decline']))
    {
      echo"here it comes";
      echo $_GET['decline'];
    $id=$_GET['decline'];
    $sql6="UPDATE `freelancer` SET `status` = 'declined' WHERE `freelancer`.`fid` ='$id' ";
    $run=mysqli_query($connection,$sql6);
    header('location:admin.php');
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
    <h2>Details of <?php echo $detals['name']; ?></h2>
  </div>
  <div class="w3-container">
    Name:<?php echo $detals['name']; ?><br>
    Date of birth:<?php echo $detals['dob']; ?><br>
    Gender:<?php echo $detals['gender']; ?><br>
    Email:<?php echo $detals['email']; ?><br>
    Username:<?php echo $detals['username']; ?><br>
    Password:<?php echo $detals['password']; ?><br>
    Phone:<?php echo $detals['phone']; ?><br>
    Hourley Price:<?php echo $detals['hprice']; ?>$<br>
    Address:<?php echo $detals['address']; ?><br>
    Skills:<?php echo $detals['skills'];?><br>
  </div>

  <a href="flancerdetails.php?update=<?php echo $detals['fid']; ?>" class="w3-button w3-green">Approve</a>
  <a href="flancerdetails.php?decline=<?php echo $detals['fid']; ?>" class="w3-button w3-red">Decline</a>



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