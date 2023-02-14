<?php
    require_once('../Classes/Users.php');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    session_start();
    $_req = json_decode(file_get_contents("php://input"));

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $response;
    $users = new Users();
    $checkUser = $users->getUserWithEmail($email);
   if($checkUser["user"]){
        $_SESSION['message'] = "Email entered Already exist";
        header("location: ../index.php");
   }
   else{
        session_unset();
       $result = $users->createUser($name, $email, $password);
       print_r(end($result));
           if(end($result)){
               $response['success'] = "";
               header("location: ../login.php");
           }
           else{
               $_SESSION['message'] = $result['message'];
               header("location: ../indexz.php");
           }
   }
