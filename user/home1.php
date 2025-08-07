
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    </script>
</head>
<body>
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center my-2 mb-lg-0 mx-5 text-danger text-decoration-none">
          <div class="me-2"><h2>Welcome</h2></div>
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="home1.php" class="nav-link px-3 text-secondary">Home</a></li>
          <li><a href="phone.php?Cd=1" class="nav-link px-3 text-secondary">Smart phone</a></li>
          <li><a href="phone.php?Cd=2" class="nav-link px-3 text-secondary">Laptop</a></li>
          <li><a href="phone.php?Cd=3" class="nav-link px-3 text-secondary">Tab</a></li>
          <li><a href="phone.php?Cd=4" class="nav-link px-3 text-secondary">Earbuds</a></li>
          <li><a href="#" class="nav-link px-3 text-secondary">About</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 d-none d-md-block">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
          <a href="userlog.php" class="btn btn-outline-primary">Login</a>
          <a href="usersign.php" class="btn btn-outline-primary me-2">Sign-up</a>
        </div>
    </div>
</body>
</html>
