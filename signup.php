<!DOCTYPE html>
<html>
<head>
  <?php 
    $title = "Sign Up";
    include "head_src.php";
  ?>
</head>

<body>
<?php
  $activeLink = "signup";
  include "header.php"
?>

<div id="maincontent" class="container-fluid">
  <div class="text-center">
    <h2>REGISTRATION</h2>
  </div>

  <form name="reg-form" action="registration.php" onsubmit="return validateForm()" method="post">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <h3> CHOOSE USERNAME AND PASSWORD </h3>
        <hr>

        <div class="form-group">
          <label for="form_username">Username</label>
          <input type="text" class="form-control" id="form_username" name="username" required="required">
        </div>

        <div class="form-group">
          <label for="form_password">Password</label>
          <input type="password" class="form-control" id="form_password" name="password" required="required">
        </div>

        <div class="form-group">
          <label for="form_confirm_password">Confirm Password</label>
          <input type="password" class="form-control" id="form_confirm_password" name="confirm_password" required="required">
        </div>

        <h3> CONTACT INFORMATION </h3>
        <hr>
      </div>
    </div>

    <div class="row">
      <div class="col-md-5 col-md-offset-1">
        <div class="form-group">
          <label for="form_firstname">First Name</label>
          <input type="text" class="form-control" id="form_firstname" name="firstname" required="required">
        </div>
      </div>

      <div class="col-md-5">
        <div class="form-group">
          <label for="form_lastname">Last Name</label>
          <input type="text" class="form-control" id="form_lastname" name="lastname" required="required">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-5 col-md-offset-1">
        <div class="form-group">
          <label for="form_email">Email Address</label>
          <input type="email" class="form-control" id="form_email" name="email" required="required">
        </div> 
      </div>

      <div class="col-md-5">
        <div class="form-group">
          <label for="form_confirm_email">Phone Number</label>
          <input type="tel" class="form-control" id="form_confirm_email" name="phone" required="required">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 col-md-offset-4 text-center">
        <button type="submit" class="btn btn-primary btn-lg btn-block submit-btn">Submit</button>
      </div>
    </div>
  </form>
</div>

<?php include "footer.php"; ?>

</body>
</html>