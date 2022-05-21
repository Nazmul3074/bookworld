<?php

require_once "autoload.php";

session_start();

if (!auth()) {
    header("location:login.php");
}

$title = "Subscribe Now";
require_once "./template/header.php";

?>

<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-success">
            <strong>Payment Success!</strong> Please wait until admin approve your payment
            <br>
            <br>
            <p><strong>Note:</strong> Your subscription will be counted from the approval by Admin</p>
        </div>
    </div>
</div>

<?php
require_once "./template/footer.php";
?>