<?php 
    include '../includes/dbAuthentication.inc';
    session_start();

    $suppdel_id = $_SESSION['supplydeliveryid'];
    $conn = OpenConnection();
    
    $sql = "SELECT * FROM suppdelivery WHERE supplydeliveryid = $suppdel_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $suppdel_id = mysqli_fetch_assoc($result);
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
    <h2>Edit Supply Delivery Page</h2>
    <form action="edit-supply-delivery.php" method="post">
        <fieldset>
            <legend>Edit Supply Delivery Page</legend>
            <p>
                <label for="prod_id">Product ID:</label>
                <input type="text" name="prod_id" id="prod_id" value = "<?php echo $suppdel_id['prod_id'];?>">
            </p>
            <p>
                <label for="supp_id">Supplier ID:</label>
                <input type="text" name="supp_id" id="supp_id" value = "<?php echo $suppdel_id['supp_id'];?>">
            </p>
            <p>
                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity" id="quantity" value = "<?php echo $suppdel_id['quantity'];?>">
            </p>
           
            <p>
                <label for="delivery_date">Delivery Date :</label>
                <input type="text" name="delivery_date" id="delivery_date" value = "<?php echo $suppdel_id['delivery_date'];?>">
            </p>
            <p>
                <label for="supplier_price">Supplier Price :</label>
                <input type="text" name="supplier_price" id="supplier_price" value = "<?php echo $suppdel_id['supplier_price'];?>">
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

            $prod_id = mysqli_real_escape_string($conn, cleanInput($_POST['prod_id']));
            $supp_id = mysqli_real_escape_string($conn, cleanInput($_POST['supp_id']));
            $quantity = mysqli_real_escape_string($conn, cleanInput($_POST['quantity']));
            $delivery_date = mysqli_real_escape_string($conn, cleanInput($_POST['delivery_date']));
            $supplier_price = mysqli_real_escape_string($conn, cleanInput($_POST['supplier_price']));
            

            $sql = 
            "UPDATE suppdelivery 
            SET 
                supp_id = '$supp_id',
                prod_id = '$prod_id',
                quantity = '$quantity',
                delivery_date = '$delivery_date',
                supplier_price = '$supplier_price',
                
                
            WHERE supplydeliveryid = $suppdel_id";

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