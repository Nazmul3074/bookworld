<?php
	session_start();
if(
    isset($_SESSION['Adminemail'])
    && !empty($_SESSION['Adminemail'])
){
    
    $title = "Profiles";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
   // $query = ""
	$result = getUser($conn);
  ?>  
    <table class = "table" style ="margin-top: 10px">
        <tr>
              <th>Name</th>
              <th>Email</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
        </tr>
        
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
      <tr>
        <td><?php echo $row['Name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><a href="admin_profile_del.php?email=<?php echo $row['email']; ?>">Delete</a></td>
      </tr>  
        <?php } ?>
</table>
<?php
      
  }
else
{
   ?>
        <script>location.assign('admin.php')</script>
    <?php
}
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>
    
    
