<?php
	session_start();

	$config = array(
		'DB_HOST'			=> 'localhost',
		'DB_USERNAME'	=> 'root',
		'DB_PASSWORD' => ''
	);

	if (isset($_POST['summary'])) {
		//updateContactInfo($config);
		echo createNewTicket($config);
	}

	function createNewTicket($config) {
		try {
			$connection = new PDO('mysql:host=localhost:3306', $config['DB_USERNAME'], $config['DB_PASSWORD']);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			if ($connection) {
				$result = "";
			}
			else {
				$error = "Unable to connect to database.";
			}
			
			$statementCreateNewTicket = $connection->prepare(
				"INSERT INTO fixx_squared.tickets (user_requesting_id, summary) VALUES (:userId, :ticketSummary);"
			);
			$statementCreateNewTicket->bindParam(':userId', $_SESSION['uid']);
			$statementCreateNewTicket->bindParam(':ticketSummary', $_POST['summary']);
			
			if ($statementCreateNewTicket->execute()) {
				$result .= "Ticket created successfully.\n";
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
		
		return "ERROR: createNewTicket failed";
	}
?>