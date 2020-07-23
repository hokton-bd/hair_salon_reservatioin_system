<?php 
    require_once 'connection.php';

    class UpdateSQLStatements extends Database {
      
        public function changeServiceStatus($service_id, $service_status) {
            if($service_status == "A") {
                $sql_u = "UPDATE services SET service_status = 'D' WHERE service_id = '$service_id'";
                $this->conn->query($sql_u);
                return true;
            } else {
                $sql_u = "UPDATE services SET service_status = 'A' WHERE service_id = '$service_id'";
                $this->conn->query($sql_u);
                return true;
            }
        } //end of changeServiceStatus

        public function updateService($service_id) {
            if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != "" ) { //service picture change
                
                $service_name = $_POST['service_name'];
                $price = $_POST['price'];
                $service_description = $_POST['service_description'];
                $picture = $_FILES['picture']['name'];

                $target_dir = "img/services/";
                $target_file = $target_dir.basename($picture);
                
                $sql_u = "UPDATE services 
                        SET service_name = '$service_name',
                            price = '$price',
                            picture = '$picture',
                            service_description = '$service_description'
             
                          WHERE service_id = '$service_id'";
                move_uploaded_file($_FILES['picture']['tmp_name'], $target_file);

            } else  {

                $service_name = $_POST['service_name'];
                $price = $_POST['price'];
                $service_description = $_POST['service_description'];
                
                $sql_u = "UPDATE services 
                        SET service_name = '$service_name',
                            price = '$price',
                            service_description = '$service_description'
             
                          WHERE service_id = '$service_id'";

            }
            
             if($this->conn->query($sql_u)) {
                return true;
            } else {
                echo $this->conn->error;
            }

        } //end of update Service

        public function changeStaffStatus($staff_id, $staff_status) {

            if($staff_status == "A") {
                $sql_u = "UPDATE staff_owner SET staff_status = 'D' WHERE staff_id = '$staff_id'";
                $this->conn->query($sql_u);
                return true;
            } else {
                $sql_u = "UPDATE staff_owner SET staff_status = 'A' WHERE staff_id = '$staff_id'";
                $this->conn->query($sql_u);
                return true;
            }

        } //end of changeStaffStatus

        public function updateStaff($staff_id, $name_flag, $email_flag) {

            if($name_flag == 0 && $email_flag == 0) { // not existed name and email

                $gender = $_POST['gender'];
                $position = $_POST['position'];
                $pass = md5($_POST['pass']);

                if(isset($_FILES['staff_picture']['name']) && $_FILES['staff_picture']['name'] != "" ) { //staff picture change
                
               
                    $picture = $_FILES['staff_picture']['name'];

                    $target_dir = "img/staffs/";
                    $target_file = $target_dir.basename($picture);
                    
                    $sql_u = "UPDATE staff_owner INNER JOIN login ON staff_owner.login_id = login.login_id
                            SET 
              
                                staff_owner.gender = '$gender',
                                staff_owner.position = '$position',
                                staff_owner.picture = '$picture',
                                login.password = '$pass'
                
                            WHERE staff_id = '$staff_id'";
                    move_uploaded_file($_FILES['staff_picture']['tmp_name'], $target_file);

                } else  {
                
                    $sql_u = "UPDATE staff_owner INNER JOIN login ON staff_owner.login_id = login.login_id
                            SET 
            
                                staff_owner.gender = '$gender',
                                staff_owner.position = '$position',
                                login.password = '$pass'
                
                            WHERE staff_id = '$staff_id'";
                }
            
                if($this->conn->query($sql_u)) {
                    return true;
                } else {
                    echo $this->conn->error;
                }

            } else {

                return false;

            }

            

        } //end of update Staff

        public function updateOwner($staff_id, $name_flag, $email_flag) {

            if($name_flag == 0 && $email_flag == 0) { // not existed name and email

                $gender = $_POST['gender'];
                $position = $_POST['position'];
                $pass = md5($_POST['pass']);

                if(isset($_FILES['staff_picture']['name']) && $_FILES['staff_picture']['name'] != "" ) { //staff picture change
                
               
                    $picture = $_FILES['staff_picture']['name'];

                    $target_dir = "img/owner/";
                    $target_file = $target_dir.basename($picture);
                    
                    $sql_u = "UPDATE staff_owner INNER JOIN login ON staff_owner.login_id = login.login_id
                            SET 
              
                                staff_owner.gender = '$gender',
                                staff_owner.position = '$position',
                                staff_owner.picture = '$picture',
                                login.password = '$pass'
                
                            WHERE staff_id = '$staff_id'";
                    move_uploaded_file($_FILES['staff_picture']['tmp_name'], $target_file);

                } else  {
                
                    $sql_u = "UPDATE staff_owner INNER JOIN login ON staff_owner.login_id = login.login_id
                            SET 
            
                                staff_owner.gender = '$gender',
                                staff_owner.position = '$position',
                                login.password = '$pass'
                
                            WHERE staff_id = '$staff_id'";
                }
            
                if($this->conn->query($sql_u)) {
                    return true;
                } else {
                    echo $this->conn->error;
                }

            } else {

                return false;

            }

            

        } //end of update Staff

        public function changeUserStatus($user_id, $user_status) {

            if($user_status == "A") {
                $sql_u = "UPDATE users SET user_status = 'D' WHERE user_id = '$user_id'";
                $this->conn->query($sql_u);
                return true;
            } else {
                $sql_u = "UPDATE users SET user_status = 'A' WHERE user_id = '$user_id'";
                $this->conn->query($sql_u);
                return true;
            }

        } //end of changeUserStatus

        public function updateUser($user_id, $name_flag, $email_flag) {

            if($email_flag == 0) { // not existed email
                $gender = $_POST['gender'];
                $pass = md5($_POST['pass']);  

                if($name_flag == 0) { //user doesn't change name

                    $sql_u = "UPDATE users INNER JOIN login ON users.login_id = login.login_id
                            SET 
                                users.gender = '$gender',
                                login.password = '$pass',
                            WHERE user_id = '$user_id'";
                
                    if($this->conn->query($sql_u)) {
                        return true;
                    } else {
                        echo $this->conn->error;
                    }

                } else { //user wants to change name

                    $new_user_name = $_POST['new_user_name'];

                    $sql_u = "UPDATE users INNER JOIN login ON users.login_id = login.login_id  SET users.name = '$new_user_name', users.gender = '$gender', login.password = '$pass' WHERE user_id = '$user_id'";

                    $this->conn->query($sql_u);
                    return true;

                }

            } else {

                return false;

            }   

        } //end of updateUser

        public function CancelReservation($reservation_id, $reservation_status) {

            if($reservation_status == "O") {

                $sql_u = "UPDATE reservations SET reservation_status = 'C' WHERE reservation_id = '$reservation_id'";
                if($this->conn->query($sql_u)) {
                    return true;
                } else {
                    echo $this->conn->error;
                }
                
            } else {

                $sql_u = "UPDATE reservations SET reservation_status = 'O' WHERE reservation_id = '$reservation_id'";
                if($this->conn->query($sql_u)) {
                    return true;
                } else {
                    echo $this->conn->error;
                }

            }

        }

        public function deactivateCoupon($coupon_id) {
            $sql_u = "UPDATE coupons SET coupon_status = 'D' WHERE coupon_id = '$coupon_id'";
            if($this->conn->query($sql_u)) {
                return true;
            } else {
                echo $this->conn->error;
            }
        }

        public function deactivateCouponByExpiration($date) {
            $sql_u = "UPDATE coupons SET coupon_status = 'D' WHERE expiration < '$date'";
            $this->conn->query($sql_u);
        }

        public function couponGot($coupon_id) {
            $sql_u = "UPDATE coupons SET coupon_status = 'G' WHERE coupon_id = '$coupon_id'";
            if($this->conn->query($sql_u)) {
                return true;
            } else {
                echo $this->conn->error;
            }
        }

        public function userCouponDone($uc_id) {
            if($uc_id != 0) { // user use coupon
                $sql_u = "UPDATE user_coupons SET uc_status = 'R' WHERE uc_id = '$uc_id'";
                if($this->conn->query($sql_u)) {
                    return true;
                } else {
                    echo $this->conn->error;
                }
            } else { //user didn't use coupon
                return true;
            }
        }

        public function userCouponAvail($uc_id) {
            $sql_u = "UPDATE user_coupons SET uc_status = 'A' WHERE uc_id = '$uc_id'";
            if($this->conn->query($sql_u)) {
                return true;
            } else {
                echo $this->conn->error;
            }
        }

        public function reservationDone($reservation_id) {
            $sql_u = "UPDATE reservations SET reservation_status = 'D' WHERE reservation_id = '$reservation_id'";
            if($this->conn->query($sql_u)) {
                return true;
            } else {
                echo $this->conn->error;
            }
        }

        public function changeShiftStatus($schedule_id) {
            $sql_u = "UPDATE schedule SET shift_status = 'D' WHERE schedule_id = '$schedule_id'";

            $this->conn->query($sql_u);

        }

        public function addVisitedAmount($user_id) {
            $visited_amount++;
            $sql_u = "UPDATE users SET visited_amount = '$visited_amount' WHERE user_id = '$user_id'";

            
        }

        public function activateCompany() {
            $sql_1 = "UPDATE coupons SET admin_status = 'A'";
            $sql_2 = "UPDATE login SET admin_status = 'A'";
            $sql_3 = "UPDATE reservations SET admin_status = 'A'";
            $sql_4 = "UPDATE schedule SET admin_status = 'A'";
            $sql_5 = "UPDATE services SET admin_status = 'A'";
            $sql_6 = "UPDATE staff_owner SET admin_status = 'A'";
            $sql_7 = "UPDATE users SET admin_status = 'A'";
            $sql_8 = "UPDATE user_coupons SET admin_status = 'A'";
            $sql_9 = "UPDATE reviews SET admin_status = 'A'";

            $this->conn->query($sql_1);
            $this->conn->query($sql_2);
            $this->conn->query($sql_3);
            $this->conn->query($sql_4);
            $this->conn->query($sql_5);
            $this->conn->query($sql_6);
            $this->conn->query($sql_7);
            $this->conn->query($sql_8);
            $this->conn->query($sql_9);

            return true;
        }
       

        public function deactivateCompany() {
            $sql_1 = "UPDATE coupons SET admin_status = 'D'";
            $sql_2 = "UPDATE login SET admin_status = 'D'";
            $sql_3 = "UPDATE reservations SET admin_status = 'D'";
            $sql_4 = "UPDATE schedule SET admin_status = 'D'";
            $sql_5 = "UPDATE services SET admin_status = 'D'";
            $sql_6 = "UPDATE staff_owner SET admin_status = 'D'";
            $sql_7 = "UPDATE users SET admin_status = 'D'";
            $sql_8 = "UPDATE user_coupons SET admin_status = 'D'";
            $sql_9 = "UPDATE reviews SET admin_status = 'D'";

            $this->conn->query($sql_1);
            $this->conn->query($sql_2);
            $this->conn->query($sql_3);
            $this->conn->query($sql_4);
            $this->conn->query($sql_5);
            $this->conn->query($sql_6);
            $this->conn->query($sql_7);
            $this->conn->query($sql_8);
            $this->conn->query($sql_9);

            return true;
        }

        public function rebook($user_id, $end_time, $reservation_id) {

            $service_id = $_SESSION['service'];
            $staff_id = $_SESSION['staff'];
            $date = $_SESSION['date'];
            $time = $_SESSION['time'];
            $price = $_SESSION['price'];
            if($_SESSION['uc_id']) {
                $uc_id = $_SESSION['uc_id'];
            }

            $sql_u = "UPDATE reservations SET service_id = '$service_id', staff_id = '$staff_id', reservation_date = '$date', reservation_time = '$time', end_time = '$end_time', payment = '$price', uc_id = '$uc_id' WHERE reservation_id = '$reservation_id'";

            if($this->conn->query($sql_u)) {
                return true;
            } else {
                echo $this->conn->error;
            }

        }

        public function changeUserCouponStatusToActive($uc_id) {
            $sql_u = "UPDATE user_coupons SET uc_status = 'A' WHERE uc_id = '$uc_id'";
            if($this->conn->query($sql_u)) {
                return true;
            } else {
                return false;
            }
        }
       
    }
    
; ?>