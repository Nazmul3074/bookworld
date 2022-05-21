<?php
	session_start();
	$title = "Add new book";
	require "./template/header.php";
	require "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_POST['add'])){
		$isbn = trim($_POST['isbn']);
		$isbn = mysqli_real_escape_string($conn, $isbn);
		
		$title = trim($_POST['title']);
		$title = mysqli_real_escape_string($conn, $title);

		$author = trim($_POST['author']);
		$author = mysqli_real_escape_string($conn, $author);
		
		$descr = trim($_POST['descr']);
		$descr = mysqli_real_escape_string($conn, $descr);
		
		$publisher = trim($_POST['publisher']);
		$publisher = mysqli_real_escape_string($conn, $publisher);
        
        $type= trim($_POST['type']);
        $type=mysqli_real_escape_string($conn, $type);
        
        $category = trim($_POST['category']);
        $category = mysqli_real_escape_string($conn, $category);

		// add image
		if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
			$image = $_FILES['image']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
			$uploadDirectory .= $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
		}
        if(isset($_FILES['pdf']) && $_FILES['pdf']['name'] != "")
        {
            $pdf=$_FILES['pdf']['name'];
            $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
            $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/pdf/";
            $uploadDirectory .= $pdf;
            move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadDirectory);
        }

		// find publisher and return pubid
		// if publisher is not in db, create new
		$findPub = "SELECT * FROM publisher WHERE publisher_name = '$publisher'";
		$findResult = mysqli_query($conn, $findPub);
		if(!$findResult){
			// insert into publisher table and return id
			$insertPub = "INSERT INTO publisher(publisher_name) VALUES ('$publisher')";
			$insertResult = mysqli_query($conn, $insertPub);
			if(!$insertResult){
				echo "Can't add new publisher " . mysqli_error($conn);
				exit;
			}
			$publisherid = mysql_insert_id($conn);
		} else {
			$row = mysqli_fetch_assoc($findResult);
			$publisherid = $row['publisherid'];
		}
        
        $findCat = "SELECT * FROM category WHERE category_name = '$category'";
        $cat_result = mysqli_query($conn, $findCat);
        if(!$cat_result){
            $insertCat = "INSERT INTO category(category_name) VALUES ('$category')";
            $insert_CatResult = mysqli_query($conn,$insertCat);
            if(!$insert_CatResult){
				echo "Can't add new Category " . mysqli_error($conn);
				exit;
			}
            $categoryid=mysql_insert_id($conn);
        } else {
			$row1 = mysqli_fetch_assoc($cat_result);
			$categoryid = $row1['categoryid'];
		}


		$query = "INSERT INTO books VALUES ('".$isbn."', '" . $title . "', '" . $author . "', '" . $image . "','" . $pdf . "', '" . $descr . "', '" . $publisherid . "','" . $categoryid . "','" . $type ."')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't add new data " . mysqli_error($conn);
			exit;
		} else {
			header("Location: admin_book.php");
		}
	}
?>
	<form method="post" action="admin_add.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>ISBN</th>
				<td><input type="text" name="isbn"></td>
			</tr>
			<tr>
				<th>Title</th>
				<td><input type="text" name="title" required></td>
			</tr>
			<tr>
				<th>Author</th>
				<td><input type="text" name="author" required></td>
			</tr>
			<tr>
				<th>Image</th>
				<td><input type="file" name="image"></td>
			</tr>
            <tr>
                 <th>Pdf</th>
                <td><input type="file" name="pdf"></td>
            </tr>
			<tr>
				<th>Description</th>
				<td><textarea name="descr" cols="40" rows="5"></textarea></td>
			</tr>
			<tr>
				<th>Publisher</th>
				<td><input type="text" name="publisher" required></td>
			</tr>
            <tr>
				<th>Category</th>
				<td><input type="text" name="category" required></td>
			</tr>
            <tr>
				<th>Type</th>
				<td><input type="text" name="type" required></td>
			</tr>
		</table>
		<input type="submit" name="add" value="Add new book" class="btn btn-primary">
		<input type="reset" value="cancel" class="btn btn-default">
	</form>
	<br/>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>