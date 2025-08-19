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
        header("location:userlog.php");
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
    <script>
        window.history.replaceState(null,null,"usersign.php");
         window.history.pushState(null, "", window.location.href);
        </script>
        <style>
            .hero {
  position: relative;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 25px;
  z-index: 1;
}

.hero::before {
  content: "";
  position: absolute;
  top: 0; left: 0;
  width: 100%;
  height: 100%;
  background: url("log.jpg") no-repeat center center / cover;
  filter: blur(8px);
  z-index: -1;   /* keep it behind text */
}
            </style>
</head>
<body class="hero">
    <section class="d-flex vh-100">
    <form method="POST" action="usersign.php" class="border border-3" style="width: 500px;margin:auto;padding:20px;height: 550px;box-shadow: 5px 5px 10px;">
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
        <div class="d-flex justify-content-center mt-5">
        <button type="submit" class="btn btn-primary" name="submit">Register</button>
        </div>
    </form>
    </section>
</body>
</html>