<?php
require_once './layout/header.php';
if ($_GET && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if (empty($id)) {
        header('Location : index.php');
    }
    $content = $defaultController->find('content', $id);
} else {
    header('Location : index.php');
}
$hotContent = $defaultController->DB('content')->paginate(0, 4, 'desc', 'visit');
$comments = $defaultController->DB("comment")->findBy(array("content_id" => $id));
?>
<section class="engine"><a rel="nofollow" href="">Mobirise website builder</a></section>
<section class="content-2 simple col-1 col-undefined mbr-parallax-background" id="content5-15" style="background-image: url(assets/images/parallax-bg51900x1267-163.jpg);">
    <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(40, 50, 78);"></div>
    <div class="container">
        <div class="row">
            <div>
                <div class="thumbnail" style="direction: rtl">
                    <div class="caption">
                        <h3><?php echo $content[0]['title']; ?></h3>
                        <div>
                            <p>
                                <?php echo $content[0]['content']; ?>
                            </p>
                        </div>
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
                        <?php
                        $i = 0;
                        foreach ($hotContent as $items) {
                            if ($items['id'] != $id) {
                                $i++;
                                if ($i <= 3) {
                                    ?>
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

                                    <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="mbr-section mbr-section--relative mbr-section--fixed-size" id="form1-13" style="background-color: rgb(204, 204, 204);">

    <div class="mbr-section__container mbr-section__container--std-padding container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="mbr-header mbr-header--center mbr-header--std-padding">
                            <h2 class="mbr-header__text" style="letter-spacing: 0px">ارسال نظر شما</h2>
                        </div>
                        <?php
                        if ($_POST && isset($_POST['comment'])) {
                            if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['comment'])) {
                                $msg = "لطفا اطلاعات را با دقت وارد نمائید";
                            } else {
                                $data = array('content_id' => $id, "name" => $_POST['name'], 'email' => $_POST['email'], 'comment' => $_POST['comment']);
                                $result = $defaultController->insert('comment', $data);
                                if ($result == true) {
                                    $msg = "نظر شما ثبت شد";
                                } else {
                                    $msg = "مشکل در ثبت اطلاعات لطقا بعدا دویاره تلاش کنید";
                                }
                            }
                        }
                        ?>
                        <form method="post" style="direction: rtl">
                            <?php if (isset($msg) && !empty($msg)): ?>
                                <div class="alert">
                                    <?php echo $msg; ?>
                                    <button type="button" class="close" style="background-color: #18d596" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" required="true" placeholder="نام*">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" required="true" placeholder="ایمیل*">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" required="true" name="comment" placeholder="پیام شما" rows="7"></textarea>
                            </div>
                            <div class="mbr-buttons mbr-buttons--right"><button type="submit" class="mbr-buttons__btn btn btn-lg btn-danger">ثبت نظر</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="msgbox-1" id="msg-box1-13" style="background-color: rgb(60, 60, 60);">


    <div class="container">
        <h2 style="letter-spacing: 0px">نظر های کاربران</h2>
        <div class="row">

            <?php foreach ($comments as $c): ?>
                <div class="col-sm-12" style="background-color: rgba(255,255,255,0.2);margin-top: 5px;margin-bottom: 5px;">
                    <h3 style="letter-spacing: 0px;direction: rtl"><?php echo $c['name'] ?></h3>
                    <p><?php echo $c['comment'] ?></p>
                    <?php if (!empty($c['response'])) { ?>
                        <div class="container" style="background-color: rgba(255,255,255,0.2);margin-bottom: 5px;direction: rtl;padding-right:  5px">
                            <h3 style="letter-spacing: 0">
                                <?php
                                if (!empty($c['user_id'])) {
                                    $user = $defaultController->find('users', $c['user_id']);
                                    if (!empty($user)) {
                                        echo $user[0]['username'];
                                    }
                                }
                                ?>
                            </h3>
                            <p> <?php echo $c['response']; ?></p>
                        </div>
                    <?php } ?> 
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

