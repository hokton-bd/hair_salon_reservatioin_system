<!-- Search Filter Section Begin -->
<section class="search-filter">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="action.php" method="post" class="check-form">
                        <h4>Check Availability</h4>
                        <div class="row">

                            <div class="date-pick mx-auto w-25">
                                <p>DATE</p>
                                <!-- <input type="date" name="date" class="datepicker-1" value="yyyy / mm / dd"> -->
                                <input class="form-control" type="date" name="date" id="calender" value="yyy/md/dd" required>
                                <input class="form-control reserve-time" type="time" name="time" id="" value="" min="10:00" max="18:00" required>
                                <small class="office-hour">Choose 10:00 - 18:00</small>
                                <!-- <img src="img/calendar.png" alt=""> -->
                                
                            </div>

                            <div class="room-selector mx-autp w-25">
                                <p class="mb-2">Service</p>
                                <select class="form-control mt-2 service-select nice-select" name="service" required>
                                    <?php foreach($retrieve->getAllServices() as $row) : ?>
                                        <?php if($row['service_status'] == "A") : ?>
                                            <option class="text-uppercase service-list" value="<?= $row['service_id']; ?>"><?= $row['service_name']; ?></option>
                                        <?php endif ; ?>
                                    <?php endforeach ; ?>
                                </select>
                            </div>
                            <input type="submit" name="check_reserve" class="reserve-button form-control d-block mx-auto col-2 pb-5 pt-4" value="Go">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Search Filter Section End -->