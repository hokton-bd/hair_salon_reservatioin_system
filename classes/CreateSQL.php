<?php 
    require_once 'connection.php';

    class CreateSQLStatements extends Database {

        public function register() {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = md5($_POST['pass']);
            $birthday = $_POST['birthday'];
            $gender = $_POST['gender'];
            $contact_num = $_POST['contact_num'];

            $sql_c_l = "INSERT INTO login(email, password) VALUES ('$email', '$pass')";
            if($this->conn->query($sql_c_l)) {
                $login_id = $this->conn->insert_id;
                $sql_c_u = "INSERT INTO users(name, birthday, gender, contact_number, login_id) VALUES ('$name', '$birthday', '$gender', '$contact_num', '$login_id')";

                if($this->conn->query($sql_c_u)) {
                    $_SESSION['message'] = "";
                    header("Location: login.php");
                } else {
                    echo "Inserting in users table: ".$this->conn->error;
                } 
            } else {
                echo "Inserting in login table: ".$this->conn->error;
            }

        } //end of register function

        public function addService() {

            $service_name = $_POST['service_name'];
            $price = $_POST['price'];
            $service_description = $_POST['service_description'];
            $name = $_FILES['picture']['name'];
            $target_dir = "img/services/";

            $target_file = $target_dir.basename($name);
            $sql_c = "INSERT INTO services(service_name, price, picture, service_description) 
                        VALUES ('$service_name', '$price', '$name', '$service_description')";
            if($this->conn->query($sql_c)) {
                $_SESSION['message'] = "";
                move_uploaded_file($_FILES['picture']['tmp_name'], $target_file);
                echo "<script>window.location = 'addService.php'</script>";
            } else {
                echo $this->conn->error;
            }

        } //end of addService

        public function addStaff() {

            $staff_name = $_POST['staff_name'];
            $gender = $_POST['gender'];
            $position = $_POST['position'];
            $pic_name = $_FILES['staff_picture']['name'];
            $email = $_POST['email'];
            $pass = md5($_POST['pass']);
            $target_dir = "img/staffs/";

            $sql_c_l = "INSERT INTO login(email, password, status) VALUES ('$email', '$pass', 'S')";
 
            if($this->conn->query($sql_c_l)) {
                $login_id = $this->conn->insert_id;
                
                $target_file = $target_dir.basename($pic_name);
                $sql_c_s = "INSERT INTO staff_owner(name, gender, position, picture, login_id) 
                        VALUES ('$staff_name', '$gender', '$position', '$pic_name', '$login_id')";

                if($this->conn->query($sql_c_s)) {
                    $_SESSION['message'] = "";
                    move_uploaded_file($_FILES['staff_picture']['tmp_name'], $target_file);
                    echo "<script>window.location = 'addStaff.php'</script>";
                } else {
                    echo $this->conn->error;
                }
            }

        } //end of addService

        public function reserve($user_id, $end_time) {
            $service_id = $_SESSION['service'];
            $staff_id = $_SESSION['staff'];
            $date = $_SESSION['date'];
            $time = $_SESSION['time'];
            $price = $_SESSION['price'];
            $uc_id = 0;
            if($_SESSION['uc_id']) {
                $uc_id = $_SESSION['uc_id'];
            }

            $sql_c = "INSERT INTO reservations(service_id, user_id, staff_id, reservation_date, reservation_time, end_time, payment, uc_id) VALUES ('$service_id', '$user_id', '$staff_id', '$date', '$time', '$end_time', '$price', '$uc_id')";

            if($this->conn->query($sql_c)) {
                return true; 

            }
        }

        public function generateCoupon() {

            $name = $_POST['coupon_name'];
            $value = $_POST['value'];
            $expiration = $_POST['expiration'];
            $desc = $_POST['desc'];

            $sql_c = "INSERT INTO coupons(coupon_name, coupon_value, expiration, description) VALUES ('$name', '$value', '$expiration', '$desc')";

            if($this->conn->query($sql_c)) {
                return true;
            } else {
                // return false;
                echo $this->conn->error;
            }

        }

        public function getCoupon($user_id) {
            $coupon_id = $_GET['id'];
            $sql_c = "INSERT INTO user_coupons(user_id, coupon_id) VALUES ('$user_id', '$coupon_id')";
            if($this->conn->query($sql_c)) {
                return true;
            } else {
                echo $this->conn->error;
                return false;
            }
        }

        public function addShift() {
            $staff_id = $_POST['staff_list'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $break_time = $_POST['break_time'];
            $day_off = $_POST['day_off'];

            $timestamp = strtotime($break_time) + 3600;
            $break_end = date('H:i', $timestamp);

            $sql_c = "INSERT INTO schedule(staff_id, start_date, end_date, shift_start, shift_end, break_start, break_end, day_off) VALUES ('$staff_id', '$start_date', '$end_date', '$start_time', '$end_time', '$break_time', '$break_end', '$day_off')";

            if($start_date > date('Y-m-d') && $start_date < $end_date && $this->conn->query($sql_c)) {
                return true;
            } else {
                echo $this->conn->error;
            }
        }



    } //end of class

; ?>