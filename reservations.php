<?php 
    include 'header.php';
    $_SESSION['message'] = "";
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    } else if($_SESSION['login_id'] != null && $_SESSION['status'] == "U") {
        header("Location: userDashboard.php");
    }
    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }
 ?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="staffDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5"><?= date('Y / m / d'); ?> Reservations</h3>
        
        <?php 
            $rows_s = $retrieve->getAllStaffs();
            foreach($rows_s as $row_s) :
         ?>
            <div class="row mx-auto text-center timeline">
                <div class="col-1 staff_name m-2">
                    <span class=""><?= $row_s['name']; ?></span>
                </div>
                <div class="col-10 row staff_reservations my-2 mr-1 mx-auto">
                    <?php
                        $rows_r = $retrieve->getReservations($row_s['staff_id']);
                        if($rows_r != false) : foreach($rows_r as $row_r) : 
                    ?>
                        <div class="col-3 bg-info border py-1 reservation-item">
                            <?php if($row_r['uc_id'] != 0) : ?>
                                <span class="badge badge-warning coupon-badge">C</span>
                            <?php endif ; ?>
                            <p class=""><?= $row_r['name']; ?></p>
                            <p class=""><?= $row_r['service_name']; ?></p>
                            <p class=""><?= substr($row_r['reservation_time'], 0, 5); ?></p>
                            <?php if($row_r['staff_id'] == $retrieve->getStaffId($_SESSION['login_id'])) : ?>
                            <a href="action.php?actiontype=service_done&id=<?= $row_r['reservation_id']; ?>&uc=<?= $row_r['uc_id']; ?>" class="btn btn-primary btn-sm">Done</a>
                            <?php endif ; ?>
                        </div>
                        
                    <?php endforeach ; ?>

                    <?php else : // no reservations ever ?>
                        <p class="text-light text-center">No appointment today.</p>
                    <?php endif ; ?>
                </div>
            </div>

        <?php endforeach ; ?>
       
    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>