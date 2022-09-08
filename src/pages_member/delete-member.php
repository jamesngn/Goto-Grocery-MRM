<?php include '../includes/header.inc';
session_start();
$regValue = $_SESSION["memberID"];

?>

<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Delete Current Member</h2>


    <?php
    $c_memberID = $_SESSION["memberID"];
    session_unset();
    session_destroy();

    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();

    $del =
        "DELETE FROM member 
            WHERE customer_id = ?";
    $stmt = $conn->prepare($del);
    $stmt->bind_param("i", $c_memberID);
    $stmt->execute();

    $sql = "SELECT * FROM member WHERE customer_id = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $c_memberID);

    if ($stmt->execute()!= null) {
        echo nl2br("\r\n Delete customer $c_memberID from the database.");
        if(!session_destroy())
        {
          echo "session not destroyed";
        }
        else {
          echo "session destroyed";
        }        
    } else {
        echo nl2br("\r\n SQL error: " . mysqli_error($conn));
    }
    $stmt->close();
    CloseConnection($conn);
    //  $conn->close();

    ?>

    <?php include '../includes/footer.inc'; ?>
    <?php include '../includes/bootstrapcore.inc'; ?>
</body>
<!--Author:THANH NGUYEN DATE:05/09/2022-->
</html>