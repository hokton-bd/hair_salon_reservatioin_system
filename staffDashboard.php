<?php 
    include 'header.php';
    $_SESSION['message'] = "";
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    } else if($_SESSION['login_id'] != null && $_SESSION['status'] != "S") {
        header("Location: index.php");    
    }

    $staff_id = $retrieve->getStaffId($_SESSION['login_id']);

 ?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

        <h3 class="text-center text-white mb-5">Staff Dashboard</h3>

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