<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "O") {
        header("Location: index.php");    
    }
    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }
    $rows = $retrieve->getAllUsers();
 ?>
 <html>
 <body>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">
    <a href="ownerDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5">All Customers</h3>

        <table class="table text-center table-hover table-light table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>BIRTHDAY</th>
                    <th>VISITED</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rows as $row) : ?>
                    <tr>
                        <td style="font-size: 14px; position: relative;">
                            <?php if($row['user_status'] == "A") : ?>
                                <span class="badge badge-primary status-badge">A</span>
                            <?php else : ?>
                                <span class="badge badge-danger status-badge">D</span>
                            <?php endif ; ?>
                            <a class="text-dark" href="customer_detail.php?id=<?= $row['user_id']?>"><?= $row['user_id'] ;?></a>
                        </td>
                        <td style="font-size: 14px;"><a class="text-dark" href="customer_detail.php?id=<?= $row['user_id']?>"><?= $row['name']; ?></a>
                        </td>
                        <td style="font-size: 14px;"><?= $row['gender']; ?></td>
                        <td style="font-size: 14px;"><?= $row['email']; ?></td>
                        <td style="font-size: 14px;"><?= $row['contact_number']; ?></td>
                        <td style="font-size: 14px;"><?= $row['birthday']; ?></td>
                        <td style="font-size: 14px;"><?= $retrieve->getDoneReservations($row['user_id']); ?></td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#user_<?= $row['user_id']?>">
                            De/Activate
                            </button>
                        </td>
                        <!-- Modal -->
                        <div class="modal fade" id="user_<?= $row['user_id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Change Customer status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div><!--modal header-->
                                    <div class="modal-body text-dark">
                                        <?php if($row['user_status'] == "A") : ?>
                                            This Customer is now <strong>Activate</strong><br>
                                            Do you change to <strong>Deactivate</strong>?
                                        <?php else: ?>
                                            This Customer is now <strong>Deactivate</strong><br>
                                            Do you change to <strong>Activate</strong>?
                                        <?php endif ; ?>
                                    </div><!--modal body-->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <a href="action.php?actiontype=changeUserStatus&id=<?= $row['user_id']?>" type="button" class="btn btn-danger">Yes</a>
                                    </div><!--modal footer-->
                                </div><!--modal content-->
                            </div><!--modal dialog-->
                        </div><!--modal-->

                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>