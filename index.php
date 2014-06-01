<?php


if (isset($_GET['p'])) {
	$placeid = $_GET['p'];
}
else {
	header("Location: 404.html");
}

// $placeid = '16860904684026707939';
// $placeid = '5609871837570610138';


?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

		<link rel="stylesheet" href="static/css/all.css">
		<script src="static/js/vendor/modernizr-2.6.2.min.js"></script>
	</head>
	<body>
		<!--[if lt IE 7]>
			<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<!-- Add your site or application content here -->
		<div class="page page-active page-rate">
			<h2>
				How was your experience working with us at Acme Studios?
			</h2>

			<ul class="rating">
				<li class="rate rate-negative">
					<a href="#">
						<span class="title">Could be better, honestly</span>
						<i class="fa fa-frown-o"></i>
					</a>
				</li>
				<li class="rate rate-neutral">
					<a href="#">
						<span class="title">It was OK, nothing special</span>
						<i class="fa fa-meh-o"></i>
					</a>
				</li>
				<li class="rate rate-positive">
					<a href="#">
						<span class="title">It was good, I'm happy</span>
						<i class="fa fa-smile-o"></i>
					</a>
				</li>
			</ul>
		</div>
		
		<div class="page page-review">
			<h2>
				Do you think we're a good business?
			</h2>
			<p>
				<em>A few years ago, having great service was enough for a business to survive...</em><br><br>

				These days people go to on Google to learn about companies. Because of this, Google is very immportant to our business and we hope you will spread the word by leaving us a nice review (it takes 15 seconds): 
			</p>
			<p>
				<a href="https://plus.google.com/_/widget/render/localreview?placeid=<?php echo $placeid; ?>"  class="leave-review btn btn-default btn-info btn-lg">
					<span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;&nbsp;
					Leave a Quick Review
				</a>
			</p>
		</div>

		<div class="page page-feedback">
			<p>
				Feedback please!
			</p>
			<form action="" id="form-feedback">

				<textarea name="feedback" id="feedback" cols="30" rows="10">Leave us a short message</textarea>

				<a href="#" class="btn btn-default btn-success btn-lg">
					<span class="glyphicon glyphicon-envelope"></span> 
					Give us Feedback
				</a>
				
			</form>

		</div>

		<div class="page page-thank-you">
			<p>
				Thank You!
			</p>
		</div>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="static/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
		<script src="static/js/vendor/greensock-v12/TweenMax.min.js"></script>
		<script src="static/js/plugins.js"></script>
		<script src="static/js/main.js"></script>

		<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
		<script>
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='//www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','UA-XXXXX-X');ga('send','pageview');
		</script>
	</body>
</html>
