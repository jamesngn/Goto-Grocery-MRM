<?php 
session_start();
$purchase = $_SESSION['purchase'];
$memberID = $purchase[0]['memberID'];
include '../includes/dbAuthentication.inc';
$conn = OpenConnection();
//retrieve customer information
$sql1 = 
    "SELECT customer_firstname, customer_lastname 
    FROM member
    WHERE customer_id = $memberID
    ";
$result = mysqli_query($conn,$sql1);

if ($result) {
    $customer = mysqli_fetch_assoc($result);
} else {
    echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
}



?>


<?php
include '../includes/header.inc'; 
?>
<head>
    <style>
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
    <h2>Read Purchase</h2>
    <div class="container">
        <table>
            <tr>
                <th>Customer Name</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Purchase Time</th>
            </tr>
            <?php foreach($purchase as $p) { 
                //retrieve product information
                $productID = $p['productID'];
                $sql2 = 
                "SELECT name, price 
                FROM product
                WHERE id = $productID
                ";
                $result = mysqli_query($conn,$sql2);

                if ($result) {
                $product = mysqli_fetch_assoc($result);
                } else {
                echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
                }
            
            ?>
            <tr>
                <td><?php echo $customer['customer_firstname'] . " " . $customer['customer_lastname'];  ?></td>
                <td><?php echo htmlspecialchars($product['name']);  ?></td>
                <td><?php echo htmlspecialchars($product['price']);  ?></td>
                <td><?php echo htmlspecialchars($p['quantity']); ?></td>
                <td><?php echo htmlspecialchars($p['purchaseTime']); ?></td>        
            </tr>
            <?php 
            //calculate the total money:
            $total += $product['price'] * $p['quantity'];
            }?>    
        </table>
        <p class="total-amount">Total amount: <span><?php echo "$".$total?></span></p>
    </div>

</body>

<?php 
session_unset();
session_destroy();
include '../includes/footer.inc'; ?>
    </body>
</html>

