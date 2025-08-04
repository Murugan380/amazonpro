<?php
    session_start();
    if(!isset($_SESSION['uname']))
    {
        header("location:adminlogin.php");
        exit();
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
        <a href="pageopen.php" class="btn btn-primary my-3">Home</a>
        <form method="POST" action="productcategory.php">
            <label>ENTER the Category ID:</label>
            <input type="number" name="t1" required>
            <label>Enter the Category Name:</label>
            <input type="text" name="t2" required>
            <input type="submit" name="submit" class="btn btn-primary">
        
        </form>
        <form method="POST" action="productcategory.php">
            <button type="submit" name="submit1" class="btn btn-primary">Show</button>
            <a href="productcategory.php" class="btn btn-primary">BAck</a>
        </form>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="productcategory.php">
            <div class="modal-body">
                <label>Category ID:</label>
                <input type="number" name="c1" id="c1" readonly>
                <label>Category Name:</label>
                <input type="text" name="c2" id="c2">
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
            window.history.replaceState(null,null,'productcategory.php');
            function del(id)
            {
                var ans=confirm("Are you sure");
                if(ans)
                window.location.assign("productcategory.php?id="+id);
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
        $con=new mysqli("localhost","root","","murugansample");
        if($con->connect_error)
        {
            echo "<script>alert('connection failed');</script>";
        }
        $qur="insert into procategory(categoryId,categoryname) values('".$v1."','".$v2."')";
        $res=mysqli_query($con,$qur);
        if($res==true)
        {
            echo "<script>alert('Insert successful');</script>";
        }
        else
            echo "<script>alert('Insert UNsuccessful');</script>";
        $con->close();
        
    }
    if(isset($_POST['submit1']))
    {
        $con=new mysqli("localhost","root","","murugansample");
        if($con->connect_error)
        {
            echo "<script>alert('connection failed');</script>";
        }
        $qur="select * from procategory";
        $res=mysqli_query($con,$qur);
    ?>
    <table>
        <?php
            while($row=$res->fetch_assoc())
            {
                $id=$row['categoryId'];
                $name=$row['categoryname'];
                ?>
                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $name ?></td>
                    <td><button type="button" class="btnx btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" name="tb1">Edit</button></td>
                    <td><button type="submit" class="btn btn-danger" onclick="del('<?php echo $id ?>')">Delete</button></td>
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
        $con=new mysqli("localhost","root","","murugansample");
        if($con->connect_error)
        {
            echo "<script>alert('connection failed');</script>";
        }
        $id=$_GET['id'];
        $qur="delete from procategory where categoryId='".$id."'";
        if($res=mysqli_query($con,$qur))
        {
            echo "<script>alert('deleted successful')
            window.location.href='productcategory.php';
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
        $con=new mysqli("localhost","root","","murugansample");
        if($con->connect_error)
        {
            echo "<script>alert('connection failed');</script>";
        }
        $qur="update procategory set categoryname='".$v2."' where categoryId='".$v1."'";
        if($res=mysqli_query($con,$qur))
        {
            echo "<script>alert('successfully updated');</script>";
        }
        $con->close();
    }
?>