<?php 
    include 'header.php';
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    } 
    if($_SESSION['status'] != "O") {
        header("Location: index.php");    
    }
    list($service_id, $service_name, $price, $picture, $service_description, $service_status) = $retrieve->getEachService($_GET['id']);
?>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">

        <a href="ownerDashboard.php" class="btn btn-outline-light">Back to Services</a>
        <h3 class="text-center text-white mb-5">Update service</h3>

        <?php $retrieve->displayMessage() ; ?>
        
        <form method="post" action="action.php" class="row mx-auto" enctype="multipart/form-data">
            <input type="hidden" name="service_id" value="<?= $service_id?>">
            <div class="row col-12 px-0 ml-1">

                <div class="col-7">
                    <input class="form-control mb-2" type="text" name="service_name" placeholder="Name" required value="<?= $service_name?>">

                    <div class="input-group mb-2 p-0 mr-5">
                        <input class="form-control" type="number" name="price" placeholder="Price" required value="<?= $price?>">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">PHP</label>
                        </div>
                    </div>

                    

                    <textarea class="form-control mb-4" name="service_description" id="" cols="30" rows="10" placeholder="Detail" required><?= $service_description?></textarea>

                </div><!--end col-7 -->

                <div class="col-5">
                    <div class="service-img-box mb-3">
                        <img src="img/services/<?= $picture?>" alt="">
                    </div>
                    <div class="input-group mb-2 p-0">
                        <div class="custom-file mr-0">
                            <input type="file" name="picture" class="custom-file-input mr-0" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label mr-0" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </div><!--end col-5 -->
            
            </div><!--end row--> 

               
            
        
            <input class="form-control btn form-btn col-3 mx-auto" type="submit" name="update_service" value="Update">
        </form>   

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php'; ?>