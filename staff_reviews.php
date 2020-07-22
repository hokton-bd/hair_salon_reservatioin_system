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

    $reviews = $retrieve->getStaffReview($_GET['id']);

 ?>
 <html>
 <body>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="allStaffs.php" class="btn btn-outline-light">Back</a>
        <h3 class="text-center text-white mb-5">Staff Reviews</h3>

        <table class="table table-hover mb-0 text-center">
            <thead class="thead-dark">
                <tr>
                    <th>DATE</th>
                    <th>NAME</th>
                    <th>RATE</th>
                    <th>COMMENT</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php if($reviews != false) : ?>
                <?php foreach($reviews as $review) : ?>
                   <tr>
                       <td><?= substr($review['reservation_date'], 5) ;?></td>
                       <td><?= $retrieve->getUserNameById($review['user_id']) ;?></td>
                       <td><?= number_format($review['staff_rating'], 1) ;?></td>
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