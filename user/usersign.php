<?php
if(isset($_POST['submit']))
{
    $v1=$_POST['t1'];
    $v2=$_POST['t2'];
    $v3=$_POST['t3'];
    $v4=$_POST['t4'];
    $con=new mysqli("localhost","root","","murugansample");
    $qur="insert into userlog(username,email,phoneno,pasword) values('".$v1."','".$v2."','".$v3."','".$v4."')";
    if($res=mysqli_query($con,$qur))
    {
        echo "<script>alert('Signin Successfull');</script>";
    }
    else
        echo "<script>alert('Signin unsuccessful')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form method="POST" action="usersign.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="t1" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="t2" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Phone number</label>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="t3" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="t4" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</body>
</html>