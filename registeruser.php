<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    if(   isset($_POST['myemail']) 
       && isset($_POST['mypass'])
       && !empty($_POST['myemail'])
       && !empty($_POST['mypass'])
    ){
        $email=$_POST['myemail'];
        $pass=$_POST['mypass'];
        $username=$_POST['myname'];
         // $Nowdate=new DateTime();
        $Nowdate=(date("Y-m-d"));
        
        try{
            ///PDO = PHP Data Object
            $con=new PDO("mysql:host=localhost:3306;dbname=books;","root","");
            ///setting 1 environment variable
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
            $enc_password=md5($pass);
            
            ///executing mysql query
            $signupquery="INSERT INTO user(email, pass, Name, time) VALUES('$email','$enc_password','$username','$Nowdate')";
            
            
            $con->exec($signupquery);
            
            ?>
                <script>location.assign("login.php");</script>
            <?php
        }
        catch(PDOException $ex){
            ?>
                <script>location.assign("register.php");</script>
            <?php
        }
        
    }
    else{
        ///if email and password data is empty or not set
        /// register.php --> registeruser.php --> register.php
    ?>
        <script>location.assign("register.php");</script>
    <?php
        
    } 
}
else{
    //for other methods we will forward to register page (register.php)
    
    echo '<script>location.assign("register.php");</script>';
}


?>
