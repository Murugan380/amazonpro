<?php include("navbar.php")?>
<?php
 if(isset($_GET['Cd']))
      $cat=(int)$_GET['Cd'];
?>      
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
      window.history.replaceState(null, null,"phone.php?Cd=<?php if($cat==1){ echo 1;}elseif($cat==2){echo 2;} else echo 3;?>");
      function phone(id,mg,ram){
        window.location.assign("phonesample.php?Id="+id +"&Col="+mg +"&Ram="+ram+"&Cat="+<?php echo $cat?>);
      }
    </script>
</head>
<body stye="background-color:black;color:white;">
  <?php
if($cat==1)
{
 ?>
 <div id="carouselExampleControls" class="carousel slide mt-5" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="slide1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="phoneslide2.png" class="d-block w-100" height="369px;" alt="...">
    </div>
    <div class="carousel-item">
      <img src="phoneslide3.png" class="d-block w-100" height="369px;"  alt="...">
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-0"></div>
    <div class="col-9">
      <h2 class="mt-5 hidden">Treat yourself to a new Mobile Phone</h2>
      <p class="mt-3 hidden">Experience the world at your fingertips! Work, socialise, book a ride, play games, listen to music, watch your favourite shows, take a photo, or simply make a call! Buy a Mobile Phone from Croma that does it all and then some.</p>
    </div>
    <div class="col-3"></div>
  </div>
</div>
<?php
}
elseif($cat==2)
{
 ?> 
  <div id="carouselExampleControls" class="carousel slide mt-5" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="lapslide1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="lapslide2.png" class="d-block w-100" height="369px;" alt="...">
    </div>
    <div class="carousel-item">
      <img src="lapslide3.png" class="d-block w-100" height="369px;"  alt="...">
    </div>
    <div class="carousel-item">
      <img src="lapslide4.png" class="d-block w-100" height="369px;"  alt="...">
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-0"></div>
    <div class="col-9">
      <h2 class="mt-5 hidden">Laptops That Bring Out the Best In You</h2>
      <p class="mt-3 hidden">While tablets and smartphones are still popular, most people agree that everything, from doing research for an assignment to playing hardcore games, works better on a laptop. It doesn't matter what your lifestyle is, there is always one for you at NextLevel.</p>
    </div>
    <div class="col-3"></div>
  </div>
</div>
 <?php
}
else
{
 ?>
 <div id="carouselExampleControls" class="carousel slide mt-5" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="tabs1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="tabs2.png" class="d-block w-100" height="369px;" alt="...">
    </div>
    <div class="carousel-item">
      <img src="tabs3.png" class="d-block w-100" height="369px;"  alt="...">
    </div>
    <div class="carousel-item">
      <img src="tabs4.png" class="d-block w-100" height="369px;"  alt="...">
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-0"></div>
    <div class="col-9">
      <h2 class="mt-5 hidden">Tablets for work and play</h2>
      <p class="mt-3 hidden">Tablets are great to have around. It’s a great portable TV screen and a nifty e-reader. And with the right apps the tablet serves as an outlet for your creative impulses. Make music, create art, or edit photos and videos on it. The versatility of the modern tablet ensures you can use it to get some (light) work done on the move. No matter what you want, there’s always the right tablet for you at NextLevel.</p>
    </div>
    <div class="col-3"></div>
  </div>
</div>
  <?php
}
?>
 <?php
 $con=new mysqli("localhost","root","","murugansample");
    $qur="select * from products where categoryId='".$cat."'";
    $res=mysqli_query($con,$qur);
    ?>
    <hr class="" style="width: 100%; height: 4px;color: black;">
      <h2 class="ms-3 hidden">Choose Yours </h2>
      <hr class="" style="width: 100%; height: 4px;color: black;">
      <div class="row container-fluid mt-5">
      <?php
      while($row=$res->fetch_assoc())
      {
        $i=0;
        $id=$row['Id'];
          $name=$row['productname'];
          $dis=$row['discribtion'];
          $bat=$row['battery'];
          $qco="select * from productcolor join productram on productcolor.productId=productram.productId where productram.productId=$id";
          $ress=mysqli_query($con,$qco);
          $arr=[];
          while($roww=$ress->fetch_assoc())
          {
            $arr[]=$roww;
          }
          $colId=$arr[0]['colorId'];
          $img=$arr[0]['imgurl'];
          $ram=$arr[0]['ramId'];
          $rami=$arr[$i]['ram'];
          $store=$arr[$i]['storage'];
          $price=$arr[$i]['price'];
          ?>
          <div class="col-md-6 col-lg-4 col-12 d-flex justify-content-center mb-5">
            <div class="card mb-5 hidden" style="max-width: 540px;box-shadow:5px 5px 15px;">
              <div class="row g-0">
                <div class="col-md-4 col-12 mt-2 p-1">
                  <img src="../admin1/files/<?php echo $img?>" class=" rounded-start" height="180px" width="160px" alt="...">
                </div>
                <div class="col-md-8 col-12 p-3">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $name?></h5>
                    <p class="card-text" style="display: -webkit-box;-webkit-line-clamp: 2; -webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;"><?php echo $dis?></p>
                    <p class="card-text">(<?php echo $rami?> Ram,<?php echo $store?> Storage,<?php echo $bat?> Battery)</p>
                    <p><i class="bi bi-currency-rupee"></i><?php echo $price?></p>
                    <div class="row">
                      <button class="btn btn-outline-primary " onclick="phone(<?php echo $id?>,'<?php echo $colId?>','<?php echo $ram?>')">Buy Now</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php
      $i++;
      }
      $con->close();  
      ?>
      </div>
