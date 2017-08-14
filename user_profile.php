<?
  session_start();
  
  // If user is not logged in, lead him to the login page
  if(!isset($_SESSION["user_name"])) {
    header('Location: login.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <?php
    $title = "User Profile";
    include "head_src.php";
  ?>
</head>

<body>
<?php
  $activeLink = "profile"; 
  include "header.php" 
?>

  <div id="maincontent" class="container">
  <h1 class="page-header">USER PROFILE</h1>
  <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">
        <img src="images/user_pic/Sadaharu.jpg" class="avatar img-circle img-thumbnail" alt="avatar">
      </div>
    </div>
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
      <form class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-5 control-label">First Name:</label>
          <div class="col-sm-7">
            <p class="form-control-static"><?= $_SESSION['first_name'] ?></p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-5 control-label">Last Name:</label>
          <div class="col-sm-7">
            <p class="form-control-static"><?= $_SESSION['last_name'] ?></p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-5 control-label">Phone Number:</label>
          <div class="col-sm-7">
            <p class="form-control-static"><?= $_SESSION['user_phone'] ?></p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-5 control-label">Email:</label>
          <div class="col-sm-7">
            <p class="form-control-static"><?= $_SESSION['user_email'] ?></p>
          </div>
        </div>                        
      </form>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

</body>
</html>