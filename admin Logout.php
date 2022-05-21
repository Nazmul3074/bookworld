<?php

session_start();
if(
        isset($_SESSION['Adminemail'])
    &&  !empty($_SESSION['Adminemail'])
){
    unset($_SESSION['Adminemail']);
    session_destroy();
    
    ?>
        <script>location.assign("Admin login.php");</script>
    <?php 
    
}
else{
    ?>
        <script>location.assign("Admin login.php");</script>
    <?php 
}

?>