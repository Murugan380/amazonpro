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
$targetdir="files/";
if(isset($_POST['submit']) && !empty($_FILES["c3"]["name"]))
{
    $v1=$_POST['c1'];
    $v2=$_POST['c2'];
    $randname=time().uniqid(rand());
$filename=basename($_FILES["c3"]["name"]);
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
    $qur="insert into productcolor(productId,color,imgurl) values('".$v1."','".$v2."','".$FN."')";
    $res=mysqli_query($con,$qur);
    if($res==true)
    {
        if(move_uploaded_file($_FILES['c3']['tmp_name'],$targetDirPath))
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
            <form method="POST" action="productcolor.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Product Id</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="c1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Product color</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="c2" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="exampleInputPassword1" name="c3">
                    <div><?php echo $statmsg?></div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
            <form method="POST" action="productcolor.php">
                <button type="submit" class="btn btn-primary" name="submit1">Display</button>
            </form>
        </div>


<!--model-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="productcolor.php" enctype="multipart/form-data">
      <div class="modal-body">
        <label>Color ID:</label>
        <input type="number" name="c1" id="c1" readonly class="form-control">
         <label>Product Id:</label>
        <input type="number" name="c2" id="c2" class="form-control">
       <label>color Name:</label>
        <input type="text" name="c3" id="c3" class="form-control">
        <label>Old image</label>
        <input type="text" id="c5" name=c5 class="form-control" readonly>
       <label>change image:</label>
        <input type="file" class="form-control" name=c51 id=c51>
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
            window.history.replaceState(null,null,'productcolor.php');
            function del(id,img)
            {
                var ans=confirm("Are you sure");
                if(ans)
                {
                window.location.assign("productcolor.php?id="+id + "&img=" +img);
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
                    $('#c5').val(data[4]);
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
    $qur="select * from productcolor";
    $res=mysqli_query($con,$qur);
    ?>
    <table class="table bordered mx-auto text-center" >
        <th>colorId</th>
        <th>ProductId</th>
        <th>Color name</th>
        <th>Image</th>
        <th>ImgUrl</th>
        <th>Edit</th>
        <th>Delete</th>
    <?php
    while($row=$res->fetch_assoc())
    {
        $id=$row['colorId'];
        $proId=$row['productId'];
        $color=$row['color'];
        $img=$row['imgurl']
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $proId ?></td>
            <td><?php echo $color ?></td>
            <td><img src="files/<?php echo $img?>" width="50px" height="50px"></td>
            <td><?php echo $img?></td>
            <td><button type="button" class="btnx btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" name="tb1">Edit</button></td>
            <td><button type="submit" class="btn btn-danger" onclick="del('<?php echo $id?>','<?php echo $img?>')">Delete</button></td>
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
    $filepath="files/".$img;
    $con=new mysqli("localhost","root","","murugansample");
    if($con->connect_error)
    {
        echo "<script>alert('connection failed');</script>";
    }
    $id=$_GET['id'];
    $qur="delete from productcolor where colorId='".$id."'";
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
        window.location.href='productcolor.php';
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
    $v5=$_POST['c5'];
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
    $qur="update productcolor set productId='".$v2."',color='".$v3."',imgurl='".$v5."' where colorId='".$v1."'";
    if($res=mysqli_query($con,$qur))
        echo "<script>alert('successfully updated');</script>";
    $con->close();
}
?>