<?php
require_once './layout/header.php';
$content = $defaultController->DB('content')->paginate(0, 9, 'desc', 'visit');
$post = $defaultController->DB('post')->paginate(0, 4, 'desc', 'id');
?>

<section class="mbr-box mbr-section mbr-section--relative mbr-section--fixed-size mbr-section--full-height mbr-section--bg-adapted mbr-parallax-background" id="header1-1" style="background-image: url(assets/images/parallax-bg11920x1280-167.png);">
    <div class="mbr-box__magnet mbr-box__magnet--sm-padding mbr-box__magnet--center-center">

        <div class="mbr-box__container mbr-section__container container">
            <div class="mbr-box mbr-box--stretched"><div class="mbr-box__magnet mbr-box__magnet--center-center">
                    <div class="row"><div class=" col-sm-8 col-sm-offset-2">
                            <div class="mbr-hero animated fadeInUp">
                                <h1 class="mbr-hero__text">سایت آموزش برنامه نویسی افق</h1>
                                <p class="mbr-hero__subtext">یادگیری برنامه نویسی را برای شما آسان کرده ایم</p>
                            </div>
                            <div class="mbr-buttons btn-inverse mbr-buttons--center"><a class="mbr-buttons__btn btn btn-lg btn-danger animated fadeInUp delay" href="/project/showall.php" style="font-weight: bold">مقالات</a> <a class="mbr-buttons__btn btn btn-lg btn-default animated fadeInUp delay" href="/project/posts.php" style="font-weight: bold">بحث و گفتگو</a></div>
                        </div></div>
                </div></div>
        </div>
        <div class="mbr-arrow mbr-arrow--floating text-center">
            <div class="mbr-section__container container">
                <a class="mbr-arrow__link" href="#content5-3"><i class="glyphicon glyphicon-menu-down"></i></a>
            </div>
        </div>
    </div>
</section>

<section class="content-2 simple col-1 col-undefined" id="content5-3" style="background-color: rgb(0, 168, 133);">

    <div class="container">
        <div class="row">
            <div>
                <div class="thumbnail">
                    <div class="caption">
                        <h3>چند نکته!</h3>
                        <div><p>
                                باور ما اینست که کاربران ایرانی لایق بهترین ها هستند و باید بهترین و بروزترین فیلم های آموزشی و مقالات در اختیار آنها قرار بگیرد تا بتوانند به سرعت پیشرفت کنند و جزء بهترین ها در صنعت طراحی و برنامه نویسی وب شوند . با ما همراه باشید تا بهترین ها رو لایق بهترین کاربران کنیم
                                <br/>
                                در این پست قصد دارم یک ابزار یا به اصطلاح کتابخانه جاوا اسکریپتی ساده و واقعا سبک را به شما معرفی کنم که با استفاده از این کتابخانه میتوانید به سادگی انیمیشن های gradient برای وبسایت خود ایجاد کنید .
                            </p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section mbr-section--relative mbr-section--fixed-size mbr-parallax-background" id="testimonials1-8" style="background-image: url(assets/images/parallax-bg51900x1267-151.jpg);">
    <div>
        <div class="mbr-overlay" style="opacity: 0.3; background-color: rgb(34, 34, 34);"></div>
        <div class="mbr-section__container mbr-section__container--std-padding container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="mbr-section__header" style="letter-spacing: 0px">آخرین مقالات سایت</h2>
                    <ul class="mbr-reviews mbr-reviews--wysiwyg row">
                        <?php foreach ($content as $items) : ?>
                            <li class="mbr-reviews__item col-sm-6 col-md-4">
                                <a class="linkShow" href="showcontent.php?id=<?php echo $items['id']; ?>">    
                                    <div class="mbr-reviews__text">
                                        <h4 style="text-align: right;direction: rtl"><?php echo $items['title']; ?></h4>
                                        <p class="mbr-reviews__p"><?php
                                            $val = strip_tags($items['content']);
                                            $val = substr($val, 0, 300);
                                            echo $val;
                                            ?>
                                        </p>
                                    </div>
                                </a>
                                <div class="mbr-reviews__author mbr-reviews__author--short">
                                    <div class="mbr-reviews__author-name"><?php
                                        $user = $defaultController->find('users', $items['user_id']);
                                        if (!empty($user)) {
                                            echo $user[0]['username'];
                                        } else {
                                            echo 'برنامه نویس';
                                        }
                                        ?></div>
                                    <div class="mbr-reviews__author-bio">
                                        <?php
                                        if (!empty($user) && $user[0]['role'] == 'Admin') {
                                            echo 'مدیریت';
                                        } else {
                                            echo 'کاربر';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </li>

                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12" style="text-align: center">
                <a href="showall.php" class="btn btn-success" style="text-align: center">نمایش تمام مقاله ها</a>
            </div>
        </div>
    </div>
</section>

<section class="content-2 simple col-4" id="content4-9" style="background-color: rgb(255, 255, 255);">

    <div class="container">
        <div class="col-lg-12" style="text-align: center">
            <h3 style="letter-spacing: 0px">نمایش آخرین پست ها</h3>
        </div>
        <div class="row">
            <?php foreach ($post as $p) : ?>
                <div>
                    <div class="thumbnail">
                        <div class="caption">
                            <div>
                                <h3><?php echo $p['title']; ?></h3>
                                <p><?php echo $p['describtion']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<style>
    .mbr-reviews__text{
        direction: rtl;
        background-color: rgba(255,255,255,0.8) !important;
    }
    .mbr-reviews__text:hover{
        background-color: rgba(255,255,255,1) !important;
    }
    .linkShow{
        text-decoration:  none;
    }
    .linkShow:hover,.linkShow:active{
        text-decoration: none;
    }
</style>
<?php
require_once './layout/footer.php';
?>