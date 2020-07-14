<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "O") {
        header("Location: index.php");
    } 
    
    $rows = $retrieve->getAllStaffs();
    $rows_se = $retrieve->getAllServices();
 ?>
 <html>
 <body>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">
    <a href="ownerDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5">All Services</h3>

        <div class="card-deck row">
            <?php foreach($rows as $row) : ?>

                <div class="col-md-4 col-lg-3 mb-3">
                    <div class="card bg-info text-light service-item">
                        <?php if($row['staff_status'] == "A") : ?>
                            <span class="badge badge-primary status-badge">A</span>
                        <?php else : ?>
                            <span class="badge badge-danger status-badge">D</span>
                        <?php endif ; ?>
                        <div class="card-img-box">
                            <img src="img/staffs/<?= $row['picture']?>" class="card-img-top" alt="...">
                        </div><!--card img box-->

                        <div class="card-body">
                            <h5 class="card-title text-light text-center"><?= $row['name'] ; ?></h5>
                            <?php foreach($rows_se as $row_se) : ?>
                            <p class="card-text text-center"><?= $retrieve->getServiceNameById($row_se['service_id']); ?></p>
                            <?php endforeach ; ?>
                        </div><!--card body-->

                        <div class="card-footer text-center">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning text-white mt-1 mx-auto" data-toggle="modal" data-target="#staff_<?= $row['staff_id']; ?>">
                              De/Activate
                            </button>
                            <a type="button" href="updateStaff.php?id=<?= $row['staff_id']; ?>" class="btn btn-primary text-white mt-2 staff-update-btn">Update</a>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="staff_<?= $row['staff_id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change Staff status</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div><!--modal header-->
                                        <div class="modal-body text-dark">
                                            <?php if($row['staff_status'] == "A") : ?>
                                                This Staff is now <strong>Activate</strong><br>
                                                Do you change to <strong>Deactivate</strong>?
                                            <?php else: ?>
                                                This Staff is now <strong>Deactivate</strong><br>
                                                Do you change to <strong>Activate</strong>?
                                            <?php endif ; ?>
                                        </div><!--modal body-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <a href="action.php?actiontype=changeStaffStatus&id=<?= $row['staff_id']?>" type="button" class="btn btn-info">Yes</a>
                                        </div><!--modal footer-->
                                    </div><!--modal content-->
                                </div><!--modal dialog-->
                            </div><!--modal-->

                        </div><!--card footer-->

                    </div><!--card -->
                </div>
            <?php endforeach ; ?>
        </div><!--end card-deck-->

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>