```php
<?php
include("../Includes/db.php");
session_start();
$sessphonenumber = $_SESSION['phonenumber'];


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


    <title>Farmer - Insert Product</title>
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

        .my-form,
        .login-form {
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
<?php
// Check if product ID is provided and if the user is logged in
if (isset($_GET['id']) && isset($_SESSION['phonenumber'])) {
    $id = $_GET['id'];
    
    // Perform deletion
    $delete_query = "DELETE FROM products WHERE product_id = $id";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        // Deletion successful
        echo "<script>alert('Product deleted successfully');</script>";
        echo "<script>window.open('MyProducts.php','_self')</script>";
        exit(); // Stop further execution
    } else {
        // Deletion failed
        echo "<script>alert('Failed to delete product');</script>";
        echo "<script>window.open('MyProducts.php','_self')</script>";
        exit(); // Stop further execution
    }
}
?>
    <div class="container">
        <main class="my-form">
            <div class="cotainer">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center font-weight-bold">Delete Product</h4>
                            </div>
                            <div class="card-body">
                                <p>Are you sure you want to delete the product "<?php echo $product_title; ?>"?</p>
                                <form action="" method="post">
                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                            <a href="MyProducts.php" class="btn btn-secondary">Cancel</a>
                                        </div>
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
```