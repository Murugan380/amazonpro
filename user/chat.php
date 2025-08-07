<?php
$id = $_GET['Id'];
$con = new mysqli("localhost", "root", "", "murugansample");

$qur = "SELECT * FROM products WHERE Id = $id";
$res = mysqli_query($con, $qur);
$row = $res->fetch_assoc();

$name = $row['productname'];
$stack = $row['stack'];
$dis = $row['discribtion'];

// Default image
$img = 'default.jpg';

// Get selected color
$selectedCol = isset($_GET['Col']) ? $_GET['Col'] : null;
if ($selectedCol) {
    $qurchange = "SELECT * FROM productcolor WHERE colorId = $selectedCol";
    $changeres = mysqli_query($con, $qurchange);
    if ($changeres && $changeres->num_rows > 0) {
        $charow = $changeres->fetch_assoc();
        $img = $charow['imgurl'];
    }
}

// Get RAMs
$qram = "SELECT * FROM productram WHERE productId = $id";
$ramres = mysqli_query($con, $qram);
$rams = [];
while ($rram = $ramres->fetch_assoc()) {
    $rams[] = $rram;
}

// Get colors
$qcolor = "SELECT * FROM productcolor WHERE productId = $id";
$colres = mysqli_query($con, $qcolor);
$colors = [];
while ($rcol = $colres->fetch_assoc()) {
    $colors[] = $rcol;
}

// Get selected RAM
$selectedRam = isset($_GET['Ram']) ? $_GET['Ram'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Product Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<script>
  var pid = <?php echo json_encode($id); ?>;
  var colr = <?php echo json_encode($selectedCol); ?>;
  var rami = <?php echo json_encode($selectedRam); ?>;

  function color(col) {
    colr = col;
    window.location.assign("chat.php?Id=" + pid + "&Col=" + colr + (rami ? "&Ram=" + rami : ""));
  }

  function ram(ramId) {
    rami = ramId;
    window.location.assign("chat.php?Id=" + pid + (colr ? "&Col=" + colr : "") + "&Ram=" + rami);
  }

  function buy() {
    if (!colr) {
      alert("Please select a color before buying.");
      return;
    }
    if (!rami) {
      alert("Please select a RAM before buying.");
      return;
    }
    window.location.assign("order.php?Id=" + pid + "&Col=" + colr + "&Ram=" + rami);
  }

  function addToCart() {
    if (!colr || !rami) {
      alert("Please select both Color and RAM to add to cart.");
      return;
    }
    alert("Added to cart!"); // Replace with your own logic (AJAX or redirect)
  }
</script>

<!-- Navbar -->
<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start p-3 bg-light">
  <a href="/" class="d-flex align-items-center my-2 mb-lg-0 mx-5 text-danger text-decoration-none">
    <div class="me-2"><h2>Welcome</h2></div>
  </a>

  <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
    <li><a href="home1.php" class="nav-link px-3 text-secondary">Home</a></li>
    <li><a href="phone.php" class="nav-link px-3 text-secondary">Smart phone</a></li>
    <li><a href="#" class="nav-link px-3 text-secondary">Laptop</a></li>
    <li><a href="#" class="nav-link px-3 text-secondary">Tab</a></li>
    <li><a href="#" class="nav-link px-3 text-secondary">About</a></li>
  </ul>

  <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 d-none d-md-block">
    <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
  </form>
</div>

<!-- Product Display -->
<div class="container mt-4">
  <div class="row">
    <!-- Image + Description -->
    <div class="col-md-6">
      <img src="../admin1/files/<?php echo $img ?>" class="img-fluid mb-3" width="400px">
      <p class="fs-5"><?php echo $dis; ?></p>
    </div>

    <!-- Details + Options -->
    <div class="col-md-6">
      <ul type="none" class="p-0">
        <li class="fs-4 mb-3"><strong>Name:</strong> <?php echo $name; ?></li>
        
        <!-- Dynamic Specs -->
        <?php
        $detail = "SELECT * FROM productdetail WHERE productId = $id";
        $dres = mysqli_query($con, $detail);
        while ($row = $dres->fetch_assoc()) {
            echo '<li class="fs-5 mb-2"><strong>' . $row['detail_Key'] . ':</strong> ' . $row['detail_Value'] . '</li>';
        }
        ?>

        <!-- RAM Buttons -->
        <li class="mt-3">
          <div class="mb-2"><strong>RAM Options:</strong></div>
          <?php foreach ($rams as $r): ?>
            <button class="btn btn-outline-dark me-2 mb-2 <?php echo ($selectedRam == $r['ramId']) ? 'active' : ''; ?>" onclick="ram(<?php echo $r['ramId']; ?>)">
              <?php echo $r['ram'] . ' + ' . $r['storage']; ?>
            </button>
          <?php endforeach; ?>
        </li>

        <!-- Color Buttons -->
        <li class="mt-3">
          <div class="mb-2"><strong>Color Options:</strong></div>
          <?php foreach ($colors as $c): ?>
            <button class="btn btn-outline-dark me-2 mb-2 <?php echo ($selectedCol == $c['colorId']) ? 'active' : ''; ?>" onclick="color(<?php echo $c['colorId']; ?>)">
              <?php echo $c['color']; ?>
            </button>
          <?php endforeach; ?>
        </li>

        <!-- Action Buttons -->
        <li class="mt-4">
          <button class="btn btn-primary me-2" onclick="addToCart()">Add to Cart</button>
          <button class="btn btn-success" onclick="buy()">Buy</button>
        </li>
      </ul>
    </div>
  </div>
</div>

</body>
</html>
