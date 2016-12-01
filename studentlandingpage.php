<?php
	include 'php/global.php';
	
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
                        <a href="#">About</a>
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
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>Have a real conversation with Fixx</small>

                </h1>
            </div>
        </div>
        <!-- /.row -->

    	<!-- Trigger/Open New Ticket Modal -->
			<div class="row">
				<div class="col-md-12">
    			<button data-toggle="modal" data-target="#new-ticket-modal" class="btn btn-primary" title="Create a New Ticket">Report a Problem</button>
				</div>
			</div>	

        <!-- Active Tickets -->
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <h3>
                    <a href="#">Your Currently Active Tickets</a>
                </h3>
                <a href="#">
                    <img class="img-responsive" src="http://placehold.it/700x400" alt="">
                </a>
            </div>
        </div>

			<!-- Completed Tickets -->
			<div class="row">
            <div class="col-md-6 portfolio-item">
                <h3>
                    <a href="#">Rate Completed Tickets</a>
                </h3>
                <a href="#">
                    <img class="img-responsive" src="http://placehold.it/700x400" alt="">
                </a>
            </div>
        </div>

        <!-- Trigger/Open Ticket Feedback Modal -->
        <button data-toggle="modal" data-target="#ticket-feedback-modal">Feedback</button>
      </div>

        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; FixxSquared 2016</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

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
