<?php
    $email = 'Johnfixit293@gmail.com';
    $expires = time() + (86400 * 30);
    setcookie('user_email', $email, $expires, '/');
?>