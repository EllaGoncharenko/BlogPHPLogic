<?php
function action_index () {
    if(is_auth()){
 echo 'Index page';
    } else {
        echo "Привет Гость!";
    }
}
function action_adminPage () {
    if(is_admin()){
        echo 'Admin page';
    } else {
        echo "Вы не Админ!";
    }
}
function action_contacts () {
    echo 'Contacts page';
}
function action_registration () {
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $formData = [
            'login' => getSaveData(htmlspecialchars(trim($_POST['login']))),
            'password' => getSaveData(trim($_POST['password'])),
            'email' => getSaveData(trim($_POST['email']))

        ];
        $rules = [
            'login' => ['required', 'login'],
            'password' => ['required','password'],
            'email' => ['required', 'email']

        ];

        $errors = validateForm($rules, $formData);
        if(empty($errors)) {
            $formData['password']= md5($formData['password'].SECRET_KEY);
//            $sql="INSERT INTO `user`(`login`, `password`, `email`) VALUES (".$formData['login'].",".$formData['password'].",".$formData['email'].")";
            $sql="INSERT INTO `user`(`login`, `password`, `email`) VALUES ('{$formData['login']}','{$formData['password']}','{$formData['email']}')";
            $sql1= "SELECT id FROM user WHERE login ='{$formData['login']}' or email='{$formData['email']}'";

            $res = selectData($sql1);

            if($res->num_rows === 0) {
                if (insertUpdateDelete($sql)) {
                    header("Location: /main/successReg");
                }
            }else {
                    echo "Данный логин или пароль уже существуют";
                }
            }

        }

    renderViewRegistration('registration', $errors);
}

function action_successReg() {
    echo "Поздравляем!";
}

function action_login(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $formData = [
            'login' => getSaveData(htmlspecialchars(trim($_POST['login']))),
            'password' => getSaveData(trim($_POST['password'])),

        ];
        $formData['password']= md5($formData['password'].SECRET_KEY);
        $sql= "SELECT id FROM user WHERE login ='{$formData['login']}' and password='{$formData['password']}'";

        $res = selectData($sql);
        if($res->num_rows === 0) {
            echo 'Некорректный логин или пароль!';
        }else {
        $_SESSION['user']= mysqli_fetch_assoc($res);
            header('Location: /');
        }
    }
    renderView('login',[]);
}

function action_admin(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $formData = [
            'login' => getSaveData(htmlspecialchars(trim($_POST['login']))),
            'password' => getSaveData(trim($_POST['password'])),

        ];
        $formData['password']= md5($formData['password'].SECRET_KEY);
        $sql= "SELECT id, role FROM user WHERE login ='{$formData['login']}' and password='{$formData['password']}'";
        $res = selectData($sql);
        if($res->num_rows === 0) {
            echo 'Неккоректный логин или пароль!';
        }else {
            $_SESSION['user']= mysqli_fetch_assoc($res);
            header('Location: /main/adminPage');
        }
    }
    renderView('admin',[]);
}

function action_logout(){
    session_unset();
    session_destroy();
    header('Location: /');
}