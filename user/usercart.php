<?php
include("navbar.php");
?>
<?php
$row="";
$arr1=[];
$arr2=[];
$arr3=[];
$con=new mysqli("localhost","root","","murugansample");
        $qdis="select * from cart where userid='".$_SESSION['uid']."'";
        $rdis=mysqli_query($con,$qdis);
        while($row=$rdis->fetch_assoc())
        {
            $arr1[]=$row;
            ?>
        <?php
        }
?>
<?php
foreach($arr1 as $pro)
{
$qdisplay="SELECT * FROM products JOIN productram on products.Id=productram.productId JOIN productcolor on products.Id=productcolor.productId join cart on productram.ramId=cart.ramid where Id='".$pro['proid']."' and productram.ramId='".$pro['ramid']."' and productcolor.colorId='".$pro['colorid']."' and cart.cartId='".$pro['cartId']."'";
$res=mysqli_query($con,$qdisplay);
while($display=$res->fetch_assoc())
{
    $arr2[]=$display;
}
}
foreach($arr2 as $i => $pro)
{
    $arr3[]=$pro['cartId'];
}
?>


<?php
 $id=(isset($_GET['Id']))?$_GET['Id']:'';
    $rd=(isset($_GET['Ram']))?$_GET['Ram']:'';
    $cd=(isset($_GET['Col']))?$_GET['Col']:'';
    if(isset($_GET['Id']))
    {
        $cart=true;
        foreach($arr1 as $item){
            if($item['ramid']==$rd && $item['colorid']==$cd)
               $cart=false;
        }
        if($cart)  
    {
    $con=new mysqli("localhost","root","","murugansample");
    $qur="insert into cart (userid,proid,ramid,colorid) values('".$_SESSION['uid']."','".$id."','".$rd."','".$cd."')";
    $res=mysqli_query($con,$qur);
    echo "<script>window.location.href='usercart.php';</script>";    
    }
    else
    {
        echo "<script>alert('already exit');window.location.assign('phonesample.php?Id='+ $id +'&Col='+$cd +'&Ram='+$rd);</script>";
    }
}
   ?>     
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        window.history.replaceState(null,null,"usercart.php");
         window.history.pushState(null, "", window.location.href);
window.onpopstate = function () {
    window.history.pushState(null, "", window.location.href);
};
        function del(de)
        {
            const res=confirm("are you sure");
            if(res)
            {
                const url="usercart.php?de="+de;
                history.replaceState(null,"",url);
                window.location.href=url;
            }
        }
    let ar = [];
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll(".checkval").forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            let cartId = this.value.toString(); // force string
            let qty = parseInt(document.getElementById('quality' + cartId).value);

            if (this.checked) {
                if (!ar.some(item => item.id === cartId)) {
                    ar.push({ id: cartId, qty: qty });
                }
            } else {
                ar = ar.filter(item => item.id !== cartId);
            }
            console.log(JSON.stringify(ar));
        });
    });

    // Initialize for already checked on load
    document.querySelectorAll(".checkval:checked").forEach(checkbox => {
        let cartId = checkbox.value.toString(); // force string
        let qty = parseInt(document.getElementById('quality' + cartId).value);
        if (!ar.some(item => item.id === cartId)) {
            ar.push({ id: cartId, qty: qty });
        }
    });
});

function add(cartid) {
    let idStr = cartid.toString();  // force string
    let q1 = document.getElementById('quality' + idStr);
    let a = parseInt(q1.value);
    if (a < 10) {
        a++;
        q1.value = a;

        let item = ar.find(x => x.id === idStr);
        let checkbox = document.querySelector(`.checkval[value='${idStr}']`);

        if (item) {
            item.qty = a;
        } else if (checkbox && checkbox.checked) {
            ar.push({ id: idStr, qty: a });
        }

        console.log(JSON.stringify(ar));
    }
}

function sub(cartid) {
    let idStr = cartid.toString();  // force string
    let q1 = document.getElementById('quality' + idStr);
    let a = parseInt(q1.value);
    if (a > 1) {
        a--;
        q1.value = a;

        let item = ar.find(x => x.id === idStr);
        let checkbox = document.querySelector(`.checkval[value='${idStr}']`);

        if (item) {
            item.qty = a;
        } else if (checkbox && checkbox.checked) {
            ar.push({ id: idStr, qty: a });
        }

        console.log(JSON.stringify(ar));
    }
}
function buy() {
    if(ar.length === 0) {
        alert('Please select items to buy!');
        return;
    }
    const jsonStr = JSON.stringify(ar);
    const encoded = encodeURIComponent(jsonStr);
    window.location.assign("order.php?ch=" + encoded );
}

</script>
<style>
    .navba{
        margin-top:58px;
    }
    .navbaa{
        margin-top:150px;
    }
    .na{
        margin-top: 80px;
    }
    </style>
</head>
<body>
    <?php
    if(!empty($arr1))
    {
        ?>
        <div class="row navba mb-4 fixed-top bg-white" style="height:50px;" id="buyn">
            <div class="col-12 d-flex justify-content-center my-2">
    <button class="btn btn-sm btn-warning ms-1" style="width:100%;" onclick="buy()">BUY  the Selected Items</button>
    </div>
</div>
    <div class="row container-fluid navbaa">
        <?php
            foreach($arr2 as $i => $pro)
            {
                ?>
                <div class="col-md-6 col-12 d-flex justify-content-center">
                    <div class="card border border-2 mb-4 hidden" style="max-width: 540px;box-shadow:2px 2px 10px;">
                        <input type="checkbox" class="form-check-input m-2 checkval" value="<?php echo $pro['cartId']?>">
                        <div class="row g-0 p-3">
                            <div class="col-md-4">
                            <img src="../admin1/files/<?php echo $pro['imgurl']?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $pro['productname']?></h5>
                                <p class="card-text" style="display: -webkit-box;-webkit-line-clamp: 2; -webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;"><?php echo $pro['discribtion']?></p>
                                <div class="card-text">(<?php echo $pro['ram']?> Ram,<?php echo $pro['storage']?> Storage,<?php echo $pro['battery']?> Battery)</div>
                                <div class="card-text"><i class="bi bi-currency-rupee"></i><?php echo $pro['price']?></div>
                            </div>
                            </div>
                            <div class="row mt-3 d-flex align-items-center">
                                <div class="col-10"><button class="btn btn-outline-primary" onclick="sub(<?php echo $pro['cartId']?>)">-</button><input type="text" value="1" class="mx-4 text-center"  style="width:30px;" id="quality<?php echo $pro['cartId'];?>" readonly><button class="btn btn-outline-primary" onclick="add(<?php echo $pro['cartId']?>)">+</button>
                                </div>
                                <div class="col-2">
                                    <button onclick="del(<?php echo $pro['cartId']?>)" class="btn btn-outline-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
            ?>
    </div>
    <?php
}
else
{
    ?>
    <div class="na bg-dark text-white text-center p-4 hidden" style="height:140px;"><div class="h2">Empty!</div>
<a class="btn btn-primary" href="home1.php">Add Something<a>
</div>
    <?php
}
?>
<?php
if(isset($_GET['de']))
{
    $de=$_GET['de'];
    $conn=new mysqli("localhost","root","","murugansample");
    $dqur="delete from cart where cartId='".$de."'";
    $res=mysqli_query($conn,$dqur);
    if($res)
    {
        $arr1[]=array_values($arr1);
        echo "<script>window.location.href='usercart.php'</script>";
    }
    else
    {
       echo "<script>alert('not deleted');</script>"; 
    }
}   
?>
<?php include('ani.html')?>
</body>
</html>