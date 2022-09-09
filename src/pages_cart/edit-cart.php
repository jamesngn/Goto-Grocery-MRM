<?php 
    session_start();

    $c_member_ID = $_SESSION["member-id"];
    $member_name = $_SESSION["customer-name"];
    
    include '../includes/dbAuthentication.inc';
    $conn = openConnection();

    // retrieve product info FROM product table
    $sql = "SELECT id, name, qty_stock from product";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo nl2br ("\r\nSQL error: " . mysqli_error($conn));
    }
    // retrieve cart info FROM cart based on memberID 
    $sql2 = "SELECT productID, quantity FROM cart WHERE memberID = '$c_member_ID'";
    $result = mysqli_query($conn,$sql2);

    if ($result) {
        $addedCartItems = mysqli_fetch_all($result,MYSQLI_ASSOC);
    } else {
        echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
    }
    
    mysqli_free_result($result);

    function returnQuantityForProductID($productID, $addedCartItems) {
        foreach ($addedCartItems as $addedCartItem) {
            if ($addedCartItem['productID'] == $productID) {
                return $addedCartItem['quantity'];
            }
        }
        return 0;
    }
?>

<?php 
    
    include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Hi <?php echo $member_name;?>, please edit items in your shopping cart !</h2>
    <form action="edit-cart.php" method="post">        
        <p>
            <table>
                
                <?php 
                    $addedNo = 0;
                    foreach($products as $product) { 
                    if (returnQuantityForProductID($product['id'], $addedCartItems) != 0) {
                        $addedNo ++;
                ?>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                </tr>
                <tr>
                    <td><?php echo $product['name'];?></td>
                    <td>
                        <select name="quantity-item-<?php echo $product['id'];?>">
                            <?php 
                            for ($i = 0; $i <= $product['qty_stock']; $i++) { ?>
                                <option <?php if ($i != 0 && $i == returnQuantityForProductID($product['id'],$addedCartItems)) {
                                    echo "selected";
                                } ?>  value="<?php echo $i;?>"> <?php echo $i;?> </option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <?php 
                    }
                } 
                ?>
            </table>
        </p>        
        <?php 
            if ($addedNo == 0) {
                echo "<h6> Your shopping cart is empty. </h6>";
        ?>
            <button><a href="http://gotogromrm.infinityfreeapp.com/pages_cart/validate-memberID-add.php" target="_blank" rel="noopener noreferrer">Go add items</a></button>
        <? } else { ?>
            <button type="submit">Edit Shopping Cart</button>
            <button type="reset">Reset</button>
        <?php
            }
        ?>        
    </form>

    <?php
        function cleanInput($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        function AddToCartDB($memberID, $cartItemsArray, $conn) {
            foreach ($cartItemsArray as $productID => $quantity) {
                $sql3 = "INSERT INTO cart (memberID,productID,quantity) VALUES ('$memberID', '$productID', '$quantity')";
                $result = mysqli_query($conn,$sql3);
                if ($result) {
                    echo nl2br ("\r\n Added to the shopping cart successfully");
                } else {
                    echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            
            foreach ($addedCartItems as $addedCartItem) {
                $c_quantity = mysqli_real_escape_string($conn, cleanInput($_POST['quantity-item-'. $addedCartItem['productID']]));
                
                if ($addedCartItem['quantity'] != $c_quantity) {
                    $editCartItems[$addedCartItem['productID']] = $c_quantity;
                }                
            }
    

            // update the quantity in cart db:
            foreach ($editCartItems as $productID => $new_quantity) 
            {
                if ($new_quantity != 0) {
                    $sql4 = "UPDATE cart SET quantity = '$new_quantity' WHERE productID = '$productID'"; 
                    $result = mysqli_query($conn,$sql4);
                    if ($result) {
                        echo "<h5>The product ID $productID is successully updated with new quantity $new_quantity </h5>";
                    } else {
                        echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
                    }
                }
                else {
                    $sql5 = "DELETE FROM cart WHERE productID = '$productID'";
                    $result = mysqli_query($conn,$sql5);
                    if ($result) {
                        echo "<h5>The product ID $productID is successully deleted</h5>";
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

