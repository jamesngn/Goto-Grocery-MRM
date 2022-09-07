<?php include '../includes/header.inc';
session_start();
$regValue = $_SESSION["categoryid"];
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Read category</h2>
    
    <?php
    echo nl2br("\r\n". $_SESSION["categoryid"]);
    $c_categoryID = $_SESSION["categoryid"];
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();
    $sql = "SELECT * FROM category WHERE CategoryID = '$c_categoryID' ";
            if(mysqli_query($conn, $sql))
            {
                $result=mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)>0)
                {
                    while($row = $result->fetch_assoc())
                    {
                    echo nl2br("\r\n CategoryID: " . $row["CategoryID"]);
                    echo nl2br("\r\n Name: ". $row["Name"]); 
                    
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