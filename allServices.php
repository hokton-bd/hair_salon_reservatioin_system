<?php 
    include 'header.php';
    require_once 'classes/RetrieveSQL.php';

    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "O") {
        header("Location: index.php");    
    }
    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }
    $rows = $retrieve->getAllServices();
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
            <?php foreach($rows as $row) : 
                $service_rating = $retrieve->calcServiceRate($row['service_id']);
                $service_id = $row['service_id'];
            ?>

                <div class="col-md-4 col-lg-3 mb-3">
                    <div class="card bg-secondary text-light service-item">
                        <?php if($row['service_status'] == "A") : ?>
                            <span class="badge badge-primary status-badge">A</span>
                        <?php else : ?>
                            <span class="badge badge-danger status-badge">D</span>
                        <?php endif ; ?>
                        <div class="card-img-box">
                            <img src="img/services/<?= $row['picture']?>" class="card-img-top" alt="...">
                        </div><!--card img box-->

                        <div class="card-body">
                            <h5 class="card-title text-light text-center text-uppercase"><?= $row['service_name'] ; ?></h5>
                            <p class="card-text text-center"><?= $row['service_description']; ?></p>
                            <p class="card-text text-center">Rate: 
                                <?php if($service_rating != false) : if($service_rating >= 3) : ?>
                                    <a href="service_reviews.php?id=<?= $service_id; ?>" class="text-warning"><?= $service_rating ;?></a>
                                <?php else : ?>
                                    <a href="service_reviews.php?id=<?= $service_id; ?>" class="text-danger"><?= $service_rating ;?></a>
                                <?php endif; else : ?>
                                    <span class="text-light">No Rate</span>
                                <?php endif ; ?>
                            </p>
                        </div><!--card body-->

                        <div class="card-footer text-center">
                            Price: <?= $row['price']; ?> PHP
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-light mt-1 mx-auto" data-toggle="modal" data-target="#service_<?= $service_id; ?>">
                              De/Activate
                            </button>
                            <a type="button" href="updateService.php?id=<?= $service_id; ?>" class="btn btn-outline-info text-white mt-2 service-update-btn">Update</a>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="service_<?= $service_id?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change Service status</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div><!--modal header-->
                                        <div class="modal-body text-dark">
                                            <?php if($row['service_status'] == "A") : ?>
                                                This service is now <strong>Activate</strong><br>
                                                Do you change to <strong>Deactivate</strong>?
                                            <?php else: ?>
                                                This service is now <strong>Deactivate</strong><br>
                                                Do you change to <strong>Activate</strong>?
                                            <?php endif ; ?>
                                        </div><!--modal body-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <a href="action.php?actiontype=change&id=<?= $service_id?>" type="button" class="btn btn-info">Yes</a>
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