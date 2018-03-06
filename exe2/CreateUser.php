<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$new_user = (isset($_POST['username']) ? $_POST['username'] : null);

if (isset($_POST['submit']))
{
	$user_exists = false;

	if($new_user != null)
	{
		$mysqli = new mysqli("mysql.eecs.ku.edu", "g111s401", "gah9moMa", "g111s401");

		/* check connection */
		if ($mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $mysqli->connect_error);
		    exit();
		}

		//Build MySQL string
		$query = "SELECT user_id FROM Users;";

		//Send query string to MySQL database
		if ($result = $mysqli->query($query)) {

			/* fetch associative array */
			while($row = $result->fetch_assoc()) {

				//echo "<p> name: " . $row["user_id"] . ". </p>";
		
				if($row["user_id"] == $new_user)
				{
					$user_exists = true;
					//break;
				}
			}

			if($user_exists == false)
			{

				$sql = "INSERT INTO Users (user_id) VALUES ('$new_user');";

				if ($mysqli->query($sql) === TRUE) {
					printf("New user name added successfully.");
				}

			}
			else
			{
				printf("The user name already exists.\n");
			}

			/* free result set */
			$result->free();
		}

		/* close connection */
		$mysqli->close();
	
	}
	else
	{
		printf ("The user name cannot be blank.\n");
	}
}

?>


