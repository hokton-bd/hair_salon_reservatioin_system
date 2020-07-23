<?php 
    session_start();
    require_once 'classes/connection.php';
    require_once 'classes/RetrieveSQL.php';
    $retrieve = new RetrieveSQLStatements();
    //check overlapping shift
    if(isset($_GET['id'])) {
        $staff_id = $_GET['id'];
        $end_date = $retrieve->getComingStaffShift($staff_id);
        if($end_date != 0) {
            $time_stamp = strtotime($end_date.'+1 day');
            echo date('Y-m-d', $time_stamp);
        } else {
            echo "";
        }
    }

?>

<?php 
    if(isset($_GET['reserve_date'])) :
        $reserve_date = $_GET['reserve_date'];
        $service_id = $_GET['service_id'];

        // if(isset($_SESSION['service'])) {
        //     $staffs = $retrieve->getServiceStaff($_SESSION['service']); //new order
        // } else {
        //     $staffs = $retrieve->getServiceStaff($_GET['service']); //re order
        // }
        $staffs = $retrieve->getServiceStaff($service_id); //re order
        foreach($staffs as $staff) : 
        if($retrieve->getDateShift($reserve_date, $staff['staff_id']) == true && $staff['service_id'] == $service_id) :
?>

        <label for="<?= $staff['staff_id']; ?>" class="col-4">
            <div class="staff-img-box mb-2">
                <img class="staff-img" src="img/staffs/<?= $staff['picture']?>" alt="">
            </div>
            <input type="radio" class="staff-radio"  name="staff" value="<?= $staff['staff_id']?>" id="<?= $staff['staff_id']?>" required>
            <span class="staff-name ml-3 text-light text-center mx-auto"><?= $staff['name']; ?> / Rate : <span class="text-warning"><?= $retrieve->calcStaffRate($staff['staff_id']) ;?></span></span>
        </label>

<?php endif; endforeach ; endif; ?>

<?php 
    if(isset($_GET['start_date'])) {
        $start_date = $_GET['start_date'];
        $time_stamp = strtotime($start_date.'+7 day');
        echo date('Y-m-d', $time_stamp);
    }
; ?>