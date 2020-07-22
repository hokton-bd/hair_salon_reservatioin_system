<?php 
    include 'header.php';

    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "U") {
        header("Location: login.php");
    }
    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }

    $user_id = $retrieve->getUserIdByLoginId($_SESSION['login_id']);
    list($name, $birthday, $gender, $contact_number, $user_status, $email, $login_id) = $retrieve->getEachUser($user_id);
    $coupons = $retrieve->getAllCoupons();
 ?>

    <!-- Hero Area Section Begin -->
    <div class="hero-area set-bg other-page" data-setbg="img/top.jpg">
        
    </div>
    <!-- Hero Area Section End -->
        <?php require_once 'reservationForm.php' ; ?>

    
    <?php $retrieve->displayMessage() ; ?>
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="userDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5">Get Coupons</h3>

        <div class="row">
        <?php if($coupons == false) : ?>
            <h5 class="text-center text-danger col-12">I'm sorry. No more available coupons. </h5>
        <?php else : ?>
            <?php foreach($coupons as $row) : ?>
            <?php if($row['coupon_status'] == "A") : ?>
        <div class="card col-3 mx-auto">
            <div class="card-body">
                <h5 class="card-title text-center"><?= $row['coupon_name'] ; ?></h5>
                <h6 class="card-title text-center"><?= $row['coupon_value']; ?> % OFF</h6>
                <p class="card-text text-dark text-center"><?= $row['description'] ; ?></p>
                <a href="action.php?actiontype=getCoupon&id=<?= $row['coupon_id']; ?>" class="btn btn-primary d-block mx-auto">Get Coupon</a>
            </div>
            <div class="card-footer text-muted text-center">
                Expiration until: <?= $row['expiration']; ?>
            </div>
        </div>
            <?php endif ; ?>
            <?php endforeach ; ?>
        <?php endif ; ?>
        </div><!--end row-->
    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>