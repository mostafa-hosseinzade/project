<?php

class LoginController {

    private $username;
    private $password;
    private $email;
    private $DB ;
    
    public function __construct() {
        $this->DB = new lib\DataBase();
    }
    public function CheckLogin($info) {
        $result = $this->CheckUser($info);
        
        if (empty($result)) {
            return false;
        }
        session_start();
        $_SESSION['user'] = $result[0];
        return true;
    }

    private function CheckUser(array $data) {
        $password = $this->CreatePassword($data);
        $sql = sprintf("select * from %s  where username='%s' "
                        . "and email = '%s' and password='%s'", 'users', $data['username'], $data['email'], $password);
        $user = $this->DB->query($sql);
        return $user;
    }

    private function SaltPassword(array $data) {
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->email = $data['email'];
        return $this->Create();
    }

    private function Create() {
        $data = array();
        $password = $this->password . $this->email . $this->username;
        $salt = $this->email . $this->password . $this->username . date("Y-m-d H:i:s");
        $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        //Create Password
        for ($index = 0; $index < 100; $index++) {
            $password = hash('SHA256', $password . $key, true);
        }
        $password = \base64_encode($password);
        $data['password'] = $password;
        //Create Salt
        for ($i = 0; $i < 100; $i++) {
            $salt = hash('SHA256', $salt . $key, true);
        }
        $salt = \base64_encode($salt);
        $data['salt'] = $salt;
        return $data;
    }

    private function CreatePassword(array $data) {
        $password = $data['password'] . $data['email'] . $data['username'];
        $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        //Create Password
        for ($index = 0; $index < 100; $index++) {
            $password = hash('SHA256', $password . $key, true);
        }
        $password = \base64_encode($password);
        return $password;
    }

    private function CreateUser(array $input) {
        $secure = $this->SaltPassword($input);
        $data['username'] = $input['username'];
        $data['username_canonical'] = $input['username'];
        $data['password'] = $secure['password'];
        $data['email'] = $input['email'];
        $data['email_canonical'] = $input['email'];
        $data['salt'] = $secure['salt'];
        $data['roles'] = $input['role'];

        $result = $this->DB()->getTable($input['table'])->insert($data);
        return $result;
    }

    

    private function forgetPassword(array $data) {
        $user = $this->DB()->query(sprintf("select c.id,c.username,c.email from %s c where c.username='%s' and c.email='%s'", $data['table'], $data['username'], $data['email']));
        if (empty($user)) {
            $response['msg'] = "کاربری یافت نشد";
            return $response;
        }
        $data['password'] =rand(0, 123456789);
        $password = $this->CreatePassword($data);
        $update['id'] = $user[0]['id'];
        $update['password'] = $password;
        $result = $this->DB()->getTable($data['table'])->update($update);
        mail($user['email'], "تغییر رمز عبور", "رمز شما با موقیت تغییر یافت رمز عبور جدید : ".$data['password']);
        $response['msg'] = "رمز عبور تغییر یافت و برای شما ارسال شد لطفا ایمیل خود را بررسی نمائید".$data['password'];
        return $response;
    }

    private function setExpires_at($table, $user) {
        $change = $this->DB()->getTable($table)->update($user);
        return $change;
    }

}