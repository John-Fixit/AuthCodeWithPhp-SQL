<?php
require('connect.php');
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $getUserQuery = "SELECT * FROM users_tb WHERE user_id=?";
    $stmt = $connect->prepare($getUserQuery);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = mysqli_stmt_get_result($stmt);
    // $result = mysqli_query($connect, $getUserQuery);
    $thisUser = mysqli_fetch_assoc($result);

    if(isset($_COOKIE['user_email'])){
        $email = $_COOKIE['user_email'];
    }
} else {
    header("location: login.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <div class="col-8 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-image text-center">
                    <img src="<?php echo 'uploads/'.$thisUser['profile_pic'] ?>" alt="" style="height: 200px; width: 200px;"   class="rounded-circle">
                </div>
                <form action="process.php" method="POST" enctype="multipart/form-data">
                    <p>
                    <?php
                        if(isset($_SESSION['errorMessage'])){
                            echo $_SESSION['errorMessage'];
                        }
                    ?>
                    </p>
                    <!-- <input type="text" name="a"> -->
                    <input type="file" name="image" accept="">
                    <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                    <!-- if multiple file along time a form, the name of the file will will have and [] in from of the file name, and the input will have attribute of multiple -->
                    <!-- <input type="file" name="filename[]" multiple id=""> -->
                </form>
                    <span class="text-center">
                    <?php 
                            if(isset($_SESSION['message'])){
                                echo $_SESSION['message'];
                            }
                            
                            ?>
                </span>
                <button type="button" class="btn btn-primary ms-auto" style="width: 4rem;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Edit
                </button>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong class="text-primary">Name</strong>
                            <p class="border-0 border-bottom my-2 border-primary px-2"><?php echo $thisUser['name'] ?>

                            </p>
                        </div>
                        <div class="col-md-6">
                            <strong class="text-primary">E-mail Address</strong>
                            <p class="border-0 border-bottom my-2 border-primary px-2"><?php echo $thisUser['email'] ?></p>
                        </div>

                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <form action="process.php" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                    </div>
                                    <div class="modal-body">
                                        
                                            <div class="form-floating my-2">
                                                <input type="text" placeholder="Name" name="name" class="form-control" value="<?php echo $thisUser['name'] ?>">
                                                <label for="">Name</label>
                                            </div>
                                            <div class="form-floating my-2">
                                                <input type="email" placeholder="E-mail" name="email" class="form-control" value="<?php echo $thisUser['email'] ?>">
                                                <label for="">E-mail Address</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" name="saveChanges" >Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>