<?php 
    // session_start();
    include 'header.php';
    $_SESSION['message'] = "";
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "O") {
        header("Location: index.php");
    }

    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }
 ?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

        <h3 class="text-center text-white mb-5">Dashboard</h3>

        <div class="row row-cols-1 row-cols-md-2">

            <!-- services -->
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card bg-secondary">
                    <span class="card-icon bg-secondary">
                        <i class="fas fa-folder-minus text-dark"></i>
                    </span>
                    <div class="card-body">
                        <h5 class="card-title text-white">Services</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                        <div class="dropdown">
                            <button id="toggler-service" class="btn btn-outline-light dropdown-toggle" type="button">
                                Action
                            </button>
                            <div id="service-menu" class="dropdown-menu">
                                <a class="dropdown-item" href="addService.php">Add New Service</a>
                                <a class="dropdown-item" href="allServices.php">Browse Services</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--end card-->

            <!-- staffs -->
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card bg-info">
                    <span class="card-icon bg-info">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="card-body">
                        <h5 class="card-title text-white">Staffs</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle toggler-staff" type="button">
                                Action
                            </button>
                            <div class="dropdown-menu staff-menu">
                                <a class="dropdown-item" href="addStaff.php">Add New Staff</a>
                                <a class="dropdown-item" href="allStaffs.php">Browse Staffs</a>
                                <a class="dropdown-item" href="schedule.php">Browse Schedule</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--end card-->

            <!-- customers -->
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card bg-primary">
                    <span class="card-icon bg-primary">
                        <i class="fas fa-id-card"></i>
                    </span>
                    <div class="card-body">
                        <h5 class="card-title text-white">Customers</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle toggler-customers" type="button">
                                Action
                            </button>
                            <div class="dropdown-menu customers-menu">
                                <a class="dropdown-item" href="allCustomers.php">Browse Customers</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--end card-->

            <!-- reports -->
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card bg-warning">
                    <span class="card-icon bg-warning">
                        <i class="fas fa-sticky-note"></i>
                    </span>
                    <div class="card-body">
                        <h5 class="card-title text-white">Reports</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle toggler-reports" type="button">
                                Action
                            </button>
                            <div class="dropdown-menu reports-menu">
                                <a class="dropdown-item" href="reports.php">Browse Reports</a>
                                <a class="dropdown-item" href="owner_reservations.php">Browse Reservations</a>
                                <a class="dropdown-item" href="coupon_reports.php">Browse Coupons</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--end card-->

            <!-- Coupons -->
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card bg-success">
                    <span class="card-icon bg-success">
                        <i class="fas fa-ticket-alt"></i>
                    </span>
                    <div class="card-body">
                        <h5 class="card-title text-white">Coupons</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle toggler-coupons" type="button">
                                Action
                            </button>
                            <div class="dropdown-menu coupons-menu">
                                <a class="dropdown-item" href="generateCoupons.php">Generate Coupons</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--end card-->


        </div><!--end row-->
    </div><!--end container-->
    </section>
    <!-- Room Section End -->


<footer id="footer" class="footer-section">
<?php require_once 'inner_footer.php' ; ?>