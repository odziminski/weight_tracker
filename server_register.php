<?php
require('connect.php');

if (!isset($_SESSION)){
  session_start();
}


$errors = [];


if (isset($_POST['register_button'])) {
    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $passwordconfirm = mysqli_real_escape_string($conn, $_POST['passwordconfirm']);

    if (empty($login)) {
        array_push($errors, "Username can not be blank!");
    }

    if ((strlen($login) < 3) || (strlen($login) > 15)){
      array_push($errors, "Username can't be shorter than 3 and longer than 15 letters!");
    }

    if (empty($password)) {
        array_push($errors, "Password can not be blank!");
    }
    if (strlen($password) < 3){
      array_push($errors, "Password can't be shorter than 3 letters!");
    }
    if ($password != $passwordconfirm) {
        array_push($errors, "Passwords does not match!");
    }

    $querySelect="
  SELECT * FROM uzytkownik WHERE login = '$login';
  ";

    $result = mysqli_query($conn, $querySelect) or die('Can not execute the query. '. mysqli_error($conn));
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['login'] === $login) {
            array_push($errors, "Username already taken!");
        }
    }

    if (count($errors) == 0) {
        $pwd= password_hash($password,PASSWORD_DEFAULT);
        $queryInsert= "
       INSERT INTO uzytkownik (id_uzytkownik,login,haslo) VALUES ('','$login','$pwd');
       ";
        mysqli_query($conn, $queryInsert) or die('Can not execute the query. '. mysqli_error($conn));


        if ($queryInsert) {
            $_SESSION['logged'] = "You are now logged in";
            $_SESSION['login'] = $login;
            header('Location: index.php');

            $queryGetID="
          SELECT * from uzytkownik where login like '$login';
          ";

            $res=mysqli_query($conn, $queryGetID)  or die('Can not execute the query. '. mysqli_error($conn));
            $row = mysqli_fetch_assoc($res);

            if ($queryGetID) {
                $_SESSION['id'] = $row['id_uzytkownik'];
                $_SESSION['registrationDate']=$row['data_utworzenia'];
            }
        }
    }
    require('profile_sex_and_height.php');
}
