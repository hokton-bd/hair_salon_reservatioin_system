<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "U") {
        header("Location: index.php");    
    }
    $rows = $retrieve->getAllServices();
    $rows_st = $retrieve->getAllStaffs();
    $user_id = $retrieve->getUserIdByLoginId($_SESSION['login_id']);
    $user_coupons = $retrieve->getUserCoupons($user_id);
?>
    <?php include 'heroArea.php' ; ?>
    <?php $retrieve->displayMessage(); ?>
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="userDashboard.php" class="btn btn-outline-light">Back</a>
        <h3 class="text-center text-white mb-2">Reserve</h3>

        <form action="action.php" method="post" class="mx-auto py-5">
            <div class="row mx-auto mb-4">
                <input class="form-control col-3 mx-auto" type="date" name="date" id="" value="<?= $_SESSION['date']; ?>">
                <input class="form-control col-3 mx-auto" type="time" name="time" id="" value="<?= $_SESSION['time']; ?>" min="10:00" max="18:00">
                <select name="service" class="form-control text-uppercase mx-auto col-3" id="service-list">
                    <?php foreach($rows as $row) : ?>
                    <?php if($row['service_status'] == "A") : ?>
                    <?php if($_SESSION['service'] == $row['service_id']) : ?>
                        <option class="text-uppercase" value="<?= $row['service_id']; ?>" selected><?= $row['service_name']; ?></option>
                    <?php else : ?>
                        <option class="text-uppercase" value="<?= $row['service_id']; ?>"><?= $row['service_name']; ?></option>
                    <?php endif ; ?>
                    <?php endif ; ?>
                    <?php endforeach ; ?>

                </select>

            </div>

            <div id="staff-select" class="row mx-auto mb-4">
                <h5 class="text-center text-light col-12 mb-2">Choose Staff</h5>
                <?php foreach($retrieve->getServiceStaff($_SESSION['service']) as $staff) : ?>
                <label for="<?= $staff['staff_id']; ?>" class="col-4">
                    <div class="staff-img-box mb-2">
                        <img class="staff-img" src="img/staffs/<?= $staff['picture']?>" alt="">
                    </div>
                    <input type="radio" class="staff-radio"  name="staff" value="<?= $staff['staff_id']?>" id="<?= $staff['staff_id']?>" required>
                    <span class="staff-name ml-3 text-light text-center mx-auto"><?= $staff['name']; ?></span>
                </label>
                <?php endforeach ; ?>
            </div>

            <p class="text-white text-center">Choose Coupon</p>
            <?php if($user_coupons != false) : ?>
                <select name="coupon" class="form-control mx-auto col-3 mb-4" id="">
                    <option value="">--------------------</option>
                    <?php 
                        foreach($user_coupons as $row) : 
                        list($coupon_value, $coupon_name, $expiration, , $coupon_status) = $retrieve->getEachCoupon($row['coupon_id']);
                    ?>
                    <?php if($row['uc_status'] == "A" && $coupon_status == "G") :?>
                        <option value="<?= $row['uc_id']?>"><?= $coupon_name.": ".$coupon_value." % OFF"; ?></option>
                    <?php endif ; ?>
                    <?php endforeach ; ?>

                </select>
            <?php endif ; ?>
            <input type="submit" value="Reserve" name="confirm_reserve" class="form-control btn form-btn col-4 d-block mx-auto">
        </form>

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>