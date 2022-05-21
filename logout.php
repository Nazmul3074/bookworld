<?php

session_start();
if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    unset($_SESSION['useremail']);
    session_destroy();
    
    ?>
        <script>location.assign("login.php");</script>
    <?php 
    
}
else{
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
else if(
!isset($_SESSION['Adminemail']
)
    ){
    ?>
        <script>location.assign("login.php");</script>
    <?php 
}

else{
    ?>
        <script>location.assign("Admin login.php");</script>
    <?php 
}
}

?>
    


