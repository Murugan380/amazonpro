<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
if(!isset($_SESSION['name']))
{
    header("location:home1.php");
    exit();
}
?>
<?php
$cat="";
if(isset($_GET['Cat']))
            {
              $cat=$_GET['Cat'];
            }
?>
<?php
$con="";
$id="";
if(isset($_GET['Id']))
{
$id=$_GET['Id'];
 $con=new mysqli("localhost","root","","murugansample");
     $qur="SELECT * FROM products where Id=$id";
    $res=mysqli_query($con,$qur);
    $row=$res->fetch_assoc();
    $id=$row['Id'];
    $name=$row['productname'];
    $stack=$row['stack'];
    $dis=$row['discribtion'];
    $con->close();
}
    ?>


<!--Get color-->
    <?php
    $kd="";
    if(isset($_GET['Col']))
    {
          $kd=$_GET['Col'];
        $con=new mysqli("localhost","root","","murugansample");
          $qurchange="select * from productcolor where colorId=$kd";
          $changeres=mysqli_query($con,$qurchange);
          if($changeres && $changeres->num_rows>0)
          {
            $charow=$changeres->fetch_assoc();
            $img=$charow['imgurl'];
            }
            $con->close();
        }
            ?>

        <!--select ram-->
<?php
$r="";
$r1=[];
$rram="";
if(isset($_GET['Ram']))
{
    $r=$_GET['Ram'];
    $con=new mysqli("localhost","root","","murugansample");
 $qram="Select * from productram where productId=$id";
          $ram=mysqli_query($con,$qram);
        }
        $con->close();
          ?>

        <!--select color-->
            <?php
            $con=new mysqli("localhost","root","","murugansample");
            $qcolor="SELECT * FROM productcolor WHERE productId=$id";
        $col=mysqli_query($con,$qcolor);
        $arr=[];
        while($rcol=$col->fetch_assoc())
        {
          $arr[]=$rcol;
        }
        $con->close();
        ?>
<?php
$sta=(isset($_GET['Qul']))?$_GET['Qul']:'1';
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
            let pid=<?php echo $id?>;
            let colr = <?php echo $kd?>;
            let rami=<?php echo $r?>;
            let qual=<?php echo $sta?>;
            function color(col)
          {
              colr = col;
              const newUrl = "phonesample.php?Id=" + pid + "&Col=" + colr + "&Ram=" + rami + "&Qul=" + qual +"&Cat="+<?php echo $cat?>;
              history.replaceState(null, "", newUrl);
              window.location.href = newUrl;
          }
          function ram(ramId)
          {
              rami = ramId;
              const newUrl = "phonesample.php?Id=" + pid + "&Col=" + colr + "&Ram=" + rami + "&Qul=" + qual +"&Cat="+<?php echo $cat?>;
              history.replaceState(null, "", newUrl);
              window.location.href = newUrl;
          }
          function quli(qlt)
          {
              qual = qlt;
              const newUrl = "phonesample.php?Id=" + pid + "&Col=" + colr + "&Ram=" + rami + "&Qul=" + qual +"&Cat="+<?php echo $cat?>;
              history.replaceState(null, "", newUrl);
              window.location.href = newUrl;
          }
            function buy()
            {
                window.location.assign("order.php?Id="+pid +"&Col="+colr +"&Ram="+rami+"&Qul="+qual);
            }
            function cart()
            {
                 window.location.assign("usercart.php?Id="+pid +"&Col="+colr +"&Ram="+rami+"&Qul="+qual);
            }
            function phone(id,mg,ram){
        window.location.assign("phonesample.php?Id="+id +"&Col="+mg +"&Ram="+ram+"&Cat="+<?php echo $cat?>);
      }
            </script>
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
          <li><a href="phone.php?Cd=1" class="nav-link mx-3 <?php if($cat==1) echo 'active';?>">Smart phone</a></li>
          <li><a href="phone.php?Cd=2" class="nav-link mx-3 <?php if($cat==2) echo 'active';?>">Laptop</a></li>
          <li><a href="phone.php?Cd=3" class="nav-link mx-3 <?php if($cat==3) echo 'active';?>">Tab</a></li>
          <li><a href="usercart.php" class="nav-link mx-3 ">Cart</a></li>
          <li><a href="yourorder.php" class="nav-link mx-3">Your orders</a></li>
        </ul>
        <div class="text-end d-flex">
          <div class="text-center d-md-flex d-none align-items-center me-3 mb-md-0 mb-3">
          <a href="userpro.php" class="user" id="user"><i class="bi bi-person"></i></a>
          <div class="ms-1"><?php echo $_SESSION['oname'];?></div>
        </div>
          </div>
          <a href="userlogout.php" class="btn btn-sm btn-outline-danger me-3">Logout</a>
        </div>
    </div>
    
        

            <div class="row container-fluid mt-3">
      <div class="col-12 col-md-6">
        <img src="../admin1/files/<?php echo $img?>" width="400px" class="mb-3 hidden">
        <li type="none" class="fs-5 mb-3 hidden"><?php echo $dis ?></li>
      </div>
      <?php
                   
        ?>


    <!--details-->
    <div class="col-12 col-md-6 d-flex">
        <div class="">
          <ul type="none">
            <li class="d-flex gap-3 fs-5 hidden"><div class="h4">Name :</div><?php echo $name?></li>
   <?php
   $con=new mysqli("localhost","root","","murugansample");
          $detail="select * from productdetail where productId=$id";
          $dres=mysqli_query($con,$detail);
          while($row=$dres->fetch_assoc())
          {
            $dekey=$row['detail_Key'];
            $devalue=$row['detail_Value'];
            ?>
            <li class="d-flex gap-3 fs-5 hidden"><div class="h4"><?php echo $dekey ?> :</div><?php echo $devalue ?></li>
            <?php
          }
          $con->close();
          ?>
