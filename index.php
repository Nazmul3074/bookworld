<?php
  session_start();
if(
    (isset($_SESSION['useremail'])) || (isset($_SESSION['Adminemail']))
)
{
  $count = 0;

  
  $title = "Book";
  require_once "./template/header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $search = $_GET['q'] ?? '';
  $row=selectBook($conn,$search);
?>
      <div class="row">
        <?php foreach($row as $book) { ?>
      	<div class="col-md-3">
      		<a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
           <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
          </a>
      	</div>
        <?php } ?>
      </div>
<?php
}

else
{
header("location:login.php");
}

  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>