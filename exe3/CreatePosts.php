<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$post_user = (isset($_POST['username']) ? $_POST['username'] : null);
$post_text = (isset($_POST['my_post']) ? $_POST['my_post'] : null);

if (isset($_POST['submit']))
{
	if($post_text != null)
	{

		$user_exists = false;

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

				if($row["user_id"] == $post_user)
				{
					$user_exists = true;
					//break;
				}
			}

			if($user_exists == true)
			{
				$sql = "INSERT INTO Posts (post_id,content,author_id) VALUES ('NULL','$post_text','$post_user');";

				if ($mysqli->query($sql) === TRUE) {
					printf("Post was successfully added to the database.\n");
				}

			}
			else
			{
				printf("Username does not exist. Only existing users may write posts.\n");
			}

		}

	}
	else
	{
		printf("The post cannot be blank. Some text must be provided.\n");
	}

}
?>


