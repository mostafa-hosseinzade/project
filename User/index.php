<?php
require_once '../Admin/Controller/DefaultController.php';
require_once '../Admin/lib/DB.php';
require_once '../Admin/lib/DBTable.php';
require_once '../Admin/Controller/LoginController.php';
$loginController = new LoginController();
@session_start();
if ($_GET && isset($_GET['logout'])) {
    session_destroy();
}
if($_POST && isset($_POST['edit'])){
    $info = $_POST;
    $password = $_SESSION['user']['password'];
    if(!empty($info['password'])){
        $password = $loginController->SaltPassword($info);
        $password = $password['password'];
    }
    $userData = array('id'=>$info['id'],"username"=>$info['username'],'password'=>$password
                ,'name'=>$info['name'],'address'=>$info['address'],
            'phone'=>$info['phone'],
            'email'=>$info['email']);
    $defaultController = new DefaultController();
    $result = $defaultController->update('users', $userData);
    if($result == true){
        $msg = "اطلاعات با موفقیت ویرایش شد";
        unset($_SESSION['user']);
        $user = $defaultController->find("users", $info['id']);
        $_SESSION['user'] = $user[0];
    }else{
        $msg ="مشکل در ویرایش اطلاعات";
    }
}

$check = $loginController->isLogin('user');
if($check == false){
    header("Location: /project/login/login.php");
}
$value = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Project</title>

        <!-- Bootstrap -->
        <link href="../bundles/css/bootstrap.rtl.css" rel="stylesheet">
        <link href="../bundles/css/css-datatable.css" rel="stylesheet">
        <script src="../bundles/js/jquery-datatable.js"></script>
        <script src="../bundles/js/datatable.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Project</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class=""><a href="/project">صفحه اصلی <span class="sr-only">(current)</span></a></li>
                    </ul>
                    <ul class="nav navbar-left">
                        <li><a href="?logout=true">خروج</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container" style="margin-top: 60px">
             <form method="post">
                  <h3><?php if (isset($msg)) echo $msg; ?></h3>
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
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                </form>
        </div>
    </body>
</html>