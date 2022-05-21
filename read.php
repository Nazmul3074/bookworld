<?php

require_once "./functions/database_functions.php";
require_once "autoload.php";

session_start();

if (!auth()) {
    header("location:login.php");
}

$book_isbn = $_GET['bookisbn'];
$book = (new Model())->selectFirst("SELECT * FROM books WHERE book_isbn= '$book_isbn'");

$title = $book['book_title'];
$path = "./bootstrap/pdf/" . $book['book_pdf'];

if ($book['book_type'] != 'Premium') {
    readPdf($path);
}

if ($book['book_type'] == 'Premium') {
    $user = Auth::user();
    $subscribed = (new Model())->selectFirst("SELECT * FROM subscribers where user_id = {$user['id']} AND expiry_date >= DATE(NOW())");

    if (!$subscribed) {
        require_once "./template/header.php";
        ?>
        <div class="row text-center">
            <h1>Your have not any subscription!</h1>
            <h1>Please subscribe first</h1>
        </div>
        <div class="text-center">
            <br>
            <a href="subscription.php" class="btn btn-warning">Subscribe</a>
        </div>
        <?php
        require_once "./template/footer.php";
    } else if ($subscribed['subscription_status'] == 0) {
        require_once "./template/header.php";
        ?>
        <div class="row text-center">
            <h1>Your premium subscription is not active yet!</h1>
            <h1>Please wait for approval</h1>
        </div>
        <?php
        require_once "./template/footer.php";
    } else {
       
        readPdf($path);
    }
}

?>