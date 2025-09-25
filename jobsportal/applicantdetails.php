<?php
include("config.php");
        $pstid=$_GET['test'];
        $applicant=$_GET['appl'];
session_start();
if(isset($_SESSION['username'])){
   $t=$_SESSION['username'];
$sql8="SELECT * FROM `job_application` WHERE owner='$t'";
$request=mysqli_query($connection,$sql8);
$number=mysqli_num_rows($request);

$sql20="SELECT * FROM `posts` WHERE job_stat='assigned' && submission!='' && posted_by='$t'  && accept=''";
$request2=mysqli_query($connection,$sql20);
$submission=mysqli_num_rows($request2);

}
else{
  header('location:index.php');
}

$temp=$_SESSION['username'];
$sql9="SELECT * FROM `job_application` WHERE owner='$temp'";
$run=mysqli_query($connection,$sql9);

    
    $sql22="SELECT * FROM `freelancer` WHERE username='$applicant'";
    $temp3=mysqli_query($connection,$sql22);
    $info=mysqli_fetch_array($temp3);

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

<body bgcolor="#E6E6FA">



  
  <!-------------------------header design--------------------->
  <?php include_once __DIR__ . '/client-header.php'; ?>
  <!---------------------body starts from here------------------------------------->
  <div class="w3-panel w3-border-top w3-border-bottom w3-border-green">
    <h2><?php echo$_SESSION['username']; ?> here is your applicant details</h2>
  </div>


  <div class="w3-container w3-green" style="padding: 1%; text-align: center;">
    <h2>Details of <?php echo $info['name']; ?></h2>
  </div>
  <div class="w3-container">
    Name:<?php echo $info['name']; ?><br>
    Date of birth:<?php echo $info['dob']; ?><br>
    Gender:<?php echo $info['gender']; ?><br>
    Email:<?php echo $info['email']; ?><br>
    Username:<?php echo $info['username']; ?><br>
    Phone:<?php echo $info['phone']; ?><br>
    Hourley Price:<?php echo $info['hprice']; ?>$<br>
    Address:<?php echo $info['address']; ?><br>
    Skills:<?php echo $info['skills'];?><br>
    Job completed:<?php echo $info['jobs_completed']; ?><br>
    Rating:<?php echo $info['rating']; ?><br>
  </div>

  <a href="applied.php?test=<?php echo $pstid; ?>&appl=<?php echo $info['username']; ?>"
    class="w3-button w3-green">Accept for Jobid:<?php echo $pstid; ?></a>

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