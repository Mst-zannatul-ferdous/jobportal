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
    <h2>Client needed approval</h2>
  </div>
  <div class="w3-container" style="padding-left: 30%;padding-right: 30%;">
    <table class="w3-table w3-bordered w3-centered" style="padding: 2%;">
      <tr>
        <th>Freelancer id</th>
        <th>Name</th>
        <th>Email</th>

        <th>Company</th>
        <th>Action</th>
        <?php while($client=mysqli_fetch_array($req2)) {?>
      <tr>
        <td><?php echo $client['cid']; ?></td>
        <td><?php echo $client['name']; ?></td>
        <td><?php echo $client['email']; ?></td>
        <td><?php echo $client['company']; ?></td>
        <td><a href="clientdetals.php?show=<?php echo $client['cid']; ?>" class="w3-button w3-red">Details</a></td>

      </tr>
      <?php } ?>
    </table>
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