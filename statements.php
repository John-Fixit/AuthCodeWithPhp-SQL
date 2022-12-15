<?php
    require('connect.php');
    $name = "John Kayode";
    $email = "johnfixit29@gmail.com";
    $password = '12345678';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO `users_tb` (`name`, `email`, `password`) VALUES (?, ?, ?)"; 
    //prepare data base
    $stmt = $connect->prepare($query);
    //bind data base
    $stmt->bind_param('sss', $name, $email, $password);
    $check = $stmt->execute();
    if($check){
        echo "Prepare statement works";
    }
    else{
        echo "prepare statment not work!";
    }
?>