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

    $reservation_id = $_GET['id'];
    $review = $retrieve->getReviewByReservationId($reservation_id);
 ?>

    <!-- Hero Area Section Begin -->
    <div class="hero-area set-bg other-page" data-setbg="img/top.jpg">
        
    </div>
    <!-- Hero Area Section End -->
        <?php require_once 'reservationForm.php' ; ?>    

    <?php $retrieve->displayMessage() ; ?>
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="userDashboard.php" class="btn btn-outline-light mb-2">Back to Dashboard</a>
        <?php foreach($review as $value) : ?>
        <h3 class="text-center text-white mb-5"><?= substr($value['reservation_date'], 5) ;?> Review Detail</h3>

        <div class="row">
        <div class="card col-6 mx-auto bg-info p-0">
            <img src="img/staffs/<?= $retrieve->displayStaffImage($value['staff_id']); ?>" class="" alt="">
            <div class="card-body">
                <p class="text-light text-center text-capitalize card-text"><?= $retrieve->getServiceNameById($value['service_id']) ;?>: <?= number_format($value['service_rating'], 1) ;?></p>
                <p class="text-light text-center text-capitalize card-text"><?= $retrieve->getStaffNameById($value['staff_id']) ;?>: <?= number_format($value['staff_rating'], 1) ;?></p>
                <p class="text-light text-center text-capitalize card-text"><?= $value['comment'] ;?></p>
            </div>
        </div>
        </div>
        

        <?php endforeach; ?>
        
    </div><!--end container-->
    </section>
    <!-- Room Section End -->
    <?php require_once 'inner_footer.php' ; ?>