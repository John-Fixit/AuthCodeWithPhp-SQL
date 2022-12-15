<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="./style.css">

<script>
    let avatar = ['1', '2']
    let vib="";

const selectAvatar = (params)=>{
   console.log(params);
   sessionStorage.setItem("avatar", params);
}
</script>

<body>
    <div class="container-fill bg_navy" style="background-image: url('uploads/3.gif');">
        <div class="col-sm-5">
            <div class="card shadow-sm border-0">
                    <div class="card-image text-center" id="avatarImg">
                        <?php
                           for($i=0; $i<count($avatar); $i++){
                                echo "<img src='uploads/$avatar[$i].gif' style='height: 100px; width: 100px;' class='rounded-circle cursorPointer eachAvatar' onclick='selectAvatar($avatar[$i])'>";
                           }                 
                        ?>
            </div>
        </div>
    </div>
</body>
</html>