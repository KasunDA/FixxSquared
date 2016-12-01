<?php
	session_start();

	$config = array(
		'DB_HOST'			=> 'localhost',
		'DB_USERNAME'	=> 'root',
		'DB_PASSWORD' => ''
	);

	if (isset($_POST['ticketId']) && isset($_POST['newStatus'])) {
		echo changeTicketStatus($config);
	}

	function changeTicketStatus($config) {
		include 'global.php';
		
		try {
			$connection = new PDO('mysql:host=localhost:3306', $config['DB_USERNAME'], $config['DB_PASSWORD']);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			if ($connection) {
				$result = "";
			}
			else {
				$error = "Unable to connect to database.";
			}
			
			$ticketId = $_POST['ticketId'];
			$newStatus = array_search($_POST['newStatus'], $ticketStatus);
			
			$statementChangeTicketStatus = $connection->prepare(
				"UPDATE fixx_squared.tickets
					SET status=:newStatus
					WHERE ticket_id=:ticketId;"
			);
			$statementChangeTicketStatus->bindParam(':ticketId', $ticketId);
			$statementChangeTicketStatus->bindParam(':newStatus', $newStatus);
			
			if ($statementChangeTicketStatus->execute()) {
				$result .= "Ticket ".$ticketId." status changed to ".$newStatus.".\n";
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
		
		return "ERROR: changeTicketStatus failed";
	}
?>