<?php
	session_start();

	function imgToTxtLines($imgPath) {
		$txtPath = "info/".explode(".", explode("/", $imgPath)[1])[0].".txt";
		$lines = false;
		if(file_exists($txtPath)) {
			$lines = file($txtPath, FILE_IGNORE_NEW_LINES);
		}
		return $lines;
	}

	$carousels = glob("images/carousel*.jpg");
	$carouselCount = count($carousels);
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		$lightbox = true;
		include "head_src.php";
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
	include "header.php";
?>

<div id="maincontent" class="container-fluid">
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="col-xs-offset-1 col-xs-10 col-md-offset-3 col-md-6">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<?php for ($i = 1; $i < $carouselCount; $i++) { ?>
						<li data-target="#myCarousel" data-slide-to="<?= $i ?>" <php></li>
						<?php } ?>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<?php for($i = 0; $i < $carouselCount; $i++) { 
							$carousel = $carousels[$i];
							$info = imgToTxtLines($carousel);
							$carouselTitle = $carouselDesc = $carouselLink = $carouselButton = "The Puppy";
							if($info) {
								list($carouselTitle, $carouselDesc, $carouselLink, $carouselButton) = $info;
							}
						?>
						<div class="item <?php if($i == 0) print 'active'; ?>">
							<img src="<?= $carousel ?>" alt="<?= $carouselTitle ?>" class="img-rounded">
							<div class="carousel-caption">
								<h3><?= $carouselTitle ?></h3>
								<p><?= $carouselDesc ?></p>
								<a href="<?= $carouselLink ?>"><button type="button" class="btn btn-danger"><?= $carouselButton ?></button></a>
							</div>
						</div>

						<?php } ?>
					</div>

					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<div id="cinema" class="container-fluid">
		<div class="sub-title">
			<h2><span class="fancy-font">featured</span><br>VIDEO</h2>
		</div>
		<div class="row">
			<div class="col-xs-offset-1 col-xs-10 col-md-offset-4 col-md-4">
				<div class="videowrapper">
				<iframe class="center-block" src="https://www.youtube.com/embed/AZ2ZPmEfjvU?autoplay=0&showinfo=0&controls=0" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<div id="gallery" class="container-fluid">
		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<div class="sub-title">
				<h2><span class="fancy-font">featured</span><br>PUPPIES</h2>
				</div>
				<?php

				require_once "admin/dbconfig.php";

				$stmt = $DB_con->query("SELECT * FROM doginfo WHERE featured=1");
				$rowCount = $stmt->rowCount();

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
						    <img src="<?= $image ?> " class="img-fluid img-rounded"    style="width:100%;height="650px";box-shadow: 1px 2px 4px grey">
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
</div>

<?php include "footer.php"; ?>

</body>
</html>