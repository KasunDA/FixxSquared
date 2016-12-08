<?php
	include 'php/global.php';
	include 'php/getTickets.php';

	session_start();
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
		<link rel="shortcut icon" href="resources/FixxFavicon.png" />
		<!-- Bootstrap-select.css -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
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
						<li><a href="about.php">About</a></li>
						<li><a href="Login Page/logout.php">Log Out</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>

		<div class="container theme-showcase main-content" role="main">
			<div class="jumbotron">
				<h1>FixxSquared - Fixx User</h1>
				<p>Welcome, <?php echo $_SESSION['username'] ?>. Help campus residents! Or else!</p>
			</div>

			<div class="page-header">
				<h1>Tickets</h1>
<!--
				<div class="btn-group">
					<button type="button" class="btn dropdown-toggle res-hall-filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						All Residence Halls
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php
							/*foreach ($resHalls as $resHall) {
								echo '<li><a class="dropdown-item" href="#" onclick="filterTicketsByHall(&quot;'.$resHall.'&quot;)">'.$resHall.'</a></li>';
							}*/
						?>
					</ul>
				</div>
-->
			</div>
			<div class="container row">
				<div class="row">
					<?php
						foreach (getTickets() as $ticket) {
							echo
								'<div class="col-md-3">'.
									'<div class="ticket">'.
										'<h4><span class="ticket-id">'.$ticket['ticket_id'].'</span>: '.$ticket['summary'].'</h4>'.
										'<h5>'.$ticket['residence_hall'].' '.$ticket['room'].'</h5>'.
										'<strong>Request date:</strong> '.$ticket['request_date'].'<br/>'.
										'<strong>Estimated completion time: </strong>'.$ticket['completion_time_estimated'].'<br/>'.
										'<select class="selectpicker form-control" title="'.$ticketStatus[$ticket['status']].'">';
											foreach($ticketStatus as $status) {
												echo '<option>'.
														$status.
													'</option>';
											}
							echo
										'</select>'.
									'</div>'.
								'</div>';
						}
					?>
				</div>
			</div>

			<!-- Footer -->
        <footer>
					<div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; FixxSquared 2016</p>
                </div>
            </div>
            <!-- /.row -->
					</div>
        </footer>
		</div>
	</body>

	<!-- Bootstrap-select.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>

	<script>
		$(document).ready(function () {
			$('.ticket').each(function () {
				var ticketId = $(this).find('.ticket-id').text();

				$(this).find('.selectpicker')
				.change(function () {
					var newStatus = $(this).find('option:selected').text();

					//console.log('ticket ' + ticketId + ' is now ' + newStatus);

					var postData = { 'ticketId': ticketId, 'newStatus': newStatus };

					$.post('php/changeTicketStatus.php', postData, function (data) {
						console.log(data);
					});
				});
			});
		});
	</script>
</html>
