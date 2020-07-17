<?php 
    // session_start();
    include 'header.php';
    $_SESSION['message'] = "";
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    
 ?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

        <h3 class="text-center text-white mb-5">Admin Dashboard</h3>

        

        </div><!--end row-->
    </div><!--end container-->
    </section>
    <!-- Room Section End -->


<footer id="footer" class="footer-section">
<?php require_once 'inner_footer.php' ; ?>