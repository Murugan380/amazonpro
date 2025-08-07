<?php
session_start();
if(!isset($_SESSION['uname']))
{
    header("location:adminlogin.php");
    exit();
}
?>
<?php
$p0="";
$p2="";
$p3="";
$p5="";
$p6="";
$pp="";
 $targetdir="files/";
if(isset($_POST['submit']))
{
    $p1=$_POST['p1'];
    $p2=$_POST['p2'];
    $p3=$_POST['p3'];
    $p5=$_POST['p5'];
    $p6=$_POST['p6'];
    $batry=$_POST['battery'];
    $discount=$_POST['discount'];
 $con=new mysqli("localhost","root","","murugansample");
     if($con->connect_error)
        echo "<script>alert('connection failed');</script>";
    try
    {
    $qur="insert into products(categoryId,productname,Brand,imgUrl,discribtion,stack,battery,discount) values('".$p1."','".$p2."','".$p3."','".$FN."','".$p5."','".$p6."','".$batry."','".$discount."')";
    $res=mysqli_query($con,$qur);
    if($res==true)
    {
        echo "<script>alert('Insert successful');</script>";
    }
}
catch(Exception $e){
    echo "<script>alert('Duplicate Entery');</script>";
}
$con->close();
}
else{
    $statmsg="Invalid format";
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
    <div class="container">
        <a href="pageopen.php" class="btn btn-primary my-3">Home</a>
        <form method="POST" action="products.php" enctype="multipart/form-data" auto>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">categoryId</label>
                <input type="number" class="form-control" id="" name="p1" value="<?php echo $p1?>" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Productname</label>
                <input type="text" class="form-control" id="" name="p2" value="<?php echo $p2?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Brand name</label>
                <input type="text" class="form-control" id="" name=p3 value="<?php echo $p3?>">
            </div>
            <div class="mb-3">
             <label>Enter the Battery size</label>
             <input type="text" name="battery" id="battery" class="form-control">
            </div>
            <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name=p5><?php echo $p5?></textarea>
            <label for="floatingTextarea2">Discribtion</label>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enter the stack</label>
                <input type="number" class="form-control" id="" name=p6 value="<?php echo $p6?>">
            </div>
            <div class="mb-3">
             <label>Enter the Discount:</label>
             <input type="number" name="discount" id="discount" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <div class="container">
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="products.php" enctype="multipart/form-data" onsubmit="return check()">
      <div class="modal-body">
        <label>Product ID:</label>
        <input type="number" name="c1" id="c1" readonly class="form-control">
         <label>Category Name:</label>
        <input type="number" name="c2" id="c2" class="form-control">
       <label>Product Name:</label>
        <input type="text" name="c3" id="c3" class="form-control">
       <label>Brand Name:</label>
        <input type="text" name="c4" id="c4" class="form-control">
        <label>image</label>
        <label>Enter the Battery size</label>
        <input type="text" name="bb" id="bb" class="form-control">
        <label>Discribtion</label>
  <textarea id="c6" name="c6" class="form-control"></textarea>
    <label>Enter the stack</label>
    <input type="number" id="c7" name="c7" class="form-control">
    <label>Enter the Discount</label>
        <input type="number" name="dd" id="dd" class="form-control">
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="savec">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>
</div>
<script>
        window.history.replaceState(null,null,'products.php');
        function del(id,img)
        {
            var ans=confirm("Are you sure");
            if(ans)
            {
            window.location.assign("products.php?id="+id);
            }
        }
        $(document).ready(function(){
            $('.btnx').on('click',function(){
                $('#exampleModal').modal('show');
                $t=$(this).closest('tr');
                var data=$t.children('td').map(function(){
                    return $(this).text();
                }).get();
                $('#c1').val(data[0]);
                $('#c2').val(data[1]);
                $('#c3').val(data[2]);
                $('#c4').val(data[3]);
                $('#bb').val(data[4]);
                $('#c6').val(data[5]);
                $('#c7').val(data[6]);
                $('#dd').val(data[7]);
            });
        });
    </script>
</body>
</html>
<?php
     $con=new mysqli("localhost","root","","murugansample");
    if($con->connect_error)
    {
        echo "<script>alert('connection failed');</script>";
    }
    $qur="select * from products";
    $res=mysqli_query($con,$qur);
    ?>
    <table class="table bordered mx-auto text-center">
        <th>Product ID</th>
        <th>categoryId</th>
        <th>productname</th>
        <th>Brand</th>
        <th>Battery</th>
        <th>discribution</th>
        <th>stack</th>
        <th>Discount</th>
        <th>edit</th>
        <th>Delete</th>
    <?php
    while($row=$res->fetch_assoc())
    {
        $id=$row['Id'];
        $catid=$row['categoryId'];
        $proname=$row['productname'];
        $brand=$row['Brand'];
         $bat=$row['battery'];
        $disc=$row['discribtion'];
        $stack=$row['stack'];
        $discc=$row['discount']
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $catid ?></td>
            <td><?php echo $proname ?></td>
            <td><?php echo $brand ?></td>
            <td><?php echo $bat ?></td>
            <td><?php echo $disc ?></td>
            <td><?php echo $stack?></td>
            <td><?php echo $discc?></td>
            <td><button type="button" class="btnx btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" name="tb1">Edit</button></td>
            <td><button type="submit" class="btn btn-danger" onclick="del('<?php echo $id?>')">Delete</button></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
     $res->free();
?>
<?php
if(isset($_GET['id']))
{
    $img=$_GET['img'];
    $con=new mysqli("localhost","root","","murugansample");
    if($con->connect_error)
    {
        echo "<script>alert('connection failed');</script>";
    }
    $id=$_GET['id'];
    $qur="delete from products where Id='".$id."'";
    if($res=mysqli_query($con,$qur))
    {
        echo "<script>alert('deleted successful');
        window.location.href='products.php';
        </script>";
    }
    else
        echo "<script>alert('deleted Unsuccessful')</script>";
    $con->close();
} 



if(isset($_POST['savec']))
{
    $v1=$_POST['c1'];
    $v2=$_POST['c2'];
    $v3=$_POST['c3'];
    $v4=$_POST['c4'];
    $v6=$_POST['c6'];
    $v7=$_POST['c7'];
    $bb=$_POST['bb'];
    $dd=$_POST['dd'];
    $con=new mysqli("localhost","root","","murugansample");
    if($con->connect_error)
        echo "<script>alert('connection failed');</script>";
    $qur="update products set categoryId='".$v2."',productname='".$v3."',Brand='".$v4."',battery='".$bb."',discribtion='".$v6."',stack='".$v7."',discount='".$dd."' where Id='".$v1."'";
    if($res=mysqli_query($con,$qur))
        echo "<script>alert('successfully updated');</script>";
    $con->close();
}
?>
