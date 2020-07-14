<?php 
    include 'header.php'; 
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "O") {
        header("Location: index.php");    
    }

    $rows = $retrieve->getAllCoupons();
?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="ownerDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5 d-inline-block ml-5">Generate Coupon</h3>

        <?php $retrieve->displayMessage() ; ?>
        <form method="post" action="action.php" class="row mx-auto mb-5" enctype="multipart/form-data">
            <div class="row col-12 mb-3">
                <input class="form-control col-6 mx-auto" type="text" name="coupon_name" id="" placeholder="Coupon Name">
            </div>
            <div class="row col-6 mx-auto mb-3">
                <input class="form-control col-5 mx-auto" type="number" name="value" id="" placeholder="Value"> 
                <span class="ml-2 mr-3 text-white">%</span>
                <input class="form-control col-5 mx-auto" type="date" name="expiration" id="">
            </div>
            <div class="row col-12 mb-3">
                <textarea class="form-control mx-auto col-6" name="desc" id="" cols="30" rows="10" style="resize: none;" placeholder="Message"></textarea>
            </div>

            <input type="submit" value="Add" name="generate_coupon" class="form-control btn form-btn col-3">
        </form>

        <div class="row mx-auto mt-5">
            <table class="table table-hover table-light text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>VALUE</th>
                        <th>EXPIRATION</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rows as $row) : ?>
                        <tr>
                            <td><?= $row['coupon_id']; ?></td>
                            <td><?= $row['coupon_name']; ?></td>
                            <td><?= $row['coupon_value']; ?> %</td>
                            <td><?= $row['expiration']; ?></td>
                            <td><?php if($row['coupon_status'] == "A") : ?>
                                    <span class="badge badge-primary status-badge">A</span>
                                <?php else : ?>
                                    <span class="badge badge-danger status-badge">D</span>
                                <?php endif ; ?>
                            </td>
                            <td><?php if($row['coupon_status'] == "A") : ?>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#coupon_<?= $row['coupon_id']?>">
                                    Deactivate
                                </button>
                                <?php endif ; ?>
                            </td>
                        </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="coupon_<?= $row['coupon_id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Deactivate Coupon</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div><!--modal header-->
                                            <div class="modal-body text-dark">
                                                <?php if($row['coupon_status'] == "A") : ?>
                                                    Once you deactivate this coupon, you can't use this coupon ever.<br>
                                                    Are you sure to <strong>Deactivate</strong> this coupon?
                                                <?php endif ; ?>
                                            </div><!--modal body-->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <a href="action.php?actiontype=deactivateCoupon&id=<?= $row['coupon_id'];?>" type="button" class="btn btn-danger">Yes</a>
                                            </div><!--modal footer-->
                                        </div><!--modal content-->
                                    </div><!--modal dialog-->
                                </div><!--modal-->

                    <?php endforeach ; ?>
                </tbody>
            </table>
        </div>



    </div><!--end container-->
    </section>
    <!-- Room Section End -->
    <?php require_once 'inner_footer.php' ; ?>