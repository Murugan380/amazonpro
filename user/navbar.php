<?php
session_start();
if(!isset($_SESSION['name']))
{
  header("location:userlog.php");
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
       document.addEventListener("DOMContentLoaded", function() {
    var currentLocation = window.location.pathname;
    var currentQuery = window.location.search; 

    var navLinks = document.querySelectorAll('.nav-link, #user');
    navLinks.forEach(function(link) {
        // Get the link's href without the domain
        var linkPath = new URL(link.href).pathname;
        var linkQuery = new URL(link.href).search;
 if (linkPath === currentLocation && linkQuery === currentQuery) {
            link.classList.add('active');
        } else if (linkPath === currentLocation && linkQuery === "") {
             link.classList.add('active');
        }
    });
    const togglerIcon = document.querySelector(".navbar-toggler i");
  const navCollapse = document.getElementById("navbarSupportedContent");

  if (togglerIcon && navCollapse) {
    navCollapse.addEventListener("show.bs.collapse", function () {
      togglerIcon.classList.replace("bi-list", "bi-x");
      document.getElementById("buyn").style.display = "none";
    });

    navCollapse.addEventListener("hide.bs.collapse", function () {
      togglerIcon.classList.replace("bi-x", "bi-list");
      document.getElementById("buyn").style.display = "block"; // Hide the buy button when navbar is collapsed
    });
  }
});
        </script>
    <style>
      .nav-link{
        color:black;
      }
        .nav-link:hover{
            color:gray;
             border-bottom:1px solid;
        }
        .user{
          color: black;
          width: 35px;
          height: 35px;
          display: flex;
          align-items: center;
          justify-content: center; 
          border-radius: 100%;
          border: 1px solid;

        }
        .user:hover{
          border-radius: 100%;
          color: rgb(255, 255, 255);
          background-color: black;
        }
        .user.active{
          color: rgb(255, 255, 255);
          background-color: black;
        }
        .btnn
        {
          border: 1px solid rgb(255, 0, 0);
          display: flex;
          justify-content: center;
          align-items: center;
          width: 70px;
          height: 35px;
          margin-top: 0px;
          text-decoration: none;
          border-radius: 5px;
          color: red;
        }
        .btnn:hover{
          background-color: rgb(255, 0, 0);
          color: rgb(255, 255, 255);
        }
        .nav-link.active {
           color:red; 
          border-bottom:4px solid;
        }
          ::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: #000000ff;
  border-radius: 3px;
}

::-webkit-scrollbar-thumb {
  background: #ffffffff;
  border-radius: 5px;
}
::-webkit-scrollbar-thumb:hover {
  background: #585050ff;
}
.navba{
  margin-top:100px;
}
body {
  font-family: 'Poppins', sans-serif;
  font-size: 18px;
  line-height: 1.6;
  color: #333;
  background-color: #f8f9fa;
}

h1, h2, h3 {
  font-family: 'Montserrat', sans-serif;
  font-weight: 600;
}
.hidden {
  opacity: 0;
  transform: translateY(50px);
  transition: all 1.5s ease-out;
}

.show {
  opacity: 1;
  transform: translateY(0);
}
        </style>

</head>
<body>
  <nav class="navbar navbar-expand-lg fixed-top bg-white ">
  <div class="container-fluid">
     <!-- Toggle button -->
      <div class="d-flex">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
          aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-list"></i>
        </button>
        <div class="me-5 ms-2 m-md-0 "><img src="next.JPG"></div>
</div>
          <div class="text-end d-md-none d-flex align-items-center justify-content-end">
            <a href="userpro.php" class="user" id="user"><i class="bi bi-person"></i></a>
          <div class="ms-1"><?php echo $_SESSION['oname'];?></div>
      </div>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse mt-3 mt-md-0" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ps-2">
        <li class="nav-item"><a href="home1.php" class="nav-link mx-3" id="n1">Home</a></li>
        <li class="nav-item"><a href="phone.php?Cd=1" class="nav-link mx-3">Smart phone</a></li>
        <li class="nav-item"><a href="phone.php?Cd=2" class="nav-link mx-3">Laptop</a></li>
        <li class="nav-item"><a href="phone.php?Cd=3" class="nav-link mx-3">Tab</a></li>
        <li class="nav-item"><a href="usercart.php" class="nav-link mx-3">Cart</a></li>
        <li class="nav-item"><a href="yourorder.php" class="nav-link mx-3">Your orders</a></li>
      </ul>

      <!-- Right-side user + logout -->
      <div class="d-md-flex">
        <div class="text-center d-md-flex d-none align-items-center me-3 mb-md-0 mb-3">
          <a href="userpro.php" class="user" id="user"><i class="bi bi-person"></i></a>
          <div class="ms-1"><?php echo $_SESSION['oname'];?></div>
        </div>
        <a href="userlogout.php" class="btn btn-sm btn-outline-danger me-3">Logout</a>
      </div>
    </div>
  </div>
</nav>

</body>
</html>