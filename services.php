<?php 
    include 'header.php';
    require_once 'classes/RetrieveSQL.php';

?>
    <!-- Hero Area Section Begin -->
    <div class="hero-area set-bg other-page" data-setbg="img/top.jpg">
        <h1 id="owner_name">Services</h1>
    </div>
    <!-- Hero Area Section End -->

    <!-- Room Section Begin -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">

                <?php foreach($retrieve->getAllServices() as $row) : ?>
                <?php if($row['service_status'] == "A") : ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="services-item">
                        <div class="si-pic set-bg" data-setbg="img/services/<?= $row['picture']; ?>">
                            <!-- <div class="service-icon">
                                <img src="img/services/service-icon-1.png" alt="">
                            </div> -->
                        </div>
                        <div class="si-text">
                            <h3><?= $row['service_name']; ?></h3>
                            <p><?= $row['service_description']; ?></p>
                            <span class="text-light"><?= $row['price']; ?> PHP -</span>
                        </div>
                    </div>
                </div>
                <?php endif ; ?>
                <?php endforeach ; ?>
                
            </div><!--end row-->
        </div>
    </section>
    <!-- Room Section End -->

    <!-- Kids Section Begin -->
    <section class="kids-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="kid-pic">
                        <img src="img/services/kids.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6" id="kids-room-desc">
                    <div class="kid-text">
                        <div class="section-title" id="kid-room-title">
                            <span>a memorable holliday</span>
                            <h2>Kids room</h2>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo
                            viverra maecenas. Donec in sodales dui, a blandit nunc. Pellentesque id eros venenatis,
                            sollicitudin neque sodales, vehicula nibh. Nam massa odio, porttitor vitae efficitur non,
                            ultricies volutpat tellus.</p>
                        <a href="login.php" class="primary-btn">Make a Reservation</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Kids Section End -->

  <?php include 'footer.php'; ?>