<?php
  session_start();
if(
    isset($_SESSION['Adminemail'])
    && !empty($_SESSION['Adminemail'])
)
{
    require_once"./template/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <tittle>Admin Panel</tittle>
  
    </head>
    <body>
             <h1>Welcome Admin - <?php echo $_SESSION['Adminemail']?></h1>
 

      
  
            <br>
        <form> 
         
        <pre>
            <input type="button" value="Manage books" onclick="addfn()" class="btn btn-success">
        
            <input type="button" value="Manage Users" onclick="deluserfn()" class="btn btn-primary">
        
         </pre>
        
        </form>
   
     <div class="header">
     
      <td></td>
             <br>
    <input type="button" value="Log out" onclick="logoutfn()" class="btn btn-danger">
       </div>
        <script>
        function logoutfn()
            {
                location.assign("admin Logout.php");
            }
            function addfn()
            {
                location.assign("admin_book.php");
            }
            function deluserfn()
            {
                location.assign("manage_user.php");
            }
        </script>
    
</body>    
</html>
<?php
}
else{
    ?>
        <script>location.assign('admin login.php')</script>
    <?php
    
}
?>