<?php

require_once "autoload.php";

session_start();

if (!auth()) {
    header("location:login.php");
}

$title = "Subscription";
require_once "./template/header.php";

$user = Auth::user();
$subscribed = (new Model())->selectFirst("SELECT * FROM subscribers where user_id = {$user['id']} AND expiry_date >= DATE(NOW())");
$datetime = new DateTime();

if ($subscribed) { ?>
    <div class="row text-center">
        <h2>Welcome - <?php echo $_SESSION['useremail'] ?></h2>
        <h2>Membership is Live!</h2>
        <h2><?= $datetime->diff(new DateTime($subscribed['expiry_date']))->format("You have %d days left on your subscription") ?></h2>
    </div>
    <?php
} else { ?>
    <div class="row text-center">
        <h1>Your have not any subscription!</h1>
        <a href="payment.php" class="btn btn-warning">Subscribe Now</a>
    </div>
    <?php
}

?>
<?php require_once "./template/footer.php"; ?>