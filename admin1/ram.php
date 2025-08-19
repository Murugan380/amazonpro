
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
    <a href="pageopen.php" class="btn btn-primary my-3">Home</a>
    <form method="POST" action="ram.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Product ID</label>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="t1" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" >Ram</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="t2" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" >Storage</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="t3" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" >Price</label>
            <input type="number" class="form-control" id="exampleInputPassword1" name="t4" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>


    <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="ram.php">
            <div class="modal-body">
                <label>Ram ID:</label>
                <input type="number" name="c0" id="c0" readonly>
                <label>Product ID:</label>
                <input type="number" name="c1" id="c1">
                <label>Ram:</label>
                <input type="text" name="c2" id="c2">
                <label>Storage:</label>
                <input type="text" name="c3" id="c3">
                <label>Price</label>
                <input type="number" name="c4" id="c4">
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
            window.history.replaceState(null,null,'ram.php');
            function del(id)
            {
                var ans=confirm("Are you sure");
                if(ans)
                window.location.assign("ram.php?id="+id);
            }
            $(document).ready(function(){
                $('.btnx').on('click',function(){
                    $('#exampleModal').modal('show');
                    $t=$(this).closest('tr');
                    var data=$t.children('td').map(function(){
                        return $(this).text();
                    }).get();
                    $('#c0').val(data[0]);
                    $('#c1').val(data[1]);
                    $('#c2').val(data[2]);
                    $('#c3').val(data[3]);
                    $('#c4').val(data[4]);
                });
            });
        </script>
</body>
</html>
<?php
if(isset($_POST['submit']))
    {
        $v1=$_POST['t1'];
        $v2=$_POST['t2'];
        $v3=$_POST['t3'];
        $v4=$_POST['t4'];
        $con=new mysqli("localhost","root","","murugansample");
        if($con->connect_error)
        {
            echo "<script>alert('connection failed');</script>";
        }
        $qur="insert into productram(productId,ram,storage,price) values('".$v1."','".$v2."','".$v3."','".$v4."')";
        $res=mysqli_query($con,$qur);
        if($res==true)
        {
            echo "<script>alert('Insert successful');</script>";
        }
        else
            echo "<script>alert('Insert UNsuccessful');</script>";
        $con->close();
        
    }
        $con=new mysqli("localhost","root","","murugansample");
        if($con->connect_error)
        {
            echo "<script>alert('connection failed');</script>";
        }
        $qur="select * from productram";
        $res=mysqli_query($con,$qur);
    ?>
    <table class="table">
        <th>RamID</th>
        <th>ProductID</th>
        <th>Ram</th>
        <th>Storage</th>
        <th>price</th>
        <th>edit</th>
        <th>Delete</th>
        <?php
            while($row=$res->fetch_assoc())
            {
                $ramid=$row['ramId'];
                $id=$row['productId'];
                $ram=$row['ram'];
                $stro=$row['storage'];
                $pric=$row['price'];
                ?>
                <tr>
                    <td><?php echo $ramid ?></td>
                    <td><?php echo $id ?></td>
                    <td><?php echo $ram ?></td>
                    <td><?php echo $stro ?></td>
                    <td><?php echo $pric ?></td>
                    <td><button type="button" class="btnx btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" name="tb1">Edit</button></td>
                    <td><button type="submit" class="btn btn-danger" onclick="del('<?php echo $ramid ?>')">Delete</button></td>
                </tr>
                <?php
            }
        ?>
    </table>
      <?php
       $res->free();
    if(isset($_GET['id']))
    {
        $conn=new mysqli("localhost","root","","murugansample");
        if($conn->connect_error)
        {
            echo "<script>alert('connection failed');</script>";
        }
        $id=$_GET['id'];
        $qurr="delete from productram where ramId='".$id."'";
        if($ress=mysqli_query($conn,$qurr))
        {
            echo "<script>alert('deleted successful')
            window.location.href='ram.php';
            </script>";
        }
        else
            echo "<script>alert('deleted Unsuccessful')</script>";
        $conn->close();
    } 
    if(isset($_POST['savec']))
    {
        $v1=$_POST['c0'];
        $v2=$_POST['c1'];
        $v3=$_POST['c2'];
        $v4=$_POST['c3'];
        $v5=$_POST['c4'];
        $conn=new mysqli("localhost","root","","murugansample");
        if($conn->connect_error)
        {
            echo "<script>alert('connection failed');</script>";
        }
        $qurr="update productram set productId='".$v2."',ram='".$v3."',storage='".$v4."',price='".$v5."' where ramId='".$v1."'";
        if($ress=mysqli_query($conn,$qurr))
        {
            echo "<script>alert('successfully updated');</script>";
        }
        $conn->close();
    }
?>