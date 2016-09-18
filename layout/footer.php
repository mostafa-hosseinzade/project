<section class="mbr-section mbr-section--relative mbr-section--fixed-size" id="social-buttons2-10" style="background-color: rgb(240, 240, 240);">


    <div class="mbr-section__container container">
        <div class="mbr-header mbr-header--inline row">
            <div class="col-sm-4">
                <h3 class="mbr-header__text">FOLLOW US</h3>
            </div>
            <div class="mbr-social-icons mbr-social-icons--style-1 col-sm-8">
                <a class="mbr-social-icons__icon socicon-bg-twitter" title="Twitter" target="_blank" href="https://twitter.com/mobirise"><i class="socicon socicon-twitter"></i></a> 
                <a class="mbr-social-icons__icon socicon-bg-facebook" title="Facebook" target="_blank" href="https://www.facebook.com/pages/Mobirise/1616226671953247"><i class="socicon socicon-facebook"></i></a> 
                <a class="mbr-social-icons__icon socicon-bg-google" title="Google+" target="_blank" href="https://plus.google.com/u/0/+Mobirise/posts"><i class="socicon socicon-google"></i></a> 
                <a class="mbr-social-icons__icon socicon-bg-github" title="GitHub" target="_blank" href="https://github.com/Mobirise"><i class="socicon socicon-github"></i></a> 
                <a class="mbr-social-icons__icon socicon-bg-android" title="Google Play" target="_blank" href="#"><i class="socicon socicon-android"></i></a>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section mbr-section--relative mbr-section--fixed-size" id="contacts3-7" style="background-color: rgb(60, 60, 60);">

    <div class="mbr-section__container container" style="direction: rtl;text-align: right">
        <div class="mbr-contacts mbr-contacts--wysiwyg row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="mbr-contacts__text"><strong>ADDRESS</strong><br>
                            1234 Street Name<br>
                            City, AA 99999<br><br>
                            <strong>CONTACTS</strong><br>
                            Email: support@mobirise.com<br>
                            Phone: +1 (0) 000 0000 001<br>
                            Fax: +1 (0) 000 0000 002</p>
                    </div>
                    <div class="col-sm-6"><p class="mbr-contacts__text"><strong>LINKS</strong></p><ul class="mbr-contacts__list"><li><a class="mbr-contacts__link text-gray" href="http://mobirise.com/">Website builder</a></li><li><a class="mbr-contacts__link text-gray" href="http://mobirise.com/mobirise-free-win.zip">Download for Windows</a></li><li><a class="mbr-contacts__link text-gray" href="http://mobirise.com/mobirise-free-mac.zip">Download for Mac</a></li></ul></div>
                </div>
            </div>
            <div class="mbr-contacts__column col-sm-4" >
                <?php
                if ($_POST && isset($_POST['contact'])) {
                    if (empty($_POST['email']) || empty($_POST['message'])) {
                        $msg = "ایمیل و متن پیام نمی تواند خالی باشد";
                    } else {
                        $data = array('name' => $_POST['name'], 'mobile' => $_POST['mobile'], 'email' => $_POST['message'], 'message' => $_POST['message']);
                        $result = $defaultController->insert('contact', $data);
                        if ($result == true) {
                            $msg = "اطلاعات با موفقیت ثبت شد";
                        } else {
                            $msg = "مشکل در ثبت اطلاعات لطفا دوباره امتحان کنید";
                        }
                    }
                }
                ?>
                <form method="post">
                    <?php if (isset($msg) && !empty($msg)): ?>
                        <div class="alert">
                            <?php echo $msg; ?>
                            <button type="button" class="close" style="background-color: #18d596" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <input type="hidden" name="contact" value="true"/>
                    <div class="form-group">
                        <input type="text" class="form-control input-sm input-inverse" name="name" required="" placeholder="name*">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control input-sm input-inverse" name="mobile" required="" placeholder="Phone or mobile*">
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control input-sm input-inverse" name="email" required="" placeholder="Email*">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control input-sm input-inverse" name="message" placeholder="Message" rows="4"></textarea>
                    </div>
                    <div class="mbr-buttons mbr-buttons--right btn-inverse"><button type="submit" class="mbr-buttons__btn btn btn-danger">ارسال اطلاعات</button></div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/smooth-scroll/SmoothScroll.js"></script>
<script src="assets/jarallax/jarallax.js"></script>
<script src="assets/mobirise/js/script.js"></script>


</body>
</html>