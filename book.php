<?php
  session_start();
  $book_isbn = $_GET['bookisbn'];
  require_once "./functions/database_functions.php";
  $conn = db_connect();

  $query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

   $row = mysqli_fetch_assoc($result);
   $cid=$row['categoryid'];
   $query1= "SELECT * FROM category WHERE categoryid= '$cid'";
   $result1 = mysqli_query($conn,$query1);
   $row_c= mysqli_fetch_assoc($result1);
   $cat = $row_c['category_name'];
  if(!$row){
    echo "Empty book";
    exit;
  }

  $title = $row['book_title'];
require "./template/header.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['review'])) {
        $reviewAction = new ReviewActions('POST');
        $reviewAction->store();
    } else if (isset($_POST['type']) && $_POST['type'] == 'bookmark') {
        $bookmarkAction = new BookmarkActions('POST');
        $bookmarkAction->bookmark();
    }
}

?>
      <!-- Example row of columns -->
      <p class="lead" style="margin: 25px 0"><a href="books.php">Books</a> > <?php echo $row['book_title']; ?></p>
      <div class="row">
        <div class="col-md-3 text-center">
          <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['book_image']; ?>">
        </div>
        <div class="col-md-6">
          <h4>Book Description</h4>
          <p><?php echo $row['book_descr']; ?></p>
          <h4>Book Details</h4>
          <table class="table">
          	<?php foreach($row as $key => $value){
              if($key == "book_descr" || $key == "book_image" || $key == "publisherid" || $key == "book_title"){
                continue;
              }
              switch($key){
                case "book_isbn":
                  $key = "ISBN";
                  break;
                case "book_title":
                  $key = "Title";
                  break;
                case "book_author":
                  $key = "Author";
                  break;
                case "book_pdf";
                  $key= "Pdf";  
                   break;
                case "categoryid":
                  $key = "Category";
                  break;
                case "book_type";
                    $key="Type";
                      break;
              }
            ?>
            <tr>
              <td><?php echo $key; ?></td>
              <td><?php
                   if($key == "Category"){
                   
                       echo $cat ; 
                   }
                  else{
                       echo $value; 
                  }
                 ?></td>
            </tr>
            <?php 
              } 
              if(isset($conn)) {mysqli_close($conn); }
            ?>
          </table>

            <div class="row">
                <div class="col-sm-12">
                    <form method="post" action="" class="text-right">
                        <input type="hidden" name="type" value="bookmark">
                        <input type="hidden" name="book_isbn" value="<?php echo $book_isbn;?>">
                        <button type="submit" class="btn btn-success">Bookmark</button>
                    </form>
                </div>
                <div class="col-sm-6" style="margin-top: 20px;">
                    <form  method ="get" action="read.php" class="text-left">
                        <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">
                        <input type="submit" value="Read" name="book" class="btn btn-danger">
                    </form>
                </div>
                <div class="col-sm-6" style="margin-top: 20px;">
                    <form method="post" action="cart.php" class="text-right">
                        <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">
                        <input type="submit" value="Subscribe" name="cart" class="btn btn-primary">
                    </form>
                </div>
            </div>

            <div class="py=5">
                <h2 class="text-center">Top reviews:</h2>
                <div class="w-50 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatableid" class="table table-bordered table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Review</th>
                                </tr>
                                </thead>
                                <?php
                                $model = new Model();
                                $reviews = $model->select("SELECT user.Name, book_reviews.review FROM book_reviews JOIN user ON book_reviews.user_id = user.id WHERE book_reviews.book_isbn = '$book_isbn'");
                                if ($reviews) {
                                    foreach ($reviews as $row) {
                                        ?>
                                        <tbody>
                                        <tr>
                                            <td> <?php echo $row['Name']; ?> </td>
                                            <td> <?php echo $row['review']; ?> </td>
                                        </tr>
                                        </tbody>
                                        <?php
                                    }
                                } else {
                                    echo "No Record Found";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py=5">
                <h2 class="text-center">Write a review:</h2>
            </div>
            <div class="w-50 m-auto">
                <form action="" method="post">
                    <input type="hidden" name="book_isbn" value="<?= $book_isbn ?>">
                    <div class="form-group">
                        <label>Review:</label>
                        <textarea class="form-control" name="review"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
      </div>
<?php
  require "./template/footer.php";
?>