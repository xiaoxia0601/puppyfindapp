<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'dbconfig.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT dog_name, breed, color, gender, age_in_weeks, birth_date, size, price, description ,dogimg1, dogimg2, dogimg3, featured FROM doginfo WHERE dog_id =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: index.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$dog_name1 = $_POST['dog_name2'];// dog name

        $breed1 = $_POST['breed2'];// dog breed
        
		$color1 = $_POST['color2'];// dog color

        $gender1 = $_POST['gender2'];// dog gender

        $age_in_weeks1 = $_POST['age_in_weeks2'];// dog age

        $birth_date1 = $_POST['birth_date2'];// dog birth date

        $size1 = $_POST['size2'];// dog size

        $price1 = $_POST['price2'];// dog price

        $description1 = $_POST['description2'];// dog descript

        $featured1 = $_POST['feature'];// dog featured
        
		$imgFile = $_FILES['dog_images2']['name'];
		$tmp_dir = $_FILES['dog_images2']['tmp_name'];
		$imgSize = $_FILES['dog_images2']['size'];

        $imgFile2 = $_FILES['dog_images3']['name'];
        $tmp_dir2 = $_FILES['dog_images3']['tmp_name'];
        $imgSize2 = $_FILES['dog_images3']['size'];


        $imgFile3 = $_FILES['dog_images4']['name'];
        $tmp_dir3 = $_FILES['dog_images4']['tmp_name'];
        $imgSize3 = $_FILES['dog_images4']['size'];

        $upload_dir = 'dog_images/'; // upload directory
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

		if($imgFile)
		{

			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

			$dogimg11 = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['dogimg1']);
					move_uploaded_file($tmp_dir,$upload_dir.$dogimg11);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$dogimg11 = $edit_row['dogimg1']; // old image from database
		}

        if($imgFile2)
        {

            $imgExt2 = strtolower(pathinfo($imgFile2,PATHINFO_EXTENSION)); // get image extension

            $dogimg22 = rand(1000,1000000).".".$imgExt2;
            if(in_array($imgExt2, $valid_extensions))
            {
                if($imgSize2 < 5000000)
                {
                    unlink($upload_dir.$edit_row['dogimg2']);
                    move_uploaded_file($tmp_dir2,$upload_dir.$dogimg22);
                }
                else
                {
                    $errMSG = "Sorry, your file is too large it should be less then 5MB";
                }
            }
            else
            {
                $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        }
        else
        {
            // if no image selected the old image remain as it is.
            $dogimg22 = $edit_row['dogimg2']; // old image from database
        }

        if($imgFile3)
        {

            $imgExt3 = strtolower(pathinfo($imgFile3,PATHINFO_EXTENSION)); // get image extension

            $dogimg33 = rand(1000,1000000).".".$imgExt3;
            if(in_array($imgExt3, $valid_extensions))
            {
                if($imgSize3 < 5000000)
                {
                    unlink($upload_dir.$edit_row['dogimg3']);
                    move_uploaded_file($tmp_dir3,$upload_dir.$dogimg33);
                }
                else
                {
                    $errMSG = "Sorry, your file is too large it should be less then 5MB";
                }
            }
            else
            {
                $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        }
        else
        {
            // if no image selected the old image remain as it is.
            $dogimg33 = $edit_row['dogimg3']; // old image from database
        }










        // if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE doginfo 
									     SET dog_name=:uname, 
										     breed=:ubreed, 
										     color=:ucolor,
										     gender=:ugender,
										     age_in_weeks=:uage_in_weeks,
										     birth_date= :ubirth_date,
										     size= :usize,
										     price= :uprice,
										     description= :udescription,
										     featured= :ufeatured,
										
										     dogimg1=:upic,
										     dogimg2=:upic2,
										     dogimg3=:upic3
								       WHERE dog_id=:uid');


			$stmt->bindParam(':uname',$dog_name1);
			$stmt->bindParam(':ubreed',$breed1);
            $stmt->bindParam(':ucolor',$color1);
            $stmt->bindParam(':ugender',$gender1);
            $stmt->bindParam(':uage_in_weeks',$age_in_weeks1);
            $stmt->bindParam(':ubirth_date',$birth_date1);
            $stmt->bindParam(':usize',$size1);
            $stmt->bindParam(':uprice',$price1);
			$stmt->bindParam(':udescription',$description1);

            $stmt->bindParam(':upic',$dogimg11);
            $stmt->bindParam(':upic2',$dogimg22);
            $stmt->bindParam(':upic3',$dogimg33);
            $stmt->bindParam(':ufeatured',$featured1);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
                window.location.href='index.php';

				</script>
                <?php
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
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

<!-- custom stylesheet -->
<link rel="stylesheet" href="style.css">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="jquery-1.11.3-jquery.min.js"></script>
</head>
<body>



<div class="container">


	<div class="page-header">
    	<h1 class="h2">update profile. <a class="btn btn-default" href="index.php"> All puppies </a></h1>
    </div>

<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
   
    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label"> Dog name </label></td>
        <td><input class="form-control" type="text" name="dog_name2" value="<?php echo $dog_name; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Dog breed.</label></td>
        <td><input class="form-control" type="text" name="breed2" value="<?php echo $breed; ?>" required /></td>
    </tr>
        
        <tr>
            <td><label class="control-label">Dog color.</label></td>
            <td><input class="form-control" type="text" name="color2" value="<?php echo $color; ?>" required /></td>
        </tr>

        <tr>
            <td><label class="control-label">Gender.</label></td>
            <td><input class="form-control" type="text" name="gender2" value="<?php echo $gender; ?>" required /></td>
        </tr>

        <tr>
            <td><label class="control-label">Age.</label></td>
            <td><input class="form-control" type="text" name="age_in_weeks2" value="<?php echo $age_in_weeks; ?>" required /></td>
        </tr>

        <tr>
            <td><label class="control-label">Birth Date.</label></td>
            <td><input class="form-control" type="text" name="birth_date2" value="<?php echo $birth_date; ?>" required /></td>
        </tr>
        <tr>
            <td><label class="control-label">Size.</label></td>
            <td><input class="form-control" type="text" name="size2" value="<?php echo $size; ?>" required /></td>
        </tr>

        <tr>
            <td><label class="control-label">Price.</label></td>
            <td><input class="form-control" type="text" name="price2" value="<?php echo $price; ?>" required /></td>
        </tr>

        <tr>
            <td><label class="control-label">Description.</label></td>
            <td><input class="form-control" type="text" name="description2" value="<?php echo $description; ?>" required /></td>
        </tr>

        <tr>
            <td><label class="control-label">Feature or Not( Insert 1 to be featured,otherwise insert 0).</label></td>
            <td><input class="form-control" type="text" name="feature" value="<?php echo $featured1; ?>" required /></td>
        </tr>

    <tr>
    	<td><label class="control-label">Puppy Img1.</label></td>
        <td>
        	<p><img src="dog_images/<?php echo $dogimg1; ?>" height="100" width="100" /></p>
        	<input class="input-group" type="file" name="dog_images2" accept="image/*" />
        </td>


    </tr>

        <tr>
            <td><label class="control-label">Puppy Img2.</label></td>

            <td>
                <p><img src="dog_images/<?php echo $dogimg2; ?>" height="100" width="100" /></p>
                <input class="input-group" type="file" name="dog_images3" accept="image/*" />
            </td>


        </tr>


        <tr>
            <td><label class="control-label">Puppy Img3.</label></td>

            <td>
                <p><img src="dog_images/<?php echo $dogimg3; ?>" height="100" width="100" /></p>
                <input class="input-group" type="file" name="dog_images4" accept="image/*" />
            </td>

        </tr>
        

    
        
        
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Update
        </button>
        
        <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-backward"></span> cancel </a>
        
        </td>
    </tr>
    
    </table>
    
</form>




</div>
</body>
</html>