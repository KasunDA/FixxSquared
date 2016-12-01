<?php
  session_start();
  
  // Connect to the database
  try {
    $dbname = 'fixx_squared';
    $user = 'root';
    $pass = '';
    $dbconn = new PDO('mysql:host=localhost;dbname='.$dbname, $user, $pass);
  }
  catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
  
  if (isset($_POST['register'])) {
    
    // @TODO: Check to see if duplicate usernames exist FINISHED
    
	
    if (!isset($_POST['username']) || !isset($_POST['pass']) || !isset($_POST['passconfirm']) || empty($_POST['username']) || empty($_POST['pass']) || empty($_POST['passconfirm'])) {
      $msg = "Please fill in all form fields.";
    }
    else if ($_POST['pass'] !== $_POST['passconfirm']) {
      $msg = "Passwords must match.";
    }
    else {
		if (isset($_POST['username']) ){
			
			$login_stmt = $dbconn->prepare('SELECT username FROM users WHERE username=:username ');
			$login_stmt->execute(array(':username' => $_POST['username']));
	  
	  
			if ($_POST['username'] == $login_stmt->fetch()) {
			$msg = "Username Taken";
			}
			else {
				// Generate random salt
				  $salt = hash('sha256', uniqid(mt_rand(), true));      

				  // Apply salt before hashing
				  $salted = hash('sha256', $salt . $_POST['pass']);
				  
				  // Store the salt with the password, so we can apply it again and check the result
				  $stmt = $dbconn->prepare("INSERT INTO users (user_type, username, pass, salt) VALUES (:user_type, :username, :pass, :salt)");
			$stmt->execute(array(':user_type' => $_POST['register'],  ':username' => $_POST['username'], ':pass' => $salted, ':salt' => $salt));
				  $msg = "Account created.";
			}
			
		}

    }
  } 
  
  // Check login
if (isset($_POST['login']) && $_POST['login'] == 'Login') {
  $salt_stmt = $dbconn->prepare('SELECT salt FROM users WHERE username=:username');
  $salt_stmt->execute(array(':username' => $_POST['username']));
  $res = $salt_stmt->fetch();
  $salt = ($res) ? $res['salt'] : '';
  $salted = hash('sha256', $salt . $_POST['pass']);


  
  $login_stmt = $dbconn->prepare('SELECT username, uid, user_type FROM users WHERE username=:username AND pass=:pass');
  $login_stmt->execute(array(':username' => $_POST['username'], ':pass' => $salted));
  
  
  if ($user = $login_stmt->fetch()) {
    $_SESSION['username'] = $user['username'];
    $_SESSION['uid'] = $user['uid'];
	$_SESSION['user_type'] =$user['user_type'];
	if( $user['user_type'] == 0 ){
		echo '<script type="text/javascript">
			   window.location = "../studentlandingpage.php"
		  </script>';
	}
	else if ($user['user_type'] == 1 ){
		echo '<script type="text/javascript">
			   window.location = "../landingFixx.php"
		  </script>';
	}
	else {
		echo '<script type="text/javascript">
			   window.location = "../adminlandingpage.php"
		  </script>';
   }
  }
  else {
    $err = 'Incorrect username or password.';
  }
}



?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>FixxSquared - Login Form</title>
      <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="login-page">
  <div class="form">
		<h1><center>FixxSquared</center></h1>
			<?php if (isset($err)) echo "<p>$err</p>" ?>
			<?php if (isset($msg)) echo "<p>$msg</p>" ?>
    <form class="register-form" method="post" action="index.php">
      <input type="text" placeholder="Email Address" name="username" />
      <input type="password" placeholder="Password" name="pass" />
      <input type="password" placeholder="Confirm Password" name="passconfirm" />
      <button type="submit" name="register" value="1" >Create a Fixx Account</button>
	  <br></br>
	  <button type="submit" name="register" value="0" >Create a Student Account</button>
	  <br></br>
	  <button type="submit" name="register" value="2" >Create an Admin Account</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" method="post" action="index.php">
      <input type="text" placeholder="Email" name="username"/>
      <input type="password" placeholder="password" name="pass"/>
      <button name="login" type="submit" value="Login" >login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="js/index.js"></script>

</body>
</html>
