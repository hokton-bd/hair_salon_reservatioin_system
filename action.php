<?php 
    session_start();
    date_default_timezone_set("Asia/Tokyo");
    require_once 'classes/CreateSQL.php';
    require_once 'classes/RetrieveSQL.php';
    require_once 'classes/UpdateSQL.php';
    require_once 'classes/DeleteSQL.php';

    $create = new CreateSQLStatements();
    $retrieve = new RetrieveSQLStatements();
    $update = new UpdateSQLStatements();

    if(isset($_POST['register'])) {
        if($retrieve->checkMultipleAccount() == true) {
            $create->register();
        } else {
            $_SESSION['message'] = "This email is already registered.";
            echo "<script>window.location = 'register.php'</script>";
        }

    } else if(isset($_POST['login'])) { //login
        $_SESSION['message'] = "";

        if($retrieve->login() == true) {

            if($retrieve->checkStatus($_SESSION['status']) == true) {
                
                switch($_SESSION['status']) {
                    case "A":
                       echo "<script>window.location = 'adminDashboard.php'</script>";
                    break;
                    
                    case "O":
                        echo "<script>window.location = 'ownerDashboard.php'</script>";
                    break;
                    
                    case "S":
                        echo "<script>window.location = 'staffDashboard.php'</script>";
                    break;
                    
                    case "U":
                        if(!(isset($_SESSION['date'])) && empty($_SESSION['date'])) {
                            echo "<script>window.location = 'userDashboard.php'</script>";
                        } else {
                            echo "<script>window.location = 'makeReservation.php'</script>";
                        }
                    break;
                }
                
            } else {
                $_SESSION['message'] = "You are deactivated.";
                header("Location: login.php");
            }
        } else {
            $_SESSION['message'] = "You type wrong email or password";
            header("Location: login.php");
        }
        
    } else if(isset($_POST['add_service'])) { //add new service
        if($retrieve->checkMultipleService() == true) {
            $create->addService();
        } else {
            $_SESSION['message'] = "This service is already existed";
            echo "<script>window.location = 'addService.php'</script>";
        }

    } else if(isset($_POST['add_staff'])) { //add new staff
        if($retrieve->checkMultipleStaff() == true && $retrieve->checkMultipleAccount() == true) {
            if($create->addStaff() == true) {
                echo "<script>window.location = 'allStaffs.php'</script>";
            }
        } else {
            $_SESSION['message'] = "This staff is already existed or this email is already registered";
            echo "<script>window.location = 'addStaff.php'</script>";
        }

    } else if(isset($_POST['add_owner'])) {

        if($retrieve->checkMultipleAccount() == true) {
            $create->addOwner();
        } else {
            $_SESSION['message'] = "This account email is already used";
            echo "<script>window.location = 'addStaff.php'</script>";
        }

    } else if(isset($_POST['update_service'])) { //update service

        $service_id = $_POST['service_id'];
        
        if($retrieve->checkMultipleService() == true) {
            
            if($update->updateService($service_id) == true) {
                
                header("Location: allServices.php");
                
            } else {
                echo "Error";
            }
            
        } else {
            $_SESSION['message'] = "This service is already existed.";
            echo "<script>window.location = 'updateService.php?id=$service_id'</script>";
        }

    } else if(isset($_POST['update_staff'])) { //update staff

        $staff_id = $_POST['staff_id'];
        list(, , , , , , $login_id, , ) = $retrieve->getEachStaff($staff_id);
        $name_flag = $retrieve->checkUpdateStaffName($staff_id);
        $email_flag = $retrieve->checkUpdateEmail($login_id);

        if($update->updateStaff($staff_id, $name_flag, $email_flag) == true) {

            if($_SESSION['status'] == "O") {
                header("Location: allStaffs.php");
            } else if($_SESSION['status'] == "S") {
                header("Location: staffDashboard.php");
            }

        } else {

            $_SESSION['message'] = "This staff is already existed or this email is already registered";
            header("Location: updateStaff.php?id=$staff_id");

        }

    } else if(isset($_POST['update_owner'])) {

        $staff_id = $_POST['staff_id'];
        list(, , , , , , $login_id, , ) = $retrieve->getEachStaff($staff_id);
        $name_flag = $retrieve->checkUpdateStaffName($staff_id);
        $email_flag = $retrieve->checkUpdateEmail($login_id);

        if($update->updateOwner($staff_id, $name_flag, $email_flag) == true) {

                header("Location: allStaffs.php");

        } else {

            $_SESSION['message'] = "This owner is already existed or this email is already registered";
            header("Location: updateOwner.php?id=$staff_id");

        }

    } else if(isset($_POST['update_user'])) { //update user

        $user_id = $_POST['user_id'];
        $name_flag = $retrieve->checkUpdateUserName($user_id);
        $email_flag = $retrieve->checkUpdateEmail($_SESSION['login_id']);
        

        if($update->updateUser($user_id, $name_flag, $email_flag) == true) {

            header("Location: userDashboard.php");

        } else {

            $_SESSION['message'] = "This email is already registered";
            header("Location: updateUserProfile.php?id=$user_id");

        }

    } else if(isset($_POST['check_reserve'])) {  //check reservation

        $today = date('Y-m-d');
        $current_time = date('H:i:s');
            
            if($_POST['date'] == $today && $_POST['time'] > $current_time) { //today and future time

                $_SESSION['date'] = $_POST['date'];
                $_SESSION['service'] = $_POST['service'];
                $_SESSION['time'] = $_POST['time'];
                if($_SESSION['login_id'] == null) { //if user doesn't login
                    $_SESSION['message'] = "Please login to order your reservation";
                    header("Location: login.php");
                    
                } else { // user is already login

                    $user_id = $retrieve->getUserIdByLoginId($_SESSION['login_id']);
                    if($retrieve->checkOverLapp($user_id, $_POST['date'], $_POST['time']) == true) { //check overlapping
                        header("Location: makeReservation.php");
                    } else {
                        $_SESSION['message'] = "You have existing reservations in the same time and date";
                        header("Location: makeReservation.php");
                    }
                    
                } 

            } else if($_POST['date'] > $today){ //future day 

                $_SESSION['date'] = $_POST['date'];
                $_SESSION['service'] = $_POST['service'];
                $_SESSION['time'] = $_POST['time'];
                if($_SESSION['login_id'] == null) { //if user doesn't login
                    $_SESSION['message'] = "Please login to order your reservation";
                    header("Location: login.php");
                    
                } else { // user is already login

                    $user_id = $retrieve->getUserIdByLoginId($_SESSION['login_id']);
                    if($retrieve->checkOverLapp($user_id, $_POST['date'], $_POST['time']) == true) { //check overlapping

                        header("Location: makeReservation.php");

                    } else {
                        
                        $_SESSION['message'] = "You have existing reservations in the same time and date";
                        header("Location: index.php");

                    }
                    
                } 

            } else if($_POST['date'] == $today && $_POST['time'] < $current_time) { //today but past time
                $_SESSION['message'] = "I'm sorry but you can't reserve past date or time.";
                header("Location: userDashboard.php");

            } else { //past date or past time
                $_SESSION['message'] = "I'm sorry but you can't reserve past date or time.";
                header("Location: userDashboard.php");
            }


    } else if(isset($_POST['confirm_reserve'])) {

            $_SESSION['date'] = $_POST['date'];
            $_SESSION['time'] = $_POST['time'];
            $_SESSION['service'] = $_POST['service'];
            $_SESSION['staff'] = $_POST['staff'];

            if($retrieve->checkOverLappStaff($_POST['staff'], $_POST['date'], $_POST['time']) == true) {

                if($_POST['coupon']) {
                    $_SESSION['uc_id'] = $_POST['coupon'];
                    $price = $retrieve->calcDiscountPay($_POST['service'], $_POST['coupon']);
                } else {
                    list(, , $price, , , ) = $retrieve->getEachService($_POST['service']);
                }

                $_SESSION['price'] = $price;
                header("Location: confirmReserve.php");

            } else {
                $_SESSION['message'] = "I'm sorry but this staff will not be available that time";
                header("Location: makeReservation.php");
            }

    } else if(isset($_POST['generate_coupon'])) {
        
        if($create->generateCoupon() == true) {
            header("Location: generateCoupons.php");
        } else {
            // echo $create->error;
        }

    } else if(isset($_POST['add_shift'])) {

        if($create->addShift() == true) {
            header("Location: schedule.php");
        } else {
            echo "FAIL";
        }

    } else if(isset($_POST['review'])) {

        if($create->review()) {
            echo "<script>window.location = 'userDashboard.php'</script>";
        }

    } else if($_GET['actiontype'] == "change") { //change service status

        $service_id = $_GET['id'];
        list($service_id, $service_name, $price, $picture, $service_description, $service_status) = $retrieve->getEachService($service_id);
        
        if($update->changeServiceStatus($service_id, $service_status) == true) {
            header("Location: allServices.php");
        }

    } else if($_GET['actiontype'] == "changeStaffStatus") { //change staff status
        $staff_id = $_GET['id'];
        
        list($staff_id, $staff_name, $gender, $picture, $position, $staff_status, $login_id, $email, $pass) = $retrieve->getEachStaff($staff_id);

        if($update->changeStaffStatus($staff_id, $staff_status) == true) {
            header("Location: allStaffs.php");
        }

    } else if($_GET['actiontype'] == "changeUserStatus") { //change user status
        $user_id = $_GET['id'];
        list($name, $birthday, $gender, $contact_number, $user_status, $email, $login_id) = $retrieve->getEachUser($user_id);

        if($update->changeUserStatus($user_id, $user_status) == true) {

            header("Location: allCustomers.php");

        }

    } else if($_GET['actiontype'] == "changeOwnStatus") { //change own staff status
        $staff_id = $_GET['id'];
        
        list($staff_id, $staff_name, $gender, $picture, $position, $staff_status, $login_id, $email, $pass) = $retrieve->getEachStaff($staff_id);

        if($update->changeStaffStatus($staff_id, $staff_status) == true) {
            header("Location: logout.php");
        }

    } else if($_GET['actiontype'] == "changeUserOwnStatus") { //change own staff status
        $user_id = $_GET['id'];
        
        list($name, $birthday, $gender, $contact_number, $user_status, $email, $login_id, $pass) = $retrieve->getEachUser($user_id);

        if($update->changeUserStatus($user_id, $user_status) == true) {
            header("Location: logout.php");
        }

    } else if($_GET['actiontype'] == "cancel_reserve") { //cancel reservation

        $reservation_id = $_GET['id'];
        $row = $retrieve->getReservationInfo($reservation_id);

        foreach($row as $value) {
            $reservation_status = $value['reservation_status'];
            $uc_id = $value['uc_id'];
        }

        if($update->CancelReservation($reservation_id, $reservation_status) == true) {
            if($update->userCouponAvail($uc_id))
            header("Location: userDashboard.php");
        } else {
            
            echo $update->error;
        }

    } else if($_GET['actiontype'] == "reserve") {
        $user_id = $retrieve->getUserIdByLoginId($_SESSION['login_id']);
        list(, , $end_time) = $retrieve->calcEndTime($_SESSION['service'], $_SESSION['date'], $_SESSION['time']);
        if($create->reserve($user_id, $end_time) == true) {

            if($update->userCouponDone($_SESSION['uc_id']) == true) {

                unset($_SESSION['date']);
                unset($_SESSION['time']);
                unset($_SESSION['service']);
                unset($_SESSION['staff']);
                unset($_SESSION['price']);
                unset($_SESSION['uc_id']);
                header("Location: userDashboard.php");
            }
        } 

    } else if($_GET['actiontype'] == "deactivateCoupon") {

        if($update->deactivateCoupon($_GET['id'])) {
            header("Location: generateCoupons.php");
        }

    } else if($_GET['actiontype'] == "getCoupon") {

        $coupon_id = $_GET['id'];
        $user_id = $retrieve->getUserIdByLoginId($_SESSION['login_id']);
        if($create->getCoupon($user_id) == true && $update->couponGot($coupon_id)) {
            header("Location: userDashboard.php");
        } 

    } else if($_GET['actiontype'] == "service_done") {
        $reservation_id = $_GET['id'];
        $uc_id = $_GET['uc'];
        if($update->reservationDone($reservation_id) == true) {
            if($update->userCouponDone($uc_id) == true) {
                header("Location: reservations.php");
            } else {
                header("Location: reservations.php");
            }
        } 
    } else if($_GET['actiontype'] == "delete_message") {
        
        $_SESSION['message'] = "";

    } else if($_GET['actiontype'] == "deactivate_company") {

        if($update->deactivateCompany() == true) {
            $_SESSION['admin_status'] = "D";
        }
        header("Location: adminDashboard.php");

    } else if($_GET['actiontype'] == "activate_company") {
        
        if($update->activateCompany() == true) {
            $_SESSION['admin_status'] = "A";
        }

        header("Location: adminDashboard.php");

    }


; ?>