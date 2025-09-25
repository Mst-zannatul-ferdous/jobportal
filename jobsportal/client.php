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
         $address=$_POST['address'];
         $profession=$_POST['profession'];
         $company=$_POST['company'];
        

        $sql="INSERT INTO `client` (`cid`, `name`, `dob`, `gender`, `email`, `phone`, `address`, `profession`, `company`, `review`, `total_rat`, `rating`, `username`, `password`, `status`) VALUES ('', '$name', '$dob', '$gender', '$email', '$phone', '$address', '$profession', '$company', '0', '0', '0', '$username', '$password', 'waiting')";
        $result=mysqli_query($connection,$sql);
        if($result)
        {
          echo"successfully inserted to database";
          header('location:index.php');
        }
        else{
          echo"sorry try again";
        }
        
      }
      


  ?>

  <?php
include('header.php');
 ?>


  <div class="w3-container w3-blue" align="center">
    <h2>You are going to be a client !</h2>
  </div>
  <div class="bg-img">
    <div class="container py-5">
      <div class="card mx-auto shadow" style="max-width:900px; background: rgba(255,255,255,0.95)">
        <div class="card-body">
          <h4 class="card-title text-center mb-4">Client sign up</h4>
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
                  <input class="form-check-input" type="radio" name="gender" id="gMaleC" value="male" checked>
                  <label class="form-check-label" for="gMaleC">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="gFemaleC" value="female">
                  <label class="form-check-label" for="gFemaleC">Female</label>
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

            <div class="form-group">
              <label for="address">Address</label>
              <input id="address" class="form-control" type="text" name="address">
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="profession">Your Profession</label>
                <input id="profession" class="form-control" type="text" name="profession">
              </div>
              <div class="form-group col-md-6">
                <label for="company">Your Company Name</label>
                <input id="company" class="form-control" type="text" name="company">
              </div>
            </div>

            <button type="submit" value="Submit" name="submit" class="btn btn-primary btn-block">Submit</button>
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