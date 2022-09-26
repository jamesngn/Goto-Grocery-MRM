<?php include '../includes/header.inc';
session_start();
$suppdel_id = $_SESSION["supplydeliveryid"];
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Read Supply Delivery</h2>
    
    <?php
    echo nl2br("\r\n". $_SESSION["supplydeliveryid"]);
    $suppdel_id = $_SESSION["supplydeliveryid"];
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();
    $sql = "SELECT * FROM suppdelivery WHERE supplydeliveryid = '$suppdel_id' ";
            if(mysqli_query($conn, $sql))
            {
                $result=mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)>0)
                {
                    while($row = $result->fetch_assoc())
                    {
                    echo nl2br("\r\n Supply Delivery ID: " . $row["supplydeliveryid"]);
                    echo nl2br("\r\n Supplier ID: ". $row["supp_id"]);
                    echo nl2br("\r\n Product ID: ". $row["prod_id"]);  
                    echo nl2br("\r\n Quantity: ". $row["quantity"]);
                    echo nl2br("\r\n Delivery Date: ". $row["delivery_date"]);
                    echo nl2br("\r\n Supplier Price: ". $row["supplier_price"]);
                    
                    }
                    session_unset();
                    session_destroy();
                }
                else{
              
                    echo nl2br("\r\n Error:DB is incorrect.");
            
                }              
            }
            else
            {
                echo nl2br("\r\n SQL error: " . mysqli_error($conn));
            }
    CloseConnection($conn);
    ?>

    <?php include '../includes/footer.inc'; ?>
</body>

</html>