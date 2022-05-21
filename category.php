<?php
	session_start();
	require_once "./functions/database_functions.php";
	$conn = db_connect();


	$query = "SELECT * FROM category ORDER BY categoryid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	

	$title = "All categoriess";
	require "./template/header.php";
?>
	<p class="lead">All Categories</p>
	<ul>
	<?php 
		while($row = mysqli_fetch_assoc($result)){
			$count = 0; 
			$query = "SELECT categoryid FROM books";
			$result2 = mysqli_query($conn, $query);
			if(!$result2){
				echo "Can't retrieve data " . mysqli_error($conn);
				exit;
			}
			while ($catInBook = mysqli_fetch_assoc($result2)){
				if($catInBook['categoryid'] == $row['categoryid']){
					$count++;
				}
			}
	?>
		<li>
			<span class="badge"><?php echo $count; ?></span>
		    <a href="bookPerCat.php?catid=<?php echo $row['categoryid']; ?>"><?php echo $row['category_name']; ?></a>
		</li>
	<?php } ?>
		<li>
			<a href="books.php">List full of books</a>
		</li>
	</ul>
<?php
	mysqli_close($conn);
	require "./template/footer.php";
?>