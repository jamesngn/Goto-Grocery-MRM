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

    $sql =
        "DELETE FROM member 
            WHERE customer_id = '$c_memberID'";

    if (mysqli_query($conn, $sql)) {
        echo nl2br("\r\n Delete customer $c_memberID from the database.");
        session_unset();
        session_destroy();
    } else {
        echo nl2br("\r\n SQL error: " . mysqli_error($conn));
    }
    CloseConnection($conn);
    //  $conn->close();

    ?>

    <?php include '../includes/footer.inc'; ?>
</body>
<!--Author:THANH NGUYEN DATE:05/09/2022-->
</html>