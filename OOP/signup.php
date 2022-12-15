<?php
    require_once('../Classes/Users.php');
    // if(isset($_POST['submit'])){
    //     $name = $_POST['name'];
    //     $email = $_POST['email'];
    //     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    //     $users = new Users();
    //      $result = $users->createUser($name, $email, $password);
    //     if(end($result)){
    //         header("location: ../login.php");
    //     }
    //     else{
    //         $_SESSION['message'] = $result['message'];
    //         header("location: ../form.php");
    //     }
    // }
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    $_req = json_decode(file_get_contents("php://input"));
    // print_r($_POST);

    $name = $_req->name;
    $email = $_req->email;
    $password = password_hash($_req->password, PASSWORD_DEFAULT);
    $response;
    $users = new Users();
    $result = $users->createUser($name, $email, $password);
        // if(end($result)){
        //     $response['success'] = "";
        // }
        // else{
        //     $_SESSION['message'] = $result['message'];
        //     header("location: ../form.php");
        // }
    echo json_encode($result);


    ?>