<hr class="mt-5" style="width: 100%; height: 4px;color: black;">
      <?php
      if($cat==1)
      {
      ?>
       <div class="container mt-5">
      <div class="row">
        <div class="col-10">
          <h2 class="my-4 hidden">Buy Mobile Phones online at the best price from NextLevel</h2>
          <p class="mb-4 hidden">In today's fast-paced world, mobile phones have become an essential device that an individual must have. The significance of mobile phones cannot be overstated, as they serve multiple purposes and offer various benefits. Mobile phones enable seamless communication, connecting people with family, friends, and colleagues anytime and anywhere. Mobile phones also provide convenient access to information, entertainment, and services through the Internet, enabling efficient multitasking and productivity. At Croma, you can choose from a wide range of the latest 5G mobile phones and 4G mobile phones.</p>

          <h2 class="my-4 hidden">Factors to consider while buying a Mobile Phone</h2>
          <p class="mb-4 hidden">When purchasing a mobile phone, it's essential to consider various factors to make an informed decision. Factors like display size, camera quality, processor performance, battery life, and storage capacity are crucial in determining the right device for you. At Croma, we understand the importance of these factors and provide detailed product descriptions to help you make the best choice. You can refer to our phone buying guide or #AskTheExperts at Croma stores to zero down on the features your new phone must have.</p>

          <h2 class="my-4 hidden">Top Mobile Phone Brands You Should Know About</h2>
          <p class="mb-4 hidden">Explore our collection of top mobile phone brands known for their exceptional features and performance. If you are looking for an Android phone, you will be spoilt for choice. Samsung is known for its stunning displays, powerful processors, and impressive camera capabilities. OnePlus is a popular choice, too and is loved for its flagship-like features at competitive prices, fast charging capabilities, and smooth performance. Xiaomi also offers feature-rich smartphones at affordable prices and is known for its excellent camera systems and long battery life. realme, Oppo, and Vivo are other brands that provide budget-friendly options with impressive performance, AI-enhanced cameras, and large batteries. Apple iPhones, powered by iOS, are loved for their seamless user experience, advanced camera technology, and robust security features. </p>
          <h2 class="my-4 hidden">Types of Mobile Phones: Which One Is Right for You?</h2>
          <p class="mb-4 hidden">At NextLevel, we understand that every individual has different preferences regarding mobile phones. Whether you're an Android enthusiast, an iPhone loyalist, a gaming enthusiast, or prefer no-fuss phones, we have diverse options to cater to your needs. Explore our collection of Android phone, iPhones, gaming mobile phones, and feature phones to find your perfect match.</p>
          <h2 class="my-4 hidden">Best Mobile Phones Across Different Price Ranges</h2>
          <p class="mb-4 hidden">Finding the ideal mobile phone within your budget is made easy at Croma. We offer phones across various price ranges, ensuring that you get the best value for your money. Explore our selection of phones, from prices starting as low as a few thousand rupees and going to more than one lakh, in the case of flagship phones.</p>
        </div>
        <div class="col-2"></div>
      </div>
    </div>
    <?php
    }
    elseif($cat==2)
    {
    ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-10">
          <h2 class="my-4 hidden">Buy laptops online at the best price in India</h2>
          <p class="mb-4 hidden">Smartphones have taken over most of our screen time. Even tablets are being designed to replace laptops. Even as the ubiquitous bricks and slabs are getting more and more powerful each week, there’s always a need for a real computer. For most people, this typically means a laptop.</p>
          <p class="mb-4 hidden">Even the most digitally-forward folks will admit there’s no substitute for a keyboard and a big screen. Tasks like creating spreadsheets or presentations and editing photos or videos are far more easily accomplished on a laptop than on a tablet or mobile phone. But what laptop is right for you depends on a variety of factors: what exactly you plan on using it for, how often you intend to use it, and (most importantly) your budget.</p>

          <h2 class="my-4 hidden">Different types of laptop computers available in NextLevel</h2>
          <p class="mb-4 hidden">Whether you are a student or a professional, a laptop helps you easily do multiple tasks. You can get an AMD Radeon Graphics laptop for an ultimate gaming feel or good storage for storing large files. Stay in sync with the latest technology with a 2-in-1 laptop or experience a super smooth performance with a Windows laptop or a MacBook.</p>

          <h2 class="my-4 hidden">What are the different laptop computers by price?</h2>
          <p class="mb-4 hidden">Laptop prices in India vary a lot and are segregated based on the features that every model offers. If you are low on budget, you can go for laptops below 30,000 that have good basic features to do the job. If your budget doesn’t hold you back, you can opt for laptops between 30,000 and 50,000 or 50,000 and 75,000. And lastly, if you need a laptop with high-end features and the latest advancements, you can go for laptops above 75,000, 1,00,000 or even above 2,00,000. </p>
          
          <h2 class="my-4 hidden">Best Laptop Brands</h2>
          <p class="mb-4 hidden">Samsung | HP | Lenovo | Dell | Asus | LG | Acer | Microsoft | MSI | Fujitsu | Macbook.</p>
          
          <h2 class="my-4">Why buy laptops from NextLevel</h2>
          <p class="mb-4">Whether you’re looking for a cheap laptop or a high-end workhorse, we will help you find the right laptop for your budget. Buy a laptop online on Croma.com or buy one from a Croma store near you to get the best deals on laptops and laptop accessories. Don’t forget to avail yourself of the many personalised offers, such as convenient EMI payment options and ZipCare plans to make the most of your product.</p>
        <div class="col-2"></div>
      </div>
    </div>
    </div>
    <?php
  }
  else
  {
  ?>
  <div class="container mt-5">
      <div class="row">
        <div class="col-10">
          <p class="mb-4 hidden">Tablets bring together the best of smartphones and laptops. A Tablet is everything you've wanted your Laptop to be: it’s sleek, lightweight and stylish. And with a touchscreen your tablet can do (almost) everything your smartphone can.</p>
          <p class="mb-4 hidden">Just as nifty as the Tablet is the E-Reader that has changed the way we read. There’s no need to carry with you a pile of books on your next vacation, just download them on your E-Reader and you’re good to go. Both Tablets and E-Readers are the next steps in the digital evolution from the smartphone and the laptop. But which Tablets and E-Readers are best for you?</p>

          <h2 class="my-4 hidden">Tablets or E-Readers, which is right for you?</h2>
          <p class="mb-4 hidden">If you’re a bookworm, you are likely far too aware of the inconvenience of reading a book on your smartphone or, alternatively, lugging a tome. The primary purpose of an E-Reader is to make it easier for you to read for long periods of time without letting it strain your eyes. Most E-Readers have excellent battery life and perform incredibly well under direct sunlight. An E-Reader uses monochrome E-Ink to display text, and it often resembles the texture of paper.</p>
          <p class="mb-4 hidden">Typically, a Tablet can perform more tasks than your regular E-Reader. It gives you the liberty of creating interactive presentations, browsing the web, taking pictures, and even navigating maps using GPS. Unlike E-Readers, Tablets have sophisticated Operating Systems. Almost all the Tablets in the market run on Apple (iPadOS), Android OS, and Windows OS. Shop for the latest iPad at the best price online now! Yet another important distinction that sets Tablets apart from E-Readers is their screen. While E-Readers use a glare-free E-Ink screen, Tablets use an LCD screen. Explore the best display Android tablets for work and play at Croma on easy EMI. If you love reading for long hours, you may well be better off with an E-Reader than a Tablet.</p>

          <h2 class="my-4 hidden">Shop Tablets and E-Readers online at the best price in India at NextLevel</h2>
          <p class="mb-4 hidden">Visit NextLevel.com to avail some of the best deals on your favourite brands. Keep your purchase free from damage by opting for an Extended Warranty or one of our after-sale plans that can help ensure its safety long after bringing it home. Make your dream gadget a reality with NextLevel.</p>
        <div class="col-2"></div>
      </div>
    </div>
    </div>
  <?php
  }?>

    <?php include("footer.php")?>
    <?php include('ani.html')?>
</body>
</html>

