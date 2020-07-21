<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "U") {
        header("Location: index.php");    
    }
    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }

    $user_id = $retrieve->getUserIdByLoginId($_SESSION['login_id']);

    list($name, $birthday, $gender, $contact_number, $user_status, $email, $login_id, $pass) = $retrieve->getEachUser($_GET['id']);
?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <?php $retrieve->displayMessage() ; ?>
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="userDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5 d-inline-block ml-5">Update Profile</h3>

        <form method="post" action="action.php" class="row mx-auto" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?= $_GET['id']?>">

            <div class="col-12">

                <div class="mb-2">
                    <input type="text" name="user_name" id="" class="form-control bg-secondary text-light mb-3" placeholder="Name" value="<?= $name; ?>">
                </div>
                <div class="mb-2">
                    <input type="text" name="new_user_name" id="" class="form-control mb-3" placeholder="Name" placeholder="New name">
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
                </div>>

                <div class="mb-2">
                    <input type="email" name="email" id="" class="form-control bg-secondary text-light" placeholder="Email" required value="<?= $email; ?>">
                </div>
                <div class="mb-2">
                    <input type="email" name="new_email" id="" class="form-control" placeholder="Email" placeholder="New Email" value="">
                </div>

                <div class="">    
                    <input type="password" name="pass" id="" class="form-control" placeholder="Password" required>
                </div>

            </div>


            <div class="row col-12">
                <input class="form-control btn form-btn col-4 mx-auto mt-5" type="submit" name="update_user" value="Update">

                <button type="button" class="btn btn-warning text-white mx-auto mt-5 col-4" data-toggle="modal" data-target="#user_<?= $user_id; ?>" style="max-height: 35px;">
                    De/Activate
                </button>
            </div>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="user_<?= $user_id?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change own status</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div><!--modal header-->
                                        <div class="modal-body text-dark">
                                            <?php if($user_status == "A") : ?>
                                                You are now <strong>Activate</strong><br>
                                                Do you change to <strong>Deactivate</strong>?
                                            <?php else: ?>
                                                You are now <strong>Deactivate</strong><br>
                                                Do you change to <strong>Activate</strong>?
                                            <?php endif ; ?>
                                        </div><!--modal body-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <a href="action.php?actiontype=changeUserOwnStatus&id=<?= $user_id?>" type="button" class="btn btn-info">Yes</a>
                                        </div><!--modal footer-->
                                    </div><!--modal content-->
                                </div><!--modal dialog-->
                            </div><!--modal-->

        </form>   

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>