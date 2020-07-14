<?php 
    include 'header.php'; 
    require_once 'classes/RetrieveSQL.php';

    $retrieve = new RetrieveSQLStatements();

; ?>
    <!-- Hero Area Section Begin -->
    <div class="hero-area set-bg other-page" data-setbg="img/top.jpg">
    </div>
    <!-- Hero Area Section End -->


    <?php $retrieve->displayMessage() ; ?>
    <!-- About Us Section Begin -->
    <section class="about-us spad">
        <div class="container">
        <h3 class="text-center text-white mb-4">Register</h3>
            <div class="row">
                
                <form method="post" action="action.php" id="register-form" class="col-lg-9 mx-auto">
                    <input required type="text" name="name" placeholder="Name" class="form-control mb-3">
                    <input required type="email" name="email" placeholder="Email" class="form-control mb-3">
                    <input required type="password" name="pass" placeholder="Password" class="form-control mb-3">
                    <div id="register-form-row" class="row col-12 mb-3 mr-0">
                        <input required type="date" name="birthday" id="" class="form-control col-3">
                        <div class="col-8 mx-auto">
                            <label for="male" class="mr-3">Male
                                <input required type="radio" name="gender" value="male" id="male" class="">
                            </label>
                            <label for="female" class="mr-3">Female
                                <input required type="radio" name="gender" value="female" id="female" class="">
                            </label>
                            <label for="other" class="mr-3">Other
                                <input required type="radio" name="gender" id="other" value="other" class="">
                            </label>
                        </div>
                    </div>
                    <input required type="number" name="contact_num" class="form-control mb-3" placeholder="Contact Number">
                
                    <input id="register-btn" name="register" type="submit" value="Register" class="form-control col-3 mx-auto d-block py-2 form-btn">
                </form>

            </div><!--end row-->
        </div>
    </section>
    <!-- About Us Section End -->


 <?php include 'footer.php' ; ?>