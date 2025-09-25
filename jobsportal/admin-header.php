<?php
// admin-header.php
// Reusable admin header. Expects badge variables to be defined in the including file:
// $nt, $n1, $n2, $n4, $n5, $n6, $nt1
?>
<div class="grid-container">
  <div class="header"><img src="images/logo.png" alt="logo"></div>
  <div>
    <div class="job">Jobs Here</div>
  </div>
  <div class="fwhite">
    <div style="display:flex;gap:8px;align-items:center;">
      <div class="w3-dropdown-hover" style="background:transparent;">
        <button class="button button1">Approval <span
            class="w3-badge w3-red"><?php echo isset($nt) ? $nt : 0; ?></span></button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
          <a href="admin.php" class="w3-bar-item w3-button">Freelancers <span
              class="w3-badge w3-red"><?php echo isset($n1) ? $n1 : 0; ?></span></a>
          <a href="clientlist.php" class="w3-bar-item w3-button">Clients <span
              class="w3-badge w3-red"><?php echo isset($n2) ? $n2 : 0; ?></span></a>
        </div>
      </div>

      <a href="admin-transactionlist.php" class="button button1"
        style="display:inline-flex;align-items:center;">Transactions <span class="w3-badge w3-red"
          style="margin-left:6px"><?php echo isset($n4) ? $n4 : 0; ?></span></a>

      <div class="w3-dropdown-hover" style="background:transparent;">
        <button class="button button1">Users <span
            class="w3-badge w3-red"><?php echo isset($nt1) ? $nt1 : 0; ?></span></button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
          <a href="flancerlist-n.php" class="w3-bar-item w3-button">Freelancers <span
              class="w3-badge w3-red"><?php echo isset($n5) ? $n5 : 0; ?></span></a>
          <a href="clientlist-n.php" class="w3-bar-item w3-button">Clients <span
              class="w3-badge w3-red"><?php echo isset($n6) ? $n6 : 0; ?></span></a>
        </div>
      </div>

      <a href="admin.php?status=logout" class="button" style="background:#66b3ff;color:#05243a;">Logout</a>
    </div>
  </div>
</div>