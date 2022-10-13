<?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET") { 

        $saleID = $_GET["saleID"];
        if ($saleID) {
            include '../includes/dbAuthentication.inc';
            $conn = OpenConnection();

            $sql = 
            "SELECT sale.memberID, member.customer_firstname, member.customer_lastname, member.customer_email
            FROM sale
            LEFT JOIN member
            ON sale.memberID = member.customer_id
            WHERE sale.saleID = $saleID
            ";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $member = mysqli_fetch_assoc($result);
                }
            }

            $sql = 
            "SELECT saleID, purchaseTime
            FROM sale
            WHERE saleID = '$saleID'
            ";
            $result = mysqli_query($conn,$sql);

            if ($result) {
                $saleInfo = mysqli_fetch_assoc($result);
            }
            
            $sql = 
            "SELECT product.name, product.retailPrice, saleitem.quantity
            FROM saleitem
            LEFT JOIN product
            ON saleitem.productID = product.id
            WHERE saleitem.saleID = '$saleID'
            ";
            $result = mysqli_query($conn,$sql);

            if ($result) {
                $saleItems = mysqli_fetch_all($result,MYSQLI_ASSOC);
            }

        } else {
            header("location: sale-table.php");
        }
    }
?>

<?php 
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;
    <section class="home-section" id="saleReadPage">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">SALE DETAILS</span>
        </div>

        <div class="content">
            <div class="invoice-container">
                <div class="backButton">
                    <a href="sale-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Sales Table</span>
                    </a>
                </div>
                <h2 class="heading">Sales Invoice</h2>
                <hr>
                <div class="sale-top-info">
                    <div class="section">
                        <div class="above-item">Customer: <?php echo ucfirst(strtolower($member['customer_firstname'])).' '.ucfirst(strtolower($member['customer_lastname']));?></div>
                        <div class="below-item">Email: <?php echo $member['customer_email'] ?> </div>
                    </div>
                    <div class="section">
                        <div class="above-item">Sale ID: <?php echo $saleInfo['saleID']; ?></div>
                        <div class="below-item">Date: <?php echo date('d-m-Y',strtotime($saleInfo['purchaseTime'])); ?></div>
                    </div>
                </div>

                <table>
                    <thead>
                        <th>Products</th>
                        <th>Qty</th>
                        <th>Retail Price</th>
                        <th>Subtotal</th>
                    </thead>
                    <tbody>
                        <?php
                            $total = 0;
                            foreach($saleItems as $saleItem):
                                $retailPrice = number_format((float)$saleItem['retailPrice'],2,'.',',');
                                $subtotal = number_format((float)$saleItem['retailPrice'] * (float)$saleItem['quantity'],2,'.',',');
                                $total += (float)$saleItem['retailPrice'] * (float)$saleItem['quantity'];
                                $formattedTotal = number_format($total,2,'.',',');
                                echo 
                                '<tr>
                                    <td>'.$saleItem['name'].'</td>
                                    <td>'.$saleItem['quantity'].'</td>
                                    <td>$ '.$retailPrice.'</td>
                                    <td>$ '.$subtotal.'</td>
                                </tr>';
                            endforeach;
                        ?>
                    </tbody>
                </table>

                <div class="total-section">
                    <span>Total</span>
                    $ <?php echo $formattedTotal;?>
                </div>
            </div>
        </div>

    </section>
    
    <script src="../js/sidebar.js"></script>    
</body>
</html>