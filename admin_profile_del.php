<?php
	$email = $_GET['email'];

	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "DELETE FROM user WHERE email = '$email'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "delete data unsuccessfully " . mysqli_error($conn);
		exit;
	}
	header("Location: manage_user.php");
?>