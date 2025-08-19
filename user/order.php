<?php
session_start();
?>
<?php
$arr3=[];
$cart=[];
$product=[];
$qid=[];
$pri=[];
if(isset($_GET['ch'])) {
  $arr3 = json_decode($_GET['ch'], true);
  if (!is_array($arr3)) $arr3 = [];
} else {
  $arr3 = [];
}
    $con=new mysqli("localhost","root","","murugansample");
  foreach($arr3 as $pro)
  {
    $cid=$pro['id'];
    $qid[]=$pro['qty'];
  $aqur="select * from cart where cartId='".$cid."'";
  $res=mysqli_query($con,$aqur);
  while($row=$res->fetch_assoc())
  {
    $cart[]=$row;
  }
}
foreach($cart as $pro)
{
$disqur="SELECT * FROM products JOIN productram on products.Id=productram.productId JOIN productcolor on products.Id=productcolor.productId join cart on productram.ramId=cart.ramid where Id='".$pro['proid']."' and productram.ramId='".$pro['ramid']."' and productcolor.colorId='".$pro['colorid']."' and cart.cartId='".$pro['cartId']."'";
$res=mysqli_query($con,$disqur);
while($row=$res->fetch_assoc())
{
  $product[]=$row;
}
}
?>
</div>
<?php
$con=new mysqli("localhost","root","","murugansample");
?>
<?php
    $rd=(isset($_GET['Ram']))?$_GET['Ram']:'';
?>


<?php
$cd=(isset($_GET['Col']))?$_GET['Col']:'';
?>
<?php
    $bd=(isset($_GET['Id']))?$_GET['Id']:'';
  $qul=(isset($_GET['Qul']))?$_GET['Qul']:'';

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
    <script>
      window.onload = function() {
    if (performance && performance.navigation.type === performance.navigation.TYPE_BACK_FORWARD) {
        location.replace("home1.php");
    }
};
      <?php
      
      if(isset($_GET['Id']))
      {
        ?>
        let pid=<?php echo $bd?>;
        let colr=<?php echo $cd?>;
        let rami=<?php echo $rd?>;
        let qual=<?php echo $qul?>;
        let url="order.php?Id="+pid +"&Col="+colr +"&Ram="+rami+"&Qul="+qual;
        <?php
      ?>
      window.history.replaceState(null,null,url);
      <?php
      }
      else {
          ?>
          let ar = <?php echo json_encode($arr3); ?>; // Converts PHP array to JS array
          const jsonStr = JSON.stringify(ar);
          const encoded = encodeURIComponent(jsonStr);
          let url="order.php?ch="+encoded;
          window.history.replaceState(null,null,url);
          <?php
      }
      ?>
      function pho()
      {
        let p=document.getElementById("p1").value;
        let select=false;
        if(p.length!=10)
        {
          inv.textContent="invalid phonenumber";
          return false;
        }
        if (!document.querySelector('input[name="r1"]:checked')) {
        rad.textContent = "Select the Paymethod";
        return false;
    }
        }
     document.addEventListener("DOMContentLoaded", function() {
    let p1 = document.getElementById('p1');
    let inv = document.getElementById('inv');

    p1.addEventListener('input', function() {
        inv.textContent = "";
    });
});
      function cont()
      {
        var pai=document.getElementById("n1").value;
        if(pai.length<10 || pai.length>20)
        {
          dis.textContent="Invalid accountnumber";
        }
        else{
          dis.textContent="";
        document.getElementById("t1").value=pai;
        document.getElementById('tt').style.display="block";
        var modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
       modal.hide();
        }
        }
        document.addEventListener('DOMContentLoaded', function () {
      document.querySelector('input[name=n1]').addEventListener('input',function()
    {
      var pai=document.getElementById("n1").value;
      if(pai.length<10 || pai.length>20)
      {
        dis.textContent="Invalid UPI ID";
      }
      else
      {
        dis.textContent="";
      }
    });
      document.querySelectorAll('input[name="r1"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
          if(this.value=='cash on delivery')
          {
            document.getElementById('tt').style.display="none";
            document.getElementById('p1').style.display="block";
            document.getElementById('rad').textContent="";
            document.getElementById('p2').required=true;
          }
          else {
            dis.textContent="";
            document.getElementById('rad').textContent="";
            document.getElementById('n1').required=true;
            var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();
          }
        });
      });
    });
 $(document).ready(function(){
            $('.btnx').on('click',function(){
                $('#exampleModal').modal('show');
            });
          });
      </script>
