<?php
session_set_cookie_params(0);
session_start();?>

<?php
if(!isset($_SESSION["name"])){
    $_SESSION["flash"]="You must log in to see grades!";
    header("Location: login.php");
} else {


    error_reporting(~E_NOTICE); // avoid notice

    require_once 'dbconfig.php';

    if (isset($_POST['btnsave'])) {
        $dogname1 = $_POST['dogname'];//
        $dogbreed1 = $_POST['dogbreed'];//
        $dogcolor1 = $_POST['dogcolor'];//
        $doggender1 = $_POST['doggender'];//
        $dogcolor1 = $_POST['dogcolor'];//

        $dogage1 = $_POST['dogage']; //
        $dogbirth1 = $_POST['dogbirth'];//

        $dogsize1 = $_POST['dogsize'];//

        $dogprice1 = $_POST['dogprice']; //
        $dogdescription1 = $_POST['dogdescription']; //
        $feature1 = $_POST['feature']; //


        $imgFile = $_FILES['dogimage']['name'];
        $tmp_dir = $_FILES['dogimage']['tmp_name'];
        $imgSize = $_FILES['dogimage']['size'];


        $imgFile2 = $_FILES['dogimage_b']['name'];
        $tmp_dir2 = $_FILES['dogimage_b']['tmp_name'];
        $imgSize2 = $_FILES['dogimage_b']['size'];

        $imgFile3 = $_FILES['dogimage_c']['name'];
        $tmp_dir3 = $_FILES['dogimage_c']['tmp_name'];
        $imgSize3 = $_FILES['dogimage_c']['size'];

        $upload_dir = 'dog_images/'; // upload directory
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions




        if (empty($dogname1)) {
            $errMSG = "Please Enter dogname.";
        } else if (empty($dogbreed1)) {
            $errMSG = "Please Enter Your dog breed.";
        } else if (empty($dogcolor1)) {
            $errMSG = "Please Enter Your dog color.";
        } else if (empty($doggender1)) {
            $errMSG = "Please Enter Your dog gender.";
        } else if (empty($dogage1)) {
            $errMSG = "Please Enter Your dog age.";
        } else if (empty($dogbirth1)) {
            $errMSG = "Please Enter Your dog birth day.";
        } else if (empty($dogsize1)) {
            $errMSG = "Please Enter Your dog size.";
        } else if (empty($dogprice1)) {
            $errMSG = "Please Enter Your dog price.";
        } else if (empty($dogdescription1)) {
            $errMSG = "Please Enter Your dog description.";
        } else if (empty($imgFile)) {
            $errMSG = "Please Select Image File.";
        } else {


            $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension


            // rename uploading image
            $dogimg = rand(1000, 1000000) . "." . $imgExt;

            // allow valid image file formats
            if (in_array($imgExt, $valid_extensions)) {
                // Check file size '5MB'
                if ($imgSize < 5000000) {
                    move_uploaded_file($tmp_dir, $upload_dir.$dogimg);
                } else {
                    $errMSG = "Sorry, your file is too large.";
                }
            } else {
                $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        }

        if($imgFile2) {


            $imgExt2 = strtolower(pathinfo($imgFile2, PATHINFO_EXTENSION)); // get image extension




            // rename uploading image
            $dogimg2 = rand(1000, 1000000) . "." . $imgExt2;

            // allow valid image file formats
            if (in_array($imgExt2, $valid_extensions)) {
                // Check file size '5MB'
                if ($imgSize2 < 5000000) {
                    move_uploaded_file($tmp_dir2, $upload_dir.$dogimg2);
                } else {
                    $errMSG = "Sorry, your file is too large.";
                }
            } else {
                $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }

        }
        if($imgFile3) {


            $imgExt3 = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

            // valid image extensions


            // rename uploading image
            $dogimg3 = rand(1000, 1000000) . "." . $imgExt3;

            // allow valid image file formats
            if (in_array($imgExt3, $valid_extensions)) {
                // Check file size '5MB'
                if ($imgSize3 < 5000000) {
                    move_uploaded_file($tmp_dir3, $upload_dir.$dogimg3);
                } else {
                    $errMSG = "Sorry, your file is too large.";
                }
            } else {
                $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        }

        // if no error occured, continue ....
        if (!isset($errMSG)) {
            $stmt = $DB_con->prepare('INSERT INTO doginfo(dog_name, breed, color, gender, age_in_weeks,
 birth_date, size, price, description ,dogimg1,dogimg2,dogimg3,featured) VALUES(:dname,:dbreed, :dcolor, :dgender, :dage, :dbirth,:dsize,:dprice,:ddescription,:dimg,:dimg2,:dimg3,:dfeature)');
            $stmt->bindParam(':dname', $dogname1);
            $stmt->bindParam(':dbreed', $dogbreed1);

            $stmt->bindParam(':dcolor', $dogcolor1);
            $stmt->bindParam(':dgender', $doggender1);
            $stmt->bindParam(':dage', $dogage1);
            $stmt->bindParam(':dbirth', $dogbirth1);

            $stmt->bindParam(':dsize', $dogsize1);

            $stmt->bindParam(':dprice', $dogprice1);
            $stmt->bindParam(':ddescription', $dogdescription1);

            $stmt->bindParam(':dfeature', $feature1);

            $stmt->bindParam(':dimg', $dogimg);

            $stmt->bindParam(':dimg2', $dogimg2);
            $stmt->bindParam(':dimg3', $dogimg3);

            if ($stmt->execute()) {
                $successMSG = "new record succesfully inserted ...";
                header("refresh:5;index.php"); // redirects image view page after 5 seconds.
            } else {
                $errMSG = "error while inserting....";
            }
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PuppyFinder Management System</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

</head>
<body>

<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 

 
    </div>
</div>

<div class="container">


	<div class="page-header">
    	<h1 class="h2">add new puppy. <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a></h1>
    </div>
    

	<?php
	if(isset($errMSG)){
			?>
            <div class="alert alert-danger">
            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
	}
	?>   

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">dogname.</label></td>
        <td><input class="form-control" type="text" name="dogname" placeholder="Enter dogname" value="<?php echo $dog_name; ?>" /></td>
    </tr>



        <tr>
            <td><label class="control-label">dogbreed.</label></td>
            <td><input class="form-control" type="text" name="dogbreed" placeholder="Enter dogbreed" value="<?php echo $breed; ?>" /></td>
        </tr>

        <tr>
            <td><label class="control-label">dogcolor.</label></td>
            <td><input class="form-control" type="text" name="dogcolor" placeholder="Enter dogbreed" value="<?php echo $color; ?>" /></td>
        </tr>

        <tr>
            <td><label class="control-label">doggender.</label></td>
            <td><input class="form-control" type="text" name="doggender" placeholder="Enter dogbreed" value="<?php echo $gender; ?>" /></td>
        </tr>




        <tr>
            <td><label class="control-label">dogage.</label></td>
            <td><input class="form-control" type="text" name="dogage" placeholder="Enter dogage" value="<?php echo $age_in_weeks; ?>" /></td>
        </tr>

        <tr>
            <td><label class="control-label">dogbirth.</label></td>
            <td><input class="form-control" type="text" name="dogbirth" placeholder="Enter dogage" value="<?php echo $birth_date; ?>" /></td>
        </tr>


        <tr>
            <td><label class="control-label">dogsize.</label></td>
            <td><input class="form-control" type="text" name="dogsize" placeholder="Enter dogsize" value="<?php echo $size; ?>" /></td>
        </tr>

        <tr>
            <td><label class="control-label">dogprice.</label></td>
            <td><input class="form-control" type="text" name="dogprice" placeholder="Enter dogprice" value="<?php echo $price; ?>" /></td>
        </tr>


        <tr>
            <td><label class="control-label">dogdescription.</label></td>
            <td><input class="form-control" type="text" name="dogdescription" placeholder="Enter doginfo" value="<?php echo $description; ?>" /></td>
        </tr>

        <tr>
            <td><label class="control-label"> Featured dog please insert 1 .</label></td>
            <td><input class="form-control" type="text" name="feature" placeholder="Enter doginfo" value="<?php echo $featured; ?>" /></td>
        </tr>


    <tr>
    	<td><label class="control-label">dog Img1.</label></td>
        <td><input class="input-group" type="file" name="dogimage" accept="image/*" /></td>
    </tr>


        <tr>
            <td><label class="control-label">dog Img2.</label></td>
            <td><input class="input-group" type="file" name="dogimage_b" accept="image/*" /></td>
        </tr>

        <tr>
            <td><label class="control-label">dog Img3.</label></td>
            <td><input class="input-group" type="file" name="dogimage_c" accept="image/*" /></td>
        </tr>



        <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; save
        </button>
        </td>
    </tr>
    
    </table>
    
</form>




    

</div>



	


<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>