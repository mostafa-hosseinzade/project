<?php
require_once '../layout/header.php';
$defaulController = new DefaultController();

if ($_POST) {
     if (isset($_POST['delete']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $defaulController->remove('contact', $id);
        $msg = "اطلاعات با موفقیت حذف شد";
    } 
}
$users = $defaulController->findAll('contact');
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
    <th>نام</th>
    <th>تلفن </th>
    <th>ایمیل</th>
    <th>پیام</th>
    <th>عملیات</th>
</thead>
<tbody>
    <?php foreach ($users as $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['mobile']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['message']; ?></td>
            <td>
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
    
    </tr>
<?php } ?>    
</tbody>
<tfoot>
<th>Id</th>
<th>title</th>
<th>describtion</th>
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
