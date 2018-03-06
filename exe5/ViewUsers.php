<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

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

		echo "<table>";
		echo "<th> ALL USERS </th>";

		/* fetch associative array */
		while($row = $result->fetch_assoc()) {

			echo "<tr>";
			echo "<td>" . $row["user_id"] . "</td>";
			echo "</tr>";
			
		}

		echo "</table>";
	}

?>
