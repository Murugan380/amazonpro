<?php
session_start();
if(!isset($_SESSION['uname']))
{
    header("location:adminlogin.php");
    exit();
}
?>
<?php
if(isset($_POST['submit']))
{
    $v1=$_POST['d1'];
    $v2=$_POST['d2'];
    $v3=$_POST['d3'];
    $con=new mysqli("localhost","root","","murugansample");
    if($con->connect_error)
    {
        echo "<script>alert('connection failed');</script>";
    }
    $qur="insert into productdetail(productId,detail_Key,detail_Value) values('".$v1."','".$v2."','".$v3."')";
    $res=mysqli_query($con,$qur);
    if($res==true)
    {
        echo "<script>alert('Insert successful');</script>";
    }
    else
        echo "<script>alert('Insert UNsuccessful');</script>";
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
        <form method="POST">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enter the ProductID</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="d1" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enter the DetailKEY</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="d2">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enter the Detail Value</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="d3">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="productdetails.php">
      <div class="modal-body">
        <label>Detail ID:</label>
        <input type="number" name="c1" id="c1" class="form-control" readonly>
        <label>Product ID:</label>
        <input type="number" name="c2" id="c2" class="form-control">
         <label>Detail Key:</label>
        <input type="text" name="c3" id="c3" class="form-control">
        <label>Detail value:</label>
        <input type="text" name="c4" id="c4" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="savec">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>
    
    <script>
        window.history.replaceState(null,null,"productdetails.php");
        function del(id)
        {
            var ans=confirm("are you sure");
            window.location.assign("productdetails.php?id="+id);
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
    $qur="select * from productdetail";
    $res=mysqli_query($con,$qur);
    ?>
    <table class="table mx-auto text-center">
        <th>Detail id</th>
        <th>Product Id</th>
        <th>detail key</th>
        <th>detail value</th>
        <th>edit</th>
        <th>detete</th>
    <?php
    while($row=$res->fetch_assoc())
    {
        $id=$row['detailId'];
        $pid=$row['productId'];
        $detailKey=$row['detail_Key'];
        $value=$row['detail_Value'];
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $pid ?></td>
            <td><?php echo $detailKey ?></td>
            <td><?php echo $value ?></td>
            <td><button type="button" class="btnx btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" name="tb1">Edit</button></td>
            <td><button type="submit" class="btn btn-danger" onclick="del('<?php echo $id ?>')">Delete</button></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
     $res->free();
if(isset($_GET['id']))
{
    $con=new mysqli("localhost","root","","murugansample");
    if($con->connect_error)
    {
        echo "<script>alert('connection failed');</script>";
    }
    $id=$_GET['id'];
    $qur="delete from productdetail where detailId='".$id."'";
    if($res=mysqli_query($con,$qur))
    {
        echo "<script>alert('deleted successful')
        window.location.href='productdetails.php';
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
    $con=new mysqli("localhost","root","","murugansample");
    if($con->connect_error)
    {
        echo "<script>alert('connection failed');</script>";
    }
    $qur="update productdetail set productId='".$v2."',detail_Key='".$v3."',detail_Value='".$v4."' where detailId='".$v1."'";
    if($res=mysqli_query($con,$qur))
    {
        echo "<script>alert('successfully updated');</script>";
    }
    $con->close();
}
?>