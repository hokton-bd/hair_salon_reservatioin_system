<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "U") {
        header("Location: index.php");    
    }

    list($service_id, $service_name, $price, $picture, $service_description, $service_status) = $retrieve->getEachService($_SESSION['service']);
?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="makeReservation.php" class="btn btn-outline-light">Back</a>
        <h3 class="text-center text-white mb-4">Check Reserve </h3>
    
        <div class="card mx-auto" style="width: 18rem;">
            <img src="img/services/<?= $picture; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center text-uppercase font-weight-bold"><?= $service_name; ?></h5>
                <p class="card-text text-center text-dark">DATE: <?= $_SESSION['date']; ?></p>
                <p class="card-text text-center text-dark">TIME: <?= $_SESSION['time']; ?></p>
                <p class="card-text text-center text-dark">STAFF: <?= $retrieve->getStaffNameById($_SESSION['staff']); ?></p>
                <p class="card-text text-dark text-center">PRICE: <?= $_SESSION['price']?> PHP</p>
                <a href="action.php?actiontype=reserve" class="btn form-btn w-50">Reserve</a>
            </div>
        </div>


    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>