</head>
<body>
  <?php
  if(isset($_GET['ch']))
  {
  ?>
<section class="m-5 container">
    <div class="row">
      <div class="col-6">
          <h4 class="m-3">Selected Item</h4>
          <?php
          $amountotal=0;
        foreach($product as $i =>$item)
        {
          $pri[]=$item['price'];
        $total=$item['price']* $qid[$i];
        $amountotal+=$total;
          ?>
              <div class="card m-3 p-3 border border-1 border-dark" style="max-width: 500px;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="../admin1/files/<?php echo $item['imgurl']?>" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $item['productname']?></h5>
                      <p class="card-text"><?php echo $item['discribtion']?></p>
                      <p class="card-text">(<?php echo $item['ram']?> Ram,<?php echo $item['storage']?> Storage,<?php echo $item['battery']?> battery)</p>
                      <a>price:<?php echo $item['price']?></a><br>
                      <a>Total Amount:<i class="bi bi-currency-rupee"></i><?php echo $total;?></a>
                      <a>Quantity:<?php echo $qid[$i]?></a>
                    </div>
                  </div>
                </div>
              </div>
            <?php
        }
        ?> 
      <?php
      }
        ?>
      </div>
      <?php
$tota=0;
if(isset($_GET['Id']))
{
   $qur="SELECT * FROM products JOIN productram on products.Id=productram.productId JOIN productcolor on productram.productId=productcolor.productId WHERE Id='".$bd."' AND ramId='".$rd."' AND colorId='".$cd."'";
    $res=mysqli_query($con,$qur);
    while($row=$res->fetch_assoc())
    {
      $proname=$row['productname'];
      $dis=$row['discribtion'];
      $rami=$row['ram'];
      $store=$row['storage'];
      $bat=$row['battery'];
      $price=$row['price'];
      $color=$row['color'];
      $img=$row['imgurl'];
    }
    $tota=$price
    ?>
    <section class="m-5 container">
  <div class="row">
    <div class="col-md-6 col-12">
      <h4 class="m-3">Selected Item</h4>
      <div class="card m-3 p-3 border border-1 border-dark" style="max-width: 500px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="../admin1/files/<?php echo $img?>" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?php echo $proname?></h5>
              <p class="card-text"><?php echo $dis?></p>
              <p class="card-text">(<?php echo $rami?> Ram,<?php echo $store?> Storage,<?php echo $bat?> battery)</p>
              <a><i class="bi bi-currency-rupee"></i><?php echo $price?></a>
              <div>Quantity: <?php echo $qul?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
?>
    <div class="col-md-6 col-12">
      <form method="POST" onsubmit="return pho()">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Enter your email :</label>
          <input type="email" class="form-control" required value="<?php echo (isset($_SESSION['name']))?$_SESSION['name']:''; ?>" name="e1">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Enter your phone number :</label>
          <input type="number" class="form-control" required value="<?php echo (isset($_SESSION['pho']))?$_SESSION['pho']:''; ?>" id="p1" name="p1">
          <div id="inv" style="color:red"></div>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Enter Delivery address :</label>
          <textarea class="form-control" rows="3" style="resize:none;" required name="ta1"></textarea>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Select the payment method:</label>
          <div id="rad" style="color:red" class="my-1"></div>
          <div class="form-check mt-0">
          <input type="radio" name="r1" class="form-check-input pay" id="gpay" value="gpay">
          <label class="form-check-label">GPay</label>
          </div>
          <div class="form-check mt-3">
          <input type="radio" name="r1" class="form-check-input pay" id="gpay" value="phonepay">
          <label class="form-check-label">PhonePay</lable>
          </div>
          <div class="mt-3" id="tt" style="display:none">
            <label class="mb-2">Payment Phone number :</lable>
            <div class="d-flex">
              <input type="text" name="t1" class="form-control" id="t1" readonly>
              <input type="button" class="btn btnx btn-outline-secondary ms-2" name="r1" value=" Edit ">
            </div>
          </div>
          <div class="form-check my-3">
          <input type="radio" name="r1" class="form-check-input pay" value="cash on delivery" id="gpay">
          <label class="form-check-label" >Cash on Delivery</label>
        </div>
        <button type="submit" class="btn btn btn-outline-warning" name="submit">Place Order</button>
      </form><br><br>
      <h6>Order Detail:</h6>
      <div>Total Amount:<i class="bi bi-currency-rupee"></i><?php if(isset($_GET['ch'])){  echo $amountotal;}else{ echo $tota*$qul; }?></div>
    </div>
      </div>
</section>


<form class="m-5">
      <div class="modal fade" tabindex="-1" id="exampleModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Enter your UPI ID</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label></label>
              <input type="text" name="n1" id="n1" class="form-control" >
              <p id="dis" class="mt-3"style="color:red"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="cont()">Continue</button>
            </div>
          </div>
        </div>
      </div>
  </form>

  <?php
  if(isset($_GET['Id']))
  {
    if(isset($_POST['submit']))
    {
      $usid=$_SESSION['uid'];
      $addr=$_POST['ta1'];
      $pay=$_POST['r1'];
      $acpho=$_POST['p1'];
      $emai=$_POST['e1'];
      $t=$tota*$qul;
      $con=new mysqli("localhost","root","","murugansample");
      $inqur="insert into userorder(orduserId,email,address,paymethod,accphoneno,proid,proramid,procolid,quantity,totalamount) values('".$usid."','".$emai."','".$addr."','".$pay."','".$acpho."','".$bd."','".$rd."','".$cd."','".$qul."','".$t."')";
      $upqur="update products set stack=stack-'".$qul."' where Id='".$bd."'";
      $res=mysqli_query($con,$upqur);
      $res=mysqli_query($con,$inqur);
      if($res)
      {
        echo "<script>alert('Successfully Order Placed');
        confirm('can you continue shopping');
        window.location.href='home1.php';
        </script>";
      }
    }
  }
  if(isset($_GET['ch']))
  {
    if(isset($_POST['submit']))
    {
      $usid=$_SESSION['uid'];
      $addr=$_POST['ta1'];
      $pay=$_POST['r1'];
      $acpho=$_POST['p1'];
      $emai=$_POST['e1'];
      $res='';
      $i=0;
      foreach($cart as $pro)
      {
        $t=$pri[$i]*$qid[$i];
      $con=new mysqli("localhost","root","","murugansample");
      $inqur="insert into userorder(orduserId,email,address,paymethod,accphoneno,proid,proramid,procolid,quantity,totalamount) values('".$usid."','".$emai."','".$addr."','".$pay."','".$acpho."','".$pro['proid']."','".$pro['ramid']."','".$pro['colorid']."','".$qid[$i]."','".$t."')";
      $res=mysqli_query($con,$inqur);
      $dq="delete from cart where cartId='".$pro['cartId']."'";
      $n=mysqli_query($con,$dq);
      $i++;
      }
      if($res)
      {
        echo "<script>alert('Successfully Order Placed');
        confirm('can you continue shopping');
        window.location.href='home1.php';
        </script>";
      }
    }
  }
  ?>
</body>
</html>