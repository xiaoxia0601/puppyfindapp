<!DOCTYPE html>
<html>
<head>
	<?php
	$title = "FAQ & Contact";
	include "head_src.php";
	?>
	<script>
	$(document).ready(function(){
		$('.faq_q').click(function(e){
			$(this).closest('div').find(".faq_a").slideToggle("slow", function(){});
		});
	});
	</script>
</head>

<body>
<?php 
	$activeLink = "faq";
	include "header.php" 
?>

<div name="faq" id="faq" class="container-fluid">
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<h2 class="fancy-font">FAQ</h2>
			
			<div class="faq"> 
				<h3 class="faq_q">Our Mission</h3>
				<p class="faq_a">Our mission is to help dog lovers, being a beginner or a professional dog owner for years, find your perfect furry companion in a nice and easy way, within just a few clicks.</p>
			</div>

			<div class="faq"> 
				<h3 class="faq_q">Our Team</h3>
				<p class="faq_a">Our team consists of four young and enthusiastic puppy lovers and we are dedicated to provide you with the perfect puppy of your choice, and our best service.</p>
			</div>

			<div class="faq"> 
				<h3 class="faq_q">How to pick your dog?</h3>
				<p class="faq_a">Use our “Finder” page, apply the filters and choose your special one!</p>
			</div>

			<div class="faq"> 
				<h3 class="faq_q">How to reserve your dog?</h3>
				<p class="faq_a">Simply click “Reserve” button on the dog information page, and it will lead you to where you could fill in your personal information, reservation date, and enter your shipping address and payment method(s).</p>
			</div>

			<div class="faq"> 
				<h3 class="faq_q">How does the shipping work?</h3>
				<p class="faq_a">We ship your puppy from other states if your requirement is not met. The shipping cost can be varied and depends on dog’s weight, travel distance, and shipping methods (express or regular).</p>
			</div>

			<div class="faq"> 
				<h3 class="faq_q">Does the total fee include health inspection and vaccine?</h3>
				<p class="faq_a">Yes! Our puppies are thoroughly examined by certified veterinarians and certificates are provided.</p>
			</div>
		</div>
	</div>
</div>

<hr> 
 
<div name="contact" id="contact" class="container-fluid">
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<h2 class="fancy-font">Contact</h2>
			 
			<p>Have questions or comments? Contact us!</p>
			
			<div class="faq"> 
				<h3 class="faq_q">For customers –</h3>
				<p class="faq_a">Phone: 888-PUP-FIND<br>Email: info@puppyfinder.com</p>
			</div>
			 
			<div class="faq"> 
				<h3 class="faq_q">For breeders –</h3>
				<p class="faq_a">Phone: 888-PUP-BRED<br>Email: breeders@puppyfinder.com</p>
			</div>
		</div>
	</div>
</div> 

<?php include "footer.php"; ?>

</body>
</html>