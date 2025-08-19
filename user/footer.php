<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function subscribe()
      {
        var emai=document.getElementById("email").value;
        if(emai=="")
        {
          alert("Please enter your email");
          return false;
        }
        else
        {
          const sub = document.getElementById('subscribe');
  sub.style.color = "green";
  sub.style.fontSize = "20px";     // ✅ correct
  sub.style.fontWeight = "bold";   // ✅ correct
  sub.textContent = "Subscription successful !";
        }
      }
      
        </script>
</head>
<body>
    <div class="  mt-5">
      <div class="bg-dark p-1">
        <div class="text-center pt-5" style="color:white" id="subscribe">
          <h3>Subscribe to our NextLevel</h3>
          <p>Get the latest updates and offers</p>
          <form class="d-flex justify-content-center">
            <input type="email" class="form-control w-50" id="email" placeholder="Enter your email" required>
            <button class="btn btn-primary ms-2" type="button" onclick="subscribe()">Subscribe</button>
          </form>
        </div>
        <div id="sub" class="text-white"></div>
        <div class="text-center text-white mt-5">
          <p>Follow us on:</p>
          <a href="" class="text-white me-3"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
          <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
        </div>
        <div class="text-center text-white mt-5">
          <p>&copy; 2023 NextLevel. All rights reserved.</p>
      </div>
    </div>
</body>
</html>