<?php 
    session_start();
    require_once 'classes/connection.php';
    require_once 'classes/RetrieveSQL.php';
    $retrieve = new RetrieveSQLStatements();

    if(isset($_GET['service'])) : 
        $reserve_date = $_GET['reserve_date'];
        $service_id = intval($_GET['service']);
        $staffs = $retrieve->getServiceStaff($service_id);
        foreach($staffs as $staff) :
            if($retrieve->getDateShift($reserve_date, $staff['staff_id']) == true) :
            
?>  
    
    <label for="<?= $staff['staff_id']; ?>" class="col-4">
        <div class="staff-img-box mb-2">
            <img class="staff-img" src="img/staffs/<?= $staff['picture']?>" alt="">
        </div>
        <input type="radio" class="staff-radio"  name="staff" value="<?= $staff['staff_id']?>" id="<?= $staff['staff_id']?>" required>
        <span class="staff-name ml-3 text-light text-center mx-auto"><?= $staff['name']; ?> / Rate : <span class="text-warning"><?= $retrieve->calcStaffRate($staff['staff_id']) ;?></span></span>
    </label>
<?php endif; endforeach ; endif; ?>


<?php //delete message 
    if(isset($_GET['cm']) == "t") { 
    $_SESSION['message'] = "";
} ; ?>

<?php //date select 
    if(isset($_GET['date'])) :
        $date = $_GET['date'];
            $services = $retrieve->getAllServices();
            $reservations = $retrieve->getDailyDoneReservations($date);
?>
<h5 class="text-center text-light col-12 mb-2">Daily Report</h5>
    <table class="table table-light mb-0 text-center">
        <thead class="thead-dark">
            <tr>
                <?php foreach($services as $service) : ?>
                <?php if($service['service_status'] == "A") : ?>
                    <th class="text-uppercase">
                        <button type="button" class="text-uppercase text-white border-0 bg-transparent" data-toggle="modal" data-target="#service_<?= $service['service_id']; ?>">
                            <?= $service['service_name']; ?>
                        </button>
                    </th>

                    <!-- Modal -->
                    <div class="modal fade" id="service_<?= $service['service_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><span class="text-uppercase"><?= $service['service_name']; ?></span> Profits</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body text-center">
                                    <div class="row">
                                        <p class="col-4 bg-secondary text-white">NAME</p>
                                        <p class="col-4 bg-secondary text-white">STAFF</p>
                                        <p class="col-4 bg-secondary text-white">COUPON</p>
                                    </div>
                                    <?php if($reservations != 0) : ?>
                                    <?php foreach($reservations as $reservation) : ?>
                                    <?php if($reservation['service_id'] == $service['service_id']) : ?>
                                        <div class="row border-bottom">
                                            <p class="col-4 text-dark"><?= $retrieve->getUserNameByID($reservation['user_id']); ?></p>
                                            <p class="col-4 text-dark"><?= $retrieve->getStaffNameById($reservation['staff_id']); ?></p>
                                            <div class="col-4 text-dark">
                                                <?php if($retrieve->getCouponInfo($reservation['uc_id']) != 0) : ?>
                                                <?php foreach($retrieve->getCouponInfo($reservation['uc_id']) as $coupon) : ?>
                                                    <p class="text-dark col-6"><?= $coupon['coupon_name']; ?></p>
                                                    <p class="text-dark col-6"><?= $coupon['coupon_value']; ?> %</p>
                                                <?php endforeach ; else: ?>
                                                    <p class="text-dark">-----</p>
                                                <?php endif ; ?>
                                            </div>
                                        </div>
                                    <?php endif ; ?>
                                    <?php endforeach ; ?>
                                    <?php endif ; ?>
                                </div><!--/modal-body-->
                            </div><!--/modal-content-->
                        </div><!--/modal-dialog-->
                    </div><!--/modal-->

                <?php endif ; ?>
                <?php endforeach ; ?>
                <th>TOTAL</th>
            </tr>            

        </thead>
        <tbody>
                <tr>
                    <?php if($reservations != 0) : // there are some reservations?>
                    <?php foreach($services as $service) : //repeat by number of services?>
                    <?php if($service['service_status'] == "A") : //display only available service?>
                        <td>
                            <?= number_format($retrieve->calcServiceProfit($service['service_id'], $date), 2); ?>
                        </td>
                    <?php endif ;?>
                    <?php endforeach; ?>
                        <td class="font-weight-bold">
                            <?php echo number_format($retrieve->calcDailyProfits($date), 2); ?>
                        </td>
                    <?php else : //no reservations ?>
                        <?php foreach($services as $service) : ?>
                        <?php if($service['service_status'] =="A") : ?>
                            <td>0.00</td>
                        <?php endif ; ?>
                        <?php endforeach ; ?>
                        <td>0.00</td>
                    <?php endif ; ?>
                </tr>
                <tr class="table-info">
                    <?php foreach($services as $service) : ?>
                    <?php if($service['service_status'] == "A") : ?>
                        <td><?= $retrieve->getDailyCustomers($date, $service['service_id']); ?></td>
                    <?php endif; endforeach ; ?>
                    <td><?= $retrieve->getDailyTotalCustomers($date); ?></td>
                </tr>
        </tbody>
    </table>
<?php endif ; ?>


<?php //monthly report
    if(isset($_GET['month'])) :
        $month = $_GET['month'];
            $services = $retrieve->getAllServices();
            $monthly_reservations = $retrieve->getMonthlyDoneReservations($month);
