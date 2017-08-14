<?php
  session_start();

  $linkToHome = "index.php";
  $linkToFinder = "finder.php";
  $linkToFaq = "faq.php#faq";
  $linkToContact = "faq.php#contact";

?>

<div id="header">
  <div id="navbar">
    <nav class="navbar-puppy navbar">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-offset-2 col-md-10">
            <a href="<?= $linkToHome ?>" class="nav navbar-brand"><img id="mainlogo" src="images/logo2.png" alt="PuppyLogo"></a>
            <ul class="nav navbar-nav navbar-center">
              <li <?php if($activeLink == "home") print 'class="active"'; ?>><a href="<?= $linkToHome ?>">Home</a></li>
              <li <?php if($activeLink == "finder") print 'class="active"'; ?>><a href="<?= $linkToFinder ?>">Finder</a></li>
              <li <?php if($activeLink == "faq") print 'class="active"'; ?>><a href="<?= $linkToFaq ?>">FAQ</a></li>
              <li <?php if($activeLink == "contact") print 'class="active"'; ?>><a href="<?= $linkToContact ?>">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right user-icon">
            <?php if(isset($_SESSION["user_name"])) { ?>
              <li><a href="user_profile.php">Welcome, <?= $_SESSION["first_name"]; ?></a></li>
              <li><a href="logout.php?logout=true"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i><span class="user-link"> Logout</span></a></li>

            <?php } else { ?>
              <li><a href="signup.php"><i class="fa fa-user-plus fa-lg" aria-hidden="true"></i><span class="user-link"> Sign Up</span></a></li>
              <li><a href="login.php"><i class="fa fa-sign-in fa-lg" aria-hidden="true"></i><span class="user-link"> Login</span></a></li>
            <?php } ?>
            </ul>


          </div>
        </div>
      </div>
    </nav>
  </div>
</div>
