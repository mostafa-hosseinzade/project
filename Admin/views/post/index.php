<?php
require_once '../layout/header.php';
$defaulController = new DefaultController();

if ($_POST) {
    if (isset($_POST['edit'])) {
        $data = $_POST;
        unset($data['edit']);
        $result = $defaulController->update('post', $data);
        $msg = "اطلاعات با موفقیت ویرایش شد";
    } else if (isset($_POST['delete']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $defaulController->remove('post', $id);
        $msg = "اطلاعات با موفقیت حذف شد";
    } else {
        $data = $_POST;
        $defaulController->insert('post', $data);
        $msg = "اطلاعات با موفقیت اضافه شد";
    }
}
$users = $defaulController->findAll('post');
?>
<?php if (isset($msg) && !empty($msg)): ?>
    <div class="alert">
        <?php echo $msg; ?>
        <button type="button" class="close" style="background-color: #18d596" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<div class="col-lg-12"><button class="pull-left btn btn-success" data-toggle="modal" data-target="#myModalCreate">Add</button></div>
<table class="display" id="test">
    <thead>
    <th>Id</th>
    <th>title</th>
    <th>describtion</th>
    <th>دسته بندی</th>
    <th>کاربر</th>
    <th>وضعیت</th>
    <th>action</th>
</thead>
<tbody>
    <?php foreach ($users as $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['title']; ?></td>
            <td><?php echo $value['describtion']; ?></td>

            <td><?php
                if (!empty($value['post_category_id'])) {
                    $user = $defaulController->find('post_category', $value['post_category_id']);
                    if (!empty($user)) {
                        echo $user[0]['title'];
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
                <?php if ($value['enable'] == true): ?>
                    <span style="color: green">فعال</span>
                <?php else: ?>
                    <span style="color: red">غیر فعال</span>
                <?php endif; ?>
            </td>
            <td>
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal<?php echo $value['id']; ?>">edit</button>
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
                                    <label>Describtion : </label>
                                    <textarea class="form-control" name="describtion" ><?php echo $value['describtion']; ?></textarea>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label> دسته بندی: </label>
                                    <select name="post_category_id" class="form-control">
                                        <?php
                                        $post_category = $defaulController->findAll('post_category');
                                        foreach ($post_category as $items) :
                                            ?>
                                            <option value="<?php echo $items['id']; ?>" <?php if ($value['id'] == $items['id']) echo 'selected'; ?>><?php echo $items['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label> کاربر سازنده : </label>
                                    <select name="user_id" class="form-control">
                                        <?php
                                        $users = $defaulController->findAll('users');
                                        foreach ($users as $items) :
                                            ?>
                                            <option value="<?php echo $items['id']; ?>" <?php if ($value['id'] == $items['id']) echo 'selected'; ?>><?php echo $items['username']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label>وضعیت : </label>
                                    <select name="enable" class="form-control">
                                        <option value="1" <?php if ($value['enable'] == 1) echo 'selected'; ?>>enable</option>
                                        <option value="0" <?php if ($value['enable'] == 0) echo 'selected'; ?>>Disable</option>
                                    </select>
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
<th>describtion</th>
<th>دسته بندی</th>
<th>کاربر</th>
<th>وضعیت</th>
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
                                <label>Describtion : </label>
                                <textarea class="form-control" name="describtion" placeholder="Describtion" ></textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label> دسته بندی: </label>
                                <select name="post_category_id" class="form-control">
                                    <?php
                                    $post_category = $defaulController->findAll('post_category');
                                    foreach ($post_category as $items) :
                                        ?>
                                        <option value="<?php echo $items['id']; ?>" ><?php echo $items['title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label> کاربر سازنده : </label>
                                <select name="user_id" class="form-control">
                                    <?php
                                    $users = $defaulController->findAll('users');
                                    foreach ($users as $items) :
                                        ?>
                                        <option value="<?php echo $items['id']; ?>" ><?php echo $items['username']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label>وضعیت : </label>
                                <select name="enable" class="form-control">
                                    <option value="1" >enable</option>
                                    <option value="0" >Disable</option>
                                </select>
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
    });
</script>
<?php
require_once '../layout/footer.php';
?>
