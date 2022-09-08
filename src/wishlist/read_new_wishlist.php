<?php include '../includes/header.inc';
session_start();
$cust_id = $_SESSION["cust_id"];
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Read Wishlist</h2>
    
    <?php
    echo nl2br("\r\n". $_SESSION["cust_id"]);
    $cust_id= $_SESSION["cust_id"];
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();
    $sql = "SELECT * FROM wishlist WHERE cust_id = '$cust_id' ";
            if(mysqli_query($conn, $sql))
            {
                $result=mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)>0)
                {
                    while($row = $result->fetch_assoc())
                    {
                    echo nl2br("\r\n cust_id: " . $row["cust_id"]);
                    echo nl2br("\r\n product_id: ". $row["product_id"]); 
                   
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