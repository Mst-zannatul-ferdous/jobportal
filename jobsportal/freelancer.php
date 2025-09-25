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
</head>

<body>
  <?php
      if(isset($_POST['submit']))
      {  require_once("config.php");
      $name=$_POST['name'];
      $dob=$_POST['dob'];
      $gender=$_POST['gender'];
      $email=$_POST['email'];
      $username=$_POST['username'];
      $password=$_POST['password'];
      $phone=$_POST['phone'];
      $hprice=$_POST['hprice'];
      $address=$_POST['address'];
      $temp=$_POST['category'];
      $category=implode(",",$temp);

        $sql="INSERT INTO `freelancer` (`fid`, `name`, `username`, `password`, `dob`, `gender`, `email`, `phone`, `hprice`, `address`, `skills`, `jobs_completed`, `review`, `total_rat`, `rating`, `balance`, `status`) VALUES (NULL, '$name', '$username', '$password', '$dob', '$gender', '$email', '$phone', '$hprice', '$address', '$category', '0', '0', '0', '0', '0', 'waiting')";
        $result=mysqli_query($connection,$sql);
        if($result)
        {
          echo"successfully inserted to database";
          header('location:index.php');
        }
        else{
          //echo"sorry try again";
          echo '<script type="text/javascript"> alert("sorry try again") </script>';
        }
        
      }
      


  ?>

  <?php
include('header.php');
 ?>


  <div class="w3-container w3-teal" align="center">
    <h2>You are going to be a freelancer</h2>
  </div>
  <div class="bg-img">
    <div class="container py-5">
      <div class="card mx-auto shadow" style="max-width:900px; background: rgba(255,255,255,0.95)">
        <div class="card-body">
          <h4 class="card-title text-center mb-4">Freelancer sign up</h4>
          <form method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input id="name" class="form-control" type="text" name="name" required>
              </div>
              <div class="form-group col-md-6">
                <label for="dob">Date of Birth</label>
                <input id="dob" class="form-control" type="date" name="dob">
              </div>
            </div>

            <div class="form-group">
              <label>Gender</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="gMale" value="male" checked>
                  <label class="form-check-label" for="gMale">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="gFemale" value="female">
                  <label class="form-check-label" for="gFemale">Female</label>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input id="email" class="form-control" type="email" name="email">
              </div>
              <div class="form-group col-md-6">
                <label for="username">Username</label>
                <input id="username" class="form-control" type="text" name="username">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input id="password" class="form-control" type="password" name="password">
              </div>
              <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                <input id="phone" class="form-control" type="text" name="phone">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="hprice">Hourly price</label>
                <input id="hprice" class="form-control" type="number" name="hprice">
              </div>
              <div class="form-group col-md-6">
                <label for="address">Address</label>
                <input id="address" class="form-control" type="text" name="address">
              </div>
            </div>

            <h5 class="mt-3">Choose your skill(s)</h5>
            <div class="form-group">
              <div class="row">
                <!-- checkbox grid -->
                <?php
                $skills = ['php','html','designing','photoshop','data-entry','writing','android','excel','css','seo','iphone','mysql','research','linux','c++','java','python'];
                foreach(array_chunk($skills,4) as $row){
                  echo '<div class="col-12 d-flex flex-wrap mb-2">';
                  foreach($row as $s){
                    $id = 'skill_'.preg_replace('/[^a-z0-9_]/i','_',$s);
                    echo '<div class="form-check mr-3">';
                    echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"category[]\" value=\"$s\" id=\"$id\">";
                    echo "<label class=\"form-check-label\" for=\"$id\">".htmlspecialchars($s)."</label>";
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
  </div>

  <?php
include('footer.php');
 ?>


</body>

</html>