<?php
	$config = array(
		'DB_HOST'			=> 'localhost',
		'DB_USERNAME'	=> 'root',
		'DB_PASSWORD' => ''
	);
  if ($_POST['summaryofissue']) {
		getissue($config);
	}

  function getissue($config) {
		try {
			$connection = new PDO('mysql:host=localhost:3306', $config['DB_USERNAME'], $config['DB_PASSWORD']);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			if ($connection) {
				$result = "";
			}
			else {
				$error = "Unable to connect to database.";
			}
    }
      catch (PDOException $e) {
  			$error = "PDO ERROR: ".$e->getMessage();
  		}
    }
?>
