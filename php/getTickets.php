<?php
	include 'global.php';

	function getTickets($filter = NULL) {
		$config = array(
			'DB_HOST'			=> 'localhost',
			'DB_USERNAME'	=> 'root',
			'DB_PASSWORD' => ''
		);
		
		$connection = new PDO('mysql:host=localhost:3306', $config['DB_USERNAME'], $config['DB_PASSWORD']);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if (!$connection) {
			$error = "Unable to connect to database.";
		}
		
		try {
			$queryString = "SELECT ticket_id, status, summary, request_date, completion_time_estimated, user_requesting_id, residence_hall, room
				FROM fixx_squared.tickets
				INNER JOIN fixx_squared.users
				WHERE tickets.user_requesting_id = users.uid";
			
			if ($filter == NULL) {
				// do nothing
			}
			else {
				/*if (in_array($filter, $resHalls)) {
					$queryString .= " WHERE ";
				}*/
			}
			
			$queryString .= ";";
			
			$resultGetTickets = $connection->query($queryString);		
			$result = $resultGetTickets->fetchAll();
		}
		catch (PDOException $e) {
			$error = "PDO ERROR: ".$e->getMessage();
		}
		
		if (isset($error)) {
			return array($error);
		}
		else if (isset($result)) {
			return $result;
		}
		
		return array("ERROR: getTickets failed");
	}
?>