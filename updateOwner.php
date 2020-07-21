<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "A") {
        header("Location: index.php");    
    }
    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }
    list($staff_id, $staff_name, $gender, $picture, $position, $staff_status, $login_id, $email, $pass) = $retrieve->getEachStaff($_GET['id']);
?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="allStaffs.php" class="btn btn-outline-light">Back</a>
        <h3 class="text-center text-white mb-5 ml-5">Update Owner</h3>

        <?php $retrieve->displayMessage() ; ?>
        <form method="post" action="action.php" class="row mx-auto" enctype="multipart/form-data">
            <input type="hidden" name="staff_id" value="<?= $_GET['id']?>">

            <div class="col-7">

                <div class="mb-2">
                    <input type="text" name="staff_name" id="" class="form-control bg-secondary text-light mb-3" placeholder="Name" value="<?= $staff_name?>" disabled>
                </div>
                <div class="mb-2">
                    <input type="text" name="new_staff_name" id="" class="form-control mb-3" placeholder="Name" placeholder="New name">
                </div>
                <div class="row mb-2">
                    <span class="text-light mr-3 ml-3">Gender</span>
                    <?php switch($gender) : case "male": ?>
                        <label class="text-white mr-3" for="male">Male<input class="ml-1" type="radio" name="gender" id="male" value="male" required checked></label>
                        <label class="text-white mr-3" for="female">Female<input class="ml-1" type="radio" name="gender" id="female" value="female" required></label>
                        <label class="text-white mr-3" for="other">Other<input class="ml-1" type="radio" name="gender" id="other" value="other" required></label>
                        <?php break; ?>

                        <?php case "female": ?>
                        <label class="text-white mr-3" for="male">Male<input class="ml-1" type="radio" name="gender" id="male" value="male" required></label>
                        <label class="text-white mr-3" for="female">Female<input class="ml-1" type="radio" name="gender" id="female" value="female" required checked></label>
                        <label class="text-white mr-3" for="other">Other<input class="ml-1" type="radio" name="gender" id="other" value="other" required></label>
                        <?php break; ?>
                        
                        <?php case "other": ?>
                        <label class="text-white mr-3" for="male">Male<input class="ml-1" type="radio" name="gender" id="male" value="male" required></label>
                        <label class="text-white mr-3" for="female">Female<input class="ml-1" type="radio" name="gender" id="female" value="female" required></label>
                        <label class="text-white mr-3" for="other">Other<input class="ml-1" type="radio" name="gender" id="other" value="other" required checked></label>
                        <?php break; ?>
                        
                    <?php endswitch ; ?>
                </div>

                <div class="mb-2">
                    <input type="text" name="position" class="form-control" placeholder="Position" value="<?= $position?>" required>
                </div>

                <div class="mb-2">
                    <input type="email" name="email" id="" class="form-control bg-secondary text-light" placeholder="Email" required value="<?= $email?>" disabled>
                </div>
                <div class="mb-2">
                    <input type="email" name="new_email" id="" class="form-control" placeholder="Email" placeholder="New Email" value="">
                </div>

                <div class="">    
                    <input type="password" name="pass" id="" class="form-control" placeholder="Password" required value="<?= $pass?>">
                </div>

            </div>

            <div class="col-5">

                <div class="input-group mb-3 mr-0">
                    <div class="staff-img-box mb-2">
                        <img src="img/owner/<?= $picture?>" alt="" class="staff-img">
                    </div>
                    <div class="custom-file mr-0">
                        <input type="file"  name="staff_picture" class="custom-file-input mr-0" id="select-img" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label mr-0" for="select-img">Choose file</label>
                    </div>
                </div>

            </div>

            <input class="form-control btn form-btn col-3 mx-auto mt-5" type="submit" name="update_owner" value="Update">
        </form>   

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>