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
    $sql = "SELECT * FROM member WHERE customer_id = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $c_memberID);
    
            if($stmt->execute())
            {
                $result=$stmt->get_result();
                if (mysqli_num_rows($result)>0)
                {
                    while($row = $result->fetch_assoc())
                    {
                    echo nl2br("\r\n Customer_id: " . $row["customer_id"]);
                    echo nl2br("\r\n First Name: ". $row["customer_firstname"]); 
                    echo nl2br("\r\n Last Name " . $row["customer_lastname"]);
                    echo nl2br("\r\n Email:" . $row["customer_email"]);
                    echo nl2br("\r\n Password:" . $row["CREATED_AT"]);
                    }
                    if(!session_destroy())
                    {
                      echo "session not destroyed";
                    }
                    else {
                      echo "session destroyed";
                    }
                }
                else{
              
                    echo nl2br("\r\n Error:DB is incorrect.");
            
                }
                
            }
            else
            {
                echo nl2br("\r\n SQL error: " . mysqli_error($conn));
            }
    $stmt->close();
    CloseConnection($conn);
    ?>


    <?php include '../includes/footer.inc'; ?>
    <?php include '../includes/bootstrapcore.inc'; ?>
</body>
<!--Author:THANH NGUYEN DATE:05/09/2022-->
</html>