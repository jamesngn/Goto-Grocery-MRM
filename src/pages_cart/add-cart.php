<?php 
    // RETRIEVE CUSTOMER ID FROM MEMBER TABLE
    include '../includes/dbAuthentication.inc';
    $conn = openConnection();
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

<?php 
    session_start();
    $c_member_ID = $_SESSION["member-id"];
    include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Hi <?php echo $c_member_ID;?>, please add items to your shopping cart !</h2>
    <form action="add-cart.php" method="post">        
        <p>
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
        
        <button type="submit">Add to Shopping Cart</button>
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
        
        function isProductAdded($id, $addedProductIDs) {
            foreach($addedProductIDs as $addedProductID) {
                if ($id == $addedProductID['productID']) {
                    return true;
                }
            }
            return false;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //create an associate array named purchasedItems : "product_id" => "quantity";
            foreach ($products as $product) {
                $c_quantity = mysqli_real_escape_string($conn, cleanInput($_POST['quantity-item-'. $product['id']]));
                if ($c_quantity > 0) {
                    $cartItems[$product['id']] = $c_quantity;
                }
            }
            //check product has added to the database by productID:
            $sql2 = "SELECT productID FROM cart WHERE memberID = '$c_member_ID'";
            $result = mysqli_query($conn, $sql2);
            $addedProductIDs = mysqli_fetch_all($result, MYSQLI_ASSOC);


            foreach($cartItems as $id => $c_quantity) {
                //check added product ID
                if (isProductAdded($id, $addedProductIDs)) {
                    echo "<h5>The product ID $id cannot be added to shopping cart as it already exists.</h5>";
                } else {
                    //add the new productID to the cart:
                    $sql3 = "INSERT INTO cart VALUES ('$c_member_ID', '$id','$c_quantity')";
                    $result = mysqli_query($conn,$sql3);
                    if ($result) {
                        echo "<h5>The product ID $id is successully added to shopping cart </h5>";
                    } else {
                        echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
                    }
                }
            }
            
            // session_unset();
            // session_destroy();
        }

        
        mysqli_free_result($result);
        CloseConnection($conn);
    ?>

    </body>
</html>

