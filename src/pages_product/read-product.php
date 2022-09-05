
<?php 
session_start();
$product = $_SESSION['productAssoc'];

include '../includes/header.inc'; 
?>
<head>
    <style>
        table {
            width: 70%;
            margin: 0 auto;
        }
        table,th,td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        </style>
</head>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Read Grocery Product</h2>
    

    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Quantity Stock</th>
        </tr>
        <tr>
            <td><?php echo htmlspecialchars($product['name']);  ?></td>
            <td><?php echo htmlspecialchars($product['description']);  ?></td>
            <td><?php echo htmlspecialchars($product['qty_stock']); ?></td>
        </tr>
    </table>
</body>

<?php 
session_unset();
session_destroy();
include '../includes/footer.inc'; ?>
    </body>
</html>

