<?php 
    include '../includes/dbAuthentication.inc';
    session_start();

    $prod_id = $_SESSION['product_id'];
    $conn = OpenConnection();
    
    $sql = "SELECT * FROM wishlist WHERE product_id = $prod_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $wishlist= mysqli_fetch_assoc($result);
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
    <h2>Edit Wishlist</h2>
    <form action="edit_wishlist.php" method="post">
        <fieldset>
            <legend>Edit the category</legend>
            <p>
                <label for="cust_id">Customer ID:</label>
                <input type="text" name="cust_id" id="cust_id" value = "<?php echo $wishlist['cust_id'];?>">
            </p>           
            <p>
                <label for="product_id">Product ID:</label>
                <input type="text" name="product_id" id="product_id" value = "<?php echo $wishlist['product_id'];?>">
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

            $cust_id = mysqli_real_escape_string($conn, cleanInput($_POST['cust_id']));  
            $prod_id = mysqli_real_escape_string($conn, cleanInput($_POST['product_id']));

            $sql = 
            "UPDATE wishlist 
            SET 
                cust_id = '$cust_id',
                product_id = '$prod_id',
            WHERE product_id = $prod_id";

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