<?php
// Start the session at the very beginning of the script.
session_start();

// Get the product details from the URL.
$id = (isset($_GET['Id'])) ? $_GET['Id'] : '';
$rd = (isset($_GET['Ram'])) ? $_GET['Ram'] : '';
$cd = (isset($_GET['Col'])) ? $_GET['Col'] : '';

// Initialize the cart as an empty array if it doesn't exist.
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// --- DELETE LOGIC ---
// This section handles deleting an item from the cart based on its index.
if (isset($_GET['delete'])) {
    $del = (int)$_GET['delete'];
    
    // Check if the index exists in the cart array before trying to unset.
    if (isset($_SESSION['cart'][$del])) {
        // Unset the entire product array at the specified index.
        unset($_SESSION['cart'][$del]);
        
        // Re-index the array to ensure there are no gaps in the keys.
        $_SESSION['cart'] = array_values($_SESSION['cart']); 
    }
    
    // Redirect to the same page to prevent form resubmission and update the view.
    header("location:chat.php");
    exit;
}

// --- ADD TO CART LOGIC ---
// This section adds a new item to the cart if it's not already present.
$already = false;
if ($id && $rd && $cd) {
    // Check if the combination of Id, Ram, and Col already exists in the cart.
    foreach ($_SESSION['cart'] as $item) { 
        if (
            $item['Id'] == $id &&
            $item['Ram'] == $rd &&
            $item['Col'] == $cd
        ) {
            $already = true;
            break;
        }
    }
}

// If the item isn't in the cart, add it as a new associative array.
if (!$already && $id && $rd && $cd) {
    $_SESSION['cart'][] = [
        'Id' => $id,
        'Ram' => $rd,
        'Col' => $cd
    ];
}

// --- DATABASE FETCHING LOGIC ---
// Initialize a single connection. This is more efficient than connecting in a loop.
$con = new mysqli("localhost", "root", "", "murugansample");
if ($con->connect_error) {
    // Handle connection error gracefully
    die("Connection failed: " . $con->connect_error);
}

// Initialize arrays to store product details.
$products = [];

// Fetch product details for all items in the cart in a single loop.
foreach ($_SESSION['cart'] as $item) {
    $proid = $item['Id'];
    $ramid = $item['Ram'];
    $colid = $item['Col'];

    $qur_product = "SELECT * FROM products WHERE Id='" . $proid . "'";
    $res_product = mysqli_query($con, $qur_product);
    $product_data = ($res_product) ? $res_product->fetch_assoc() : null;

    $qur_ram = "SELECT * FROM productram WHERE ramId='" . $ramid . "'";
    $res_ram = mysqli_query($con, $qur_ram);
    $ram_data = ($res_ram) ? $res_ram->fetch_assoc() : null;

    $qur_color = "SELECT * FROM productcolor WHERE colorId='" . $colid . "'";
    $res_color = mysqli_query($con, $qur_color);
    $color_data = ($res_color) ? $res_color->fetch_assoc() : null;

    // Check if all data was found before adding to the products array.
    if ($product_data && $ram_data && $color_data) {
        $products[] = [
            'name' => $product_data['productname'],
            'brand' => $product_data['Brand'],
            'description' => $product_data['discribtion'],
            'ram' => $ram_data['ram'],
            'storage' => $ram_data['storage'],
            'price' => $ram_data['price'],
            'img' => $color_data['imgurl']
        ];
    }
}

// Close the single database connection.
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        // This function redirects to the same page with a 'delete' parameter.
        function del(di) {
            window.location.assign("chat.php?delete=" + di);
        }
    </script>
    <style>
        .cart-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">My Shopping Cart</h1>
        <hr>
        <div class="cart-container">
            <?php
            // --- PRODUCT CARD GENERATION ---
            // Check if the products array is populated and display the products.
            if (!empty($products)) {
                foreach ($products as $i => $product) {
                    ?>
                    <div class="card shadow-sm" style="width: 18rem;">
                        <img src="../admin1/files/<?php echo htmlspecialchars($product['img']); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
                            <p class="card-text"><strong>Brand:</strong> <?php echo htmlspecialchars($product['brand']); ?></p>
                            <p class="card-text"><strong>RAM:</strong> <?php echo htmlspecialchars($product['ram']); ?></p>
                            <p class="card-text"><strong>Storage:</strong> <?php echo htmlspecialchars($product['storage']); ?></p>
                            <p class="card-text"><strong>Price:</strong> &#8377;<?php echo htmlspecialchars($product['price']); ?></p>
                            <!-- The corrected delete button passing the loop index $i -->
                            <button onclick="del(<?php echo $i; ?>)" class="btn btn-danger w-100 mt-2">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <!-- Show a message if the cart is empty -->
                <div class="alert alert-info text-center" role="alert">
                    Your cart is empty!
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>
