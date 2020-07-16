<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "O") {
        header("Location: index.php");    
    }   
    $date = date('Y-m-d');
    $services = $retrieve->getAllServices();
 ?>
 <html>
 <body>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">
    <a href="ownerDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5">Reports</h3>

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
                <h5 class="text-center text-light col-12 mb-2">Daily Report</h5>
                    <table class="table table-light mb-0 text-center">
                        <thead class="thead-dark">
                            <tr>
                            <?php foreach($services as $service) : ?>
                            <?php if($service['service_status'] == "A") : ?>
                                <th><?= $service['service_name']; ?></th>
                            <?php endif ; ?>
                            <?php endforeach ; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($retrieve->getDailyDoneReservations($date) != false) :
                                    $daily_reservations = $retrieve->getDailyDoneReservations($date);
                                    foreach($daily_reservations as $reservation) :
                                        $user_name = $retrieve->getUserNameById($reservation['user_id']);
                                        $service_name = $retrieve->getServiceNameById($reservation['service_id']);
                                        $staff_name = $retrieve->getStaffNameById($reservation['staff_id']);
                                ?>
                                <tr>
                                    <td><?= $user_name; ?></td>
                                    <td><?= substr($reservation['reservation_time'], 0, 5); ?></td>
                                    <td><?= $service_name; ?></td>
                                    <td><?= $staff_name; ?></td>
                                    <td><?= $reservation['payment']; ?></td>
                                </tr>
                            <?php endforeach ; ?>
                            <tr>
                                <td colspan="4" class="text-left font-weight-bold pl-5">TOTAL</td>
                                <td class="font-weight-bold"><?php echo $retrieve->calcDailyProfits($date); ?></td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

            </div><!--report table-->

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>