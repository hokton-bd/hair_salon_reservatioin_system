<?php 
    // session_start();
    include 'header.php';
    $_SESSION['message'] = "";
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    
    
 ?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

        <h3 class="text-center text-white mb-5">Admin Dashboard</h3>

        <div class="row row-cols-1 row-cols-md-2">

            <!-- staffs -->
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card bg-info">
                    <span class="card-icon bg-info">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="card-body">
                        <h5 class="card-title text-white">Owners</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle toggler-owner" type="button">
                                Action
                            </button>
                            <div class="dropdown-menu owner-menu">
                                <a class="dropdown-item" href="add_ownerAccount.php">Add Account</a>
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
                                <a class="dropdown-item" href="allStaffs.php">Browse Staffs</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--end card-->

              <!-- reports -->
              <div class="col-md-4 col-lg-3 mb-4">
                <div class="card bg-danger">
                    <span class="card-icon bg-danger">
                        <i class="fas fa-building"></i>
                    </span>
                    <div class="card-body">
                        <h5 class="card-title text-white">Company</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>

                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle toggler-company" type="button">
                                Action
                            </button>
                            <div class="dropdown-menu company-menu">
                                <?php if($_SESSION['admin_status'] == "A") : ?>
                                    <a class="dropdown-item" href="action.php?actiontype=deactivate_company">Deactivate</a>
                                <?php else : ?>
                                    <a class="dropdown-item" href="action.php?actiontype=activate_company">Activate</a>
                                <?php endif ; ?>
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