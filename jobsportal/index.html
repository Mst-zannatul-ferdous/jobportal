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
  <?php

      session_start();
      if(isset($_POST['submit']))
      {  require_once("config.php");
         $username=$_POST['username'];
         $password=$_POST['password'];
         $type=$_POST['type'];
        
         
        $sql="SELECT * FROM `$type` WHERE username='$username' and password='$password' and status='approved'";
        $result=mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0)
        {

          echo"<script>alert('successfully logged in to database')</script>";
          $_SESSION['username']=$username;
          $_SESSION['type']=$type;
          if($type==="user")
          {
            header('location:admin.php');
          }
          else if($type==="freelancer")
          {
            header('location:freelancerhome.php');
          }
          else if($type==="client")
          {
            header('location:clienthome.php');
          }
          
        }
        else{
          echo"<script>alert('Wrong Username or Password!')
          header('location:index.php');
          </script>";
        
        }
        
      }
  ?>

  <?php
include('header.php');
 ?>

  <div class="addimage">
    <div class="addtext">
      <h1 style="font-size:50px">Hire expert freelancers for any job, online</h1>
      <h3>Millions of small businesses use Freelancer to turn their ideas into reality.</h3>
      <button class="button button2" id="Btn2">I want to work</button>
      <button class="button button2" id="Btn3">I want to Hire</button>
    </div>

  </div>
  <div class="features">
    <h2>Don't waste your talent.</h2>
    <p>Choose your skill and get started now.</p>
    <div class="grid-container3 features__grid">
      <div class="feature-card">
        <img src="images/web.png" alt="Web development icon" class="feature-card__img">
        <h2 class="feature-card__title">Web development</h2>
      </div>
      <div class="feature-card">
        <img src="images/research.png" alt="Web research icon" class="feature-card__img">
        <h2 class="feature-card__title">Web Research</h2>
      </div>
      <div class="feature-card">
        <img src="images/mobile.png" alt="App development icon" class="feature-card__img">
        <h2 class="feature-card__title">App development</h2>
      </div>
      <div class="feature-card">
        <img src="images/designer.png" alt="Graphic design icon" class="feature-card__img">
        <h2 class="feature-card__title">Graphic Design</h2>
      </div>
    </div>
  </div>
  <?php include_once __DIR__ . '/footer.php'; ?>

  <!--------------------------------modal for login---------------------------------------->

  <div id="modal1" class="modal" role="dialog" aria-modal="true" aria-hidden="true" aria-labelledby="loginTitle">
    <form id="loginForm" class="modal-content" method="post" action="">
      <div class="modal-header">
        <h2 id="loginTitle">Sign in to Jobs Here</h2>
        <button type="button" class="close" aria-label="Close" data-close>&times;</button>
      </div>

      <div class="container">
        <label for="username"><b>Username</b></label>
        <input id="username" type="text" placeholder="Enter Username" class="w3-input" name="username" required>

        <label for="password"><b>Password</b></label>
        <input id="password" type="password" placeholder="Enter Password" class="w3-input" name="password" required>

        <div class="radio-row" role="radiogroup" aria-label="Account type">
          <label><input type="radio" name="type" value="user" checked required> Admin</label>
          <label><input type="radio" name="type" value="freelancer"> Freelancer</label>
          <label><input type="radio" name="type" value="client"> Client</label>
        </div>

        <button type="submit" name="submit" class="btn-submit">Sign in</button>
      </div>
    </form>
  </div>

  <!---------------------------------Another model for signup-------------------------------------->

  <script>
  (function() {
    var modal = document.getElementById('modal1');
    var loginForm = document.getElementById('loginForm');
    var openBtns = {
      login: document.getElementById('Btn'),
      signup: document.getElementById('Btn1'),
      work: document.getElementById('Btn2'),
      hire: document.getElementById('Btn3')
    };

    function showModal() {
      modal.setAttribute('aria-hidden', 'false');
      // focus first input
      var first = modal.querySelector('input[type="text"], input[type="email"], input[type="password"], button');
      if (first) first.focus();
    }

    function hideModal() {
      modal.setAttribute('aria-hidden', 'true');
    }

    if (openBtns.login) openBtns.login.addEventListener('click', function() {
      showModal();
    });
    if (openBtns.signup) openBtns.signup.addEventListener('click', function() {
      location.href = 'signup.php';
    });
    if (openBtns.work) openBtns.work.addEventListener('click', function() {
      showModal();
    });
    if (openBtns.hire) openBtns.hire.addEventListener('click', function() {
      showModal();
    });

    // close buttons
    var closeButtons = modal.querySelectorAll('[data-close]');
    closeButtons.forEach(function(btn) {
      btn.addEventListener('click', hideModal);
    });

    // click outside to close
    modal.addEventListener('click', function(e) {
      if (e.target === modal) hideModal();
    });

    // close on Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && modal.getAttribute('aria-hidden') === 'false') {
        hideModal();
      }
    });

    // optional: ensure form submits normally (existing PHP handles it)
  })();
  </script>

</body>

</html>