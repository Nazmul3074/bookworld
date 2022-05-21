<?php	
	// if save change happen
	if(!isset($_POST['save_change'])){
		echo "Something wrong!";
		exit;
	}

	$isbn = trim($_POST['isbn']);
	$title = trim($_POST['title']);
	$author = trim($_POST['author']);
	$descr = trim($_POST['descr']);
	$publisher = trim($_POST['publisher']);
    $category = trim($_POST['category']);
    $type = trim($_POST['type']);

	if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
		$image = $_FILES['image']['name'];
		$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
		$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
		$uploadDirectory .= $image;
		move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
	}

    if(isset($_FILES['pdf']) && $_FILES['pdf']['name'] != ""){
        
            $pdf=$_FILES['pdf']['name'];
            $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
            $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/pdf/";
            $uploadDirectory .= $pdf;
            move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadDirectory);
        }

	require_once("./functions/database_functions.php");
	$conn = db_connect();

	// if publisher is not in db, create new
	$findPub = "SELECT * FROM publisher WHERE publisher_name = '$publisher'";
	$findResult = mysqli_query($conn, $findPub);
    $row = mysqli_fetch_assoc($findResult);
    $uppub=$row['publisherid'];
	if(!$findResult){
		// insert into publisher table and return id
		$insertPub = "INSERT INTO publisher(publisher_name) VALUES ('$publisher')";
		$insertResult = mysqli_query($conn, $insertPub);
        $row = mysqli_fetch_assoc($insertResult);
        $uppub=$row['publisherid'];
		if(!$insertResult){
			echo "Can't add new publisher " . mysqli_error($conn);
			exit;
		}
	}
  
    $findCat = "SELECT * FROM category WHERE category_name = '$category'";
    $cat_result = mysqli_query($conn, $findCat);
    $row = mysqli_fetch_assoc($cat_result);
    $upcat=$row['categoryid'];
        if(!$cat_result){
            $insertCat = "INSERT INTO category(category_name) VALUES ('$category')";
            $insert_CatResult = mysqli_query($conn,$insertCat);
            $row = mysqli_fetch_assoc($insert_CatResult);
            $upcat=$row['categoryid'];
         } 
		


	$query = "UPDATE books SET  
	book_title = '$title', 
	book_author = '$author', 
	book_descr = '$descr', 
    book_type=  '$type',
    publisherid = '$uppub',
    categoryid= '$upcat'";
	if(isset($image)){
		$query .= ", book_image='$image'";
	} 
  
     if(isset($pdf))
     {
         $query .= ", book_pdf='$pdf' WHERE book_isbn = '$isbn'";
     }
    else{
        $query .="WHERE book_isbn= '$isbn'";
    }
	$result = mysqli_query($conn, $query);
 
	if(!$result){
		echo "Can't update data " . mysqli_error($conn);
		exit;
	} else {
		header("Location: admin_edit.php?bookisbn=$isbn");
	}
?>