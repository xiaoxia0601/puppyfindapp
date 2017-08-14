<?php 
session_set_cookie_params(0);
session_start();?>


<?php
if(!isset($_SESSION["name"])){
$_SESSION["flash"]="You must log in to see grades!";
header("Location: login.php");
} else {


    require_once 'dbconfig.php';

    if (isset($_GET['delete_id'])) {
        // select image from db to delete
        $stmt_select = $DB_con->prepare('SELECT dogimg1 FROM doginfo WHERE dog_id =:uid');
        $stmt_select->execute(array(':uid' => $_GET['delete_id']));
        $imgRow = $stmt_select->fetch(PDO::FETCH_ASSOC);
        unlink("dog_images/" . $imgRow['dogimg1']);

        // it will delete an actual record from db
        $stmt_delete = $DB_con->prepare('DELETE FROM doginfo WHERE dog_id =:uid');
        $stmt_delete->bindParam(':uid', $_GET['delete_id']);
        $stmt_delete->execute();

        header("Location: index.php");
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
<title>PuppyFinder Management System</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
</head>

<body>

<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 

 
    </div>
</div>

<div class="container">

	<div class="page-header">
    	<h1 class="h2">PuppyFinder Management System. / <a class="btn btn-default" href="addnew.php"> <span class="glyphicon glyphicon-plus"></span> &nbsp; add new </a></h1>
    </div>
    
<br/>

<div class="row">
<?php
	
	$stmt = $DB_con->prepare('SELECT dog_id, dog_name, breed, color, gender, age_in_weeks, birth_date, size, price, description ,dogimg1 FROM doginfo ORDER BY dog_id DESC');
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			?>
			<div class="col-xs-3">
				<p class="page-header"><?php echo $dog_name."&nbsp;/&nbsp;".$breed; ?></p>
				<img src="dog_images/<?php echo $row['dogimg1']; ?>" class="img-rounded" width="150px" height="150px" />
				<p class="page-header">
				<span>
				<a class="btn btn-info" href="editform.php?edit_id=<?php echo $row['dog_id']; ?>" title="click for edit" onclick="return confirm('sure to edit ?')"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
				<a class="btn btn-danger" href="?delete_id=<?php echo $row['dog_id']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
				</span>
				</p>
			</div>       
			<?php
		}
	}
	else
	{
		?>
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
            </div>
        </div>
        <?php
	}
	
?>
</div>	




</div>


<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>