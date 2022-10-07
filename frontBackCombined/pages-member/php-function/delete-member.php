<?php
    $c_memberID = $_POST['delete_id'];

    require 'dbAuthentication.php';
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

    if ($stmt->execute) {

    } else {
        echo nl2br("\r\n SQL error: " . mysqli_error($conn));
    }
    $stmt->close();
    CloseConnection($conn);
    //  $conn->close();

    ?>