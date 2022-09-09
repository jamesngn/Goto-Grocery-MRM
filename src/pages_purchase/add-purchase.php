<?php session_start(); 
    $c_member_ID = $_SESSION["member-ID"];

    include "../includes/dbAuthentication.inc";
    $conn = OpenConnection();

    $sql = "SELECT cart.memberID as memberID, cart.productID as productID,cart.quantity as quantity, product.name as productName, product.price as price, product.qty_stock as qty_stock 
            FROM cart 
            LEFT JOIN product
            ON cart.productID = product.id
            LEFT JOIN member
            ON cart.memberID = member.customer_id
            WHERE memberID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$c_member_ID);

    if ($stmt -> execute()) 
    {
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) == 0) 
        {
            $cartInfo = 0;
            // echo nl2br("\r\nError: Your shopping cart is empty.");
        } 
        else 
        {
            $cartInfo = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
    else {
        echo nl2br("\r\nSQL error: " . mysqli_error($conn));
    }
?>
<?php include '../includes/header.inc'; ?>

<head>
    <style>
        button a:link {
            text-decoration: none;
            
        }
        button a {
            color:black;
        }
        .container {
            width:70%;
        }
        table {
            width: 100%;
            margin: 0 auto;
        }
        table,th,td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
        .total-amount {
            font-size: 1.2em;
            text-align: right;
            margin-top: 0.5em;
        }
        .total-amount span {
            font-size:1.5em;
        }
        </style>
</head>

<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Purchase items in your shopping cart</h2>

    <?php if ($cartInfo != 0) { ?>
    <div class="container">
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                <?php
                $total = 0;
                foreach($cartInfo as $c) {         
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($c['productName']);  ?></td>
                    <td><?php echo htmlspecialchars($c['price']);  ?></td>
                    <td><?php echo htmlspecialchars($c['quantity']); ?></td>     
                </tr>
                <?php 
                //calculate the total money:
                $total += $c['price'] * $c['quantity'];
                }?>    
            </table>
            <p class="total-amount">Total amount: <span><?php echo "$".$total?></span></p>
    </div>

    <form action="add-purchase.php" method="post">
        <button type="submit" name = "purchaseStatus" value = "accept">Purchase</button>
    </form>
    <?php } else {?>
    <h5>Your shopping cart is empty. You cannot proceed to purchase!</h5>
    <button> <a href="../pages_cart/validate-memberID-add.php">Add to shopping cart</a></button>
    <?php } ?>    
    <?php
        function cleanInput($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if($_POST['purchaseStatus'] == "accept") {
                //add memberID to the purchase table.
                $sql2 = "INSERT INTO purchase(memberID) VALUES (?) ";

                $stmt = $conn -> prepare($sql2);
                $stmt->bind_param("i",$c_member_ID);

                if ($stmt->execute()) {
                    echo nl2br("\r\nMember ID $c_member_ID is successfully added to the purchase DB table.");
                } else {
                    echo nl2br("\r\n SQL error: " . mysqli_error($conn));
                }

                //retrieve purchaseId that is just added.
                $sql3 = "SELECT MAX(purchaseID) FROM purchase WHERE memberID = ?";

                $stmt = $conn -> prepare($sql3);
                $stmt->bind_param("i",$c_member_ID);

                if ($stmt->execute()) {
                    $result = $stmt -> get_result();
                    if (mysqli_num_rows($result) == 0) {
                        echo "Cannot find the maximum purchaseID";
                    } else {
                        $fetch_purchaseID = mysqli_fetch_assoc($result);
                        $purchaseID = $fetch_purchaseID['MAX(purchaseID)'];
                    }
                } else {
                    echo nl2br("\r\n SQL error: " . mysqli_error($conn));
                }

                if ($purchaseID && $cartInfo) {
                    //add to purchase items db;
                    $lineNo = 1;
                    foreach ($cartInfo as $cartItem) {
                        $sql4 = "INSERT INTO purchaseItem(purchaseID, lineNo, productID, quantity) VALUES (?,?,?,?)";

                        $stmt = $conn -> prepare($sql4);
                        $stmt->bind_param("iiii",$purchaseID,$lineNo, $cartItem['productID'], $cartItem['quantity']);

                        if ($stmt->execute()) {
                            $result = $stmt -> get_result();
                            if ($result) {
                                // echo nl2br("\r\nFailed to add to the purchaseItem DB.");
                            } else {
                                // echo nl2br("\r\nSucceeded to add to the purchaseItem DB.");
                                //delete items in the cart:
                                $sql5 = "DELETE FROM cart WHERE memberID = ?";

                                $stmt = $conn -> prepare($sql5);
                                $stmt->bind_param("i",$c_member_ID);

                                if ($stmt->execute()) {
                                    $result = $stmt -> get_result();
                                    if ($result) {
                                        // echo nl2br("\r\nFailed to delete the cart info from cart DB.");
                                    } else {
                                        // echo nl2br("\r\nSucceeded to delete the cart info from cart DB.");
                                    }
                                } else {
                                    echo nl2br("\r\n SQL error: " . mysqli_error($conn));
                                }

                                //substract the qty_stock after the customer purchases the item.
                                $remaining_qty = $cartItem['qty_stock'] - $cartItem ['quantity'];
                                $sql6 = "UPDATE product SET qty_stock = ? WHERE id = ?";

                                $stmt = $conn -> prepare($sql6);
                                $stmt->bind_param("ii",$remaining_qty,$cartItem['productID']);

                                if ($stmt->execute()) {
                                    $result = $stmt -> get_result();
                                    if ($result) {
                                        echo nl2br("\r\nFailed to update the stock quantity of product ID ". $cartItem['productID'] . " from product DB.");
                                    } else {
                                        echo nl2br("\r\nSucceeded to update the stock quantity of product ID ".$cartItem['productID']." from product DB.");
                                    }
                                } else {
                                    echo nl2br("\r\n SQL error: " . mysqli_error($conn));
                                }
                            }
                        } else {
                            echo nl2br("\r\n SQL error: " . mysqli_error($conn));
                        }
                        $lineNo ++;
                    }
                }
            }
        }

    ?>

    <?php include '../includes/footer.inc'; ?>
    <?php include '../includes/bootstrapcore.inc'; ?>
</body>
</html>
