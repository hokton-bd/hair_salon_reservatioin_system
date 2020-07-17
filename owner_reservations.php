<?php 
    include 'header.php';
    $_SESSION['message'] = "";
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    } else if($_SESSION['login_id'] != null && $_SESSION['status'] == "U") {
        header("Location: userDashboard.php");
    }
$minus_three = date('Y-m-d', strtotime('-3days'));
$minus_two = date('Y-m-d', strtotime('-2days'));
$minus_one = date('Y-m-d', strtotime('-1days'));
$today = date('Y-m-d');
$plus_one = date('Y-m-d', strtotime('+1days'));
$plus_two = date('Y-m-d', strtotime('+2days'));
$plus_three = date('Y-m-d', strtotime('+3days'));
 ?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="ownerDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5">Reservations</h3>
        <div class="row weekly-reservations-list mr-0">
        
            <div class="weekly-reservations mx-auto">
                <div class="card-header font-weight-bold">
                    <?= substr($minus_three, 5); ?>
                </div>

                <div class="card-body p-0">
                    <?php
                        if($retrieve->getDailyReservations($minus_three) != 0) : 
                        foreach($retrieve->getDailyReservations($minus_three) as $reservation) :  ?>
                        <div type="button" data-toggle="modal" data-target="#reservation_<?= $reservation['reservation_id']; ?>" class="reservation-item border-bottom text-center">
                            <span style="font-size: 12px;" class="text-dark text-center"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5); ?></span><br>
                            <span class="text-dark text-center"><?= $retrieve->getUserNameById($reservation['user_id']); ?></span><br>
                            <span class="text-dark text-center"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></span>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="reservation_<?= $reservation['reservation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row bg-secondary text-center">
                                            <p class="col-2 mx-auto">TIME</p>
                                            <p class="col-2 mx-auto">NAME</p>
                                            <p class="col-2 mx-auto">SERVICE</p>
                                            <p class="col-2 mx-auto">STAFF</p>
                                            <p class="col-2 mx-auto">COUPON</p>
                                        </div>
                                        <div class="row text-dark text-center">
                                            <p class="col-2 mx-auto text-dark"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5) ; ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getUserNameById($reservation['user_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getStaffNameById($reservation['staff_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark" style="overflow: hidden;">
                                                <?php if($retrieve->getCouponInfo($reservation['uc_id']) != 0) : ?>
                                                <?php foreach($retrieve->getCouponInfo($reservation['uc_id']) as $coupon) : ?>
                                                    <?= $coupon['coupon_name']; ?><br>
                                                    <?php echo $coupon['coupon_value'] ; ?>
                                                <?php endforeach ; endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--/modal-->

                        <?php  endforeach ; else : ?>
                    <p class="text-dark text-center m-1" style="font-size: 12px;">No<br>reservations</p>
                    
                    <?php endif; ?>
                </div>
            </div>


            <div class="weekly-reservations mx-auto">
                <div class="card-header font-weight-bold">
                    <?= substr($minus_two, 5); ?>
                </div>

                <div class="card-body p-0">
                    <?php
                        if($retrieve->getDailyReservations($minus_two) != 0) : 
                        foreach($retrieve->getDailyReservations($minus_two) as $reservation) :  ?>
                       <div type="button" data-toggle="modal" data-target="#reservation_<?= $reservation['reservation_id']; ?>" class="reservation-item border-bottom text-center">
                            <span style="font-size: 12px;" class="text-dark text-center"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5); ?></span><br>
                            <span class="text-dark text-center"><?= $retrieve->getUserNameById($reservation['user_id']); ?></span><br>
                            <span class="text-dark text-center"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></span>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="reservation_<?= $reservation['reservation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row bg-secondary text-center">
                                            <p class="col-2 mx-auto">TIME</p>
                                            <p class="col-2 mx-auto">NAME</p>
                                            <p class="col-2 mx-auto">SERVICE</p>
                                            <p class="col-2 mx-auto">STAFF</p>
                                            <p class="col-2 mx-auto">COUPON</p>
                                        </div>
                                        <div class="row text-dark text-center">
                                            <p class="col-2 mx-auto text-dark"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5) ; ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getUserNameById($reservation['user_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getStaffNameById($reservation['staff_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark" style="overflow: hidden;">
                                                <?php if($retrieve->getCouponInfo($reservation['uc_id']) != 0) : ?>
                                                <?php foreach($retrieve->getCouponInfo($reservation['uc_id']) as $coupon) : ?>
                                                    <?= $coupon['coupon_name']; ?><br>
                                                    <?php echo $coupon['coupon_value'] ; ?>
                                                <?php endforeach ; endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--/modal-->
                    <?php  endforeach ; else : ?>
                    <p class="text-dark text-center m-1" style="font-size: 12px;">No<br>reservations</p>
                    
                    <?php endif; ?>
                </div>
            </div>

            <div class="weekly-reservations mx-auto">
                <div class="card-header font-weight-bold">
                    <?= substr($minus_one, 5); ?>
                </div>

                <div class="card-body p-0">
                    <?php
                        if($retrieve->getDailyReservations($minus_one) != 0) : 
                        foreach($retrieve->getDailyReservations($minus_one) as $reservation) :  ?>
                        <div type="button" data-toggle="modal" data-target="#reservation_<?= $reservation['reservation_id']; ?>" class="reservation-item border-bottom text-center">
                            <span style="font-size: 12px;" class="text-dark text-center"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5); ?></span><br>
                            <span class="text-dark text-center"><?= $retrieve->getUserNameById($reservation['user_id']); ?></span><br>
                            <span class="text-dark text-center"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></span>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="reservation_<?= $reservation['reservation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row bg-secondary text-center">
                                            <p class="col-2 mx-auto">TIME</p>
                                            <p class="col-2 mx-auto">NAME</p>
                                            <p class="col-2 mx-auto">SERVICE</p>
                                            <p class="col-2 mx-auto">STAFF</p>
                                            <p class="col-2 mx-auto">COUPON</p>
                                        </div>
                                        <div class="row text-dark text-center">
                                            <p class="col-2 mx-auto text-dark"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5) ; ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getUserNameById($reservation['user_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getStaffNameById($reservation['staff_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark" style="overflow: hidden;">
                                                <?php if($retrieve->getCouponInfo($reservation['uc_id']) != 0) : ?>
                                                <?php foreach($retrieve->getCouponInfo($reservation['uc_id']) as $coupon) : ?>
                                                    <?= $coupon['coupon_name']; ?><br>
                                                    <?php echo $coupon['coupon_value'] ; ?>
                                                <?php endforeach ; else: ?>
                                                    ------
                                                <?php endif ; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--/modal-->
                    <?php  endforeach ; else : ?>
                    <p class="text-dark text-center m-1" style="font-size: 12px;">No<br>reservations</p>
                    
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="weekly-reservations mx-auto bg-primary">
            <div class="card-header font-weight-bold text-white">
                    <?= substr($today, 5); ?>
                </div>

                <div class="card-body p-0">
                    <?php
                        if($retrieve->getDailyReservations($today) != 0) : 
                        foreach($retrieve->getDailyReservations($today) as $reservation) :  ?>
                        <div type="button" data-toggle="modal" data-target="#reservation_<?= $reservation['reservation_id']; ?>" class="reservation-item border-bottom text-center">
                            <span style="font-size: 12px;" class="text-white text-center"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5); ?></span><br>
                            <span class="text-white text-center"><?= $retrieve->getUserNameById($reservation['user_id']); ?></span><br>
                            <span class="text-white text-center"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></span>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="reservation_<?= $reservation['reservation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row bg-secondary text-center">
                                            <p class="col-2 mx-auto">TIME</p>
                                            <p class="col-2 mx-auto">NAME</p>
                                            <p class="col-2 mx-auto">SERVICE</p>
                                            <p class="col-2 mx-auto">STAFF</p>
                                            <p class="col-2 mx-auto">COUPON</p>
                                        </div>
                                        <div class="row text-dark text-center">
                                            <p class="col-2 mx-auto text-dark"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5) ; ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getUserNameById($reservation['user_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getStaffNameById($reservation['staff_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark" style="overflow: hidden;">
                                                <?php if($retrieve->getCouponInfo($reservation['uc_id']) != 0) : ?>
                                                <?php foreach($retrieve->getCouponInfo($reservation['uc_id']) as $coupon) : ?>
                                                    <?= $coupon['coupon_name']; ?><br>
                                                    <?php echo $coupon['coupon_value'] ; ?>
                                                <?php endforeach ; endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--/modal-->
                    <?php  endforeach ; else : ?>
                    <p class="text-dark text-center m-1" style="font-size: 12px;">No<br>reservations</p>
                    
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="weekly-reservations mx-auto">
                <div class="card-header font-weight-bold">
                    <?= substr($plus_one, 5); ?>
                </div>

                <div class="card-body p-0">
                    <?php
                        if($retrieve->getDailyReservations($plus_one) != 0) : 
                        foreach($retrieve->getDailyReservations($plus_one) as $reservation) :  ?>
                        <div type="button" data-toggle="modal" data-target="#reservation_<?= $reservation['reservation_id']; ?>" class="reservation-item border-bottom text-center">
                            <span style="font-size: 12px;" class="text-dark text-center"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5); ?></span><br>
                            <span class="text-dark text-center"><?= $retrieve->getUserNameById($reservation['user_id']); ?></span><br>
                            <span class="text-dark text-center"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></span>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="reservation_<?= $reservation['reservation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row bg-secondary text-center">
                                            <p class="col-2 mx-auto">TIME</p>
                                            <p class="col-2 mx-auto">NAME</p>
                                            <p class="col-2 mx-auto">SERVICE</p>
                                            <p class="col-2 mx-auto">STAFF</p>
                                            <p class="col-2 mx-auto">COUPON</p>
                                        </div>
                                        <div class="row text-dark text-center">
                                            <p class="col-2 mx-auto text-dark"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5) ; ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getUserNameById($reservation['user_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getStaffNameById($reservation['staff_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark" style="overflow: hidden;">
                                                <?php if($retrieve->getCouponInfo($reservation['uc_id']) != 0) : ?>
                                                <?php foreach($retrieve->getCouponInfo($reservation['uc_id']) as $coupon) : ?>
                                                    <?= $coupon['coupon_name']; ?><br>
                                                    <?php echo $coupon['coupon_value'] ; ?>
                                                <?php endforeach ; endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--/modal-->
                    <?php  endforeach ; else : ?>
                    <p class="text-dark text-center m-1" style="font-size: 12px;">No<br>reservations</p>
                    
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="weekly-reservations mx-auto">
                <div class="card-header font-weight-bold">
                    <?= substr($plus_two, 5); ?>
                </div>

                <div class="card-body p-0">
                    <?php
                        if($retrieve->getDailyReservations($plus_two) != 0) : 
                        foreach($retrieve->getDailyReservations($plus_two) as $reservation) :  ?>
                        <div type="button" data-toggle="modal" data-target="#reservation_<?= $reservation['reservation_id']; ?>" class="reservation-item border-bottom text-center">
                            <span style="font-size: 12px;" class="text-dark text-center"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5); ?></span><br>
                            <span class="text-dark text-center"><?= $retrieve->getUserNameById($reservation['user_id']); ?></span><br>
                            <span class="text-dark text-center"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></span>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="reservation_<?= $reservation['reservation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row bg-secondary text-center">
                                            <p class="col-2 mx-auto">TIME</p>
                                            <p class="col-2 mx-auto">NAME</p>
                                            <p class="col-2 mx-auto">SERVICE</p>
                                            <p class="col-2 mx-auto">STAFF</p>
                                            <p class="col-2 mx-auto">COUPON</p>
                                        </div>
                                        <div class="row text-dark text-center">
                                            <p class="col-2 mx-auto text-dark"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5) ; ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getUserNameById($reservation['user_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getStaffNameById($reservation['staff_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark" style="overflow: hidden;">
                                                <?php if($retrieve->getCouponInfo($reservation['uc_id']) != 0) : ?>
                                                <?php foreach($retrieve->getCouponInfo($reservation['uc_id']) as $coupon) : ?>
                                                    <?= $coupon['coupon_name']; ?><br>
                                                    <?php echo $coupon['coupon_value'] ; ?>
                                                <?php endforeach ; endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--/modal-->
                    <?php  endforeach ; else : ?>
                    <p class="text-dark text-center m-1" style="font-size: 12px;">No<br>reservations</p>
                    
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="weekly-reservations mx-auto">
                <div class="card-header font-weight-bold">
                    <?= substr($plus_three, 5); ?>
                </div>

                <div class="card-body p-0">
                    <?php
                        if($retrieve->getDailyReservations($plus_three) != 0) : 
                        foreach($retrieve->getDailyReservations($plus_three) as $reservation) :  ?>
                        <div type="button" data-toggle="modal" data-target="#reservation_<?= $reservation['reservation_id']; ?>" class="reservation-item border-bottom text-center">
                            <span style="font-size: 12px;" class="text-dark text-center"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5); ?></span><br>
                            <span class="text-dark text-center"><?= $retrieve->getUserNameById($reservation['user_id']); ?></span><br>
                            <span class="text-dark text-center"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></span>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="reservation_<?= $reservation['reservation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row bg-secondary text-center">
                                            <p class="col-2 mx-auto">TIME</p>
                                            <p class="col-2 mx-auto">NAME</p>
                                            <p class="col-2 mx-auto">SERVICE</p>
                                            <p class="col-2 mx-auto">STAFF</p>
                                            <p class="col-2 mx-auto">COUPON</p>
                                        </div>
                                        <div class="row text-dark text-center">
                                            <p class="col-2 mx-auto text-dark"><?= substr($reservation['reservation_time'], 0, 5)." - ".substr($reservation['end_time'], 0, 5) ; ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getUserNameById($reservation['user_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getStaffNameById($reservation['staff_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark" style="overflow: hidden;">
                                                <?php if($retrieve->getCouponInfo($reservation['uc_id']) != 0) : ?>
                                                <?php foreach($retrieve->getCouponInfo($reservation['uc_id']) as $coupon) : ?>
                                                    <?= $coupon['coupon_name']; ?><br>
                                                    <?php echo $coupon['coupon_value'] ; ?>
                                                <?php endforeach ; endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--/modal-->
                    <?php  endforeach ; else : ?>
                    <p style="font-size: 12px;" class="text-dark text-center m-1">No<br>reservations</p>
                    
                    <?php endif; ?>
                </div>
            </div>

        </div><!--/row-->
       
    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>