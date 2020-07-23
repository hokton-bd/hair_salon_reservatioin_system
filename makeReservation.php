<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "U") {
        header("Location: index.php");    
    }
    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }
    $rows = $retrieve->getAllServices();
    $rows_st = $retrieve->getAllStaffs();
    $user_id = $retrieve->getUserIdByLoginId($_SESSION['login_id']);
    $user_coupons = $retrieve->getUserCoupons($user_id);
    if(isset($_GET['id'])) {
        $reservation_id = $_GET['id'];
        foreach($retrieve->getReservationInfo($reservation_id) as $re_reserve) {
            $re_date = $re_reserve['reservation_date'];
            $re_time = $re_reserve['reservation_time'];
            $re_service = $re_reserve['service_id'];
            $re_uc = $re_reserve['uc_id'];
        }
    }
?>
    <?php include 'heroArea.php' ; ?>
    <?php $retrieve->displayMessage(); ?>
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="userDashboard.php" class="btn btn-outline-light">Back</a>
        <h3 class="text-center text-white mb-2">Reserve</h3>

        <form action="action.php" method="post" class="mx-auto py-5">
            <div class="row mx-auto mb-4">

                <?php if(isset($_SESSION['date'])) : ?>
                    <input class="form-control col-3 mx-auto" type="date" name="date" id="reserve_date" value="<?= $_SESSION['date']; ?>" min="<?= $date; ?>">
                <?php elseif(isset($reservation_id)) : //rebook ?>
                    <input class="form-control col-3 mx-auto" type="date" name="date" id="reserve_date" value="<?= $re_date; ?>" min="<?= $date; ?>">
                <?php else : // reorder?>
                    <input class="form-control col-3 mx-auto" type="date" name="date" id="reserve_date" value="<?= $date; ?>" min="<?= $date; ?>">
                <?php endif ; ?>

                <?php if(isset($_SESSION['time'])) : ?>
                    <input class="form-control col-3 mx-auto" type="time" name="time" id="" value="<?= $_SESSION['time']; ?>" min="10:00" max="18:00">
                <?php elseif(isset($reservation_id)) : //rebook ?>
                    <input class="form-control col-3 mx-auto" type="time" name="time" id="" value="<?= $re_time; ?>" min="10:00" max="18:00">
                <?php else : //reorder ?>
                    <input class="form-control col-3 mx-auto" type="time" name="time" id="" value="<?= $retrieve->getLastTime($_GET['reservation_id']); ?>" min="10:00" max="18:00">
                <?php endif; ?>

                <select name="service" class="form-control text-uppercase mx-auto col-3" id="service-list">
                    <?php if(isset($_SESSION['service'])) : ?>
                    <!-- new order -->
                        <?php foreach($rows as $row) : ?>
                        <?php if($row['service_status'] == "A") : ?>
                        <?php if($_SESSION['service'] == $row['service_id']) : ?>
                            <option class="text-uppercase" value="<?= $row['service_id']; ?>" selected><?= $row['service_name']; ?> / <span style="font-size: 12px;">Rate: <?= $retrieve->calcServiceRate($row['service_id']) ;?></span></option>
                        <?php else : ?>
                            <option class="text-uppercase" value="<?= $row['service_id']; ?>"><?= $row['service_name']; ?> / <span style="font-size: 12px;">Rate: <?= $retrieve->calcServiceRate($row['service_id']) ;?></span></option>
                        <?php endif ; ?>
                        <?php endif ; ?>
                        <?php endforeach ; ?>
                    <!-- /new order -->

                    <!-- rebook -->
                    <?php elseif(isset($reservation_id)) : ?>
                        <?php foreach($rows as $row) : ?>
                        <?php if($row['service_status'] == "A") : ?>
                        <?php if($re_service == $row['service_id']) : ?>
                            <option class="text-uppercase" value="<?= $row['service_id']; ?>" selected><?= $row['service_name']; ?> / <span style="font-size: 12px;">Rate: <?= $retrieve->calcServiceRate($row['service_id']) ;?></span></option>
                        <?php else : ?>
                            <option class="text-uppercase" value="<?= $row['service_id']; ?>"><?= $row['service_name']; ?> / <span style="font-size: 12px;">Rate: <?= $retrieve->calcServiceRate($row['service_id']) ;?></span></option>
                        <?php endif ; ?>
                        <?php endif ; ?>
                        <?php endforeach ; ?>
                    <!-- /rebook -->
                    
                    <?php else : ?>

                    <!-- re order -->
                        <?php foreach($rows as $row) : ?>
                        <?php if($row['service_status'] == "A") : ?>
                        <?php if($_GET['service'] == $row['service_id']) : ?>
                            <option class="text-uppercase" value="<?= $row['service_id']; ?>" selected><?= $row['service_name']; ?> / <span style="font-size: 12px;">Rate: <?= $retrieve->calcServiceRate($row['service_id']) ;?></span></option>
                        <?php else : ?>
                            <option class="text-uppercase" value="<?= $row['service_id']; ?>"><?= $row['service_name']; ?> / <span style="font-size: 12px;">Rate: <?= $retrieve->calcServiceRate($row['service_id']) ;?></span></option>
                        <?php endif ; ?>
                        <?php endif ; ?>
                        <?php endforeach ; ?>
                    <?php endif ; ?>
                    <!-- /re order -->

                </select>

            </div>

            <h5 class="text-center text-light col-12 mb-2">Choose Staff</h5>
            <div id="staff-select" class="row mx-auto mb-4">

                <?php if(isset($_SESSION['service'])) : ?>
                <!-- new order -->
                    <?php foreach($retrieve->getServiceStaff($_SESSION['service']) as $staff) : ?>
                    <?php if($retrieve->getDateShift($_SESSION['date'], $staff['staff_id']) == true) : ?>
                    <label for="<?= $staff['staff_id']; ?>" class="col-4">
                        <div class="staff-img-box mb-2">
                            <img class="staff-img" src="img/staffs/<?= $staff['picture']?>" alt="">
                        </div>
                        <input type="radio" class="staff-radio"  name="staff" value="<?= $staff['staff_id']?>" id="<?= $staff['staff_id']?>" required>
                        <span class="staff-name ml-3 text-light text-center mx-auto"><?= $staff['name']; ?> Rate : <span class="text-warning"><?= $retrieve->calcStaffRate($staff['staff_id']) ;?></span></span>
                    </label>
                    <?php endif ; ?>
                    <?php endforeach ; ?>
                <!-- new order -->
                
                <?php elseif(isset($_GET['id'])) : ?>
                <!-- rebook -->
                    <?php foreach($retrieve->getServiceStaff($re_service) as $staff) : ?>
                    <?php if($retrieve->getDateShift($re_date, $staff['staff_id']) == true) : ?>
                    <label for="<?= $staff['staff_id']; ?>" class="col-4">
                        <div class="staff-img-box mb-2">
                            <img class="staff-img" src="img/staffs/<?= $staff['picture']?>" alt="">
                        </div>
                        <input type="radio" class="staff-radio"  name="staff" value="<?= $staff['staff_id']?>" id="<?= $staff['staff_id']?>" required>
                        <span class="staff-name ml-3 text-light text-center mx-auto"><?= $staff['name']; ?> / Rate : <span class="text-warning"><?= $retrieve->calcStaffRate($staff['staff_id']) ;?></span></span>
                    </label>
                    <?php endif ; ?>
                    <?php endforeach ; ?>

                <!-- /rebook -->
                <?php else : ?>
                <!-- re order -->

                    <?php foreach($retrieve->getServiceStaff($_GET['service']) as $staff) : ?>
                    <?php if($retrieve->getDateShift($date, $staff['staff_id']) == true) : ?>
                    <label for="<?= $staff['staff_id']; ?>" class="col-4">
                        <div class="staff-img-box mb-2">
                            <img class="staff-img" src="img/staffs/<?= $staff['picture']?>" alt="">
                        </div>
                        <?php if(isset($_GET['staff']) && $_GET['staff'] == $staff['staff_id']) : ?>
                            <input type="radio" class="staff-radio"  name="staff" value="<?= $staff['staff_id']?>" id="<?= $staff['staff_id']?>" required checked>
                            <span class="staff-name ml-3 text-light text-center mx-auto"><?= $staff['name']; ?> / Rate : <span class="text-warning"><?= $retrieve->calcStaffRate($staff['staff_id']) ;?></span></span>
                        <?php else : ?>
                            <input type="radio" class="staff-radio"  name="staff" value="<?= $staff['staff_id']?>" id="<?= $staff['staff_id']?>" required>
                            <span class="staff-name ml-3 text-light text-center mx-auto"><?= $staff['name']; ?> / Rate : <span class="text-warning"><?= $retrieve->calcStaffRate($staff['staff_id']) ;?></span></span>
                        <?php endif ; ?>
                    </label>
                    <?php endif ; ?>
                    <?php endforeach ; ?>
                <!-- re order -->
                <?php endif ; ?>

            </div>

            <?php if($user_coupons != false) : ?>
                <p class="text-white text-center">Choose Coupon</p>
                <select name="coupon" class="form-control mx-auto col-3 mb-4" id="">
                    <option value="">--------------------</option>
                    <?php foreach($user_coupons as $row) : ?>
                    <?php if($row['uc_status'] == "A" && $row['coupon_status'] == "G") :?>
                        <option value="<?= $row['uc_id']?>"><?= $row['coupon_name'].": ".$row['coupon_value']." % OFF"; ?></option>
                    <?php endif ; ?>
                    <?php endforeach ; ?>
                </select>
            <?php endif ; ?>

            <?php if(isset($reservation_id)) : ?>
                <input type="hidden" name="reservation_id" value="<?= $reservation_id; ?>">
                <input type="submit" value="Rebook" name="confirm_rebook" class="form-control btn form-btn col-4 d-block mx-auto">
            <?php else : ?>
                <input type="submit" value="Reserve" name="confirm_reserve" class="form-control btn form-btn col-4 d-block mx-auto">
            <?php endif ; ?>
        </form>

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>