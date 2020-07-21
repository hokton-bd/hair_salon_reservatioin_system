<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "U") {
        header("Location: login.php");
    }
    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }

    $user_id = $retrieve->getUserIdByLoginId($_SESSION['login_id']);
    list($name, $birthday, $gender, $contact_number, $user_status, $email, $login_id) = $retrieve->getEachUser($user_id);
 ?>

    <!-- Hero Area Section Begin -->
    <div class="hero-area set-bg other-page" data-setbg="img/top.jpg">
        
    </div>
    <!-- Hero Area Section End -->
        <?php require_once 'reservationForm.php' ; ?>    

    <?php $retrieve->displayMessage() ; ?>
    <section class="services-section spad pt-5">
    <div class="container">

        <h2 class="text-center text-white my-5">Welcome <a href="updateUserProfile.php?id=<?= $user_id; ?>" class="text-primary"><?= $name; ?></a></h2>

        <div class="row">

        <div class="row col-12 mb-5">
            <a href="coupon.php" class="btn btn-info mx-auto d-block">We have added new coupon!</a>
        </div>

        <div class="mx-auto col-12 mb-5">
            <h5 class="text-white mb-3">Coming Reservation</h5>
            <table class="table table-hover table-light text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>DATE</th>
                        <th>TIME</th>
                        <th>SERVICE</th>
                        <th>STAFF</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($retrieve->getComingReservations($user_id) as $row) : ?>
                    <?php if($row['reservation_status'] == "O") : ?>
                        <tr>
                            <td><?= $row['reservation_date']; ?></td>
                            <td><?= substr($row['reservation_time'], 0, 5); ?></td>
                            <td><?= $retrieve->getServiceNameById($row['service_id']); ?></td>
                            <td><?= $retrieve->getStaffNameById($row['staff_id']); ?></td>
                            <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning text-light" data-toggle="modal" data-target="#reservation_<?= $row['reservation_id']; ?>">
                                Cancel
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="reservation_<?= $row['reservation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Cancel</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>
                                            <div class="modal-body">
                                                Do you cancel this reservation?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                                <a href="action.php?actiontype=cancel_reserve&id=<?= $row['reservation_id']; ?>" type="button" class="btn btn-secondary">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php endforeach ; ?>
                </tbody>
            </table>
        </div><!--end col-5 -->

        <div class="col-12 mx-auto">
            <h5 class="text-white mb-3">History Reservations</h5>
            <table class="table table-hover table-light text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>DATE</th>
                        <th>TIME</th>
                        <th>SERVICE</th>
                        <th>STAFF</th>
                        <th>PRICE</th>
                        <th></th>
                    </tr>
                    <?php foreach($retrieve->getUserHistoryReservation($user_id) as $row_h) : ?>
                        <tr>
                            <td><?= $row_h['reservation_date']; ?></td>
                            <td><?= substr($row_h['reservation_time'], 0, 5); ?></td>
                            <td><?= $retrieve->getServiceNameById($row_h['service_id']); ?></td>
                            <td><?= $retrieve->getStaffNameById($row_h['staff_id']); ?></td>
                            <td><?= $retrieve->getServicePriceById($row_h['service_id']); ?> PHP</td>
                            <td>
                                <?php if($retrieve->checkReviewed($row_h['reservation_id']) == true) : ?>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#review_<?= $row_h['reservation_id']; ?>">
                                  Review
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="review_<?= $row_h['reservation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Rate this service and staff</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>
                                            <form method="post" action="action.php">
                                                <input type="hidden" name="reservation_id" value="<?= $row_h['reservation_id']; ?>">
                                                <div class="modal-body">
                                                    <p class="text-dark font-weight-bold">Service</p>
                                                    <div class="row review-list">
                                                        <label class="review-item" for="service1"><span class="review_num">1</span>
                                                            <input required type="radio" name="rate_service" value="1" id="service1">
                                                        </label>
                                                        <label class="review-item" for="service2"><span class="review_num">2</span>
                                                            <input required type="radio" name="rate_service" value="2" id="service2">
                                                        </label>
                                                        <label class="review-item" for="service3"><span class="review_num">3</span>
                                                            <input required type="radio" name="rate_service" value="3" id="service3">
                                                        </label>
                                                        <label class="review-item" for="service4"><span class="review_num">4</span>
                                                            <input required type="radio" name="rate_service" value="4" id="service4">
                                                        </label>
                                                        <label class="review-item" for="service5"><span class="review_num">5</span>
                                                            <input required type="radio" name="rate_service" value="5" id="service5">
                                                        </label>
                                                    </div>
                                                
                                                    <p class="text-dark font-weight-bold">Staff</p>
                                                    <div class="row review-list">
                                                        <label class="review-item" for="staff1"><span class="review_num">1</span>
                                                            <input required type="radio" name="rate_staff" value="1" id="staff1">
                                                        </label>
                                                        <label class="review-item" for="staff2"><span class="review_num">2</span>
                                                            <input required type="radio" name="rate_staff" value="2" id="staff2">
                                                        </label>
                                                        <label class="review-item" for="staff3"><span class="review_num">3</span>
                                                            <input required type="radio" name="rate_staff" value="3" id="staff3">
                                                        </label>
                                                        <label class="review-item" for="staff4"><span class="review_num">4</span>
                                                            <input required type="radio" name="rate_staff" value="4" id="staff4">
                                                        </label>
                                                        <label class="review-item" for="staff5"><span class="review_num">5</span>
                                                            <input required type="radio" name="rate_staff" value="5" id="staff5">
                                                        </label>
                                                    </div>

                                                    <p class="text-dark font-weight-bold">Comment</p>
                                                    <textarea name="comment" id="" cols="30" rows="10" placeholder="Comment" style="resize: none;" class="form-control"></textarea>
                                                    
                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" style="border: none;"><input type="submit" name="review" value="Save" class="form-control btn-primary btn"></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach ; ?>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>

        </div><!--end row-->
    </div><!--end container-->
    </section>
    <!-- Room Section End -->
    <?php require_once 'inner_footer.php' ; ?>