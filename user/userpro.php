<?php
include("navbar.php");
?>
<?php
$pasword="";
$con=new mysqli("localhost","root","","murugansample");
$qur="select * from userlog where userId='".$_SESSION['uid']."'";
$res=mysqli_query($con,$qur);
?>
<section class="container navba">
<h3 class="mb-4 hidden">Edit here</h3>
<?php
while($row=$res->fetch_assoc())
{
    $name=$row['username'];
    $email=$row['email'];
    $phono=$row['phoneno'];
    $pasword=$row['pasword'];
    ?>
    <ul type="none">
        <h6 class="mb-3 hidden">USER :</h6>
        <input type="text" value="<?php echo $name?>" class="form-control mb-3 hidden" readonly>
        <li class="mb-3 hidden" hidden><?php echo $name?></li>
        <h6 class="mb-3 hidden">EMAIL :</h6>
        <input type="email" value="<?php echo $email?>" class="form-control mb-3 hidden" readonly>
        <li class="mb-3" hidden><?php echo $email?></li>
        <h6 class="mb-3 hidden">PHONE :</h6>
        <input type="email" value="<?php echo $phono?>" class="form-control mb-3 hidden" readonly>
        <li class="mb-3 hidden" hidden><?php echo $phono?></li>
        <li><button type="button" class="btnx btn btn-outline-secondary hidden" data-bs-toggle="modal" data-bs-target="#exampleModal" name="tb1">Edit</button></li>
</ul>
    <?php
}
?>
</section>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        window.history.replaceState(null,null,'userpro.php');
         function check()
        {
            let pas=<?php echo $pasword?>;
            let val=document.getElementBYId('c4').value;
            if(val!=pas)
            {
                alert("INvalid");
                return false;
            }
        }
        </script>
</head>
<body>
    <script>
         $(document).ready(function(){
            $('.btnx').on('click',function(){
                $('#exampleModal').modal('show');
                $t=$(this).closest('ul');
                var data=$t.children('li').map(function(){
                    return $(this).text();
                }).get();
                $('#c1').val(data[0]);
                $('#c2').val(data[1]);
                $('#c3').val(data[2]);
            });
        });
    </script>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="userpro.php" onsubmit="return check()">
            <div class="modal-body">
                <label  class="form-label mb-1">Name:</label>
                <input type="text" name="c1" id="c1" class="form-control  mb-2">
                <label class="form-label mb-1">Email:</label>
                <input type="text" name="c2" id="c2" class="form-control  mb-2">
                <label class="form-label mb-1">Phone number:</label>
                <input type="text" name="c3" id="c3" class="form-control  mb-2">
                <label class="form-label mb-1">Password:</label>
                <input type="password" name="c4" id="c4" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="save">Save changes</button>
            </div>
            </form>
            </div>
        </div>
        </div>

        <?php
        if(isset($_POST['save'])){
            $name=$_POST['c1'];
            $email=$_POST['c2'];
            $phone=$_POST['c3'];
            $pass=$_POST['c4'];
            if($pasword!=$pass)
            {
                echo "<script>alert('Invalid Password');window.location.href='userpro.php';</script>";
            }
            else
            {
                 $con=new mysqli("localhost","root","","murugansample");
            $qur="update userlog set username='".$name."',email='".$email."',phoneno='".$phone."' where userId='".$_SESSION['uid']."'";
            $res=mysqli_query($con,$qur);
            if($res)
            {
                echo "<script>alert('Successfully Updated');window.location.href='userpro.php';</script>";
            }
            }
        }

        ?>
<?php include("ani.html")?>
</body>
</html>