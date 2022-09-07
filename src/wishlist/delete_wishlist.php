<?php 
    session_start();
    $prod_id = $_SESSION['product_id'];
    include '../includes/header.inc' 
?>
<body>
    <?php include '../includes/menu.inc' ?>;
    <h2>Delete Wishlist</h2>

    
    <?php 
        include '../includes/dbAuthentication.inc';
        $conn = OpenConnection();

        $sql = "DELETE FROM wishlist WHERE product_id = '$prod_id'";

        if (mysqli_query($conn, $sql)) {
            echo nl2br("\r\n Successfully deleted the wishlist = $prod_id from the database");
            session_unset();
            session_destroy();
        } else {
            echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    ?>
    <?php include '../includes/footer.inc'?>;
</body>