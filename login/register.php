<?php
if ($_POST) {
    $info = $_POST;
    if (empty($info)) {
        $msg = "لطفا صفحه را مجددا بارگزاری نمائید";
    } else
    if (empty($info['username']) || empty($info['email']) || empty($info['password1']) || empty($info['password2'])) {
        $msg = "مشکل در اطلاعات ارسال شده";
    } else if ($info['password1'] != $info['password2']) {
        $msg = "رمز عبور یکسان وارد نشده است";
    } else {
        //include file need
        require_once '../Admin/lib/DB.php';
        require_once '../Admin/lib/DBTable.php';
        require_once '../Admin/Controller/DefaultController.php';
        require_once '../Admin/Controller/LoginController.php';
        
        $data = array("username"=>$info['username'],'password'=>$info['password1']
                ,'name'=>$info['name'],'address'=>$info['address'],
            'phone'=>$info['phone'],
            'email'=>$info['email'],'role'=>'user');
        $loginController = new LoginController();
        $result = $loginController->CreateUser($data);
        if ($result == true) {
            $msg = "اطلاعات با موفقیت ثبت شد اکنون میتوانید با اطلاعاتی که وارد کردید وارد پنل خود شوید";
        } else {
            $msg = "مشکل در ثبت اطلاعات لطفا دوباره امتحان کنید";
        }
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
        <title>Register Page</title>

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
                    <form method="post" style="margin-top: 40px;">
                        <h3>فرم ثبت نام</h3>
                        <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
                            <label>نام:</label>
                            <input type="text" name="name" placeholder="Name"  class="form-control"><br>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
                            <label>تلفن</label>
                            <input type="text" name="phone" placeholder="Phone Number"  class="form-control"><br>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
                            <label>آدرس</label>
                            <input type="text" name="address" placeholder="Address"  class="form-control"><br>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
                            <label>نام کاربری</label>
                            <input type="text" name="username" placeholder="User Name"  class="form-control"><br>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
                            <label>رمز عبور</label>
                            <input type="password" name="password1" placeholder="Password"  class="form-control"><br>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
                            <label>تکرار رمز عبور</label>
                            <input type="password" name="password2" placeholder="Password"  class="form-control"><br>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
                            <label>ایمیل</label>
                            <input type="text" name="email" placeholder="Email"  class="form-control"><br>
                        </div>

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