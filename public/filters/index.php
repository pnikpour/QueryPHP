<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	include('../assets/php/lib.php');

	forbid();
?>

<html>
<head>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src='../assets/js/effect.js' type='text/javascript'></script>
	<link rel='stylesheet' href='../assets/css/styles.css' type='text/css' />
</head>
<body>


<?php


	// Logout snippet
	navPOST();
?>


<h1>Form</h1>

<div class='filterForm'>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" name='addUserForm' id='addUserForm' method='post'>

		<?php include '../assets/php/createNav.php'; ?>

		 <table border=1>
			<tr><th>Ticket Number</th></tr>
			<tr><td><input type='text' name='ticketNumber' id='ticketNumber'/></td></tr>

			<tr><th>Status</th></tr>
			<tr><td>
			<select name='status'>
				<?php
					$table = "tickets";
					$col = 'status';
					$query = 'SHOW COLUMNS FROM :table WHERE field = :col';
					$result = getDB()->prepare(query);
					$result->bindParam(':table', $table);
					$result->bindParam(':col', $col);

					$row = $result->fetch(PDO::FETCH_ASSOC);
					foreach(explode("','", substr($row['Type'],6,-2)) as $option) {
						echo ("<option>$option</option>");
					}
				?>
			</select>
			</td></tr>
		</table>
	</form>
</div>
</body>
</html>


