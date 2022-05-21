<?php
	session_start();
if(
    isset($_SESSION['Adminemail'])
    && !empty($_SESSION['Adminemail'])
){
	//require_once "./functions/admin.php";
	$title = "List book";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getAll($conn);
?>
	<p class="lead"><a href="admin_add.php">Add new book</a></p>
	<a href="admin_signout.php" class="btn btn-primary">Sign out!</a>
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>ISBN</th>
			<th>Title</th>
			<th>Author</th>
			<th>Image</th>
            <th>Pdf</th>
			<th>Description</th>
			<th>Publisher</th>
            <th>Category</th>
            <th>Type</th>
            <th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['book_isbn']; ?></td>
			<td><?php echo $row['book_title']; ?></td>
			<td><?php echo $row['book_author']; ?></td>
			<td><?php echo $row['book_image']; ?></td>
            <td><?php echo $row['book_pdf']; ?></td>
			<td><?php echo $row['book_descr']; ?></td>
			<td><?php echo getPubName($conn, $row['publisherid']); ?></td>
            <td><?php echo getCatName($conn, $row['categoryid']); ?></td>
            <td><?php echo $row['book_type']; ?></td>
			<td><a href="admin_edit.php?bookisbn=<?php echo $row['book_isbn']; ?>">Edit</a></td>
			<td><a href="admin_delete.php?bookisbn=<?php echo $row['book_isbn']; ?>">Delete</a></td>
		</tr>
		<?php } ?>
	</table>

<?php
}
else
{
   ?>
        <script>location.assign('index.php')</script>
    <?php
}
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>