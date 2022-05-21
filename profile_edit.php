<?php
  session_start();
if(
    isset($_SESSION['useremail'])
    && !empty($_SESSION['useremail'])
)
{
    require_once"./template/header.php";
    require_once "./functions/database_functions.php";
    $conn = db_connect();

     $useremail=$_SESSION['useremail'];
	
  
	
    $query = "SELECT * FROM user WHERE email='$useremail'";
    $result=mysqli_query($conn,$query);
   
         $row=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <tittle><B>My Profile</B></tittle>
  
    </head>
    <body>
           
       
        
             <form method="post" action="edit_profile.php">
                 <table class="table">
           
            <tr>
                <th>Name</th>
                <td><input type="text" name="Name" value ="<?php echo $row['Name'];?>" ></td>
             </tr>
                <tr>
                <th>Current Password</th>
                <td><input type="password" name="curpass" required ></td>
                <tr>
                <th>Password</th>
                <td><input type="password" name="pass" ></td>
                </tr>     
    </table>
             <input type="hidden" name=useremail value="useremail">    
            <input type="submit" name="Save" value="Save" class="btn btn-primary">
            </form>
          <br/>
        <a href="profile.php" class="btn btn-success">Confirm</a>
    
</body>    
</html>
<?php
}

else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
    
}
require_once "./template/footer.php";
?>