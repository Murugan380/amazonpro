<?php
session_start();
if(!isset($_SESSION['uname']))
{
    header("location:adminlogin.php");
}
?>
<?php
    $conn=new mysqli("localhost","root","","murugansample");
     if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $dqur="select * from userorder";
    $des=mysqli_query($conn,$dqur);
    if($des)
    {
        ?>
        <section class="container-fluid mt-5">
        <table class="text-center table" style="border:2px solid;">
            <tr>
                <th>orderid</th>
                <th>order userid</th>
                <th>Email</th>
                <th>Order Address</th>
                <th>PAYMENT Method</th>
                <th>Order Phone number</th>
                <th>product id</th>
                <th>ram id</th>
                <th>color id</th>
                <th>quantity</th>
                <th>Total</th>
                <th> order Date</th>
    </tr>
        <?php
    while($row=$des->fetch_assoc())
    {
        $oid=$row['orderId'];
        $userid=$row['orduserId'];
      $email=$row['email'];
      $addr=$row['address'];
      $paymethod=$row['paymethod'];
      $phone=$row['accphoneno'];
      $proid=$row['proid'];
      $proram=$row['proramid'];
      $procolid=$row['procolid'];
      $quantity=$row['quantity'];
      $total=$row['totalamount'];
      $odate=$row['order_date'];
      ?>
      <tr>
        <td><?php echo $oid?></td>
        <td><?php echo $userid?></td>
      <td><?php echo $email?></td>
      <td> <?php echo $addr?></td>
      <td> <?php echo $paymethod?></td>
      <td><?php echo $phone?></td>
      <td><?php echo $proid?></td>
      <td><?php echo $proram?></td>
      <td><?php echo $procolid?></td>
      <td><?php echo $quantity?></td>
      <td><?php echo $total?></td>
      <td><?php echo $odate?></td>
    </tr>
      <?php
    }
     $conn->close();
}
?>
</table>
</section>
<?php
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
</head>
<body>
</body>
</html>