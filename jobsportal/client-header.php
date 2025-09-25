<?php
// client-header.php
// Reusable client header. Expects $number and $submission to be defined by including files (badge counts).
?>
<div class="grid-container">
  <div class="header"><img src="images/logo.png" alt="logo"></div>
  <div>
    <div class="job">Jobs Here</div>
  </div>
  <div class="fwhite">
    <div style="display:flex;gap:8px;align-items:center;justify-content:flex-end;">
      <a href="clienthome.php" class="button button1" style="display:inline-flex;align-items:center;">Home</a>

      <a href="jobapplied.php" class="button button1" style="display:inline-flex;align-items:center;">Job Application <span class="w3-badge w3-blue" style="margin-left:6px"><?php echo isset($number) ? $number : 0; ?></span></a>

      <a href="finaljob.php" class="button button1" style="display:inline-flex;align-items:center;">Submission <span class="w3-badge w3-blue" style="margin-left:6px"><?php echo isset($submission) ? $submission : 0; ?></span></a>

      <a href="userlist.php" class="button button1">View users</a>
      <a href="clientpost.php" class="button button1">Your posts</a>

      <!-- Search form moved to the right end and visually compacted -->
      <form action="userlist.php" method="POST" style="display:flex;gap:6px;align-items:center;margin:0 0 0 8px;">
        <input type="text" name="take" class="w3-input w3-light-grey" placeholder="Find expert" style="height:32px;padding:6px 8px;min-width:180px;">
        <input type="submit" name="submit" value="Go" class="button button1" style="height:32px;padding:4px 10px;">
      </form>

      <a href="clienthome.php?status=logout" class="button" style="background:#66b3ff;color:#05243a;">Logout</a>
    </div>
  </div>
</div>
