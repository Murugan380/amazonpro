<?php include("navbar.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

    <script>
        window.history.pushState(null, "", window.location.href);
window.onpopstate = function () {
    window.history.pushState(null, "", window.location.href);
};
function phone(id,mg,ram,cat){
        window.location.assign("phonesample.php?Id="+id +"&Col="+mg +"&Ram="+ram+"&Cat="+cat);
      }
      
</script>
<style>
    .navba{
    margin-top: 50px;
}


</style>
</head>
<body>
    
<div id="carouselExampleControls" class="carousel slide navba" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="nlslide.png" class="d-block w-100" height="369px;" alt="...">
    </div>
    <div class="carousel-item">
      <img src="slide2.png" class="d-block w-100" height="369px;" alt="...">
    </div>
    <div class="carousel-item">
      <img src="slide3.png" class="d-block w-100" height="369px;"  alt="...">
    </div>
  </div>
</div>
<div class="container mt-5 hidden">
<h3>Treat yourself to a new One</h3>
<p class="my-3">Experience the world at your fingertips! Work, socialise, book a ride, play games, listen to music, watch your favourite shows, take a photo, or simply make a call! Buy a Mobile Phone from Croma that does it all and then some.</p>
</div>
<div class="row container-fluid mt-5 hidden ">
  <h1>NextLevel Advantages</h1>
  <img src="homeimg1.png" class="img-fluid" alt="...">
</div>

<?php
$y=1;
while($y<=3)
{
?>
<hr class="mt-5" style="width: 100%; height: 4px;color: black;">
  <h2 class="ms-5 hidden"><?php if($y==1){ echo "Smart Phones";}elseif($y==2){ echo "Laptop";}else{ echo "Tab";} ?></h2>
  <hr class="" style="width: 100%; height: 4px;color: black;">
<div class="container-fluid mt-3">
  <div class="px-2">
<div class="d-flex align-items-center px-5">
  
  <!-- Prev Button OUTSIDE -->
  <button class="btn btn-outline-dark me-5" type="button" data-bs-target="#carouselExampleControlsNoTouching<?php echo $y?>" data-bs-slide="prev">
    ‹
  </button>

  <!-- Carousel in the Middle -->
  <div id="carouselExampleControlsNoTouching<?php echo $y?>" class="carousel slide w-100" data-bs-touch="false" data-bs-interval="false">
    <div class="carousel-inner">
      <?php
      $con = new mysqli("localhost","root","","murugansample");
      $cat = $y;
      $qur = "SELECT * FROM products WHERE categoryId='".$cat."'";
      $res = mysqli_query($con,$qur);
      $i=0;
      $count = 0;
      while($row = $res->fetch_assoc()) {
          $id   = $row['Id'];
          $name = $row['productname'];
          $bat  = $row['battery'];

          $qco = "SELECT * FROM productcolor 
                  JOIN productram ON productcolor.productId = productram.productId 
                  WHERE productram.productId=$id";
          $ress = mysqli_query($con,$qco);
          $arr=[];
          while($roww=$ress->fetch_assoc()){
            $arr[]=$roww;
          }

          $colId = $arr[0]['colorId'];
          $img   = $arr[0]['imgurl'];
          $ram   = $arr[0]['ramId'];
          $rami  = $arr[0]['ram'];
          $store = $arr[0]['storage'];
          $price = $arr[0]['price'];

          // open new carousel-item every 4 items
          if ($count % 4 == 0) {
              echo '<div class="carousel-item '.($count==0 ? 'active' : '').'"><div class="row g-0">';
          }
          ?>

          <div class="col-md-3 hidden">
            <div class="card border border-3 h-100" style="max-width:16rem;">
              <img src="../admin1/files/<?php echo $img?>" class="card-img-top p-1 border border-bottom-3" alt="..." height="160px">
              <div class="card-body">
                <h5 class="card-title"><?php echo $name?></h5>
                <div>(<?php echo $rami?> Ram, <?php echo $store?> Storage)</div>
                <div><?php echo $bat?> Battery</div>
                <p class="mt-2"><i class="bi bi-currency-rupee"></i><?php echo $price?></p>
                  <a class="btn btn-outline-dark" 
                    onclick="phone(<?php echo $id?>,<?php echo $colId?>,<?php echo $ram ?>,<?php echo $cat?>)">
                    Buy Now
                  </a>
              </div>
            </div>
          </div>

          <?php
          $count++;

          // close row and carousel-item every 4 items
          if ($count % 4 == 0) {
              echo '</div></div>';
          }
          $i++;
          if ($i > 7) {
              break;
          }
      }

      // close unclosed row if items not multiple of 4
      if ($count % 4 != 0) {
          echo '</div></div>';
      }

      $con->close();
      ?>
    </div>
  </div>

  <!-- Next Button OUTSIDE -->
  <button class="btn btn-outline-dark ms-1" type="button" data-bs-target="#carouselExampleControlsNoTouching<?php echo $y?>" data-bs-slide="next">
    ›
  </button>
</div>
    </div>
    </div>
    <?php
    $y++;
}
    ?>
<hr class="mt-5" style="width: 100%; height: 4px;color: black;">
    <div class="container">
      <div class="row">
        <div class="col-10">
          <h2 class="my-4 hidden">Next-Level Performance</h2>
          <p class="mb-4 hidden">In today's fast-paced world, mobile phones have become an essential device that an individual must have. The significance of mobile phones cannot be overstated, as they serve multiple purposes and offer various benefits. Mobile phones enable seamless communication, connecting people with family, friends, and colleagues anytime and anywhere. Mobile phones also provide convenient access to information, entertainment, and services through the Internet, enabling efficient multitasking and productivity. At Croma, you can choose from a wide range of the latest 5G mobile phones and 4G mobile phones.</p>

          <h2 class="my-4 hidden">Power That Lasts</h2>
          <p class="mb-4 hidden">When purchasing a mobile phone, it's essential to consider various factors to make an informed decision. Factors like display size, camera quality, processor performance, battery life, and storage capacity are crucial in determining the right device for you. At Croma, we understand the importance of these factors and provide detailed product descriptions to help you make the best choice. You can refer to our phone buying guide or #AskTheExperts at Croma stores to zero down on the features your new phone must have.</p>

          <h2 class="my-4 hidden">Stunning Display</h2>
          <p class="mb-4 hidden">Explore our collection of top mobile phone brands known for their exceptional features and performance. If you are looking for an Android phone, you will be spoilt for choice. Samsung is known for its stunning displays, powerful processors, and impressive camera capabilities. OnePlus is a popular choice, too and is loved for its flagship-like features at competitive prices, fast charging capabilities, and smooth performance. Xiaomi also offers feature-rich smartphones at affordable prices and is known for its excellent camera systems and long battery life. realme, Oppo, and Vivo are other brands that provide budget-friendly options with impressive performance, AI-enhanced cameras, and large batteries. Apple iPhones, powered by iOS, are loved for their seamless user experience, advanced camera technology, and robust security features. </p>
          <h2 class="my-4 hidden">Capture Every Moment</h2>
          <p class="mb-4 hidden">At NextLevel, we understand that every individual has different preferences regarding mobile phones. Whether you're an Android enthusiast, an iPhone loyalist, a gaming enthusiast, or prefer no-fuss phones, we have diverse options to cater to your needs. Explore our collection of Android phone, iPhones, gaming mobile phones, and feature phones to find your perfect match.</p>
          <h2 class="my-4 hidden">Smart & Connected</h2>
          <p class="mb-4 hidden">Finding the ideal mobile phone within your budget is made easy at Croma. We offer phones across various price ranges, ensuring that you get the best value for your money. Explore our selection of phones, from prices starting as low as a few thousand rupees and going to more than one lakh, in the case of flagship phones.</p>
        </div>
        <div class="col-2"></div>
      </div>
    </div>
</div>
</div>

   <?php include("footer.php")?>
  <?php include('ani.html')?>
</body>
</html>
