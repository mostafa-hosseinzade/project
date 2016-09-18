<?php
require_once '../layout/header.php';
$defaulController = new DefaultController();

if ($_POST) {
    if (isset($_POST['edit'])) {
        $data = $_POST;
        unset($data['edit']);
        $result = $defaulController->update('comment', $data);
        $msg = "اطلاعات با موفقیت ویرایش شد";
    } else if (isset($_POST['delete']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $defaulController->remove('comment', $id);
        $msg = "اطلاعات با موفقیت حذف شد";
    } else {
        $data = $_POST;
        $defaulController->insert('comment', $data);
        $msg = "اطلاعات با موفقیت اضافه شد";
    }
}
$users = $defaulController->findAll('comment');
?>
<?php if (isset($msg) && !empty($msg)): ?>
    <div class="alert">
        <?php echo $msg; ?>
        <button type="button" class="close" style="background-color: #18d596" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<table class="display" id="test">
    <thead>
    <th>Id</th>
    <th>مربوط به</th>
    <th>کامنت</th>
    <th>پاسخ</th>
    <th>کاربر</th>
    <th>action</th>
</thead>
<tbody>
    <?php foreach ($users as $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
             <td><?php
                if (!empty($value['content_id'])) {
                    $user = $defaulController->find('content', $value['content_id']);
                    if (!empty($user)) {
                        echo $user[0]['title'];
                    }
                }
                ?>
            </td>
            <td><?php echo $value['comment']; ?></td>
            <td><?php echo $value['response']; ?></td>
            <td><?php
                if (!empty($value['user_id'])) {
                    $user = $defaulController->find('users', $value['user_id']);
                    if (!empty($user)) {
                        echo $user[0]['username'];
                    }
                }
                ?></td>
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
                                    <label>Response : </label>
                                    <textarea class="form-control" name="response" ><?php echo $value['response']; ?></textarea>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label> مقاله: </label>
                                    <select name="content_id" class="form-control">
                                        <?php
                                        $content = $defaulController->findAll('content');
                                        foreach ($content as $items) :
                                            ?>
                                            <option value="<?php echo $items['id']; ?>" <?php if ($value['id'] == $items['id']) echo 'selected'; ?>><?php echo $items['title']; ?></option>
                                        <?php endforeach; ?>
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
<thead>
    <th>Id</th>
    <th>مربوط به</th>
    <th>کامنت</th>
    <th>پاسخ</th>
    <th>کاربر</th>
    <th>action</th>

</tfoot>
</table> 
<script>
    $(document).ready(function () {
        $('#test').DataTable();
    });
</script>
<?php
require_once '../layout/footer.php';
?>
