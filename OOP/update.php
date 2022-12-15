<?php
require_once ('../Classes/Users.php');
    $userId = "38";
    $name = "Ajibade Paul";
    $email = "ajibadepaul@gmail.com";
    $user = new Users();
    
    $result = $user->updateUser($userId, $name, $email);
    print_r($result);

?>