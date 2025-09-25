<?php
  define('db_server','localhost');
  define('db_username','root');
  define('db_password','');
  define('db_database','jobs');
  $connection=mysqli_connect(db_server,db_username,db_password,db_database);
  if($connection){
      
  }
else{
    echo"<script>alert('Failed to connect to database')</script>";
   }

// Stripe configuration - for test mode use your Stripe test keys here or set environment variables
// You can set these in your Apache/PHP environment or replace getenv() calls below with the literal keys (not recommended)
define('STRIPE_SECRET_KEY', getenv('STRIPE_SECRET_KEY') ?: 'sk_test_replace_me');
define('STRIPE_PUBLISHABLE_KEY', getenv('STRIPE_PUBLISHABLE_KEY') ?: 'pk_test_replace_me');

// Webhook signing secret (optional, set when you configure webhook endpoint in Stripe dashboard or stripe-cli)
define('STRIPE_WEBHOOK_SECRET', getenv('STRIPE_WEBHOOK_SECRET') ?: 'whsec_replace_me');
?>