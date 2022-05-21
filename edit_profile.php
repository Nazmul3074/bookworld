<?php	
  session_start();
if(
    isset($_SESSION['useremail'])
    && !empty($_SESSION['useremail'])
)
{
	if(!isset($_POST['Save'])){
		echo "Something wrong!";
		exit;
	}
   
	require_once("./functions/database_functions.php");
	$conn = db_connect();
    $email=$_SESSION['useremail'];
	$Name = trim($_POST['Name']);
    $curpass=$_POST['curpass'];
    $pass = ($_POST['pass']);
    $enc_curpass  = md5($curpass);
   
    $query1="SELECT * FROM user WHERE email= '$email'";

    $result1=mysqli_query($conn,$query1);
   
    $row=mysqli_fetch_assoc($result1);

   if($enc_curpass == $row['pass'])
   {
       $query = "UPDATE user SET  
	   Name = '$Name'";
   
	
	
	if(empty($pass)){
      
        $query .= " WHERE email= '$email'";
	
	} 
    else{
              $enc_password = md5($pass);	
        $query .= ", pass = '$enc_password' WHERE email= '$email'"; 
    }
          $result = mysqli_query($conn, $query);
          echo "<script>alert('Saved');</script>";
         ?>
    <script>location.assign("profile_edit.php")</script>
      <?php
   }

else
{
    echo "<script>alert('Incorrect Password');</script>";
    ?>
    <script>location.assign("profile_edit.php")</script>
<?php
    //header("location:profile_edit.php");
}
	    	
 
}
else
{
    header("location.login.php");
}
?>