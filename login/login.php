<?php
require_once '../Admin/Controller/LoginController.php';
require_once '../Admin/lib/DB.php';
$loginController = new LoginController();
@session_start();
//Check User Is Login if is login redirect
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] == 'user') {
        header('Location: /project/User');
    } else if ($_SESSION['user']['role'] == 'admin') {
        header('Location:/project/Admin/views/users');
    }
}
//send data for login
if ($_POST) {
    $info = $_POST;
    if (empty($info)) {
        $data['msg'] = "لطفا صفحه را مجددا بارگزاری نمائید";
    }
    if (empty($info['username']) || empty($info['email']) || empty($info['password'])) {
        $data['msg'] = "مشکل در اطلاعات ارسال شده";
    }


    $result = $loginController->CheckLogin($info);
    if (!empty($result)) {
        if ($result['role'] == 'admin') {
            header('Location: /project/Admin/views/users');
        } else {
            header('Location: /project/User');
        }
    } else {
        $msg = "کاربری با این اطلاعات یافت نشد";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>فرم ورود</title>

        <!-- Bootstrap -->
        <link href="../bundles/css/bootstrap.rtl.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <h2><a class="btn btn-info" href="/project" style="border-radius:  0px;font-size: 0.7em;margin-right: 10px"><span class="glyphicon glyphicon-forward"></span> <span>بازگشت</span></a></h2>
        <div class="container">
            <div class="col-lg-4 col-md-4 hidden-xs hidden-sm">

            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <h3><?php if (isset($msg)) echo $msg; ?></h3>
                    <form method="post" style="text-align: center;margin-top: 40px;">
                        <h2>فرم ورود</h2>
                        <input type="text" name="username" placeholder="User Name"  class="form-control"><br>
                        <input type="text" name="email" placeholder="Email"  class="form-control"><br/>
                        <input type="text" name="password" placeholder="Password"  class="form-control">
                        <input type="submit" class="btn btn-primary form-control" >
                        <a href="#/resset" >رمز خود را فراموش کرده ام</a>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 hidden-xs hidden-sm">

            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>