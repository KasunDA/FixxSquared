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
		// TODO
		return "New ticket alert!";
	}
?>