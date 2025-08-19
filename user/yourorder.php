<?php
include("navbar.php");
?>
<?php

?>
<?php
$con=new mysqli("localhost","root","","murugansample");
$qur="SELECT * FROM userorder JOIN products ON products.Id=userorder.proid JOIN productram ON productram.ramId=userorder.proramid JOIN productcolor on productcolor.colorId=userorder.procolid WHERE orduserId='".$_SESSION['uid']."'";
$res=mysqli_query($con,$qur);
if($res->num_rows==0)
{
    ?>
    <div class="na bg-dark  text-white text-center p-4" style="height:140px;">
    <div class="h2">Empty!</div> 
    <a class="btn btn-primary" href="home1.php">Shop Now<a>
    </div>
    <?php
}
else{
  ?>
  <section class="container-fluid navba">
<h1 class="my-4 hidden">Your ORDERS :</h1>
<div class="row">
  <?php

while($row=$res->fetch_assoc())
{
    $orderid=$row['orderId'];
    $proname=$row['productname'];
$imgurl=$row['imgurl'];
$ram=$row['ram'];
$store=$row['storage'];
$bat=$row['battery'];
$price=$row['price'];
$total=$row['totalamount'];
$quant=$row['quantity'];
?>
<div class="col-md-4 col-12">
<div class="card border border-3 mb-5 hidden" style="max-width: 540px;box-shadow:2px 2px 10px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="../admin1/files/<?php echo $imgurl?>" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $proname?></h5>
        <p class="card-text">(<?php echo $ram ?> Ram,<?php echo $store?> Storage,<?php echo $bat?> Battery)</p>
        <p class="card-text">Price: <i class="bi bi-currency-rupee"></i><?php echo $price?></p>
        <p class="card-text">Quantity: <?php echo $quant?></p>
        <p class="card-text">Total Amount <i class="bi bi-currency-rupee"></i><?php echo $total?></p>
        <button onclick="show(<?php echo $orderid?>)" class="btn btn-outline-primary">Details</button>
        <button onclick="del(<?php echo $orderid?>)" class="btn btn-outline-danger">Cancel</button>
      </div>
    </div>
  </div>
</div>
</div>
<?php
}
}
?>
</div>
<?php
$con->close();
?>
</section>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        window.history.replaceState(null,null,'yourorder.php');
        function del(id)
        {
            var ans=confirm("Are you sure");
            if(ans)
            {
                const url="yourorder.php?Did="+id;
                history.replaceState(null,"",url);
                window.location.href=url;
            }
        }
        function show(oid){
          window.location.assign("orderdetail.php?Oid="+oid);
        }
    </script>
    <style>
      .na{
        margin-top: 80px;
      }
    </style>
</head>
<body>
   <?php
   if(isset($_GET['Did']))
   {
    $id=$_GET['Did'];
    $conn=new mysqli("localhost","root","","murugansample");
    $dqur="delete from userorder where orderId='".$id."'";
    $des=mysqli_query($conn,$dqur);
    if($des)
    {
        echo "<script>alert('Order Canceled');window.location.href='yourorder.php'</script>";
    }
    $conn->close();
   }
   ?>
   <?php include('ani.html')?>
</body>
</html>