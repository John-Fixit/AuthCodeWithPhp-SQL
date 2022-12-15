<?php
require_once('./Classes/Users.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-headers: Content-Type");

$_reqFile = json_decode(file_get_contents("php://input"));

echo json_encode($_reqFile);

?>