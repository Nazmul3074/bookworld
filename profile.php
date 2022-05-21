<?php
session_start();
if (
    isset($_SESSION['useremail'])
    && !empty($_SESSION['useremail'])
) {
    require_once "./template/header.php";
    require_once "./functions/database_functions.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $bookmarkAction = new BookmarkActions('POST');
        $bookmarkAction->detachBookmark();
    }

    $useremail = $_SESSION['useremail'];
    $conn = db_connect();
    $query = "SELECT * FROM user WHERE email='$useremail'";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);

    $user = Auth::getUser();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <tittle><B>My Profile</B></tittle>
  
    </head>
    <body>
             <h1>Welcome - <?php echo $_SESSION['useremail']?></h1>
        <br>
        <div>
             <form>
            <table class="table" style="margin-top:20px">
                 
                     <tr>
                
                <th>Name</th>
                <th>Email</th>
                <th>&nbsp;</th>
                </tr>
                <tr>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                
                </tr>
                 </table>
         </form>
            <form method="post" action="profile_edit.php">
            <input type="hidden" name="useremail" value="<?php echo  $useremail;?>">
            <input type="submit" value="Edit profile" name="profile" class="btn btn-info">
           
        </form>
        </div>
   <div>
       <div class="card">
           <div class="card-header"><h2>Bookmarks</h2></div>
           <div class="card-body">
               <table class="table" style="margin-top:20px">
                   <tr>
                       <th>Book Title</th>
                       <th>Actions</th>
                   </tr>
                   <?php
                   $bookmarks = (new Model())->select("SELECT books.* FROM bookmarks JOIN books ON bookmarks.book_isbn = books.book_isbn WHERE bookmarks.user_id = {$user['id']}");
                   foreach ($bookmarks as $bookmark) {
                       ?>
                       <tr>
                           <td>
                               <a href="book.php?bookisbn=<?php echo $bookmark['book_isbn']; ?>"><?php echo $bookmark['book_title']; ?></a>
                           </td>
                           <td>
                               <form action="" method="post">
                                   <input type="hidden" name="book_isbn" value="<?= $bookmark['book_isbn']; ?>">
                                   <button type="submit" class="btn btn-danger">Remove</button>
                               </form>
                           </td>
                       </tr>
                   <?php } ?>
               </table>
           </div>
       </div>
  
        <br>
           <form > 
            <input type="button" value="My Subcription" onclick="subfn()" class="btn btn-success">
            </form>
        </div>
           <td></td>
        
        <script>
            function subfn()
            {
                location.assign("subscription.php");
            }
        </script>
</body>    
</html>
<?php
}
else if(
    isset($_SESSION['Adminemail'])
    && !empty($_SESSION['Adminemail']))
{
    header("location:admin.php");
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
    
}
require_once "./template/footer.php";
?>