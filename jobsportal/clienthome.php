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
  <!-- Bootstrap (local) -->
  <link rel="stylesheet" href="css/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <link rel="shortcut icon" href="images/logo.png">
  <style>
  .error {
    color: #FF0000;
  }
  </style>
</head>

<body bgcolor="#E6E6FA">

  <?php
     $subjectErr =  "";
     $subject =  "";
     $categoryErr =  "";
     $category =  "";
      
      if(isset($_POST['submit']))
      {  require_once("config.php");

        if (empty($_POST["subject"])) {
          $subjectErr = "Subject is required";
        } else {
          $subject=$_POST['subject'];
          }
        

        //$subject=$_POST['subject'];
        $price=$_POST['price'];
        $details=$_POST['details'];
        $poster=$_SESSION['username'];
        
        if(empty($_POST['category'])){
          $categoryErr = "Category is required";
        }
        else{
          $temp=$_POST['category'];
        $category=implode(",", (array)$temp);
        }
        if(!$subject){
          echo '<script type="text/javascript"> alert("subject fields are required!") </script>';
          //echo 'subject fields are required!';
      }else{
        
        $sql="INSERT INTO `posts` (`postid`, `subject`, `price`, `posted_by`, `category`, `post_detail`, `job_stat`) VALUES (NULL, '$subject', '$price', '$poster', '$category', '$details', 'pending')";
        $result=mysqli_query($connection,$sql);
        if($result)
        {
          //echo"Your job has been posted";
          
          //header('location:clienthome.php');
          //echo '<script type="text/javascript"> alert("Your job has been posted") </script>';
          echo'<script type="text/javascript">
              alert("Your job has been posted");
              location="clienthome.php";
               </script>';
        }
        else{
          echo"sorry try again";
        }
      }
        
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
  <div class="w3-panel w3-border-top w3-border-bottom w3-border-green">
    <h2>Welcome <?php echo$_SESSION['username']; ?></h2>
  </div>


  <h3>New here ! Post a job.</h3>
  <div class="container py-4">
    <div class="card mx-auto shadow" style="max-width:900px; background: rgba(255,255,255,0.95)">
      <div class="card-body">
        <h4 class="card-title">Post a new job</h4>
        <form method="post" id="pform">
          <div class="form-group">
            <label for="subject">Enter a subject name that the project is related to</label>
            <input id="subject" class="form-control" type="text" name="subject"
              value="<?php echo htmlspecialchars($subject);?>">
            <small class="text-danger"><?php echo $subjectErr;?></small>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="price">Price</label>
              <input id="price" class="form-control" type="number" step="0.001" name="price">
            </div>
            <div class="form-group col-md-6">
              <label>Posted by</label>
              <input class="form-control" type="text" value="<?php echo htmlspecialchars($_SESSION['username']);?>"
                readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="details">Enter details of the job</label>
            <textarea id="details" class="form-control" rows="4" name="details">Enter details here...</textarea>
          </div>

          <h5 class="mt-3">Choose category for this job</h5>
          <div class="form-group">
            <div class="row">
              <?php
              $cats = ['php','html','designing','photoshop','data-entry','writing','android','excel','css','seo','iphone','mysql','research','linux','c++','java','python'];
              foreach(array_chunk($cats,4) as $row){
                echo '<div class="col-12 d-flex flex-wrap mb-2">';
                foreach($row as $c){
                  $id = 'cat_'.preg_replace('/[^a-z0-9_]/i','_',$c);
                  echo '<div class="form-check mr-3">';
                  echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"category[]\" value=\"$c\" id=\"$id\">";
                  echo "<label class=\"form-check-label\" for=\"$id\">".htmlspecialchars($c)."</label>";
                  echo '</div>';
                }
                echo '</div>';
              }
              ?>
            </div>
          </div>

          <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
      </div>
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