<?php
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();

    $id = $_POST['delete_id'];

        
    $sql = "DELETE FROM supplier WHERE supplier_id = $id";
    $result = mysqli_query($conn,$sql);

    CloseConnection($conn);
?>