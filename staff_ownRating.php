<?php 
    include 'header.php';
    $_SESSION['message'] = "";
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    } else if($_SESSION['login_id'] != null && $_SESSION['status'] != "S") {
        header("Location: index.php");    
    }
    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }
    $staff_id = $_GET['id'];
    $reviews = $retrieve->getStaffReview($staff_id);
    $staff_rating = $retrieve->calcStaffRate($staff_id);
 ?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="staffDashboard.php" class="btn btn-outline-light mb-2">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5">Your Rating / Average: 
            <?php if($staff_rating >= 3) : ?>
                <span class="text-primary"><?= $staff_rating ;?></span>
            <?php else : ?>
                <span class="text-danger"><?= $staff_rating ;?></span>
            <?php endif ; ?>
        </h3>

        <table class="table mb-0 table-light text-center">
            <thead class="thead-dark">
                <tr class="text-uppercase">
                    <th>date</th>
                    <th>rate</th>
                    <th>comment</th>
                </tr>
            </thead>
            <tbody>
                <?php if($reviews != false) : ?>
                    <?php foreach($reviews as $review) : ?>
                        <tr>
                            <td><?= substr($review['reservation_date'], 5) ;?></td>
                            <td>
                                <?php if($review['staff_rating'] >= 3) : ?>
                                    <span class="text-primary"><?= number_format($review['staff_rating'], 1) ;?></span>
                                <?php else : ?>
                                    <span class="text-danger"><?= number_format($review['staff_rating'], 1) ;?></span>
                                <?php endif ; ?>
                            </td>
                            <td><?= $review['comment'] ;?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        
    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>