<?php
session_start();
if(isset($_SESSION['name']))
{
    header("location:home1.php");
    exit();
}
?>
<?php
if(isset($_POST['submit']))
{
    $v1=$_POST['t1'];
    $v2=$_POST['t2'];
    $con=new mysqli("localhost","root","","murugansample");
    $qur="select * from userlog where email='".$v1."' and pasword='".$v2."'";
    $res=mysqli_query($con,$qur);
    while($row=$res->fetch_assoc())
    {
      $uid=$row['userId'];
      $pho=$row['phoneno'];
      $name=$row['username'];
      $_SESSION['pho']=$pho;
      $_SESSION['uid']=$uid;
      $_SESSION['oname']=$name;
    }
    if($res->num_rows>0)
    {  
        $_SESSION['name']=$v1;
        header("location:home1.php");
    }
    else
        echo "<script>alert('invalid user')</script>";
    $con->close();
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
        window.history.replaceState(null,null,"userlog.php");
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
    <form method="POST" class="border border-3" style="width: 500px;margin:auto;padding:20px;height: 350px;box-shadow: 5px 5px 10px;">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name=t1 required>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name=t2 required>
      </div>
      <button type="submit" class="btn btn-primary" name=submit>Login</button>
      <p class="mt-3">Don't have an account? <a href="usersign.php" style="">Register</a></p>
    </form>
  </section>
</body>
</html>