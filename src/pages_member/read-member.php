<?php include '../includes/header.inc';
session_start();
$regValue = $_SESSION["memberID"];
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Read member</h2>
    <?php
    echo nl2br("\r\n". $_SESSION["memberID"]);
    $c_memberID = $_SESSION["memberID"];
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();
    $sql = "SELECT * FROM member WHERE customer_id = '$c_memberID' ";
            if(mysqli_query($conn, $sql))
            {
                $result=mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)>0)
                {
                    while($row = $result->fetch_assoc())
                    {
                    echo nl2br("\r\n Customer_id: " . $row["customer_id"]);
                    echo nl2br("\r\n First Name: ". $row["customer_firstname"]); 
                    echo nl2br("\r\n Last Name " . $row["customer_lastname"]);
                    echo nl2br("\r\n Email:" . $row["customer_email"]);
                    }
                    session_unset();
                    session_destroy();
                }
                else{
              
                    echo nl2br("\r\n Error:DB is correct.");
            
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