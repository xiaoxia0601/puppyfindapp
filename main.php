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


	if (isset($_POST['btn'])){
		$breed1 = $_POST['breed'];
		$gender1 = $_POST['gender'];
		$age1 = $_POST['age'];
		$color1 = $_POST['color'];
		$search_res = "<h2><span class='fancy-font'>Search Result</span><br>PUPPIES</h2>";
	} else {
		$search_res = "<h2><span class='fancy-font'>All</span><br>PUPPIES</h2>";
	}

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
	<?php
		$lightbox = true;
	?>
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




<div id="maincontent" class="container-fluid">
		
	<div class="row">
		<?php
			include "filter.php"
		?>
		<div class="col-md-8">
			<div class="sub-title">
			<!-- <h2><span class="fancy-font">All</span><br>PUPPIES</h2> --> 
			<? print $search_res; ?>
			</div>
			<?php

			include "admin/dbconfig.php";
			if (empty($_POST['btn'])){
				$stmt = $DB_con->query("SELECT * FROM doginfo WHERE 1");
			} else {
				$query = "SELECT * FROM doginfo WHERE (color $color1) AND (breed $breed1) AND (gender $gender1) AND (age_in_weeks $age1) ;";
				print "<script>console.log(\"$query\")</script>";
				$stmt = $DB_con->query($query);
			}
			
			$rowCount = $stmt->rowCount();

			$i = 0;
			foreach ($stmt as $row) {
				if($i % 3 == 0) {
					print "<div class='puppy-row row'>";
				}						
				$image = "admin/dog_images/".$row["dogimg1"];
				$dog_id1 = $row["dog_id"];
				$puppyName = $row["dog_name"];
				$puppyGender = $row["gender"];
				$puppyAge = $row["age_in_weeks"];
				$puppyBreed = $row["breed"];
				$puppyColor = $row["color"];
				$puppySize = $row["size"];
				$puppyDesc = $row["description"];
				$puppyDB = DateTime::createFromFormat('Y-m-d', $row["birth_date"]);;
				$puppyWeeks = floor($puppyDB->diff(new DateTime('now'))->days / 7);
			?>
			<div class="col-sm-6 col-md-4">
				<a href="<?= $image ?>" data-toggle="lightbox" data-gallery="puppy-gallery" data-title="<?= $puppyName.' - the '.$puppyBreed ?>">
					<img src="<?= $image ?>" class="img-fluid img-rounded" style="width:100%; box-shadow: 1px 2px 4px grey"">
				</a>
				<a class="puppy-name" href="#"><?= $puppyName ?></a>
				<div class="puppy-info">
					<ul>
						<li><?= $puppyWeeks ?> weeks</li>
						<li><?= $puppyGender ?></li>
						<li><?= $puppyBreed ?></li>
						<li><?= $puppyColor ?></li>
						<li><?= $puppySize ?></li>
						<li><?= $puppyDesc ?></li>
						<li><a href="doginfo.php?id=<?= $dog_id1 ?>" target="_blank">Take <?php if($puppyGender == "Female") print "her"; else print "him"; ?> home!</a>
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

<?php include "footer.php"; ?>

</body>
</html>
		