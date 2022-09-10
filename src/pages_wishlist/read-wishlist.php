<?php include '../includes/header.inc';
session_start();
$regValue = $_SESSION["wishlistid"];
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Read Wishlist</h2>
    
    <?php
    echo nl2br("\r\n". $_SESSION["wishlistid"]);
    $c_wishlistID = $_SESSION["wishlistid"];
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();
    $sql = "SELECT * FROM wishlist WHERE wishlistid = '$c_wishlistID' ";
            if(mysqli_query($conn, $sql))
            {
                $result=mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)>0)
                {
                    while($row = $result->fetch_assoc())
                    {
                    echo nl2br("\r\n Wishlist ID: " . $row["wishlistid"]);
                    echo nl2br("\r\n Customer ID: ". $row["cust_id"]);
                    echo nl2br("\r\n Product ID: ". $row["prod_id"]);  
                    
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