<?php
if($stack)
{
    ?>
    <div class="d-flex mt-3 gap-3">
    <div style="color:green;text-decration:none;" class="hidden">In stack</div>
    <?php
    $i=1;
    ?>
    <select name="quanti" onchange="quli(this.value)" class="hidden">
        <?php
    while($i<=$stack)
    {
        ?>
        <option <?php if($sta==$i) echo "selected";?>><?php echo $i ?></option>
        <?php
        $i++;
    }
    ?>
    </select></div><br>
    <?php
}
else
{
    ?>
    <div style="color:red" class="hidden">Out of stack</div>
    <?php
}
?>

<?php
     
     while($rram=$ram->fetch_assoc())
          {
            $s1=$rram['ramId'];
            $r1=$rram['ram'];
           $store=$rram['storage'];
           $price=$rram['price'];
            ?>
            <a class="btn btn-outline-dark my-2 hidden <?php echo ($r==$s1)?'active':'';?>" onclick="ram(<?php echo $s1?>)"><?php echo $r1."+".$store;?><div class="mt-1"><i class="bi bi-currency-rupee"><?php echo $price ?></i> </div></a>
            <?php
          }
?>
<br>
          <?php
           for($i=0;$i<count($arr);$i++)
        {
            ?>
          <a class="btn btn-outline-dark my-3 hidden <?php echo ($kd== $arr[$i]['colorId'])?'active':'';?>" onclick="color(<?php echo $arr[$i]['colorId']?>)"><?php echo $arr[$i]['color'];?></a>
        <?php
        }
        ?><?php
        
          ?>
        <li><a class="btn btn-warning mb-3 hidden" onclick="cart()">Add to cart</a></li>
        <?php
        if($stack)
        {
        ?>
          <li><a class="btn btn-warning hidden" onclick="buy()">Buy</a></li>
          <?php }?>
          </ul>
  </div>
  </div>
  </div>


  <div class="container-fluid mt-5">
  <h2 class="mb-3 hidden">Choose Next</h2>
<div style="overflow-x:auto; white-space:nowrap; width:100%; padding:10px; -ms-overflow-style:none; scrollbar-width:none;border-radius:10px;">
  <div class="">
 <?php
 $con=new mysqli("localhost","root","","murugansample");
    $qur="select Id,productname,discribtion from products where categoryId='".$cat."'";
    $res=mysqli_query($con,$qur);
    ?>
    <div class="">
      <?php
      $i=1;
      while($row=$res->fetch_assoc())
      {
        $pid=$row['Id'];
          $name=$row['productname'];
          $dis=$row['discribtion'];
          if($pid==$id)
          {
          }
          else{
                      $qco="select * from productcolor join productram on productcolor.productId=productram.productId where productram.productId=$pid";
          $ress=mysqli_query($con,$qco);
          $arr=[];
          while($roww=$ress->fetch_assoc())
          {
            $arr[]=$roww;
          }
          $colId=$arr[0]['colorId'];
          $img=$arr[0]['imgurl'];
          $ram=$arr[0]['ramId'];
          ?>
          <div style="display:inline-block; margin-right:15px; vertical-align:top;">
              <div class="card hidden" style="width: 18rem;box-shadow:2px 2px 10px;">
                <img src="../admin1/files/<?php echo $img?>" class="card-img-top" alt="..." height="200px">
          <?php
          ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $name?></h5>
                    <p class="card-text" style="display: -webkit-box;-webkit-line-clamp: 2; -webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;"><?php echo $dis;?></p>
                    <a  class="btn btn-primary" onclick="phone(<?php echo $pid?>,<?php echo $colId?>,<?php echo $ram ?>,<?php echo $cat?>)">Show More</a>
                </div>
              </div>
          </div>
      <?php
       if($i>10)
        {
          break;
        }
      $i++;
          }
      }
      $con->close();  
      ?>
      </div>
    </div>
    </div>
    <?php include("ani.html")?>
    </body>
</html>