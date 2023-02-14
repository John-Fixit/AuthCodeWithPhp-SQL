<?php
require_once ('../Classes/Users.php');

$userId = "12";
$user = new Users();

$result = $user->deleteUser($userId);
if(end($result)){
    print_r($result['message']);
}

