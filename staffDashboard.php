<?php 
    include 'header.php';
    $_SESSION['message'] = "";
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    } else if($_SESSION['login_id'] != null && $_SESSION['status'] != "S") {
        header("Location: index.php");    
    }
    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }

    $staff_id = $retrieve->getStaffId($_SESSION['login_id']);
    $shifts = $retrieve->getStaffShift($staff_id);
 ?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

        <h3 class="text-center text-white mb-5">Staff Dashboard</h3>

        <div class="row mb-5">
            <table class="table table-hover table-light text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>WEEK</th>
                        <th>HOURS</th>
                        <th>BREAK</th>
                        <th>DAY OFF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($shifts != 0) : ?>
                    <?php foreach($shifts as $shift) : ?>
                        <tr>
                            <td><?= substr($shift['start_date'], 5)." - ".substr($shift['end_date'], 5); ?></td>
                            <td><?= substr($shift['shift_start'], 0, 5)." - ".substr($shift['shift_end'], 0, 5); ?></td>
                            <td><?= substr($shift['break_start'], 0, 5)." - ".substr($shift['break_end'], 0, 5); ?></td>
                            <td class="text-uppercase"><?= substr($shift['day_off'], 5); ?></td>
                        </tr>
                    <?php endforeach ; ?>
                    <?php endif ; ?>
                </tbody>
            </table>
        </div>

        <div class="row row-cols-1 row-cols-md-2">

            <!-- Update profile -->
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card bg-success">
                    <span class="card-icon bg-success">
                        <i class="fas fa-folder-minus text-dark"></i>
                    </span>
                    <div class="card-body">
                        <h5 class="card-title text-white">Profile</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle toggler-profile" type="button">
                                Action
                            </button>
                            <div class="dropdown-menu profile-menu">
                                <a class="dropdown-item" href="updateStaffProfile.php?id=<?= $staff_id; ?>">Update Profile</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--end card-->

            <!-- Reservations -->
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card bg-info">
                    <span class="card-icon bg-info">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="card-body">
                        <h5 class="card-title text-white">Reservations</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle toggler-reservations" type="button">
                                Action
                            </button>
                            <div class="dropdown-menu reservations-menu">
                                <a class="dropdown-item" href="reservations.php">See Reservations</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--end card-->

        </div><!--end row-->
    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>