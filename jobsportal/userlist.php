<?php
include("config.php");
session_start();
if(isset($_SESSION['username'])){
  $t=$_SESSION['username'];
$sql8="SELECT * FROM `job_application` WHERE owner='$t'";
$request=mysqli_query($connection,$sql8);
$number=mysqli_num_rows($request);

$sql19="SELECT * FROM `posts` WHERE job_stat='assigned' && submission!='' && posted_by='$t' && accept=''";
$request2=mysqli_query($connection,$sql19);
$submission=mysqli_num_rows($request2);
}
else{
  header('location:index.php');
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

<body bgcolor="#E6E6FA">

  <?php
     
      
      if(isset($_POST['submit']))
      {  
        $string=$_POST['take'];
        $sql40="SELECT * FROM `freelancer` WHERE skills LIKE '%$string%'";
        $run40=mysqli_query($connection,$sql40);
        
      }
      else{  
        $sql40="SELECT * FROM `freelancer` WHERE status='approved'";
        $run40=mysqli_query($connection,$sql40);
      }

      
     
      
      if(isset($_GET['status'])){
        if ($_GET['status']=='logout') {
          session_destroy();
        header('location:index.php');
        }
    
      }
      


      


  ?>

  
  <!-------------------------header design--------------------->
  <?php include_once __DIR__ . '/client-header.php'; ?>




  <!---------------------body starts from here------------------------------------->

  <div class="w3-cell-row" style="padding: 2%;">
    <!---------------------------------------------Left most bar--------------------------------------------->
    <div class="w3-container w3-cell w3-mobile w3-border w3-round-xlarge" style="width:25%;padding: 2%;">
      <p class="w3-card w3-border w3-round-xlarge" style="padding: 2%;"><b>List of your Client review.<br>Click to see
          details.</b></p>
      <?php while($show=mysqli_fetch_array($run40)) { 
      $uname=$show['username'];
      ?>

      <a style="width: 100%;" href="userlist.php?send=<?php echo $uname;?>"
        class="w3-button w3-hover-shadow w3-brown w3-border w3-round-xlarge"><?php echo $uname;?></a><br>

      <?php }
      
     ?>
    </div>
    <br>
    <!---------------------------------------------Middle body bar--------------------------------------------->
    <?php 
    
   ?>

    <div class="w3-container w3-cell w3-mobile w3-border w3-round-xlarge" style="width:65%;padding: 2%;">
      <?php

      if(isset($_GET['send']))
      {
        $uname=$_GET['send'];
      }

    if(empty($uname)){
      echo'<script type="text/javascript">
              alert("No Results");
              location="userlist.php";
               </script>';
    }
    else{
     $sql41="SELECT * FROM `freelancer` WHERE username='$uname'";
     $run41=mysqli_query($connection,$sql41);
     $result=mysqli_fetch_array($run41);
    }
      ?>
      <div class="w3-card w3-border w3-round-xlarge">

        <table class="w3-table w3-bordered w3-centered" style="padding: 2%;">
          <tr>
            <td>Name:</td>
            <td><?php echo $result['name'];?></td>
          </tr>
          <tr>
            <td>Email:</td>
            <td><?php echo $result['email'];?></td>
          </tr>
          <tr>
            <td>Phone:</td>
            <td><?php echo $result['phone'];?></td>
          </tr>
          <tr>
            <td>Job completed:</td>
            <td><?php echo $result['jobs_completed'];?></td>
          </tr>
          <tr>
            <td>Rating:</td>
            <td><?php echo $result['rating'];?>*</td>
          </tr>
          <tr>
            <td>Address:</td>
            <td><?php echo $result['address'];?></td>
          </tr>
        </table>
      </div>
      <br>


      <?php 
    

     ?>
    </div>
    <br>
    <!-------------------------Table right bar here--------------------->
    <div class="w3-container w3-cell w3-mobile w3-border w3-round-xlarge w3-cell-middle" style="width:10%;">
      <p>Click to see details of freelancer.</p>
    </div>
  </div>

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