<?php

require_once "./autoload.php";

session_start();

if (!authAdmin()) {
    header("location:login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = new AdminPaymentApprovalAction('POST');
    $action->updateStatus();
}

$title = "Subscribe Now";
require_once "./template/header.php";

$model = new Model();
$payments = $model->select("SELECT user.Name, subscribers.* FROM subscribers JOIN user ON subscribers.user_id = user.id");

?>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Subscribed At</th>
                    <th>Current Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($payments) {
                    foreach ($payments as $payment) {
                        ?>
                        <tr>
                            <td><?= $payment['Name'] ?></td>
                            <td><?= $payment['subscribed_at'] ?></td>
                            <td><?= $payment['subscription_status'] == 0 ? 'Pending' : ($payment['subscription_status'] == 1 ? 'Approved' : 'Denied') ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="subscription_id" value="<?= $payment['id'] ?>">
                                    <button type="submit" class="btn btn-success" name="status" value="1">Approve</button>
                                    <button type="submit" class="btn btn-danger" name="status" value="2">Deny</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
require_once "./template/footer.php";
?>