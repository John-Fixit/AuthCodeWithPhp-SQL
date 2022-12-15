<?php
    require_once ('../Classes/Users.php');
    $userId = "38";
    $user = new Users();

    $result = $user->getUser($userId);
    print_r($result);
?>