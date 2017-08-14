<!DOCTYPE html>
<html>
<head>
  <?php
    $title = "Logout";
    include "head_src.php";
  ?>
</head>

<body>
<?php
  require_once "admin/dbconfig.php";

  if(isset($_GET['logout']) && $_GET['logout']=="true") {
    $user->logout();
    $success_msg = "You have successfully logged out! Will be redirected to home in a second.";
    header("refresh:1;url=index.php");
  } else {
    header("location: index.php");
  }

  $activeLink = "logout";
  include "header.php";
?>

<div id="maincontent" class="container" >
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
          <?php if (!empty($success_msg)) { ?>
            <div id="success" class="alert alert-success" role="alert">
              <?php echo $success_msg; ?>
            </div>
          <?php } ?>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

</body>
</html>
