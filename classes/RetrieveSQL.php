<?php 
    require_once 'connection.php';

    class RetrieveSQLStatements extends Database {
     
        public function login() {
            $email = $_POST['email'];
            $pass = md5($_POST['pass']);
            $sql_r = "SELECT * FROM login WHERE email = '$email' AND password = '$pass'";

            $result = $this->conn->query($sql_r);
            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $_SESSION['login_id'] = $row['login_id'];
                $_SESSION['status'] = $row['status'];

                return true;

            } else {
                $_SESSION['login_id'] = 0;
                $_SESSION['message'] = "This account is not registered";
                return false;
            }
            
        } //end of login function

        public function displayMessage() {
            if(isset($_SESSION['message']) && $_SESSION['message'] != null) {
                echo "<p class='text-center text-white bg-danger p-2 mb-0'>".$_SESSION['message']."<button id='delete-message' class='ml-3 btn btn-sm btn-light'>Got it</button></p>";
            }
        }

        public function checkStatus( $status) {

            $login_id = $_SESSION['login_id'];
            if($status == "S") {

                $sql_r = "SELECT * FROM staff_owner WHERE login_id = '$login_id'";
                $result = $this->conn->query($sql_r);

                if($result->num_rows == 1) {
                    $row = $result->fetch_assoc();

                    $staff_status = $row['staff_status'];
                    
                    if($staff_status == "A") {
                        return true;
                    } else {
                        return false;
                    }
                }

            } else if($status == "U") {

                $sql_r = "SELECT * FROM users WHERE login_id = '$login_id'";
                $result = $this->conn->query($sql_r);

                if($result->num_rows == 1) {
                    $row = $result->fetch_assoc();

                    $user_status = $row['user_status'];

                    if($user_status == "A") {
                        return true;
                    } else {
                        return false;
                    }
                }

            } else {
                return true;
            }

        } //end of checkStatus

        public function checkMultipleAccount() {
            $email = $_POST['email'];
            $pass = md5($_POST['pass']);
            $sql_r = "SELECT * FROM login WHERE email = '$email'";
            $result = $this->conn->query($sql_r);
            
            if($result->num_rows == 0) {
                return true;
            } else {
                return false;
            }
        } //end of checkMultipleAccount

        public function checkMultipleService() {
            $name = $_POST['service_name'];
            $sql_r = "SELECT * FROM services WHERE service_name = '$name'";
            $result = $this->conn->query($sql_r);
            if($result->num_rows == 0) {
                return true;
            } else {
                return false;
            }
        } //end of checkMultipleService

        public function checkMultipleStaff() {
            $staff_name = $_POST['staff_name'];
            $sql_r = "SELECT * FROM staff_owner WHERE name = '$staff_name'";
            $result = $this->conn->query($sql_r);
            if($result->num_rows == 0) {
                return true;
            } else {
                return false;
            }
        } //end of checkMultipleService


        public function getAllServices() {

            $sql_r = "SELECT * FROM services ORDER BY service_id ASC";
            $result = $this->conn->query($sql_r);

            if($result->num_rows > 0) {
                $rows = array();
                while($row = $result->fetch_assoc()) {  
                    $rows[] = $row;
                }
                return $rows;
            }

        } //end of getAllServices

        public function getEachService($service_id) {
            $sql_r = "SELECT * FROM services WHERE service_id = '$service_id'";
            $result = $this->conn->query($sql_r);
            if($result->num_rows == 1) {
                while($row = $result->fetch_assoc()) {
                    $service_name = $row['service_name'];
                    $price = $row['price'];
                    $picture = $row['picture'];
                    $service_description = $row['service_description'];
                    $service_status = $row['service_status'];
                }

                return [$service_id, $service_name, $price, $picture, $service_description, $service_status];
            }
        } // end of get Each service

        public function getAllStaffs() {

            $sql_r = "SELECT * FROM login INNER JOIN staff_owner ON login.login_id = staff_owner.login_id WHERE login.status = 'S'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows > 0) {
                $rows = array();

                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }

                return $rows;
            }


        } //end of getAllStaffs

        public function getEachStaff($staff_id) {

            $sql_r = "SELECT * FROM login INNER JOIN staff_owner ON login.login_id = staff_owner.login_id WHERE staff_owner.staff_id= '$staff_id'";

            $result = $this->conn->query($sql_r);

            if($result->num_rows == 1) {
                while($row = $result->fetch_assoc()) {
                    $staff_name = $row['name'];
                    $gender = $row['gender'];
                    $picture = $row['picture'];
                    $position = $row['position'];
                    $staff_status = $row['staff_status'];
                    $login_id = $row['login_id'];
                    $email = $row['email'];
                    $pass = $row['password'];

                    return [$staff_id, $staff_name, $gender, $picture, $position, $staff_status, $login_id, $email, $pass];
                }
            } else {
                echo $this->conn->error;
            }
            

        } // end of get Each staff

        public function getStaffId($login_id) {

            $sql_r = "SELECT * FROM staff_owner WHERE login_id = '$login_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                return $row['staff_id'];
            }

        } // end of getStaffId

        public function checkUpdaaffName($staff_id) {
            $staff_name = $_POST['staff_name'];
            $new_staff_name = $_POST['new_staff_name'];

            if($staff_name != $new_staff_name && $new_staff_name != "") { //input different name

                $sql_r = "SELECT * FROM staff_owner WHERE name = '$new_staff_name'";
                $result = $this->conn->query($sql_r);
                
                if($result->num_rows == 0) { //not existed

                    //update name only
                    $sql_u = "UPDATE staff_owner SET name = '$new_staff_name' WHERE staff_id = '$staff_id'";
                    $this->conn->query($sql_u);
                    return 0;

                } else {
                    return 1; //already existed
                }

            } else { // input same name or blank

                return 0; //use same name

            }

        } //end of checkUpdateStaffName

        public function checkUpdateEmail($login_id) {
            $email = $_POST['email'];
            $new_email = $_POST['new_email'];

            if($email != $new_email && $new_email != "") { //input different email

                $sql_r = "SELECT * FROM login WHERE email = '$new_email'";
                $result = $this->conn->query($sql_r);
                
                if($result->num_rows == 0) { //not existed
                    $sql_u = "UPDATE login SET email = '$new_email' WHERE login_id = '$login_id'";
                    $this->conn->query($sql_u);
                    return 0;
                } else {
                    return 1; //already existed
                }

            } else { // input same email or blank

                return 0; //use same email

            }

        } //end of checkUpdateEmail

        public function getAllUsers() {

            $sql_r = "SELECT * FROM users INNER JOIN login ON users.login_id = login.login_id";
            $result = $this->conn->query($sql_r);

            if($result->num_rows > 0) {

                $rows = array();

                while($row = $result->fetch_assoc()) {

                    $rows[] = $row;

                }

                return $rows;
            }


        } //end of getAllUsers

        public function getEachUSer($user_id) {

            $sql_r = "SELECT * FROM users INNER JOIN login ON users.login_id = login.login_id WHERE user_id = '$user_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 1) {

                while($row = $result->fetch_assoc()) {

                    $name = $row['name'];
                    $birthday = $row['birthday'];
                    $gender = $row['gender'];
                    $contact_number = $row['contact_number'];
                    $user_status = $row['user_status'];
                    $email = $row['email'];
                    $login_id = $row['login_id'];
                    $pass = $row['password'];

                }

                return [$name, $birthday, $gender, $contact_number, $user_status, $email, $login_id, $pass];

            }

        } //end of getEachUser

        public function getUserIdByLoginId($login_id) {

            $sql_r = "SELECT * FROM users WHERE login_id = '$login_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 1) {

                $row = $result->fetch_assoc();

                return $row['user_id'];;
            }

        } //end of getUSerIdByLoginId

        public function getReservations($staff_id) {
            $today = date('Y-m-d');
            $sql_r = "SELECT * FROM ((reservations 
                        INNER JOIN users ON reservations.user_id = users.user_id) 
                        INNER JOIN services ON reservations.service_id = services.service_id) 
                        WHERE reservations.staff_id = '$staff_id' AND reservation_date = '$today' AND reservation_status = 'O'
                        ORDER BY reservations.reservation_time ASC";

            $result = $this->conn->query($sql_r);

            if($result->num_rows > 0) {

                $rows = array();

                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }

                return $rows;
                
            } else {
                return false;
            }

        }  //end of getReservations

        public function checkUpdateUserName($user_id) {
            $user_name = $_POST['user_name'];
            $new_user_name = $_POST['new_user_name'];

            if($user_name != $new_user_name && $new_user_name != "") { //input different name

                return 1;

            } else { // input same name or blank

                return 0; //use same name

            }

        } //end of checkUpdateuserName

        public function getComingReservations($user_id) {
            $today = date('Y-m-d');
            $time = date('H:i:s');

            $sql_r = "SELECT * FROM reservations WHERE user_id = '$user_id' AND reservation_date >= '$today' AND reservation_status = 'O' ORDER BY reservation_date ASC";

            $result = $this->conn->query($sql_r);

            if($result->num_rows > 0) {
                $rows = array();
                while($row = $result->fetch_assoc()) {

                    if($row['reservation_date'] == $today) {

                        if($row['reservation_time'] > $time) {
                            $rows[] = $row;
                            return $rows;
                        }
                        
                    } else if($row['reservation_date'] > $today) {
                        $rows[] = $row;
                        return $rows;
                    }
                }

            }

        } // end of getComingReservations

        public function getServiceNameById($service_id) {
            $sql_r = "SELECT * FROM services WHERE service_id = '$service_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                return $row['service_name'];
            }

        } //end of getServiceNameById

        public function getServicePriceById($service_id) {
            $sql_r = "SELECT * FROM services WHERE service_id = '$service_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                return $row['price'];
            }

        } //end of getServiceNameById

        public function getStaffNameById($staff_id) {
            $sql_r = "SELECT * FROM staff_owner WHERE staff_id = '$staff_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                return $row['name'];
            }

        } //end of getStaffNameById

        public function getUserNameById($user_id) {
            $sql_r = "SELECT * FROM users WHERE user_id = '$user_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                return $row['name'];
            }

        } //end of getUserNameById

        public function getUserHistoryReservation($user_id) {
            $today = date('Y-m-d');
            $sql_r = "SELECT * FROM reservations WHERE user_id = '$user_id' AND reservation_date <= '$today' AND reservation_status = 'D' ORDER BY reservation_date DESC";

            $result = $this->conn->query($sql_r);

            if($result->num_rows > 0) {
                $rows = array();
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            }

        } //end of getUserHistoryReservation

        public function getServiceImage($service_id) {
            $sql_r = "SELECT * FROM services WHERE service_id = '$service_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 1) {

                $row = $result->fetch_assoc();
                return $row['picture'];

            }
        } 

        public function checkOverLapp($user_id, $date, $time) {

            $sql_r = "SELECT * FROM reservations WHERE user_id = '$user_id' AND reservation_date = '$date' AND end_time > '$time'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 0){ // overlapping is nothing
                return true;
            } else { //there are overlapping
                return false;
            }

        }

        public function checkOverLappStaff($staff_id, $date, $time) {

            $sql_r = "SELECT * FROM reservations WHERE staff_id = '$staff_id' AND reservation_date = '$date' AND end_time > '$time'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 0) {
                return true;
            } else {
                return false;
            }

        }

        public function calcEndTime($service_id, $date, $time) {

            $sql_r = "SELECT * FROM services WHERE service_id = '$service_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $service_period = $row['service_period'];

                $service_period_hour = substr($service_period, 1, 1); //change time to str

                $service_period_min = substr($service_period, 3, 2); //change time to str

                $tmp = $date.' '.$time; //set to tmp
                $time_stamp = strtotime($tmp); //replace to time stamp

                $add_hour = '+'.$service_period_hour.'hour';
                $add_min = '+'.$service_period_min.'minute'; 

                $added_hour = strtotime($add_hour, $time_stamp); // add hour

                $added_hour_min = strtotime($add_min, $added_hour); //add min

                $end_date_time = date('Y-m-d H:i:s', $added_hour_min); //calc end time
                $end_date = substr($end_date_time, 0, 10);
                $end_time = substr($end_date_time, 11, -3);
                var_dump($end_date_time);
                var_dump($end_date);
                var_dump($end_time);
                return [$end_date_time, $end_date, $end_time];
            }

        }

        public function getNameById($login_id) {

            $sql_r = "SELECT * FROM login WHERE login_id = '$login_id'";
            $result = $this->conn->query($sql_r);
            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $status = $row['status'];
            }
            switch($status) {
                case "O":
                    $sql_r = "SELECT * FROM staff_owner WHERE login_id = '$login_id'";
                    $result = $this->conn->query($sql_r);
                    if($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        return $row['name'];
                    }
                case "S":
                    $sql_r = "SELECT * FROM staff_owner WHERE login_id = '$login_id'";
                    $result = $this->conn->query($sql_r);
                    if($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        return $row['name'];
                    }
                case "U":
                    $sql_r = "SELECT * FROM users WHERE login_id = '$login_id'";
                    $result = $this->conn->query($sql_r);
                    if($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        return $row['name'];
                    }
            }

        }

        public function getAllCoupons() {

            $sql_r = "SELECT * FROM coupons WHERE coupon_status = 'A'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows > 0) {
                $rows = array();
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            } else {
                return false;
            }

        }

        public function getEachCoupon($coupon_id) {

            $sql_r = "SELECT * FROM coupons WHERE coupon_id = '$coupon_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                return [$row['coupon_value'], $row['coupon_name'], $row['expiration'], $row['description'], $row['coupon_status']];
            }

        }

        public function getUserCoupons($user_id) {
            
            $sql_r = "SELECT * FROM user_coupons WHERE user_id = '$user_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows > 0) {
                $rows = array();
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            } else {
                return false;
            }

        }

        public function calcDiscountPay($service_id, $uc_id) {

            $sql_r = "SELECT * FROM user_coupons INNER JOIN coupons ON user_coupons.coupon_id = coupons.coupon_id WHERE user_coupons.uc_id = '$uc_id'";

            $result = $this->conn->query($sql_r);
            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $coupon_value = $row['coupon_value'];
            }

            list(, , $price, , , ) = $this->getEachService($service_id);

            $coupon_value /= 100;
            $off_price = 1.0 - $coupon_value;
            $total = $price * $off_price;
            return $total;

        }

        public function getServiceStaff($service_id) {
            $sql_r = "SELECT * FROM staff_owner WHERE service_id = '$service_id'";
            $result = $this->conn->query($sql_r);
            if($result->num_rows > 0) {
                $rows = array();
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            }

        }

        public function getReservationInfo($reservation_id) {

            $sql_r = "SELECT * FROM reservations WHERE reservation_id = '$reservation_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 1) {
                $rows = array();

                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            }

        } //end of getReservationInfo

        
        public function getDailyDoneReservations($date) {
            $sql_r = "SELECT * FROM reservations WHERE reservation_date = '$date' AND reservation_status = 'D' ORDER BY service_id ASC";
            $result = $this->conn->query($sql_r);

            if($result->num_rows > 0) {
                $rows = array();
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            } else {
                return 0;
            }
        }
        
        public function getDailyReservations($date) {
            $sql_r = "SELECT * FROM reservations WHERE reservation_date = '$date' AND reservation_status != 'C' ORDER BY reservation_time ASC";
            $result = $this->conn->query($sql_r);

            if($result->num_rows > 0) {
                $rows = array();
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            } else {
                return 0;
            }
        }


        public function calcDailyProfits($date) {

           if($this->getDailyDoneReservations($date) != false) {
               $daily_reservations = $this->getDailyDoneReservations($date);
               $total = 0;
               foreach($daily_reservations as $reservation) {
                   $total = $total + $reservation['payment'];
                }
                
                return $total;

            } else {
                return $total;
            }
        }

        public function calcMonthlyProfits($month) {

           if($this->getMonthlyDoneReservations($month) != false) {
               $monthly_reservations = $this->getMonthlyDoneReservations($month);      
               $total = 0;
               foreach($monthly_reservations as $reservation) {
                   $total = $total + $reservation['payment'];
                }
                
                return $total;

            } else {
                return $total;
            }
        }

        public function getMonthlyDoneReservations($month) {
            $sql_r = "SELECT * FROM reservations WHERE MONTH(reservation_date) = '$month' AND reservation_status = 'D' ORDER BY reservation_date ASC";
            $result = $this->conn->query($sql_r);
            if($result->num_rows > 0) {
                $rows = array();
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            } else {
                return 0;
            }
        }

        public function getMonthlyReservations($month) {
            $sql_r = "SELECT * FROM reservations WHERE MONTH(reservation_date) = '$month' ORDER BY reservation_date ASC";
            $result = $this->conn->query($sql_r);
            if($result->num_rows > 0) {
                $rows = array();
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            } else {
                return 0;
            }
        }

        public function calcServiceProfit($service_id, $date) {
            $sql_r = "SELECT * FROM reservations WHERE service_id = '$service_id' AND reservation_date = '$date' AND reservation_status = 'D'";
            $result = $this->conn->query($sql_r);
            if($result->num_rows > 0) {
                $total = 0;
                while($row = $result->fetch_assoc()) {
                    $total = $total + $row['payment'];
                }
                return $total;
            }
        }

        public function calcMonthlyServiceProfit($service_id, $month) {
            $sql_r = "SELECT * FROM reservations WHERE MONTH(reservation_date) = '$month' AND reservation_status = 'D' AND service_id = '$service_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows > 0) {
                $total = 0;
                while($row = $result->fetch_assoc()) {
                    $total = $total + $row['payment'];
                }

                return $total;

            } else {
                return 0;
            }

        }

        public function getCouponInfo($uc_id) {
            $sql_r = "SELECT * FROM user_coupons INNER JOIN coupons ON user_coupons.coupon_id = coupons.coupon_id WHERE user_coupons.uc_id = '$uc_id'";
            $result = $this->conn->query($sql_r);

            if($result->num_rows == 1) {
                $rows = array();
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }

                return $rows;

            } else {
                return 0;
            }

        }

        public function getAllSchedule() {
            $sql_r = "SELECT * FROM schedule";
            $result = $this->conn->query($sql_r);

            if($result->num_rows > 0) {
                $rows = array();
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            } 
        }

        public function getComingStaffShift($staff_id) {
            $sql_r = "SELECT * FROM schedule WHERE staff_id = '$staff_id' AND shift_status = 'A' ORDER BY end_date ASC LIMIT 1";
            $result = $this->conn->query($sql_r);
            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                return $row['end_date'];
            } else {
                return 0;
            }
        }

        public function getStaffShift($staff_id) {
            $sql_r = "SELECT * FROM schedule WHERE staff_id = '$staff_id' AND shift_status = 'A' ORDER BY start_date ASC LIMIT 2";
            $result = $this->conn->query($sql_r);
            if($result->num_rows > 0) {
                $rows = array();
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            } else {
                return 0;
            }
        }

        public function getDateShift($date, $staff_id) {
            $sql_r = "SELECT * FROM schedule WHERE staff_id = '$staff_id' AND day_off = '$date'";
            $result = $this->conn->query($sql_r);
            if($result->num_rows == 0) {
                return true;
            } else {
                return false;
            }
        }

    } //end of class
    
; ?>