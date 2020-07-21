<?php 
    include 'header.php';
    require_once 'classes/UpdateSQL.php';
    $update = new UpdateSQLStatements();
    if($_SESSION['login_id'] == null) {
        header("Location: login.php");

    }
    if($_SESSION['status'] != "O") {
        header("Location: index.php");    
    }
    $staffs = $retrieve->getAllStaffs();
    $schedules = $retrieve->getAllSchedule();
    foreach($schedules as $schedule) {
        if(date('Y-m-d') > $schedule['end_date']) {
            $update->changeShiftStatus($schedule['schedule_id']);
        }
    }
    if($_SESSION['admin_status'] == "D") {
        header("Location: login.php");
    }
 ?>
 <html>
 <body>
    <!-- Hero Area Section Begin -->
    <?php include 'heroArea.php' ; ?>
    <!-- Hero Area Section End -->
    <section class="services-section spad pt-5">
    <div class="container">
    <a href="ownerDashboard.php" class="btn btn-outline-light">Back to Dashboard</a>
        <h3 class="text-center text-white mb-5">Schedule</h3>

        <form action="action.php" method="post" class="mb-5">
            <div class="row mb-2">
            <span class="text-light col-2">Staff</span>
                <select name="staff_list" id="staff_list" class="form-control mr-1 ml-0 col-3" required>
                    <?php foreach($staffs as $staff) : ?>
                        <option value="<?= $staff['staff_id']?>"><?= $staff['name']; ?></option>
                    <?php endforeach ; ?>
                </select>
            </div>
            <div class="row mb-2">
                <span class="text-light col-2">Start Date</span><input type="date" name="start_date" id="start_date" class="form-control mr-1 ml-0 col-3" required min="">
                <span class="text-light col-2">End Date</span><input type="date" name="end_date" id="end_date" class="form-control mr-1 ml-0 col-3" required min="">
            </div>
            <div class="row mb-2">
                <span class="text-light col-2">Start Time</span><input type="time" name="start_time" id="" class="form-control mr-1 ml-0 col-3" min="9:00" required>
                <span class="text-light col-2">End Time</span><input type="time" name="end_time" id="" class="form-control mr-1 ml-0 col-3" max="19:00" required>
            </div>
            <div class="row mb-2">
                <span class="text-light col-2">Break</span>
                <select name="break_time" id="" class="form-control col-3" required>
                    <option value="12:00">12:00-13:00</option>
                    <option value="13:00">13:00-14:00</option>
                    <option value="14:00">14:00-15:00</option>
                    <option value="15:00">15:00-16:00</option>
                    <option value="16:00">16:00-17:00</option>
                </select>
                <span class="text-light col-2">Day off</span>
                <input type="date" name="day_off" id="day_off" class="form-control col-3" required min="" max="" required>
            </div>
                <input type="submit" value="Add" name="add_shift" class="form-control btn form-btn col-2 ">
        </form>

        <table class="table table-hover table-light mb-0 text-center">
            <thead class="thead-dark">
                <tr>
                    <th>NAME</th>
                    <th>WEEK</th>
                    <th>START TIME</th>
                    <th>END TIME</th>
                    <th>BREAK</th>
                    <th>DAY OFF</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($schedules as $schedule) : ?>
                <?php if($schedule['end_date'] > date('Y-m-d')) : ?>
                    <tr>
                        <td><?= $retrieve->getStaffNameById($schedule['staff_id']); ?></td>
                        <td><?= substr($schedule['start_date'], 5)." - ".substr($schedule['end_date'], 5) ; ?></td>
                        <td><?= substr($schedule['shift_start'], 0, 5); ?></td>
                        <td><?= substr($schedule['shift_end'], 0, 5); ?></td>
                        <td><?= substr($schedule['break_start'], 0, 5)." - ".substr($schedule['break_end'], 0, 5); ?></td>
                        <td class="text-uppercase"><?= $schedule['day_off']; ?></td>
                    </tr>
                <?php endif ; ?>
                <?php endforeach ; ?>
            </tbody>
        </table>

    </div><!--end container-->
    </section>
    <!-- Room Section End -->
<?php require_once 'inner_footer.php' ; ?>