?>

<h5 class="text-center text-light col-12 mb-2">Monthly Report</h5>
    <table class="table table-light mb-0 text-center">
        <thead class="thead-dark">
            <tr>
                <?php foreach($services as $service) : ?>
                <?php if($service['service_status'] == "A") : ?>
                    <th>
                        <button type="button" class="text-uppercase text-white border-0 bg-transparent" data-toggle="modal" data-target="#service_<?= $service['service_id']; ?>">
                            <?= $service['service_name']; ?>
                        </button>
                    </th>
                        <!-- Modal -->
                    <div class="modal fade" id="service_<?= $service['service_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><span class="text-uppercase"><?= $service['service_name']; ?></span> Monthly Profits</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body text-center">
                                    <div class="row">
                                        <p class="col-4 bg-secondary text-white">DATE</p>
                                        <p class="col-4 bg-secondary text-white">NAME</p>
                                        <p class="col-4 bg-secondary text-white">STAFF</p>
                                    </div>
                                    <?php if($monthly_reservations != 0) : ?>
                                    <?php foreach($monthly_reservations as $reservation) : ?>
                                    <?php if($reservation['service_id'] == $service['service_id']) : ?>
                                        <div class="row border-bottom">
                                            <p class="col-4 text-dark"><?= $reservation['reservation_date']; ?></p>
                                            <p class="col-4 text-dark"><?= $retrieve->getUserNameByID($reservation['user_id']); ?></p>
                                            <p class="col-4 text-dark"><?= $retrieve->getStaffNameById($reservation['staff_id']); ?></p>
                                            
                                        </div>
                                    <?php endif ; ?>
                                    <?php endforeach ; ?>
                                    <?php endif ; ?>
                                </div><!--/modal-body-->
                            </div><!--/modal-content-->
                        </div><!--/modal-dialog-->
                    </div><!--/modal-->

                <?php endif ; ?>
                <?php endforeach ; ?>
                <th>
                    <button type="button" class="text-uppercase text-white border-0 bg-transparent" data-toggle="modal" data-target="#monthly_total">
                    TOTAL</button>
                </th>

                    <!-- Modal -->
                    <div class="modal fade" id="monthly_total" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Monthly Total Profits</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body text-center">
                                    <div class="row bg-secondary">
                                        <p class="col-2 mx-auto text-white">DATE</p>
                                        <p class="col-2 mx-auto text-white">NAME</p>
                                        <p class="col-2 mx-auto text-white">SERVICE</p>
                                        <p class="col-2 mx-auto text-white">STAFF</p>
                                        <p class="col-2 mx-auto text-white">COUPON</p>
                                    </div>
                                    <?php if($monthly_reservations != 0) : ?>
                                    <?php foreach($monthly_reservations as $reservation) : ?>
                                        <div class="row border-bottom">
                                            <p class="col-2 mx-auto text-dark"><?= substr($reservation['reservation_date'], 5); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getUserNameByID($reservation['user_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getServiceNameById($reservation['service_id']); ?></p>
                                            <p class="col-2 mx-auto text-dark"><?= $retrieve->getStaffNameById($reservation['staff_id']); ?></p>
                                            <div class="col-2 mx-auto text-dark">
                                                <?php if($retrieve->getCouponInfo($reservation['uc_id']) != 0) : ?>
                                                <?php foreach($retrieve->getCouponInfo($reservation['uc_id']) as $coupon) : ?>
                                                    <p class="text-dark" style="overflow: hidden;"><?= $coupon['coupon_name']; ?></p>
                                                    <p class="text-dark"><?= $coupon['coupon_value']; ?> %</p>
                                                <?php endforeach ; else: ?>
                                                    <p class="text-dark">-----</p>
                                                <?php endif ; ?>
                                            </div>
                                        </div>
                                    <?php endforeach ; ?>
                                    <?php endif ; ?>
                                </div><!--/modal-body-->
                            </div><!--/modal-content-->
                        </div><!--/modal-dialog-->
                    </div><!--/modal-->

            </tr>
        </thead>
        <tbody>
            <tr>
                <?php if($monthly_reservations != 0) : // there are some reservations?>
                <?php foreach($services as $service) : //repeat by number of services?>
                <?php if($service['service_status'] == "A") : //display only available service?>
                    <td>
                        <?= number_format($retrieve->calcMonthlyServiceProfit($service['service_id'], $month), 2); ?>
                    </td>
                <?php endif ;?>
                <?php endforeach; ?>
                    <td class="font-weight-bold">
                        <?php echo number_format($retrieve->calcMonthlyProfits($month), 2); ?>
                    </td>
                <?php else : //no reservations ?>
                    <?php foreach($services as $service) : ?>
                    <?php if($service['service_status'] =="A") : ?>
                        <td>0.00</td>
                    <?php endif ; ?>
                    <?php endforeach ; ?>
                    <td>0.00</td>
                <?php endif ; ?>
            </tr>
            <tr class="table-info">
                <?php foreach($services as $service) : if($service['service_status'] == "A") : ?>
                    <td><?= $retrieve->getMonthlyCustomers($month, $service['service_id']); ?></td>
                <?php endif; endforeach ; ?>
                <td><?= $retrieve->getMonthlyTotalCustomers($month); ?></td>
            </tr>
        </tbody>
    </table>
<?php endif ; ?>

<?php
    
; ?>