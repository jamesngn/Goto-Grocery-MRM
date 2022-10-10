<?php
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();

    $id = $_POST['delete_id'];

        
    $sql = "DELETE FROM category WHERE CategoryID = $id";
    $result = mysqli_query($conn,$sql);

    CloseConnection($conn);
?>