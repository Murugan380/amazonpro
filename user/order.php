<?php
$cd="";
$bd="";
if(isset($_GET['Ram']))
{
    $rd=$_GET['Ram'];
}
if(isset($_GET['Col']))
{
$cd=$_GET['Col'];
}
if(isset($_GET['Id']))
{
    $bd=$_GET['Id'];
}
if(isset($_GET['Qul']))
{
  $qul=$_GET['Qul'];
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
    <form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enter Delivery address</label>
    <textarea class="form-control"></textarea>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Select the payment method:</label>
    <div class="form-check mt-3">
    <input type="radio" name="r1" class="form-check-input">
    <label class="form-check-label">GPay</label>
    </div>
    <div class="form-check mt-3">
    <input type="radio" name="r1" class="form-check-input">
    <label class="form-check-label">PhonePay</lable>
    </div>
    <div class="form-check my-3">
    <input type="radio" name="r1" class="form-check-input">
    <label class="form-check-label">Cash on Delivery</label>
  </div>
  <button type="submit" class="btn btn-primary">Continue</button>
</form>
</body>
</html>