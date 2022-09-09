<?php 
    include '../includes/dbAuthentication.inc';
    session_start();

    $wishlist_id = $_SESSION['wishlistid'];
    $conn = OpenConnection();
    
    $sql = "SELECT * FROM wishlist WHERE wishlistid = $wishlist_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $wishlist = mysqli_fetch_assoc($result);
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
    <h2>Edit Wishlist Page</h2>
    <form action="edit-wishlist.php" method="post">
        <fieldset>
            <legend>Edit the wishlist</legend>
            <p>
                <label for="customer-id">Customer ID:</label>
                <input type="text" name="customer-id" id="customer-id" value = "<?php echo $wishlist['cust_id'];?>">
            </p>
            <p>
                <label for="product-id">Product ID:</label>
                <input type="text" name="product-id" id="product-id" value = "<?php echo $wishlist['prod_id'];?>">
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

            $c_cust_id = mysqli_real_escape_string($conn, cleanInput($_POST['customer-id']));
            $c_prod_id = mysqli_real_escape_string($conn, cleanInput($_POST['product-id']));
            

            $sql = 
            "UPDATE wishlist 
            SET 
                cust_id = '$c_cust_id',
                prod_id = '$c_prod_id'
                
            WHERE wishlistid = $wishlist_id";

            if (mysqli_query($conn, $sql)) {
                echo "\r\nRecord updated successfully";
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