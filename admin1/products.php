<?php
session_start();
if(!isset($_SESSION['uname']))
{
    header("location:adminlogin.php");
    exit();
}
?>
<?php
$statmsg="";
$p0="";
$p2="";
$p3="";
$filename="";
$p5="";
$p6="";
$pp="";
 $targetdir="files/";
if(isset($_POST['submit']) && !empty($_FILES["p4"]["name"]))
{
    $p1=$_POST['p1'];
    $p2=$_POST['p2'];
    $p3=$_POST['p3'];
    $p5=$_POST['p5'];
    $p6=$_POST['p6'];
    $pp=$_POST['pp'];
$randname=time().uniqid(rand());
$filename=basename($_FILES["p4"]["name"]);
$FN=$randname.$filename;
$targetDirPath=$targetdir.$FN;
$filetype=pathinfo($targetDirPath,PATHINFO_EXTENSION);
$allowtype=array('png','jpg','jpeg','gif');
 $con=new mysqli("localhost","root","","murugansample");
     if($con->connect_error)
        echo "<script>alert('connection failed');</script>";
if(in_array($filetype,$allowtype))
{
    try
    {
    $qur="insert into products(categoryId,productname,Brand,price,imgUrl,discribtion,stack) values('".$p1."','".$p2."','".$p3."','".$pp."','".$FN."','".$p5."','".$p6."')";
    $res=mysqli_query($con,$qur);
    if($res==true)
    {
        if(move_uploaded_file($_FILES['p4']['tmp_name'],$targetDirPath))
        echo "<script>alert('file uploaded successfull')</script>";  
        echo "<script>alert('Insert successful');</script>";
    }
}
catch(Exception $e){
    echo "<script>alert('Duplicate Entery');</script>";
}
}
else{
    $statmsg="Invalid format";
}
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
</head>
<body>
    <div class="container">
        <a href="pageopen.php" class="btn btn-primary my-3">Home</a>
        <form method="POST" action="products.php" enctype="multipart/form-data">
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
             <label>Enter the Price</label>
             <input type="number" name="pp" id="pp" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="" name="p4" required>
                <div style="color:red;"><?php echo $statmsg ?></div>
            </div>
            <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name=p5><?php echo $p5?></textarea>
            <label for="floatingTextarea2">Discribtion</label>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enter the stack</label>
                <input type="number" class="form-control" id="" name=p6 value="<?php echo $p6?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <div class="container">
<form method="POST" action="products.php" class="mt-3" >
    <button type="submit" class="btn btn-primary" name="submit1">Display</button>
    <a href="products.php" class="btn btn-primary">back</a>
</form>


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
        <label>Enter the Price</label>
        <input type="number" name="cp" id="cp" class="form-control">
        <label>image</label>
        <input type="text" id="c5" name=c5 class="form-control" readonly>
       <label>change image:</label>
        <input type="file" class="form-control" name=c51 id=c51>
        <div id="fail"></div>
        <label>Discribtion</label>
  <textarea id="c6" name="c6" class="form-control"></textarea>
    <label>Enter the stack</label>
    <input type="number" id="c7" name="c7" class="form-control">
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
            window.location.assign("products.php?id="+id + "&img=" +img);
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
                $('#cp').val(data[4]);
                $('#c5').val(data[6]);
                $('#c6').val(data[7]);
                $('#c7').val(data[8]);
            });
        });
    </script>
</body>
</html>
<?php
if(isset($_POST['submit1']))
{
     $con=new mysqli("localhost","root","","murugansample");
    if($con->connect_error)
    {
        echo "<script>alert('connection failed');</script>";
    }
    $qur="select * from products";
    $res=mysqli_query($con,$qur);
    ?>
    <table class="table bordered">
    <?php
    while($row=$res->fetch_assoc())
    {
        $id=$row['Id'];
        $catid=$row['categoryId'];
        $proname=$row['productname'];
        $brand=$row['Brand'];
        $price=$row['price'];
        $img=$row['imgUrl'];
        $disc=$row['discribtion'];
        $stack=$row['stack'];
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $catid ?></td>
            <td><?php echo $proname ?></td>
            <td><?php echo $brand ?></td>
            <td><?php echo $price ?></td>
            <td><img src="files/<?php echo $img?>" width="50px" height="50px"></td>
            <td><?php echo $img?></td>
            <td><?php echo $disc ?></td>
            <td><?php echo $stack?></td>
            <td><button type="button" class="btnx btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" name="tb1">Edit</button></td>
            <td><button type="submit" class="btn btn-danger" onclick="del('<?php echo $id?>','<?php echo $img?>')">Delete</button></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
     $res->free();
}
if(isset($_GET['id']))
{
    $img=$_GET['img'];
    $filepath="files/".$img;
    $con=new mysqli("localhost","root","","murugansample");
    if($con->connect_error)
    {
        echo "<script>alert('connection failed');</script>";
    }
    $id=$_GET['id'];
    $qur="delete from products where Id='".$id."'";
    if($res=mysqli_query($con,$qur))
    {
        if(file_exists($filepath))
        {
            if(unlink($filepath))
            {
                echo "<script>alert('file deleted')</script>";
            }
        }
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
    $v5=$_POST['c5'];
     $v6=$_POST['c6'];
    $v7=$_POST['c7'];
    $pp=$_POST['cp'];
    $dir="files/";
    $rand=time().uniqid(rand());
    $basename=basename($_FILES["c51"]["name"]);
    $filename1=$rand.$basename;
    if(!empty($_FILES["c51"]["name"]))
    {
        
            $targetDirPath=$dir.$filename1;
            $filetype=pathinfo($targetDirPath,PATHINFO_EXTENSION);
        $allowtype=array('png','jpg','jpeg','gif');
        if(in_array($filetype,$allowtype))
        {
            $delfun=$dir.$v5;
            $v5=$filename1;
            if(file_exists($delfun))
                unlink($delfun);
            if(move_uploaded_file($_FILES['c51']['tmp_name'],$targetDirPath))
                echo "<script>alert('file uploaded successfull')</script>";  
        }
        else 
        die("<script>alert('Invalid file format please update valid format')</script>");
    }
    $con=new mysqli("localhost","root","","murugansample");
    if($con->connect_error)
        echo "<script>alert('connection failed');</script>";
    $qur="update products set categoryId='".$v2."',productname='".$v3."',Brand='".$v4."',price='".$pp."',imgUrl='".$v5."',discribtion='".$v6."',stack='".$v7."' where Id='".$v1."'";
    if($res=mysqli_query($con,$qur))
        echo "<script>alert('successfully updated');</script>";
    $con->close();
}
?>
