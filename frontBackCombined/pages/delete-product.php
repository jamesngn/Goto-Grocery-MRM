<?php
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();

    $id = $_POST['delete_id'];

    
    $sql = "SELECT image FROM product WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            echo $product['image'];
            unlink($product['image']);
        }
    }
        
    $sql = "DELETE FROM product WHERE id = $id";
    $result = mysqli_query($conn,$sql);

    CloseConnection($conn);
?>