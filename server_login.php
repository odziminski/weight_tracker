<?php
require('connect.php');

if (!isset($_SESSION)) {
    session_start();
}

$errors=[];

if (isset($_POST['login_button'])) {
    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($login)) {
        array_push($errors, "Username is required!");
    }

    if (empty($password)) {
        array_push($errors, "Password can not be blank!");
    }

    if (count($errors) == 0) {
        $pwd= password_hash($password,PASSWORD_DEFAULT);

        $querySelect="
        SELECT * FROM uzytkownik WHERE login='$login' and haslo='$pwd';
      ";

        $results=mysqli_query($conn, $querySelect)  or die('Can not execute the query. '. mysqli_error($conn));

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['login']=$login;
            $_SESSION['logged']="You are logged in";

            $queryGetID="
          SELECT * from uzytkownik where login like '$login';
          ";

            $res=mysqli_query($conn, $queryGetID)  or die('Can not execute the query. '. mysqli_error($conn));
            $row = mysqli_fetch_assoc($res);
              if ($queryGetID) {
                $_SESSION['id'] = $row['id_uzytkownik'];
                $_SESSION['registrationDate']=$row['data_utworzenia'];
            }
            header('Location: index.php');
          }
          else {
            array_push($errors, 'Wrong login or password!');
        }
    }
    require('profile_sex_and_height.php');
}
