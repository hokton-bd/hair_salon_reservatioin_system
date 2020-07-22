<?php 
    // session_start();
    include 'header.php';
    $_SESSION['message'] = "";
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    $staff_overall = number_format($retrieve->calcTotalStaffRate(), 1);
    $service_overall = number_format($retrieve->calcTotalServiceRate(), 1);
    $overall = number_format($retrieve->calcOverallRate(), 1);
 ?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

    <a href="adminDashboard.php" class="btn btn-outline-light mb-2">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5">Company Info</h3>


        <h5 class="text-center text-light mb-3">Rating Overall</h5>
        <table class="table table-light text-center mb-5">
            <thead class="thead-dark">
                <tr class="text-uppercase">
                    <th>staffs</th>
                    <th>services</th>
                    <th>total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php if($staff_overall >= 3) : ?>
                            <span class="text-primary"><?= $staff_overall ;?></span>
                        <?php else :  ?>
                            <span class="text-danger"><?= $staff_overall ;?></span>
                        <?php endif ; ?>
                    </td>
                    <td>
                        <?php if($service_overall >= 3) : ?>
                            <span class="text-primary"><?= $service_overall ;?></span>
                        <?php else :  ?>
                            <span class="text-danger"><?= $service_overall ;?></span>
                        <?php endif ; ?>
                    </td>
                    <td>
                        <?php if($overall >= 3) : ?>
                            <span class="text-primary"><?= $overall ;?></span>
                        <?php else :  ?>
                            <span class="text-danger"><?= $overall ;?></span>
                        <?php endif ; ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <h5 class="text-center text-light mb-3">Customers</h5>

        <table class="table table-light text-center mb-0">
            <thead class="thead-dark">
                <tr class="text-uppercase">
                    <th>active</th>
                    <th>non-active</th>
                    <th>total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row"><?= $retrieve->getActiveUsers() ;?></td>
                    <td><?= $retrieve->getNonactiveUsers() ;?></td>
                    <td><?= $retrieve->getTotalUsers() ;?></td>
                </tr>
                
            </tbody>
        </table>
       
    </div><!--end container-->
    </section>
    <!-- Room Section End -->


<footer id="footer" class="footer-section">
<?php require_once 'inner_footer.php' ; ?>