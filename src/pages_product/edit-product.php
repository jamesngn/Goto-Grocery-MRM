<?php 
    include '../includes/dbAuthentication.inc';
    session_start();

    $product_id = $_SESSION['productID'];
    $conn = OpenConnection();
    
    $sql = "SELECT * FROM product WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $product = mysqli_fetch_assoc($result);
    }  else {
        echo "\r\nSQL error: " . mysqli_error($conn);
    }
    CloseConnection($conn);
?>




<?php
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/menu.inc'?>
    <h2>Edit Product Page</h2>
    <form action="edit-product.php" method="post">
        <fieldset>
            <legend>Edit the product</legend>
            <p>
                <label for="grocery-name">Grocery Name:</label>
                <input type="text" name="grocery-name" id="grocery-name" value = "<?php echo $product['name'];?>">
            </p>
            <p>
                <label for="description">Description:</label>
                <input type="text" name="description" id="description" value = "<?php echo $product['description'];?>">
            </p>
            <p>
                <label for="qty-stock">Quantity Stock:</label>
                <input type="text" name="qty-stock" id="qty-stock" value = "<?php echo $product['qty_stock'];?>">
            </p>
            <p>
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" value = "<?php echo $product['price'];?>">
            </p>
            <p>
                <label for="category-id">Category ID:</label>
                <input type="text" name="category-id" id="category-id" value = "<?php echo $product['category_ID'];?>">
            </p>
            <p>
                <label for="supplier-id">Supplier ID:</label>
                <input type="text" name="supplier-id" id="supplier-id" value = "<?php echo $product['supplier_ID'];?>">
            </p>
            <p>
                <label for="date-stock-in">Last Date Restocked: </label>
                <input type="text" name="date-stock-in" id="date-stock-in" placeholder = "dd-mm-yyyy" value = "<?php echo $product['date_stock_in'];?>">
            </p>
            <button type="submit">Edit</button>
            <button type="reset">Reset</button>
        </fieldset>
    </form>

    <?php

        function cleanInput($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $conn = OpenConnection();

            $c_grocery_name = mysqli_real_escape_string($conn, cleanInput($_POST['grocery-name']));
            $c_description = mysqli_real_escape_string($conn, cleanInput($_POST['description']));
            $c_qty_stock = mysqli_real_escape_string($conn, cleanInput($_POST['qty-stock']));
            $c_price = mysqli_real_escape_string($conn, cleanInput($_POST['price']));
            $c_category_id = mysqli_real_escape_string($conn, cleanInput($_POST['category-id']));
            $c_supplier_id = mysqli_real_escape_string($conn, cleanInput($_POST['supplier-id']));
            $c_date_stock_in = mysqli_real_escape_string($conn, cleanInput($_POST['date-stock-in']));

            $sql = 
            "UPDATE product 
            SET 
                name = '$c_grocery_name',
                description = '$c_description',
                qty_stock = '$c_qty_stock',
                price = '$c_price',
                category_ID = '$c_category_id',
                supplier_ID = '$c_supplier_id',
                date_stock_in = '$c_date_stock_in'
            WHERE id = $product_id";

            if (mysqli_query($conn, $sql)) {
                echo "\r\nRecord updated successfuly";
                session_unset();
                session_destroy();
            } else {
                echo "\r\nError updating record: " . mysqli_error($conn);
            }

            CloseConnection($conn);
        }
    ?>
    
    <?php include '../includes/footer.inc'?>
</body>
</html>