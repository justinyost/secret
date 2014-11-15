<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Secret Santa</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Secret Santa">

		<!-- Le styles -->
		<link href="./css/bootstrap.css" rel="stylesheet">
		<style>
		  body {
		    padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		  }
		</style>
		<link href="./css/bootstrap-responsive.css" rel="stylesheet">

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="./js/html5shiv.js"></script>
		<![endif]-->
  </head>

  <body>

		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="brand" href="#">Secret Santa</a>
				</div>
			</div>
		</div>

    <div class="container">

      <h1>Secret Santa</h1>
      <p>Add each person's name and email who is participating in the Secret Santa drawing. Select the suggested price and hit the send email button. Everyone will receive an email with who they have been randomly select to purchase a gift for.</p>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap-transition.js"></script>
    <script src="./js/bootstrap-alert.js"></script>
    <script src="./js/bootstrap-modal.js"></script>
    <script src="./js/bootstrap-dropdown.js"></script>
    <script src="./js/bootstrap-scrollspy.js"></script>
    <script src="./js/bootstrap-tab.js"></script>
    <script src="./js/bootstrap-tooltip.js"></script>
    <script src="./js/bootstrap-popover.js"></script>
    <script src="./js/bootstrap-button.js"></script>
    <script src="./js/bootstrap-collapse.js"></script>
    <script src="./js/bootstrap-carousel.js"></script>
    <script src="./js/bootstrap-typeahead.js"></script>
		<script type="text/javascript" src="./includes/js/secret_santa.js" charset="utf-8"></script>
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '<?php echo GOOGLE_ANALYTICS_ID; ?>']);
			_gaq.push(['_trackPageview']);
			(function() {
    			var ga = document.createElement('script');
    			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    			ga.setAttribute('async', 'true');
    			document.documentElement.firstChild.appendChild(ga);
  			})();
		</script>
  </body>
</html>
