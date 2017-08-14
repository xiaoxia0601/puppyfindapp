<?php
  
  function imgToTxtLines($imgPath) {
    $txtPath = "info/".explode(".", explode("/", $imgPath)[1])[0].".txt";
    $lines = false;
    if(file_exists($txtPath)) {
      $lines = file($txtPath, FILE_IGNORE_NEW_LINES);
    }
    return $lines;
  }

  $images = glob("images/puppy*.jpg");
  $imagesCount = count($images);

  $carousels = glob("images/carousel*.jpg");
  $carouselCount = count($carousels);
?>

<!DOCTYPE html>
<html>
<head>
  <title> PuppyFinder </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.png" type="image/png">
  <link rel="stylesheet/less" type="text/css" href="puppy.less" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.css.map">
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.js.map"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js"></script>
  <script src="main.js"></script>
  <script>
  $(document).ready(function(){
    $('.puppy-name').click(function(e){
      e.preventDefault();
      $(this).closest('div').find(".puppy-info").slideToggle("slow", function(){});
    });
  });
  </script>
</head>

<body>
<?php
  $activeLink = "home"; 
  include "header.php" 
?>

<div class="container">
  <h1 class="page-header">EDIT USER PROFILE</h1>
  <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">
        <img src="images/user_pic/image.png" class="avatar img-circle img-thumbnail" alt="avatar">
        <input type="file" class="text-center center-block well well-sm">
      </div>
    </div>
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
      <h3>User Profile</h3>
      <form class="form-horizontal" role="form">
        <div class="form-group">
          <label class="col-lg-3 control-label">First Name:</label>
          <div class="col-lg-8">
            <input class="form-control" value="sicong" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Last Name:</label>
          <div class="col-lg-8">
            <input class="form-control" value="wang" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Phone Number:</label>
          <div class="col-lg-8">
            <input class="form-control" value="111111" type="tel">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Email Address:</label>
          <div class="col-lg-8">
            <input class="form-control" value="tuhao@gmail.com" type="email">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Username:</label>
          <div class="col-md-8">
            <input class="form-control" value="cocowang" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Password:</label>
          <div class="col-md-8">
            <input class="form-control" value="111111" type="password">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Confirm password:</label>
          <div class="col-md-8">
            <input class="form-control" value="111111" type="password">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
            <input class="btn btn-primary" value="Save Changes" type="button">
            <span></span>
            <input class="btn btn-default" value="Cancel" type="reset">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

<script>
  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox();
  });
</script>
</body>
</html>