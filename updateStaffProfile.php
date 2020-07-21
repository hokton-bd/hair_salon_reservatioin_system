<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] == "U") {
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
    <?php $retrieve->displayMessage(); ?>
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="staffDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5">Update Staff</h3>

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
                        <img src="img/staffs/<?= $picture?>" alt="" class="staff-img">
                    </div>
                    <div class="custom-file mr-0">
                        <input type="file" name="staff_picture" class="custom-file-input mr-0" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label mr-0" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>

            </div>

            <div class="row col-12">
                <input class="form-control btn form-btn col-4 mx-auto mt-5" type="submit" name="update_staff" value="Update">

                <button type="button" class="btn btn-warning text-white mx-auto mt-5 col-4" data-toggle="modal" data-target="#staff_<?= $staff_id; ?>" style="max-height: 35px;">
                    De/Activate
                </button>
            </div>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="staff_<?= $staff_id?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change own status</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div><!--modal header-->
                                        <div class="modal-body text-dark">
                                            <?php if($staff_status == "A") : ?>
                                                You are now <strong>Activate</strong><br>
                                                Do you change to <strong>Deactivate</strong>?
                                            <?php else: ?>
                                                You are now <strong>Deactivate</strong><br>
                                                Do you change to <strong>Activate</strong>?
                                            <?php endif ; ?>
                                        </div><!--modal body-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <a href="action.php?actiontype=changeOwnStatus&id=<?= $staff_id?>" type="button" class="btn btn-info">Yes</a>
                                        </div><!--modal footer-->
                                    </div><!--modal content-->
                                </div><!--modal dialog-->
                            </div><!--modal-->

        </form>   

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>