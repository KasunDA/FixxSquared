<?php
	session_start();

	$config = array(
		'DB_HOST'			=> 'localhost',
		'DB_USERNAME'	=> 'root',
		'DB_PASSWORD' => ''
	);

	if (isset($_POST['feedback-ticket-id']) && (isset($_POST['feedback-rating']) || isset($_POST['feedback-comments']))) {
		echo submitTicketFeedback($config);
	}

	function submitTicketFeedback($config) {
		try {
			$connection = new PDO('mysql:host=localhost:3306', $config['DB_USERNAME'], $config['DB_PASSWORD']);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			if ($connection) {
				$result = "";
			}
			else {
				$error = "Unable to connect to database.";
			}
			
			if (isset($_POST['feedback-rating']) && $_POST['feedback-rating'] != '') {
				$statementFeedbackRating = $connection->prepare(
					"UPDATE fixx_squared.tickets
						SET feedback_rating=:feedbackRating
						WHERE ticket_id=:ticketId;"
				);
				
				$statementFeedbackRating->bindParam(':feedbackRating', $_POST['feedback-rating']);
				$statementFeedbackRating->bindParam(':ticketId', $_POST['feedback-ticket-id']);
				
				if ($statementFeedbackRating->execute()) {
					$result .= "Ticket feedback rating submitted successfully.\n";
				};
			}
			
			if (isset($_POST['feedback-comments']) && $_POST['feedback-comments'] != '') {
				$statementFeedbackComment = $connection->prepare(
					"UPDATE fixx_squared.tickets
						SET feedback_comment=:feedbackComment
						WHERE ticket_id=:ticketId;"
				);
				
				$statementFeedbackComment->bindParam(':feedbackComment', $_POST['feedback-comments']);
				$statementFeedbackComment->bindParam(':ticketId', $_POST['feedback-ticket-id']);
				
				if ($statementFeedbackComment->execute()) {
					$result .= "Feedback comments submitted successfully.\n";
				};
			}
		}
		catch (PDOException $e) {
			$error = "PDO ERROR: ".$e->getMessage();
		}
		
		if (isset($error)) {
			return $error;
		}
		else if (isset($result)) {
			return $result;
		}
		
		return "ERROR: submitTicketFeedback failed";
	}
?>