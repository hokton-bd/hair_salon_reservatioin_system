<?php 
    include 'header.php'; 
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "O") {
        header("Location: index.php");    
    }
?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <?php $retrieve->displayMessage() ; ?>
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="ownerDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5 d-inline-block ml-5">Add New Staff</h3>

        <form method="post" action="action.php" class="row mx-auto" enctype="multipart/form-data">
            <div class="col-6">
                <input type="text" name="staff_name" id="" class="form-control mb-3" placeholder="Name" required>
            </div>
            <div class="row col-5 ml-1">
                <label class="text-white mr-3" for="male">Male<input class="ml-1" type="radio" name="gender" id="male" value="male" required></label>
                <label class="text-white mr-3" for="female">Female<input class="ml-1" type="radio" name="gender" id="" value="female" required></label>
                <label class="text-white mr-3" for="other">Other<input class="ml-1" type="radio" name="gender" id="" value="other" required></label>
            </div>

            <div class="col-6">
                <input type="text" name="position" class="form-control" placeholder="Position" required>
            </div>

            <div class="input-group mb-3 col-6 mr-0">
                <div class="custom-file mr-0">
                    <input type="file" name="staff_picture" class="custom-file-input mr-0" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                    <label class="custom-file-label mr-0" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
                <div class="col-6">
                    <input type="email" name="email" id="" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-6">    
                    <input type="password" name="pass" id="" class="form-control" placeholder="Password" required>
                </div>
        
            <input class="form-control btn form-btn col-3 mx-auto mt-5" type="submit" name="add_staff" value="Add">
        </form>   

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>