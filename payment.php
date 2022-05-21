<?php

require_once "autoload.php";

session_start();

if (!auth()) {
    header("location:login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = new PaymentActions('POST');
    $action->store();
}

$title = "Subscribe Now";
require_once "./template/header.php";

?>

<div class="container">
    <div class="page-header text-center">
        <h1>Premium Subscription</h1>
    </div>

    <!-- Credit Card Payment Form - START -->
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="text-center">Payment Details</h3>
                            <div class="row">
                                <div class="col-sm-6 text-right">
                                    Subscription For:
                                </div>
                                <div class="col-sm-6">1 Month</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 text-right">
                                    Subscription Amount:
                                </div>
                                <div class="col-sm-6">BDT 200</div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="POST">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group"> <label>CARD NUMBER</label>
                                        <div class="input-group"> <input type="tel" required class="form-control" placeholder="Valid Card Number" /> <span class="input-group-addon"><span class="fa fa-credit-card"></span></span> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-7 col-md-7">
                                    <div class="form-group"> <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label> <input required type="tel" class="form-control" placeholder="MM / YY" /> </div>
                                </div>
                                <div class="col-xs-5 col-md-5 pull-right">
                                    <div class="form-group"> <label>CV CODE</label> <input type="tel" class="form-control" placeholder="CVC" /> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group"> <label>CARD OWNER</label> <input type="text" class="form-control" placeholder="Card Owner Name" /> </div>
                                </div>
                            </div>

                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-xs-12"> <button class="btn btn-success btn-lg btn-block" type="submit">Confirm Payment</button> </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






<?php

require_once "./template/footer.php";
?>