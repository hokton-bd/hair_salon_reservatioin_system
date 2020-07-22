<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] == "S" || $_SESSION['status'] == "U") {
        header("Location: index.php");
    }
    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }
    $date = date('Y-m-d');
    $year = substr($date, 0, 4);
    $services = $retrieve->getAllServices();
    $reservations = $retrieve->getDailyDoneReservations($date);
 ?>
 <html>
 <body>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

    <?php if($_SESSION['status'] == "A") : ?>
        <a href="adminDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
    <?php endif; ?>
    <?php if($_SESSION['status'] == "O") : ?>
        <a href="ownerDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
    <?php endif; ?>

        <h3 class="text-center text-white mb-3">Reports</h3>

        <h5 class="text-center text-light mb-5"><i>Running Total Income: <span class="font-weight-bold"><?= number_format($retrieve->calcYearIncome($year), 2) ;?></span></i></h5>

            <div class="row mb-4">
                <input id="date-select" type="date" name="" placeholder="YYYY/mm/dd" class="form-control col-3 mx-auto" value="<?= $date; ?>">
                <select name="month" id="month-select" class="form-control col-3 mx-auto">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div id="report-table">
            <h5 class="text-center text-light col-12 mb-2">Daily Income Report</h5>
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

            </div><!--report table-->

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>