   <!-- Footer Section Begin -->
   <footer id="footer" class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-item">
                        <div class="footer-logo">
                            <a href="#"><img src="img/logo.png" alt=""></a>
                        </div>
                        <p>Dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-item">
                        <h5>Contact us</h5>
                        <div class="newslatter-form">
                            <input class="form-control mb-2" type="email" name="email" id="" placeholder="Email">
                            <textarea style="background-color: #676767; border: none; font-size: 11px; padding-left: 25px; resize: none;" class="form-control mb-3 text-white" placeholder="Message" name="message" id="message-contents" cols="30" rows="10"></textarea>
                            <input id="submit-btn" type="submit" value="Send" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="footer-item">
                        <ul>
                            <li><img src="img/placeholder.png" alt="">1525 Boring Lane,<br />Los Angeles, CA</li>
                            <li><img src="img/phone.png" alt="">+1 (603)535-4592</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
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
    //delete message
    $(document).ready(function() {
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