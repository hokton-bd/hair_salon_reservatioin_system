<?php
    include 'header.php' ;  
    require_once 'classes/RetrieveSQL.php';
    $retrieve = new RetrieveSQLStatements();
; ?>
    <!-- Hero Area Section Begin -->
    <div class="hero-area set-bg other-page" data-setbg="img/top.jpg">
    </div>
    <!-- Hero Area Section End -->

    <?php 
        $retrieve->displayMessage();
     ; ?>
    <!-- About Us Section Begin -->
    <section class="about-us spad">
        <div class="container">
            <h3 class="text-center text-white mb-4">Login</h3>
            <div class="row">
                <form method="post" action="action.php" id="register-form" class="col-lg-6 mx-auto">

                    <input required type="email" name="email" placeholder="Email" class="form-control mb-3">
                    <input required type="password" name="pass" placeholder="Password" class="form-control mb-3">
                
                    <div class="row col-12">
                        <input id="login-btn" class="form-btn" type="submit" name="login" value="Login" class="form-control w-100">
                    </div>
                    <a href="register.php" class="btn btn-primary col-6 mt-5 d-block mx-auto">Not yet registered? Click here!</a>
                    </form>

            </div><!--end row-->
        </div>
    </section>
    <!-- About Us Section End -->


 <?php include 'footer.php' ; ?>