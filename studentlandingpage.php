<?php
	include 'php/global.php';
	include 'php/getTickets.php';

	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FixxSquared - Student Landing</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="resources/main.css" rel="stylesheet" type="text/css"/>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">FixxSquared</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#update-contact-info-modal" id="toggle-contact-info-modal">Update Contact Info</a>
                    </li>
                    <li>
                        <a href="Login Page/logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container main-content">

        <!-- Page Header -->
        <div class="jumbotron">
					<h1>FixxSquared - Student</h1>	
					<p>Welcome, <?php echo $_SESSION['username'] ?>. Have a real conversation with Fixx!</p>
					
					<!-- Trigger/Open New Ticket Modal -->
					<button data-toggle="modal" data-target="#new-ticket-modal" class="btn btn-primary" title="Create a New Ticket">Report a Problem</button>
        </div>
        <!-- /.row -->

        <!-- Active Tickets -->
			<div class="page-header">
				<h2>
					Your Currently Active Tickets
				</h2>
			</div>
			<div class="container">
				<div class="row">
					<?php
						foreach (getTickets() as $ticket) {
							if ($ticket['user_requesting_id'] == $_SESSION['uid'] && $ticket['status'] != 3) {
								echo
									'<div class="col-md-3">'.
										'<div class="ticket">'.
											'<h4>#'.$ticket['ticket_id'].': '.$ticket['summary'].'</h4>'.
											'<h5>'.$ticket['residence_hall'].' '.$ticket['room'].'</h5>'.
											'<strong>Request date:</strong> '.$ticket['request_date'].'<br/>'.
											'<strong>Estimated completion time: </strong>'.$ticket['completion_time_estimated'].'<br/>'.
											'<button disabled class="btn">'.$ticketStatus[$ticket['status']].'</button>'.
										'</div>'.
									'</div>';
							}
						}
					?>
				</div>
			</div>

			<!-- Completed Tickets -->
			<div class="page-header">
				<h2>
					Rate Completed Tickets
				</h2>
			</div>
			<div class="container">
				<div class="row">
					<?php					
						foreach (getTickets() as $ticket) {
							if ($ticket['user_requesting_id'] == $_SESSION['uid'] && $ticket['status'] == 3) {
								echo
									'<div class="col-md-3">'.
										'<div class="ticket">'.
											'<h4>#'.$ticket['ticket_id'].': '.$ticket['summary'].'</h4>'.
											'<h5>'.$ticket['residence_hall'].' '.$ticket['room'].'</h5>'.
											'<strong>Request date:</strong> '.$ticket['request_date'].'<br/>'.
											'<strong>Estimated completion time: </strong>'.$ticket['completion_time_estimated'].
											'<div class="btn-group">'.
												'<button disabled class="btn">'.$ticketStatus[$ticket['status']].'</button>'.
												'<button data-toggle="modal" data-target="#ticket-feedback-modal" class="btn btn-info">Feedback</button>'.
											'</div>'.
										'</div>'.
									'</div>';	
							}
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

        <!-- /.row -->

    </div>
    <!-- /.container -->

		<!-- Update Contact Info Modal -->
		<div class="modal fade" id="update-contact-info-modal" role="dialog" aria-labelledby="updateContactInfoModal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="updateContactInfoModal">Update Contact Info</h4>
					</div>
					<div class="modal-body">
						<div class="container">
							<form id="update-contact-info-form" role="form">
								<div class="row">
									<div class="form-group col-md-6">
										<label for="updateEmail" class="form-control-label">E-mail Address</label>
										<input name="updateEmail" type="text" class="form-control"/>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="updateResHall" class="form-control-label">Residence Hall</label>
										<input name="updateResHall" type="text" class="form-control"/>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="updateRoom" class="form-control-label">Room</label>
										<input name="updateRoom" type="text" class="form-control"/>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="modal-footer">
						<button onclick="submitContactInfo()" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</div>

		<!-- New Ticket Modal -->
		<div id="new-ticket-modal" class="modal fade">
			<div class="modal-dialog" role="document">
				<!-- Modal content -->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h2>Create a New Ticket</h2>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label for="summaryofissue" class="form-control-label">Summary of Issue:</label>
								<textarea class="form-control" id="new-ticket-summary"></textarea>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button onclick="submitNewTicket()" type="button" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Ticket Feedback Modal -->
		<div id="ticket-feedback-modal" class="modal fade">
			<div class="modal-dialog">
				<!-- Modal content -->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h2>Feedback Form</h2>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label for="message-text" class="form-control-label">What did you like/dislike about your overall FixxSquared experience?</label>
								<textarea class="form-control" id="message-text"></textarea>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
						<button type="button" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</body>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Bootstrap.min.js -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="resources/main.js" type="text/javascript"></script>
</body>

</html>
