<?php
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();

    $id = $_POST['delete_id'];

        
    $sql = "DELETE FROM product WHERE id = '$id'";
    $result = mysqli_query($conn,$sql);

?>