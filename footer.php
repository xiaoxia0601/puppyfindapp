<div class="footer">
	<ul>
        <li><a href="admin/login.php"><i class="fa fa-user fa-lg" aria-hidden="true"></a></i></li>
        <li class="divider"> | </li>
		<li><i class="fa fa-envelope fa-lg" aria-hidden="true"></i> <a href="mailto:info@puppyfinder.com">info@puppyfinder.com</a></li>
		<li class="divider"> | </li>
		<li><i class="fa fa-phone fa-lg" aria-hidden="true"></i> <a href="tel:888-PUP-FIND">888-PUP-FIND</a></li>
		<li class="divider"> | </li>
		<li><a href="https://www.facebook.com"><i class="fa fa-facebook-official fa-lg" aria-hidden="true"></a></i></li>
		<li><a href="https://plus.google.com"><i class="fa fa-google-plus-square fa-lg" aria-hidden="true"></a></i></li>
		<li><a href="https://www.twitter.com"><i class="fa fa-twitter-square fa-lg" aria-hidden="true"></i></a></li>
		<li><a href="https://www.weibo.com"><i class="fa fa-weibo fa-lg" aria-hidden="true"></i></a></li>
		<li><a href="https://www.wechat.com"><i class="fa fa-wechat fa-lg" aria-hidden="true"></i></a></li>




	</ul>
</div>

<?php
	if(isset($lightbox) && $lightbox) {
?>
	<script>
	  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
	      event.preventDefault();
	      $(this).ekkoLightbox();
	  });
	</script>
<?php
	}
?>