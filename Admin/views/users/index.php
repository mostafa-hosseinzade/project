<?php
require_once '../layout/header.php';
$defaulController = new DefaultController();

if ($_POST) {
    if (isset($_POST['edit'])) {
        $data = $_POST;
        unset($data['edit']);
        $result = $defaulController->update('users', $data);
        $msg = "اطلاعات با موفقیت ویرایش شد";
    } else if (isset($_POST['delete']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $defaulController->remove('users', $id);
        $msg = "اطلاعات با موفقیت حذف شد";
    } else {
        $data = $_POST;
        $createPassword = new LoginController();
        $password = $createPassword->SaltPassword($data);
        $data['password'] = $password['password'];
        $defaulController->insert('users', $data);
    }
}
$users = $defaulController->findAll('users');
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
    <th>name</th>
    <th>Username</th>
    <th>Email</th>
    <th>Address</th>
    <th>Phone</th>
    <th>وضعیت</th>
    <th>نوع کاربر</th>
    <th>action</th>
</thead>
<tbody>
    <?php foreach ($users as $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['username']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['address']; ?></td>
            <td><?php echo $value['phone']; ?></td>
            <td>
                <?php if ($value['enable'] == true): ?>
                    <span style="color: green">فعال</span>
                <?php else: ?>
                    <span style="color: red">غیر فعال</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($value['role'] == 'admin'): ?>
                    <span >مدیریت</span>
                <?php else: ?>
                    <span >کاربر عادی</span>
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
                                    <label>Name : </label>
                                    <input type="text" class="form-control" name="name" value="<?php echo $value['name']; ?>" />
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label>User Name : </label>
                                    <input type="text"  class="form-control" name="username" value="<?php echo $value['username']; ?>" />
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label>Email : </label>
                                    <input type="text" name="email" class="form-control" value="<?php echo $value['email']; ?>" />
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label>Password : </label>
                                    <input type="text" class="form-control" name="password" value="" />
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label>Address : </label>
                                    <input type="text" class="form-control" name="address" value="<?php echo $value['address']; ?>" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label>Phone : </label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo $value['phone']; ?>" />
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label>وضعیت : </label>
                                    <select name="enable" class="form-control">
                                        <option value="1" <?php if ($value['enable'] == 1) echo 'selected'; ?>>enable</option>
                                        <option value="0" <?php if ($value['enable'] == 0) echo 'selected'; ?>>Disable</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <label>سطح دسترسی : </label>
                                    <select name="enable" class="form-control">
                                        <option value="user" <?php if ($value['role'] == 'user') echo 'selected'; ?>>کاربر عادی</option>
                                        <option value="admin" <?php if ($value['role'] == 'admin') echo 'selected'; ?> >مدیریت</option>
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
<th>name</th>
<th>Username</th>
<th>Email</th>
<th>Address</th>
<th>Phone</th>
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
                                <label>Name : </label>
                                <input type="text" class="form-control" name="name" />
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label>User Name : </label>
                                <input type="text"  required="true" class="form-control" name="username" />
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label>Email : </label>
                                <input type="email" required="true" name="email" class="form-control" />
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label>Password : </label>
                                <input type="text" required="true" class="form-control" name="password" value="" />
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label>Address : </label>
                                <input type="text" class="form-control" name="address"  />
                            </div>

                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label>Phone : </label>
                                <input type="text" class="form-control" name="phone"  />
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label>وضعیت : </label>
                                <select name="enable" class="form-control">
                                    <option value="1" >enable</option>
                                    <option value="0" >Disable</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <label>سطح دسترسی : </label>
                                <select name="enable" class="form-control">
                                    <option value="user" >کاربر عادی</option>
                                    <option value="admin" >مدیریت</option>
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
