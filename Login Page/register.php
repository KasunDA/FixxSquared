<?php
  session_start();
  
  // Connect to the database
  try {
    $dbname = 'lecture18';
    $user = 'root';
    $pass = '';
    $dbconn = new PDO('mysql:host=localhost;dbname='.$dbname, $user, $pass);
  }
  catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
  
  if (isset($_POST['register']) && $_POST['register'] == 'Register') {
    
    // @TODO: Check to see if duplicate usernames exist FINISHED
    
	
    if (!isset($_POST['username']) || !isset($_POST['pass']) || !isset($_POST['passconfirm']) || empty($_POST['username']) || empty($_POST['pass']) || empty($_POST['passconfirm'])) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['pass'] !== $_POST['passconfirm']) {
      $msg = "Passwords must match.";
    }
    else {
		if (isset($_POST['username']) ){
			
			$login_stmt = $dbconn->prepare('SELECT username FROM users_secure WHERE username=:username ');
			$login_stmt->execute(array(':username' => $_POST['username']));
	  
	  
			if ($_POST['username'] = $login_stmt->fetch()) {
			$msg = "Username Taken";
			}
			else {
				// Generate random salt
				  $salt = hash('sha256', uniqid(mt_rand(), true));      

				  // Apply salt before hashing
				  $salted = hash('sha256', $salt . $_POST['pass']);
				  
				  // Store the salt with the password, so we can apply it again and check the result
				  $stmt = $dbconn->prepare("INSERT INTO users_secure (username, pass, salt) VALUES (:username, :pass, :salt)");
				  $stmt->execute(array(':username' => $_POST['username'], ':pass' => $salted, ':salt' => $salt));
				  $msg = "Account created.";
			}
			
		}

    }
  } 
?>
<!doctype html>
<html>
<head>
  <title>Lecture 18 Registration</title>
</head>
<body>
  <h1>User Registration</h1>
  <?php if (isset($msg)) echo "<p>$msg</p>" ?>
  <form method="post" action="register.php">
    <label for="username">Username: </label><input type="text" name="username" />
    <label for="pass">Password: </label><input type="password" name="pass" />
    <label for="passconfirm">Confirm: </label><input type="password" name="passconfirm" />
    <input type="submit" name="register" value="Register" />
  </form>
</body>
</html>
