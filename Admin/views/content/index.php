<?php
require_once '../layout/header.php';
$defaulController = new DefaultController();

if ($_POST) {
    if (isset($_POST['edit'])) {
        $data = $_POST;
        unset($data['edit']);
        $result = $defaulController->update('content', $data);
        $msg = "اطلاعات با موفقیت ویرایش شد";
    } else if (isset($_POST['delete']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $defaulController->remove('content', $id);
        $msg = "اطلاعات با موفقیت حذف شد";
    } else {
        $data = $_POST;
        $defaulController->insert('content', $data);
        $msg = "اطلاعات با موفقیت اضافه شد";
    }
}
$users = $defaulController->findAll('content');
?>
<?php if (isset($msg) && !empty($msg)): ?>
    <div class="alert">
        <?php echo $msg; ?>
        <button type="button" class="close" style="background-color: #18d596" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<script src="../../../bundles/ckeditor/ckeditor.js"></script>
<div class="col-lg-12"><button class="pull-left btn btn-success" data-toggle="modal" data-target="#myModalCreate">Add</button></div>
<table class="display" id="test">
    <thead>
    <th>Id</th>
    <th>title</th>
    <th>محتوا</th>
    <th>دسته بندی</th>
    <th>کاربر</th>
    <th>تعداد نمایش</th>
    <th>اولویت نمایش</th>
    <th>action</th>
</thead>
<tbody>
    <?php foreach ($users as $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['title']; ?></td>
            <td><?php
                $content = strip_tags($value['content']);
                $content = substr($content, 0, 60);
                echo $content;
                ?></td>
            <td><?php
                if (!empty($value['ctg_id'])) {
                    $ctg = $defaulController->find('contentcategory', $value['ctg_id']);
                    if (!empty($ctg)) {
                        echo $ctg[0]['title'];
                    }
                }
                ?>
            </td>

            <td><?php
                if (!empty($value['user_id'])) {
                    $user = $defaulController->find('users', $value['user_id']);
                    if (!empty($user)) {
                        echo $user[0]['username'];
                    }
                }
                ?></td>
            <td>
                <?php echo $value['visit']; ?>
            </td>
            <th>
                <?php echo $value['order_list']; ?>
            </th>
            <td>
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModalShow<?php echo $value['id']; ?>">show</button>
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal<?php echo $value['id']; ?>" onclick="ck('TextAreaEdit<?php echo $value['id']; ?>')">edit</button>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalDelete<?php echo $value['id']; ?>">delete</button>
            </td>

            <!-- Modal -->
    <div class="modal fade" id="myModalDelete<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $value['id']; ?>" />
                    <input type="hidden" name="delete" value="true" />
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <h3>آیا از حذف اطلاعات مطمئن هستید ؟</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalShow<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">نمایش اطلاعات مقالات</h4>
                </div>
                <div class="modal-body">
                    <h3><?php echo $value['title']; ?></h3> 
                    <?php echo $value['content']; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post">
                    <input type="hidden" name="edit" value="true" />
                    <input type="hidden" name="id" value="<?php echo $value['id'] ?>" />
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">ویرایش اطلاعات</h4>
                    </div>
                    <div class="modal-body">

                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label>Title : </label>
                                    <input type="text" class="form-control" name="title" value="<?php echo $value['title']; ?>" />
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label>Content : </label>
                                    <textarea class="form-control" id="TextAreaEdit<?php echo $value['id']; ?>" name="content" ><?php echo $value['content']; ?></textarea>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label> دسته بندی: </label>
                                    <select name="ctg_id" class="form-control">
                                        <?php
                                        $ctg_id = $defaulController->findAll('contentcategory');
                                        foreach ($ctg_id as $items) :
                                            ?>
                                            <option value="<?php echo $items['id']; ?>" <?php if ($value['id'] == $items['id']) echo 'selected'; ?>><?php echo $items['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label>اولویت : </label>
                                    <input type="number" name="order_list" value="<?php echo $value['order_list']; ?>" />
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </tr>
<?php } ?>    
</tbody>
<tfoot>
<th>Id</th>
<th>title</th>
<th>محتوا</th>
<th>دسته بندی</th>
<th>کاربر</th>
<th>تعداد نمایش</th>
<th>اولویت نمایش</th>
<th>action</th>

</tfoot>
</table> 

<div class="modal fade" id="myModalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ویرایش اطلاعات</h4>
                </div>
                <div class="modal-body">

                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label>Title : </label>
                                <input type="text" class="form-control" name="title" placeholder="Title" />
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label>محتوا : </label>
                                <textarea id="TextAreaAdd" class="form-control" name="content" placeholder="Content" ></textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label> دسته بندی: </label>
                                <select name="ctg_id" class="form-control">
                                    <?php
                                    $ctg_id = $defaulController->findAll('contentcategory');
                                    foreach ($ctg_id as $items) :
                                        ?>
                                        <option value="<?php echo $items['id']; ?>" ><?php echo $items['title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label>اولویت : </label>
                                <input type="number" name="order_list" value="<?php echo $value['order_list']; ?>" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#test').DataTable();
        CKEDITOR.replace("TextAreaAdd");
    });
</script>
<script>
    function ck(id) {
        CKEDITOR.replace(id);
    }
</script>
<?php
require_once '../layout/footer.php';
?>
