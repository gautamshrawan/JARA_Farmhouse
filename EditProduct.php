<?php
include("../Includes/db.php");
session_start();
$sessphonenumber = $_SESSION['phonenumber'];

if (!isset($sessphonenumber)) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $getting_prod = "SELECT * FROM products WHERE product_id = $id";
    $run = mysqli_query($con, $getting_prod);

    if ($run) {
        $details = mysqli_fetch_array($run);
        $product_title = $details['product_title'];
        $product_cat = $details['product_cat'];
        $product_type = $details['product_type'];
        $product_stock = $details['product_stock'];
        $product_price = $details['product_price'];
        $product_expiry = $details['product_expiry'];
        $product_desc = $details['product_desc'];
        $product_keywords = $details['product_keywords'];
        $product_delivery = $details['product_delivery'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_pro'])) {
    $product_title = $_POST['product_title'];
    $product_stock = $_POST['product_stock'];
    $product_cat = $_POST['product_cat'];
    $product_type = $_POST['product_type'];
    $product_expiry = $_POST['product_expiry'];
    $product_price = $_POST['product_price'];
    $product_desc = $_POST['product_desc'];
    $product_keywords = $_POST['product_keywords'];
    $product_delivery = $_POST['product_delivery'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];

    if (!empty($product_image)) {
        move_uploaded_file($product_image_tmp, "product_images/$product_image");
        $update_product = "UPDATE products SET product_title='$product_title', product_cat='$product_cat', product_type='$product_type', product_stock='$product_stock', product_price='$product_price', product_expiry='$product_expiry', product_desc='$product_desc', product_keywords='$product_keywords', product_delivery='$product_delivery', product_image='$product_image' WHERE product_id='$id'";
    } else {
        $update_product = "UPDATE products SET product_title='$product_title', product_cat='$product_cat', product_type='$product_type', product_stock='$product_stock', product_price='$product_price', product_expiry='$product_expiry', product_desc='$product_desc', product_keywords='$product_keywords', product_delivery='$product_delivery' WHERE product_id='$id'";
    }

    $run_update = mysqli_query($con, $update_product);

    if ($run_update) {
        echo "<script>alert('Product updated successfully');</script>";
        echo "<script>window.open('MyProducts.php', '_self');</script>";
    } else {
        echo "<script>alert('Error updating product');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/c587fc1763.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../portal_files/bootstrap.min.css">
    <title>Farmer - Update Product</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);
        body {
            margin: 0;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f5f8fa;
        }
        .my-form, .login-form {
            font-family: Raleway, sans-serif;
        }
        .my-form {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .my-form .row {
            margin-left: 0;
            margin-right: 0;
        }
        .login-form {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .login-form .row {
            margin-left: 0;
            margin-right: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <main class="my-form">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center font-weight-bold">Update Product <i class="fas fa-leaf"></i></h4>
                            </div>
                            <div class="card-body">
                                <form name="my-form" action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="product_title" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Title:</label>
                                        <div class="col-md-6">
                                            <input type="text" id="product_title" class="form-control" name="product_title" value="<?php echo $product_title; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_stock" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Stock:(In kg)</label>
                                        <div class="col-md-6">
                                            <input type="text" id="product_stock" class="form-control" name="product_stock" value="<?php echo $product_stock; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_cat" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Categories:</label>
                                        <div class="col-md-6">
                                            <select name="product_cat" required>
                                                <option>Select a Category</option>
                                                <?php
                                                $get_cats = "SELECT * FROM categories";
                                                $run_cats = mysqli_query($con, $get_cats);
                                                while ($row_cats = mysqli_fetch_array($run_cats)) {
                                                    $cat_id = $row_cats['cat_id'];
                                                    $cat_title = $row_cats['cat_title'];
                                                    echo "<option value='$cat_id' ".($cat_id == $product_cat ? 'selected' : '').">$cat_title</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_type" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Type:</label>
                                        <div class="col-md-6">
                                            <input type="text" id="product_type" class="form-control" name="product_type" value="<?php echo $product_type; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_expiry" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Expiry:</label>
                                        <div class="col-md-6">
                                            <input id="product_expiry" class="form-control" type="date" name="product_expiry" value="<?php echo $product_expiry; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_image" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Image:</label>
                                        <div class="col-md-6">
                                            <input id="product_image" type="file" name="product_image">
                                            <?php if (!empty($product_image)): ?>
                                                <img src="product_images/<?php echo $product_image; ?>" alt="Product Image" width="100">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_price" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product MRP: (Per kg)</label>
                                        <div class="col-md-6">
                                            <input type="text" id="product_price" class="form-control" name="product_price" value="<?php echo $product_price; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_desc" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Description:</label>
                                        <div class="col-md-6">
                                            <textarea name="product_desc" id="product_desc" class="form-control" rows="3" required><?php echo $product_desc; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_keywords" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Keywords:</label>
                                        <div class="col-md-6">
                                            <input type="text" id="product_keywords" class="form-control" name="product_keywords" value="<?php echo $product_keywords; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_delivery" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Delivery:</label>
                                        <div class="col-md-6">
                                            <input type="radio" id="product_delivery" name="product_delivery" value="yes" <?php echo ($product_delivery == 'yes') ? 'checked' : ''; ?>> Yes
                                            <input type="radio" id="product_delivery" name="product_delivery" value="no" <?php echo ($product_delivery == 'no') ? 'checked' : ''; ?>> No
                                        </div>
                                    </div>

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" name="update_pro">
                                            UPDATE
                                        </button>
                                    </div>
                                </form>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
