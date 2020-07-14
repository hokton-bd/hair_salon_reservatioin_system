<?php 
    include 'header.php'; 

    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    } 
    if($_SESSION['status'] != "O") {
        header("Location: index.php");    
    }
?>
    <?php include 'heroArea.php' ; ?>
    <?php if($_SESSION['message'] != null): ?>
        <p class="text-center p-2 bg-danger text-white mb-0"><?= $_SESSION['message']; ?></p>
    <?php endif ; ?>
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="ownerDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5 ml-5">Add New Service</h3>
        
        <?php $retrieve->displayMessage() ;//display error message ?>
        
        <form method="post" action="action.php" class="row mx-auto" enctype="multipart/form-data">
            <input class="form-control mb-2" type="text" name="service_name" placeholder="Name" required>

            <div class="row col-12 px-0 ml-1">

                <div class="input-group mb-2 col-4 p-0 mr-5">
                    <input class="form-control" type="number" name="price" placeholder="Price" required>
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">PHP</label>
                    </div>
                </div>

                <div class="input-group mb-2 col-7 ml-2 p-0">
                    <div class="custom-file mr-0">
                        <input type="file" name="picture" class="custom-file-input mr-0" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                        <label class="custom-file-label mr-0" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
            </div> 
            <textarea class="form-control mb-4" name="service_description" id="" cols="30" rows="10" placeholder="Detail" required></textarea>
        
            <input class="form-control btn form-btn col-3 mx-auto" type="submit" name="add_service" value="Add">
        </form>   

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>