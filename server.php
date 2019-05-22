<?php
require('connect.php');
session_start();

$errors = [];


if (isset($_POST['register_button'])) {
  $login = mysqli_real_escape_string($conn, $_POST['login']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $passwordconfirm = mysqli_real_escape_string($conn, $_POST['passwordconfirm']);

  if (empty($login)) {
    array_push($errors,"Username can not be blank!");
  }

  if (empty($password)) {
    array_push($errors,"Password can not be blank!");
  }

  if ($password!=$passwordconfirm) {
    array_push($errors,"Passwords does not match!");
  }



  $querySelect="
  SELECT * FROM uzytkownik WHERE login='$login';
  ";

    $result = mysqli_query($conn, $querySelect);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
      if ($user['login'] === $login) {
        array_push($errors, "Username already taken!");
        }
     }

     if (count($errors)==0){
       $pwd= hash('sha256',$password);
       $queryInsert= "
       INSERT INTO uzytkownik (id_uzytkownik,login,haslo) VALUES ('','$login','$pwd');
       ";
       mysqli_query($conn, $queryInsert);

       if ($queryInsert){
  	      $_SESSION['logged'] = "You are now logged in";
          $_SESSION['login']=$login;
          header('Location: index.php');
          $queryGetID="
          SELECT * from uzytkownik where login like '$login';
          ";
          $res=mysqli_query($conn,$queryGetID);
          $row = mysqli_fetch_assoc($res);

           if($queryGetID){
              $_SESSION['id'] = $row['id_uzytkownik'];
          }
        }
      }
    }


if (isset($_POST['login_button'])) {
  $login = mysqli_real_escape_string($conn, $_POST['login']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($login)) {
      array_push($errors,"Username is required!");
    }

    if (empty($password)) {
      array_push($errors,"Password can not be blank!");
    }

    if (count($errors)==0){
      $pwd= hash('sha256',$password);

      $querySelect="
        SELECT * FROM uzytkownik WHERE login='$login' and haslo='$pwd';
      ";
      $results=mysqli_query($conn,$querySelect);

        if (mysqli_num_rows($results)==1){
          $_SESSION['login']=$login;
          $_SESSION['logged']="You are logged in";

          $queryGetID="
          SELECT * from uzytkownik where login like '$login';
          ";
          $res=mysqli_query($conn,$queryGetID);
          $row = mysqli_fetch_assoc($res);
           if($queryGetID){
              $_SESSION['id'] = $row['id_uzytkownik'];
          }
          header('Location: index.php');
        }else{
          array_push($errors,'Wrong login or password!');
        }
      }
    }
