
<?php 
    // RETRIEVE CUSTOMER ID FROM MEMBER TABLE
    include '../includes/dbAuthentication.inc';
    $conn = openConnection();

    $sql = "SELECT customer_id FROM member";
    $result = mysqli_query($conn,$sql);
    if ($result) { 
        $customerIDs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo nl2br("\r\nSQL ERROR: " . mysqli_error($conn));
    }
    mysqli_free_result($result);


    $sql = "SELECT id, name, qty_stock from product";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo nl2br ("\r\nSQL error: " . mysqli_error($conn));
    }
    mysqli_free_result($result);

    
    // print_r($customerIDs);
?>


<?php include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Add new Purchase</h2>
    <form action="add-purchase.php" method="post">        
        <p>
            <label for="member-ID">Member ID:</label>
            <select name="member-ID" id="member-ID">
                <?php foreach($customerIDs as $customerID) { ?>
                    <option value="<?php echo htmlspecialchars($customerID['customer_id']);?>"><?php echo htmlspecialchars($customerID['customer_id']);?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <h4>Choose purchase product and Quantity</h4>
            <table>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                </tr>
                <?php foreach($products as $product) { ?>
                <tr>
                    <td><?php echo $product['name'];?></td>
                    <td>
                        <select name="quantity-item-<?php echo $product['id'];?>" id="">
                            <?php 
                            for ($i = 0; $i <= $product['qty_stock']; $i++) { ?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </p>
        
        <button type="submit">Purchase</button>
        <button type="reset">Reset</button>
    </form>

    <?php
        function cleanInput($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $c_member_ID = mysqli_real_escape_string($conn, cleanInput($_POST['member-ID']));
            //create an associate array named purchasedItems : "product_id" => "quantity";
            foreach ($products as $product) {
                $c_quantity = mysqli_real_escape_string($conn, cleanInput($_POST['quantity-item-'. $product['id']]));
                if ($c_quantity > 0) {
                    $purchaseItems[$product['id']] = $c_quantity;
                }
            }
        }
            
        $sql2 = "INSERT INTO purchase (memberID) VALUES ('$c_member_ID')";

        if (mysqli_query($conn,$sql2)) {
            echo nl2br ("\r\n Added this purchase with member ID $c_member_ID to the database");
        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }

        // select the added purchaseID to add to the purchase Item table.
        $sql3 = "SELECT MAX(purchaseID) FROM purchase";
        $result = mysqli_query($conn,$sql3);
        if ($result) {
            $purchaseID = mysqli_fetch_row($result);
        } else {
            echo nl2br("\r\n SQL error: " . mysqli_error($conn));
        }
        $i = 1;
        //add puchase items with quantity to the purchaseItem table
        foreach ($purchaseItems as $product_id => $quantity) {
            $sql4 = "INSERT INTO purchaseItem (purchaseID,lineNo,productID,quantity) VALUES ('$purchaseID[0]','$i','$product_id','$quantity')";
            $result = mysqli_query($conn,$sql4);
            if ($result) {
                echo nl2br("\r\n Added the purchase Item with ID $product_id and quantity $quantity");
            } else {
                echo nl2br("\r\n SQL error: " . mysqli_error($conn));
            }
            //update q_ty stock based on productID in the table product
            $sql5 = 
            "UPDATE product
            SET
                qty_stock = qty_stock - $quantity
            WHERE id = $product_id";

            $result = mysqli_query($conn, $sql5);
            if ($result) {
                echo nl2br("\r\n Update the stock quantity for item with ID $product_id");
            } else {
                echo nl2br("\r\n SQL error: " . mysqli_error($conn));
            }

            $i = $i + 1;
        }
        
        
        mysqli_free_result($result);
        CloseConnection($conn);
    ?>

    </body>
</html>

