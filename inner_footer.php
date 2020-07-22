

<footer id="footer" class="footer-section">

<div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <ul>
                            <li class="active"><a href="./index.php">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Staff</a></li>
                            <li><a href="#">News</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-lg-12 ">
                        <div class="small text-white text-center"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>document.write(new Date().getFullYear());</script> 
                            All rights reserved | Hokuto<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
</footer>
    <!-- Footer Section End -->
    <script>
        //staffDashboard
        $('.toggler-profile').on('click', function() {
            $('.profile-menu').toggle();
        });
        $('.toggler-reservations').on('click', function() {
            $('.reservations-menu').toggle();
        });

        //ownerDashboard
        $('#toggler-service').on('click', function() {
            $('#service-menu').toggle();
        });
        $('.toggler-staff').on('click', function() {
            $('.staff-menu').toggle();
        });
        $('.toggler-customers').on('click', function() {
            $('.customers-menu').toggle();
        });
        $('.toggler-reports').on('click', function() {
            $('.reports-menu').toggle();
        });
        $('.toggler-coupons').on('click', function() {
            $('.coupons-menu').toggle();
        });

        //adminDashboard
        $('.toggler-owner').on('click', function() {
            $('.owner-menu').toggle();
        });
        $('.toggler-company').on('click', function() {
            $('.company-menu').toggle();
        });

        //choose staff
        $(document).ready(function() {
            $("#service-list").change(function() {
                var getServiceID = $(this).val();
                var reserve_date = $('#reserve_date').val();
                $.ajax({
                    type: 'GET',
                    url: 'ajax.php',
                    data: {service:getServiceID, reserve_date:reserve_date},
                    success: function(data) {
                        $("#staff-select").html(data);
                    } 
                });

            });

            $('#reserve_date').change(function() {
                var reserve_date = $(this).val();
                var service_list = $('#service-list').val();

                $.ajax({
                    type:'GET',
                    url:'shift_ajax.php',
                    data:{reserve_date:reserve_date, service_id:service_list},
                    success:function(data) {
                        $('#staff-select').html(data);
                    }
                })
            })
        });

        $(document).ready(function() {
            //delete message
            
            $("#delete-message").click(function() {
                var url2= window.location.href;
                $.ajax({
                    type: 'GET',
                    url: 'ajax.php',
                    data: {cm:"t"},
                    success: function(){
                        window.location = url2;
                    }
                });
            });

            //display daily profits
            $('#date-select').change(function() {
                var selected_date = $(this).val();

                $.ajax({
                    type: 'GET',
                    url: 'ajax.php',
                    data:{date:selected_date},
                    success: function(data) {
                        $('#report-table').html(data);
                    }
                });

            });

            //display monthly profits
            $('#month-select').change(function() {
                var selected_month = $(this).val();

                $.ajax({
                    type: 'GET',
                    url: 'ajax.php',
                    data:{month:selected_month},
                    success: function(data) {
                        $('#report-table').html(data);
                    }
                });

            });

            //check overlapping shift
            $('#staff_list').change(function() {
                var staff_id = $(this).val();

                $.ajax({
                    type: 'GET',
                    url: 'shift_ajax.php',
                    data:{id:staff_id},
                    success: function(data) {
                        data = $.trim(data);
                        $('#start_date').attr('min', data);
                    }
                });

            });

            $('#start_date').change(function() {
                var start_date = $('#start_date').val();
                $('#end_date').removeAttr('disabled');
                $('#end_date').attr('min', start_date);
                
                $.ajax({
                    type: 'GET',
                    url: 'shift_ajax.php',
                    data:{start_date:start_date},
                    success: function(data) {
                        data = $.trim(data);
                        $('#end_date').attr('max', data);
                    }
                });
            });

            $('#start_date').change(function() {
                $('#end_date').change(function() {
                    var start_date = $('#start_date').val();
                    var end_date = $('#end_date').val();

                    $('#day_off').attr({'min':start_date, 'max':end_date});
                });

            });

            function readURL(input, display) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                    $(display).attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

                $('#select-staff-img').change(function() {
                readURL(this, '#display-staff-img');

                });
                $('#select-service-img').change(function() {
                readURL(this, '#display-service-img');
                });
        });

        
    </script>
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>