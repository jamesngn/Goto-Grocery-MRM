<?php 
session_start();
$purchaseID = $_SESSION['purchaseID'];
include '../includes/dbAuthentication.inc';
$conn = OpenConnection();
//retrieve customer information
$sql = 
    "SELECT member.customer_firstname as firstname, member.customer_lastname as lastname, product.name as productName, product.price as price, purchaseItem.quantity as quantity, purchase.purchaseTime as purchaseTime
    FROM purchase
    JOIN member
    ON purchase.memberID = member.customer_id
    JOIN purchaseItem
    ON purchase.purchaseID = purchaseItem.purchaseID
    JOIN product
    ON purchaseItem.productID = product.id
    WHERE purchaseItem.purchaseID = $purchaseID
    ";

$result = mysqli_query($conn,$sql);

if ($result) {
    $purchaseInfo = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
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
            <?php 
            $total = 0;
            foreach($purchaseInfo as $p) {            
            ?>
            <tr>
                <td><?php echo $p['firstname'] . " " . $p['lastname'];  ?></td>
                <td><?php echo htmlspecialchars($p['productName']);  ?></td>
                <td><?php echo htmlspecialchars($p['price']);  ?></td>
                <td><?php echo htmlspecialchars($p['quantity']); ?></td>
                <td><?php echo htmlspecialchars($p['purchaseTime']); ?></td>        
            </tr>
            <?php 
            //calculate the total money:
            $total += $p['price'] * $p['quantity'];
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

