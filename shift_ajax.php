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