<!DOCTYPE html>
<html>
<head>
  <?php
    $title = "Sign In";
    include "head_src.php";
  ?>
</head>

<body>
<?php
  $activeLink = "login";
  include "header.php";
  require_once "admin/dbconfig.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $success = $user->login($_POST['username'], $_POST['password']);

      if ($success) {
         header("location: index.php");
      } else {
         $error = "Your Username or Password is invalid!";
      }
   }
?>

<div id="maincontent" class="container" >
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
          <?php if (!empty($error)) { ?>
            <div id="error" class="alert alert-danger" role="alert">
              <?php echo $error; ?>
            </div>
          <?php } ?>
            <h1 class="text-center">Sign In</h1>

            <form id="signInForm" method="post">
                <div class="form-group">
                    <label for="form_username">Username</label>
                    <input type="text" class="form-control" id="form_username" name="username" required="required">
                </div>

                <div class="form-group">
                    <label for="form_password">Password</label>
                    <input type="password" class="form-control" id="form_password" name="password" required="required">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-block submit-btn">Submit</button>
                </div>
            </form>

            <div id="signUpLink" class="text-center">
                <a href="signup.php">Not registed, sign up today!</a>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

</body>
</html>
