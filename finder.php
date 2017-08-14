<?php
	session_start();

	require_once "admin/dbconfig.php";
	if ($_SERVER["REQUEST_METHOD"] == "GET"){
		$query = "SELECT * FROM doginfo WHERE 1";
	} else {
		extract($_POST);
		$query = "SELECT * FROM doginfo WHERE (color $color) AND (breed $breed) AND (gender $gender) AND (age_in_weeks $age) ;";
		
	}
	print "<script>console.log(\"$query\")</script>";

	try {
		$stmt = $DB_con->query($query);
		$puppyCount = $stmt->rowCount();
	} catch (PDOException $e) {
		$errMsg = $e->getMessage();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		$lightbox = true;
		include "head_src.php";
	?>
	<style>
	.filter-box {
		margin: 10px auto 80px auto;
	}



	</style>
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
	$activeLink = "finder"; 
	include "header.php";
?>

<div id="maincontent" class="container-fluid">
	<div class="row" style="margin: 50px auto;">
		<div class="col-md-8 col-md-offset-3 text-center">
		<?php
		if(isset($errMsg)) { 
		?>
			<div class="alert alert-danger text-center"><?= $errMsg ?></div>;
		<?php 
		} 
		if(isset($puppyCount)) {
		?>
			<h3 class="fancy-font">we found <?= $puppyCount ?> puppies for you!</h3>	
		<?php		
		}
		?>
		</div>
	</div>
	<div class="row">
		<?php include "filter.php" ?>

		<div id="gallery" class="col-md-8">
			<?php
			$i = 0;
			foreach ($stmt as $row) {
				if($i % 3 == 0) {
					print "<div class='puppy-row row'>";
				}
				extract($row);
				$image = "admin/dog_images/".$row["dogimg1"];
				$puppyDB = DateTime::createFromFormat('Y-m-d', $birth_date);
				$puppyWeeks = floor($puppyDB->diff(new DateTime('now'))->days / 7);
			?>
				<div class="col-sm-6 col-md-4">
					<a href="<?= $image ?>" data-toggle="lightbox" data-gallery="puppy-gallery" data-title="<?= $dog_name.' - the '.$breed ?>">
					    <img src="<?= $image ?>" class="img-fluid img-rounded" style="width:100%; box-shadow: 1px 2px 4px grey">
					</a>
					<a class="puppy-name" href="#"><?= $dog_name ?></a>
					<div class="puppy-info">
						<ul>
							<li><?= $puppyWeeks ?> weeks</li>
							<li><?= $gender ?></li>
							<li><?= $breed ?></li>
							<li><?= $color ?></li>
							<li><?= $size ?></li>
							<li><?= $description ?></li>
							<li><a href="doginfo.php?id=<?= $dog_id ?>" target="_blank">Take <?php if($gender == "Female") print "her"; else print "him"; ?> home!</a></li>
						</ul>							
					</div>
				</div>

			<?php
				if($i % 3 == 2) {
					print "</div>";
				}		
				$i = $i + 1;				
			}
			if($i % 3 == 0) {
				print "</div>";
			}
			?>
			</div>
		</div>
	</div>
</div>

<?php include "footer.php"; ?>

</body>
</html>