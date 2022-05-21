<?php

require_once "autoload.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    //we will process here
    
    if(   isset($_POST['myemail']) 
       && isset($_POST['mypass'])
       && !empty($_POST['myemail'])
       && !empty($_POST['mypass'])
    ){
        $email=$_POST['myemail'];
        $pass=$_POST['mypass'];
        
        
        ///store the data to database
        try{
            ///PDO = PHP Data Object
            $conn=new PDO("mysql:host=localhost:3306;dbname=books;","root","");
            ///setting 1 environment variable
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
            $enc_password=md5($pass);
            
            ///checking from the database
            $myquerystring="SELECT * FROM user WHERE email='$email' and pass='$enc_password'";
            
            $returnobj = $conn->query($myquerystring);   ///the return objects is a PDOStatement object

            if($returnobj->rowCount()==1){
                
                session_start();
                $_SESSION['useremail']=$email; ///global variable
                Auth::setUser($returnobj->fetch());
                
                ?>
                    <script>location.assign("index.php");</script>
                <?php
            }
            else{
                ?>
                    <script>location.assign("login.php");</script>
                <?php
            }
        }
        catch(PDOException $ex){
            ?>
                <script>location.assign("login.php");</script>
            <?php
        }
        
    }
    else{
        ///if email and password data is empty or not set
    ?>
        <script>location.assign("login.php");</script>
    <?php
        
    } 
    
}
else{
    //we won't process
    ?>
        <script>location.assign('login.php')</script>
    <?php
    
}


?>