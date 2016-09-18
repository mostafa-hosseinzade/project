<?php
require_once './layout/header.php';
if ($_GET && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if (empty($id)) {
        header('Location:/project/post.php');
    }
    $post = $defaultController->DB('post')->findBy(array('post_category_id' => $id));
} else {
    $offset = 0;
    if (isset($_GET['offset'])) {
        $offset = $_GET['offset'];
    }
    $post = $defaultController->paginate(
            'post', $offset, 12, 'desc', 'id');
    $count = $defaultController->DB('post')->query('select count(*) as c from post');
}
$post_category = $defaultController->findAll('post_category');
?>
<div class="clearfix"></div>

<section class="mbr-section mbr-section--relative mbr-section--fixed-size mbr-parallax-background" id="testimonials1-12" style="background-image: url(assets/images/parallax-bg51900x1267-161.jpg);">
    <div>

        <div class="mbr-section__container mbr-section__container--std-padding container">
            <div class="row">
                <div class="col-lg-12" dir="rtl">
                    <h2 style="letter-spacing: 0px">دسته بندی پست ها</h2>
                    <?php foreach ($post_category as $ctg) { ?>
                        <a href="/project/posts.php?id=<?php echo $ctg['id']; ?>" class="btn btn-info" style="border-radius: 0px;margin: 2px"><?php echo $ctg['title']; ?></a>
                    <?php } ?>
                    <br/>
                    <hr/>
                </div>
                <div class="col-sm-12">
                    <h2 class="mbr-section__header" style="letter-spacing: 0px;text-align: right">نمایش پست ها</h2>
                    <ul class="mbr-reviews mbr-reviews--wysiwyg row">
                        <?php foreach ($post as $items) : ?>
                            <li class="mbr-reviews__item col-sm-6 col-md-4">
                                <a class="linkShow" href="showpost.php?id=<?php echo $items['id']; ?>">    
                                    <div class="mbr-reviews__text">
                                        <h4 style="text-align: right;direction: rtl"><?php echo $items['title']; ?></h4>
                                        <p class="mbr-reviews__p" style="direction: rtl;text-align: right">
                                            <?php echo $items['describtion']; ?>
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
            <?php if (empty($id) && $count[0]['c'] > 10) { ?>
                <div class="col-lg-12" style="text-align: center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php if ($offset > 0): ?>
                                <li>
                                    <a href="?offset=<?php echo $offset - 10; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php
                            $count = round($count[0]['c'] / 10, 0, PHP_ROUND_HALF_UP);
                            for ($i = 1; $i <= $count; $i++) {
                                ?>
                                <li class="<?php if ($offset == $i * 10 - 10) echo 'active'; ?>"><a href="?offset=<?php echo $i * 10 - 10; ?>" ><?php echo $i ?></a></li>                                        
                            <?php } ?>
                            <li>
                                <a href="?offset=<?php echo $offset + 10; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<style>
    .mbr-reviews__text{
        direction: rtl !important;
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