<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Secret Santa</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Secret Santa">

		<!-- Le styles -->
		<link href="./css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/bootstrap-theme.min.css" rel="stylesheet">
		<link href="./css/custom.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
  </head>

  <body role="document">

		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
			  <div class="navbar-header">
			    <a class="navbar-brand" href="#">Secret Santa</a>
			  </div>
			  <div id="navbar" class="navbar-collapse collapse">
			  </div><!--/.nav-collapse -->
			</div>
		</nav> <!-- Nav -->

		<div class="container theme-showcase" role="main">
			<div class="page-header">
				<h1>Secret Santa</h1>
				<p>Add each person's name and email who is participating in the Secret Santa drawing. Select the suggested price and hit the send email button. Everyone will receive an email with who they have been randomly select to purchase a gift for.</p>
			</div>

			<form class="form-horizontal" role="form" data-number-of-people="1">

				<div id="person1">
					<div class="form-group">
							<label for="name1" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-10">
							<input type="text" class="form-control" id="name1" name="data[Person][1][name]" placeholder="Enter name">
							</div>
					</div>

					<div class="form-group">
							<label for="email1" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="email1" name="data[Person][1][email]" placeholder="Enter email">
							</div>
					</div>

					<div class="form-group">
							<label for="wishlist1" class="col-sm-2 control-label">Wishlist</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="wishlist1" name="data[Person][1][wishlist]" placeholder="Enter wishlist or other details">
							</div>
					</div>
					<hr/>
				</div>


				<div class="form-group">
					<div>
						<button type="button" class="btn btn-info _add_person">
							<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add another person
						</button>
					</div>
				</div>
				<div class="form-group">
					<div>
						<button type="submit" class="btn btn-primary">Randomize and Email Participants</button>
					</div>
				</div>

			</form>
		</div>

		<!-- javascript -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
		<script src="./js/jquery.scripts.js"></script>
		<!---
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
		--->
  </body>
</html>
