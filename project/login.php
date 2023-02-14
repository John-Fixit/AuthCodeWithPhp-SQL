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

    <div class="shadow-sm bgImg" style="background-image: url('uploads/bgImg2.jpg');">
        <div class="col-sm-4 mx-aut shadow">
            <div class="p-3 bg-light rounded">
                <div class="header text-center">`
                    <h3 class="text-color">Login <span class="text-danger"> to Your </span>Account</h3>
                </div>
                <form action="process.php" method="POST">
                    <span class="text-danger text-center">
                        <?php
                        session_start();
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                        }
                        session_unset();
                        ?>
                    </span>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" placeholder="name" name="email" id="">
                        <label for="">Email</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" placeholder="name" name="password" id="">
                        <label for="">Password</label>
                    </div>
                    <div class="col-12">
                        Don't Have an account yet? <a href="index.php" class="text-decoration-none text-color fw-bold">Signup</a> Here
                    </div>
                    <div class="my-2">
                        <button class="btn bg_navy fw-bold w-100 rounded-pill" name="login">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>