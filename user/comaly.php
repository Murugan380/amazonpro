<?php
if(isset($_GET['Id']))
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
    ?>


    <?php
    $kd="";
    if(isset($_GET['Col']))
          $kd=$_GET['Col'];
        $con=new mysqli("localhost","root","","murugansample");
          $qurchange="select * from productcolor where colorId=$kd";
          $changeres=mysqli_query($conn,$qurchange);
          if($changeres && $changeres->num_rows>0)
          {
            $charow=$changeres->fetch_assoc();
            $img=$charow['imgurl'];
            }
            $con->close();
            ?>

        <!--select ram-->
<?php
$r="";
if(isset($_GET['Ram']))
    $r=$_GET['Ram'];
 $qram="Select * from productram where productId=$id";
          $ram=mysqli_query($con,$qram);
          $r1=[];
          while($rram=$ram->fetch_assoc())
          {
            $r1[]=$rram;
          }
          ?>

        <!--select color-->
            <?php
            $qcolor="SELECT * FROM productcolor WHERE productId=$id";
        $col=mysqli_query($con,$qcolor);
        $arr=[];
        while($rcol=$col->fetch_assoc())
        {
          $arr[]=$rcol;
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
    </head>
    <body>
        <script>
            let pid=<?php echo $id?>;
            let colr = <?php echo $kd?>;
            let rami=<?php echo $r?>;
            function color(col)
            {
                colr=col;
                window.location.assign("phonesample.php?Id="+pid +"&Col="+colr +"&Ram=" + rami );
            }
            function ram(ramId)
            {
                rami=ramId;
                window.location.assign("phonesample.php?Id="+pid +  "&Col=" + colr  +"&Ram="+rami);
            }
            function buy()
            {
                window.location.assign("order.php?Id="+pid +"&Col="+colr +"&Ram="+rami);
            }
            </script>
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center my-2 mb-lg-0 mx-5 text-danger text-decoration-none">
          <div class="me-2"><h2>Welcome</h2></div>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="home1.php" class="nav-link px-3 text-secondary">Home</a></li>
          <li><a href="phone.php" class="nav-link px-3 text-secondary">Smart phone</a></li>
          <li><a href="#" class="nav-link px-3 text-secondary">Laptop</a></li>
          <li><a href="#" class="nav-link px-3 text-secondary">Tab</a></li>
          <li><a href="#" class="nav-link px-3 text-secondary"></a></li>
          <li><a href="#" class="nav-link px-3 text-secondary">About</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 d-none d-md-block">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>
    </div>
    </body>
    </html>

            <div class="row container-fluid mt-3">
      <div class="col-12 col-md-6">
        <img src="../admin1/files/<?php echo $img?>" width="400px" class="mb-3">
        <li type="none" class="fs-5 mb-3"><?php echo $dis ?></li>
      </div>
      <?php
                   
        ?>


    <!--details-->
    <div class="col-12 col-md-6 d-flex">
        <div class="">
          <ul type="none">
            <li class="d-flex gap-3 fs-5"><div class="h4">Name :</div><?php echo $name?></li>
   <?php
          $detail="select * from productdetail where productId=$id";
          $dres=mysqli_query($con,$detail);
          while($row=$dres->fetch_assoc())
          {
            $dekey=$row['detail_Key'];
            $devalue=$row['detail_Value'];
            ?>
            <li class="d-flex gap-3 fs-5"><div class="h4"><?php echo $dekey ?> :</div><?php echo $devalue ?></li>
            <?php
          }
          ?>

<?php
for($i=0;$i<count($r1);$i++)
          {
            $s1=$r1[$i]['ramId'];
            ?>
            <a class="btn btn-outline-dark my-3" onclick="ram(<?php echo $s1?>)"><?php echo $r1[$i]['ram']."+".$r1[$i]['storage'];?></a>
            <?php
          }
?>
<br>
          <?php
           for($i=0;$i<count($arr);$i++)
        {
            ?>
          <a class="btn btn-outline-dark my-3" onclick="color(<?php echo $arr[$i]['colorId']?>)"><?php echo $arr[$i]['color'];?></a>
        <?php
        }
        ?>
        <li><a class="btn btn-primary mb-3" onclick="">Add to cart</a></li>
          <li><a class="btn btn-primary" onclick="buy()">Buy</a></li>
          </ul>
  </div>
  </div>
  </div>