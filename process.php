<?php
$message = "";
require('connect.php');
session_start();
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email) || empty($password)) {
        $_SESSION['message'] = "All fields are required";
        header("location: login.php");
    } else {
        $sql = "SELECT * FROM users_tb WHERE `email` = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        // $result = mysqli_query($connect, $sql);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        // print_r($user['password']);
        if ($user) {
            $check = password_verify($password, $user['password']);
            if ($check) {
                setcookie('user_email', $user['email']);
                $_SESSION['id'] = $user['user_id'];
                header("location: dashboard.php");
            } else {
                $_SESSION['message'] = "Password entered is incorrect, please check and try again";
                header("location: login.php");
                echo ("password not correct");
            }
        } else {
            $_SESSION['message'] = "E-mail entered does not exist";
            header("location: login.php");
        }
    }
}


if (isset($_POST['saveChanges'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    if (empty($name) || empty($email)) {
        header("location: dashboard.php");
        $_SESSION['message'] = "name or email in the editing form can not be empty";
        $_SESSION['status'] = false;
    } else {
        $userId = $_SESSION['id'];
        $getUsersQuery = "SELECT * FROM users_tb WHERE email = ?";
        $stmt = $connect->prepare($getUsersQuery);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $getResult = mysqli_stmt_get_result($stmt);

        $found = mysqli_fetch_assoc($getResult);
        if ($found) {
            $editQuery = "UPDATE users_tb SET name= ? WHERE user_id= ? ";
            $stmt = $connect->prepare($editQuery);
            $stmt->bind_param('ss', $name, $userId);
            $saveChanges = $stmt->execute();
            if ($saveChanges) {
                $_SESSION['message'] = "Name is edited successfully but Email remains unchanged";
                $_SESSION['status'] = true;
                header("location: dashboard.php");
            } else {
                $_SESSION['message'] = "User information not edited!";
                header("location: dashboard.php");
            }
        } else {
            $editQuery = "UPDATE users_tb SET name=?, email= ? WHERE user_id= ? ";
            $stmt = $connect->prepare($editQuery);
            $stmt->bind_param('sss', $name, $email, $userId);
            $saveChanges = $stmt->execute();
            if ($saveChanges) {
                $_SESSION['message'] = "User information edited and saved successfully";
                $_SESSION['status'] = true;
                header("location: dashboard.php");
            } else {
                $_SESSION['message'] = "User information not edited!";
                $_SESSION['status'] = false;
                header("location: dashboard.php");
            }
        }
    }
}

if (isset($_POST['upload'])) {
    $userId = $_SESSION['id'];
    $allowed_extension = ['png', 'jpg', 'jpeg'];
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_ext = explode('.', $file_name);
    $ext1 = $file_ext[1];
    $ext2 = strtolower(end($file_ext));
    if (in_array($ext2, $allowed_extension)) {
        if ($file_size < 10000000) {
            $newFileName = time() . "." . $ext2;
            $target_dir = "uploads/" . $newFileName;
            $upload = move_uploaded_file($file_tmp, $target_dir);
            if ($upload) {
                $query = "UPDATE users_tb SET profile_pic='$newFileName' WHERE user_id= '$userId'";
                $updatedFile = mysqli_query($connect, $query);
                if (!$updatedFile) {
                    $_SESSION['errorMessage'] = "Error occurred please try again";
                 
                    header("location: dashboard.php");
                } else {
                    header("location: dashboard.php");
                }
            } else {
                $_SESSION['errorMessage'] = "Error occured file not saved to the upload folder";
             
                header("location: dashboard.php");
            }
        } else {
            $_SESSION['errorMessage'] = "file size is too large than required (only 10mb file is required).";
       
            header("location: dashboard.php");
        }
    } else {
        $_SESSION['errorMessage'] = "File extension uploaded is not allowed";
        $_SESSION['uploadStatus']= false;
        header("location: dashboard.php");
    }
}
