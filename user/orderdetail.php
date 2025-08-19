<?php
session_start();
if(!isset($_SESSION['name']))
{
  header("location:userlog.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
      .nav-link{
        color:black;
      }
        .nav-link:hover{
            color:gray;
             border-bottom:1px solid;
        }
        .user{
          color: black;
          width: 35px;
          height: 35px;
          display: flex;
          align-items: center;
          justify-content: center; 
          border-radius: 100%;
          border: 1px solid;

        }
        .user:hover{
          border-radius: 100%;
          color: rgb(255, 255, 255);
          background-color: black;
        }
        .btnn
        {
          border: 1px solid rgb(255, 0, 0);
          display: flex;
          justify-content: center;
          align-items: center;
          width: 70px;
          height: 35px;
          margin-top: 0px;
          text-decoration: none;
          border-radius: 5px;
          color: red;
        }
        .btnn:hover{
          background-color: rgb(255, 0, 0);
          color: rgb(255, 255, 255);
        }
        .nav-link.active {
           color:red; 
          border-bottom:4px solid;

}
.navba{
  margin-top:100px;
}
.hidden {
  opacity: 0;
  transform: translateY(50px);
  transition: all 1s ease-out;
}

.show {
  opacity: 1;
  transform: translateY(0);
}
        </style>

</head>
<body>
  <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start border-3 border-dark p-2">
          <div class="me-2"><img src="next.JPG"></div>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ps-2">
          <li><a href="home1.php" class="nav-link  mx-3" id="n1">Home</a></li>
          <li><a href="phone.php?Cd=1" class="nav-link mx-3">Smart phone</a></li>
          <li><a href="phone.php?Cd=2" class="nav-link mx-3 ">Laptop</a></li>
          <li><a href="phone.php?Cd=3" class="nav-link mx-3 ">Tab</a></li>
          <li><a href="usercart.php" class="nav-link mx-3 ">Cart</a></li>
          <li><a href="yourorder.php" class="nav-link mx-3 active">Your orders</a></li>
        </ul>
        <div class="text-end d-flex">
          <div class="text-center d-md-flex d-none align-items-center me-3 mb-md-0 mb-3">
          <a href="userpro.php" class="user" id="user"><i class="bi bi-person"></i></a>
          <div class="ms-1"><?php echo $_SESSION['oname'];?></div>
        </div>
          <a href="userlogout.php" class="btn btn-sm btn-outline-danger me-3">Logout</a>
        </div>
    </div>
<?php
   if(isset($_GET['Oid']))
   {
    $oid=$_GET['Oid'];
    $conn=new mysqli("localhost","root","","murugansample");
     if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $dqur="select * from userorder where orderId='".$oid."'";
    $des=mysqli_query($conn,$dqur);
    if($des)
    {
        ?>
        <div class="container-fluid">
        <h1 class="my-4 navba hidden">ORDER DETAILS :</h1>
            <?php
    while($row=$des->fetch_assoc())
    {
      $email=$row['email'];
      $addr=$row['address'];
      $paymethod=$row['paymethod'];
      $phone=$row['accphoneno'];
      $odate=$row['order_date'];
      $delivery = new DateTime($odate);
       $delivery_date = new DateTime($odate);
            $delivery_date->add(new DateInterval('P7D')); 
      ?>
      <div class="ms-5 p-5 border border-3" style="width:500px;box-shadow:5px 5px 10px hidden">
      <h6 class="hidden">Email :</h6> <div class="ms-2 mb-4 hidden"><?php echo $email?></div>
      <h6 class="hidden">Order Address :</h6><div class="ms-2  mb-4 hidden" style="text-transform: capitalize;"> <?php echo $addr?></div>
      <h6 class="hidden">PAYMENT Method :</h6><div class="ms-2  mb-4 hidden"> <?php echo $paymethod?></div>
      <h6 class="hidden">Order Phone number :</h6> <div class="ms-2  mb-4 hidden"><?php echo $phone?></div>
      <h6 class="hidden">Order Date :</h6> <div class="ms-2  mb-4 hidden"><?php echo $delivery->format('d F Y');?></div>
      <h6 class="hidden">You Can recive at :</h6><div class="ms-2  mb-4 hidden"> <?php echo $delivery_date->format('d F Y');?></div>
    </div>
      <?php
    }
}
?>
</div><br><br><br>
<?php

    $conn->close();
   }

   ?>
   <?php include('ani.html')?>
   </body>
</html>