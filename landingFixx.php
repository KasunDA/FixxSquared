<?php
	include 'php/global.php';
?>
<!doctype html>
<html>
	<head>
		<title>FixxSquared</title>
		<!-- Bootstrap.min.css -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<!-- Bootstrap.min.js -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="resources/main.js"></script>
		<link rel="stylesheet" href="resources/main.css">
	</head>
	<body>
		<!-- Fixed navbar -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand active" href="#">FixxSquared</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="#about">About</a></li>
						<li><a href="#logout">Log Out</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>

		<div class="container theme-showcase" role="main">
			<div class="jumbotron">
				<h1>FixxSquared</h1>
				<p>Help campus residents! Or else!</p>
			</div>

			<div class="page-header">
				<h1>Open Tickets</h1>
				<div class="btn-group">
					<button type="button" class="btn dropdown-toggle res-hall-filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						All Residence Halls
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php
							foreach ($resHalls as $resHall) {
								echo '<li><a class="dropdown-item" href="#" onclick="filterTicketsByHall(&quot;'.$resHall.'&quot;)">'.$resHall.'</a></li>';
							}
						?>
					</ul>
				</div>
			</div>

			<div class="page-header">
				<h1>Acknowledged Tickets</h1>
			</div>
		</div>
	</body>
</html>
