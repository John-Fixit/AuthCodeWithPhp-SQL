<?php
require("connect.php");
$message = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($name) || empty($email) || empty($password)) {
        $message = "All field is required";
    } else if (strlen($password) < 8) {
        $message = "password must be at least 8 characters";
    } else {
        $sql = "SELECT * FROM `users_tb` WHERE `email` = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = mysqli_stmt_get_result($stmt);
        $found = mysqli_num_rows($result);
        if ($found > 0) {
            $message = "Email already exist";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO `users_tb` (`name`, `email`, `password`) VALUES (?, ?, ?)";
            $stmt = $connect->prepare($query);
            $stmt->bind_param('sss', $name, $email, $hashedPassword);
            $response = $stmt->execute();
            if ($response) {
                header("location: login.php");
            } else {
                $message = "Details not saved";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>

<body>
    <div class="shadow-sm bgImg">
            <div class="col-sm-4 mx-aut shadow">
                <div class="p-3 bg-light rounded">
                    <div class="header text-center">
                        <h3 class="text-color">Create <span class="text-danger">An</span> Account</h3>
                    </div>
                    <form action="./OOP/signup.php" method="POST">
                        <span class="text-danger text-center"><?php
                        session_start();
                                                    if (isset($_SESSION['message'])) {
                                                        echo $_SESSION['message'];
                                                    }
                                                    ?></span>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" placeholder="Name" name="name">
                            <label for="">Name</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="email" class="form-control" placeholder="Name" name="email">
                            <label for="">E-mail Address</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="password" class="form-control" required placeholder="Name" name="password">
                            <label for="">Password</label>
                        </div>
                        <div class="col-12">
                            Already Have an account? <a href="login.php" class="text-decoration-none text-color fw-bold">Login</a> To your account
                        </div>
                        <button class="btn btn-danger w-100 rounded-pill" name="submit">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>