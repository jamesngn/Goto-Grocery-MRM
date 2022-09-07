<?php include '../includes/header.inc';
session_start();
$supp_id1 = $_SESSION["supplier_id"];
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Read supplier</h2>
    
    <?php
    echo nl2br("\r\n". $_SESSION["supplier_id"]);
    $supp_id = $_SESSION["supplier_id"];
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();
    $sql = "SELECT * FROM supplier WHERE supplier_id = '$supp_id' ";
            if(mysqli_query($conn, $sql))
            {
                $result=mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)>0)
                {
                    while($row = $result->fetch_assoc())
                    {
                    echo nl2br("\r\n supplier_id: " . $row["supplier_id"]);
                    echo nl2br("\r\n supplier_name: ". $row["supplier_name"]); 
                   
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