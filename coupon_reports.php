<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "O") {
        header("Location: index.php");    
    }
    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }
    $coupons = $retrieve->getAllCoupons();
 ;?>
 <html>
 <body>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">
    <a href="ownerDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5">Coupons Reports</h3>
        <!-- <h5 class="text-light mb-2 d-inline mr-5"></h5> -->
        <table class="table text-center table-hover table-light table-striped mb-0 mt-3 w-100">
            <thead class="thead-dark d-table w-100">
                <tr>
                    <th class="coupon-table-body" width="200px">NAME</th>
                    <th class="coupon-table-body">VALUE</th>
                    <th class="coupon-table-body">EXPIRATION</th>
                    <th class="coupon-table-body">USED</th>
                    <th class="coupon-table-body">IN HAND</th>
                    <th class="coupon-table-body">LEFT</th>
                </tr>
            </thead>
            <tbody style="overflow: scroll; max-height: 245px;" class="d-block w-100">
                <?php if($coupons != false) : foreach($coupons as $coupon) : ?>
                    <tr class="d-table w-100">
                        <td class="coupon-table-body word-wrap"><span class="badge badge-primary mr-1"><?= $retrieve->getTotalCouponAmount($coupon['coupon_name']); ?></span><?= $coupon['coupon_name']; ?></td>
                        <td class="coupon-table-body word-wrap"><?= $coupon['coupon_value']; ?> %</td>
                        <td class="coupon-table-body word-wrap"><?= $coupon['expiration']; ?></td>
                        <td class="coupon-table-body word-wrap"><?= $retrieve->getUsedCoupons($coupon['coupon_name']); ?></td>
                        <td class="coupon-table-body word-wrap"><?= $retrieve->getHandCoupons($coupon['coupon_name']); ?></td>
                        <td class="coupon-table-body word-wrap"><?= $retrieve->getLeftCoupons($coupon['coupon_name']); ?></td>
                    </tr>                    
                <?php endforeach; endif ; ?>
            </tbody>
        </table>

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>