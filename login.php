<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

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
                <a class="navbar-brand" href="login.php">Login</a>
            </div>
        </div>
    </nav>
</head>
<body>
<div class="jumbotron">
    <div class="container">
        <form class="form-horizontal" method="post" action="loginprocess.php">
            <div class="form-group">
                <label for="myemail" class="control-label col-md-4">Email</label>
                <div class="col-md-4">
                    <input type="email" id="myemail" name="myemail" placeholder="x@gmail.com" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <lebel for="mypass" class="control-label col-md-4">Password</lebel>
                <div class="col-md-4">
                    <input type="password" id="mypass" name="mypass" class="form-control">
                </div>
            </div>
            <p class="lead text-center text-muted"><input type="submit" value="Click to Login" class="btn btn-primary">
            </p>
        </form>
        <p>Not a member? <a href="register.php">Sign up</a></p>
        <div class="text-muted pull-right">
            <p> Admin! <a href="admin.php">Admin log in</a></p>
        </div>
    </div>
</div>
</body>

</html>
