<?php
require_once './layout/header.php';

if ($_GET && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if (empty($id)) {
        header('Location:/project/posts.php');
    }
    $post = $defaultController->find('post', $id);
    $post_response = $defaultController->DB('post_response')
            ->findBy(array('post_id', $id));

    if ($_POST && isset($_POST['response'])) {
        if (empty($_POST['response'])) {
            $msg = "متن پیام نمی تواند خالی باشد";
        } else {
            @session_start();
            $user = $_SESSION['user'];
            if (!empty($user)) {
                $data = array('post_id' => $id, 'response' => $_POST['response'], 'user_id' => $user['id']);
                $result = $defaultController->insert('post_response', $data);
                if ($result == true) {
                    $msg = "اطلاعات با موفقیت ثبت شد";
                } else {
                    $msg = "مشکل در ثبت اطلاعات لطفا دوباره امتحان کنید";
                }
            }
        }
    }
} else {
    header('Location:/project/posts.php');
}
?>

<section class="content-2 simple col-1 col-undefined mbr-parallax-background" id="content5-15" style="background-image: url(assets/images/parallax-bg51900x1267-163.jpg);">
    <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(40, 50, 78);"></div>
    <div class="container">
        <div class="row">
            <div>
                <?php if (isset($msg) && !empty($msg)): ?>
                    <div class="alert" style="direction: rtl;background-color: white">
                        <?php echo $msg; ?>
                        <button type="button" class="close" style="background-color: #18d596" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="thumbnail" style="direction: rtl;    background-color: rgba(0,0,0,0.4);">
                    <div class="caption">
                        <h3><?php echo $post[0]['title']; ?></h3>
                        <div>
                            <p>
                                <?php echo $post[0]['describtion']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="msgbox-1" id="msg-box1-13" style="background-color: rgb(60, 60, 60);">


    <div class="container">
        <div class="row">
            <h2 style="letter-spacing: 0px">پاسخ ها</h2>
            <?php foreach ($post_response as $r) { ?>
                <div class="col-sm-12" style="margin-top: 3px;margin-bottom: 3px;    background-color: rgba(255,255,255,0.5);">
                    <h2><?php
                        $user = $defaultController->find('users', $r['user_id']);
                        echo $user[0]['username'];
                        ?></h2>
                    <p>
                        <?php
                        echo $r['response'];
                        ?>
                    </p>
                </div>
            <?php } ?>

            <div class="col-lg-12">
                <?php if ($loginController->isLogin('user') || $loginController->isLogin('admin')) { ?>
                    <button data-toggle="modal" data-target="#myModal" class="btn btn-info btn-lg" style="border-radius: 0px" >
                        ارسال پاسخ
                    </button>
                <?php } else { ?>
                <button disabled="true" class="btn btn-info btn-lg" style="border-radius: 0px" >
                        برای ارسال پاسخ باید وارد شوید
                    </button>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" style="z-index: 2000" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="post">

                <input type="hidden" name="response" value="true"/>
                <div class="modal-header">
                    <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title pull-right" id="myModalLabel">ارسال پاسخ</h4>
                    <br/>
                </div>
                <div class="modal-body" style="direction: rtl">
                    <label>پاسخ : </label>
                    <textarea class="form-control" name="response" placeholder="Describtion" ></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary pull-left">ثبت پاسخ</button>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">انصراف</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
require_once './layout/footer.php';
?>