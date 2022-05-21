<?php
require("Connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login</title>

    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="./bootstrap/css/jumbotron.css" rel="stylesheet">
</head>

<head>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin%20login.php">Admin Login</a>
            </div>
        </div>
    </nav>
</head>
<div class="jumbotron">
    <div class="container">
        <form class="form-horizontal" method="POST">
            <div class="form-group">
                <label for="Admin_email" class="control-label col-md-4">Admin Email</label>:
                <div class="col-md-4">
                    <input type="email" id="Admin_email" name="Admin_email" placeholder="x@gmail.com" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="mypass" class="control-label col-md-4">Password</label>
                <div class="col-md-4">
                    <input type="password" id="mypass" name="mypass" class="form-control">
                </div>
            </div>
            <p class="lead text-center text-muted">
                <button type="submit" name="Singin" class="btn btn-primary">Sign in</button>
            </p>
        </form>
        <p>User! <a href="login.php">User log in</a></p>
    </div>
</div>

<?php
if (isset($_POST["Singin"])) {
    $adminemail = $_POST['Admin_email'];
    $adminpass = $_POST['mypass'];
    $query = "SELECT * FROM `admin panel` WHERE Admin_Email= '$adminemail'AND admin_pass='$adminpass' ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        echo "match";
        session_start();
        $_SESSION['Adminemail'] = $adminemail;
        $_SESSION['admin'] != true;
        header("location:admin.php");
    } else {
        echo "<script>alert('Incorrect Password');</script>";
    }
}

?>

</html>
