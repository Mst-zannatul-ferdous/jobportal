<?php
// freelancer-header.php
// Reusable header for freelancer pages. Expects $pending and $req28 to be defined by the including files.
?>
<div class="grid-container">
  <div class="header"><img src="images/logo.png" alt="logo"></div>
  <div>
    <div class="job">Jobs Here</div>
  </div>
  <div class="fwhite">
    <div style="display:flex;gap:8px;align-items:center;justify-content:flex-end;">
      <a href="freelancerhome.php" class="button button1" style="display:inline-flex;align-items:center;">Home</a>

      <a href="submitjob.php" class="button button1" style="display:inline-flex;align-items:center;">Pending Job <span
          class="w3-badge w3-blue" style="margin-left:6px"><?php echo isset($pending) ? $pending : 0; ?></span></a>

      <a href="flancer-paycheck.php" class="button button1" style="display:inline-flex;align-items:center;">Pay Check
        <span class="w3-badge w3-blue" style="margin-left:6px"><?php echo isset($req28) ? $req28 : 0; ?></span></a>

      <a href="freelancerhome.php?status=logout" class="button" style="background:#66b3ff;color:#05243a;">Logout</a>
    </div>
  </div>
</div>