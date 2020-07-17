<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "O") {
        header("Location: index.php");    
    }
    $user_id = $_GET['id'];
    list($name, $birthday, $gender, $contact_number, $user_status, $email, $login_id, $pass) = $retrieve->getEachUser($user_id);
    list($d_count, $d_reservations) = $retrieve->getTotalReservations($user_id);
    list($c_count, $c_reservations) = $retrieve->getCanceledReservations($user_id);
    list($o_count, $o_reservations) = $retrieve->getOpenReservations($user_id);
 ;?>
 <html>
 <body>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">
    <a href="allCustomers.php" class="btn btn-outline-light">Back</a>
        <h3 class="text-center text-white mb-5"><?= $name; ?>'s Detail</h3>

        <h5 class="text-light mb-2 d-inline mr-5">Visited</h5><span class="bg-primary text-white px-3 py-1"><?= $d_count; ?></span>
        <table class="table text-center table-hover table-light table-striped mb-5 mt-3 w-100">
            <thead class="thead-dark d-table w-100">
                <tr>
                    <th class="w-25">DATE</th>
                    <th class="w-25">TIME</th>
                    <th class="w-25">SERVICE</th>
                    <th class="w-25">STAFF</th>
                </tr>
                
            </thead>
            <tbody style="overflow: scroll; max-height: 245px;" class="d-block w-100">
                <?php if($d_reservations != 0) : foreach($d_reservations as $value) : ?>
                    <tr class="d-table w-100">
                        <td class="w-25"><?= $value['reservation_date']; ?></td>
                        <td class="w-25"><?= $value['reservation_time']." - ".$value['end_time']; ?></td>
                        <td class="w-25"><?= $retrieve->getServiceNameById($value['service_id']); ?></td>
                        <td class="w-25"><?= $retrieve->getStaffNameById($value['staff_id']); ?></td>
                    </tr>
                <?php endforeach ; endif; ?>
                

            </tbody>
        </table>

        <h5 class="text-light mb-2 d-inline mr-5">Coming</h5><span class="bg-info text-white px-3 py-1"><?= $o_count; ?></span>
        <table class="table text-center table-hover table-light table-striped mt-3 mb-5 w-100">
            <thead class="thead-dark d-table w-100">
                <tr>
                    <th class="w-25">DATE</th>
                    <th class="w-25">TIME</th>
                    <th class="w-25">SERVICE</th>
                    <th class="w-25">STAFF</th>
                </tr>
                
            </thead>
            <tbody style="overflow: scroll; max-height: 245px;" class="d-block w-100">
                <?php if($o_reservations != 0) : foreach($o_reservations as $value) : ?>
                    <tr class="d-table w-100">
                        <td class="w-25"><?= $value['reservation_date']; ?></td>
                        <td class="w-25"><?= $value['reservation_time']." - ".$value['end_time']; ?></td>
                        <td class="w-25"><?= $retrieve->getServiceNameById($value['service_id']); ?></td>
                        <td class="w-25"><?= $retrieve->getStaffNameById($value['staff_id']); ?></td>
                    </tr>
                <?php endforeach ; endif;?>
                

            </tbody>
        </table>

        <h5 class="text-light mb-2 d-inline mr-5">Canceled</h5><span class="bg-danger text-white px-3 py-1"><?= $c_count; ?></span>
        <table class="table text-center table-hover table-light table-striped mt-3 mb-0 w-100">
            <thead class="thead-dark d-table w-100">
                <tr>
                    <th class="w-25">DATE</th>
                    <th class="w-25">TIME</th>
                    <th class="w-25">SERVICE</th>
                    <th class="w-25">STAFF</th>
                </tr>
                
            </thead>
            <tbody style="overflow: scroll; max-height: 245px;" class="d-block w-100">
                <?php if($c_reservations != 0) : ?>
                <?php foreach($c_reservations as $value) : ?>
                    <tr class="d-table w-100">
                        <td class="w-25"><?= $value['reservation_date']; ?></td>
                        <td class="w-25"><?= $value['reservation_time']." - ".$value['end_time']; ?></td>
                        <td class="w-25"><?= $retrieve->getServiceNameById($value['service_id']); ?></td>
                        <td class="w-25"><?= $retrieve->getStaffNameById($value['staff_id']); ?></td>
                    </tr>
                <?php endforeach ; endif; ?>
                
            </tbody>
        </table>

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>