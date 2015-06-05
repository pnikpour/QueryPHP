
<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);
	require_once('assets/php/lib.php');

	// Accepts username and cleartext password; verifies password with hashed one in database
	function authUser($user, $pass) {
		$db = getDB();
		$query = 'SELECT username, hash, groups FROM workorder.users WHERE username LIKE "' . $user . '"';
		$stmt = $db->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
		$group = $rows['groups'];	
		$hash = $rows['hash'];

		if (password_verify($pass, $hash)) {
			$_SESSION['user'] = $user;
			$_SESSION['password'] = $hash;
			header('Location: ../../menu.php');
		} else {
			echo 'Invalid';
			session_unset();
			exit();
		}
	}

	authUser($_POST['user'], $_POST['password']);
?>
