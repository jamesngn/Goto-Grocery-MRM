<?php 
    session_start();
    $wishlist_id = $_SESSION['wishlistid'];
    include '../includes/header.inc' 
?>
<body>
    <?php include '../includes/menu.inc' ?>;
    <h2>Delete Current Wishlist</h2>

    
    <?php 
        include '../includes/dbAuthentication.inc';
        $conn = OpenConnection();

        $sql = "DELETE FROM wishlist 
        WHERE wishlistid = '$wishlist_id'";

        if (mysqli_query($conn, $sql)) {
            echo nl2br("\r\n Successfully deleted the wishlist ID = $wishlist_id from the database");
            session_unset();
            session_destroy();
        } else {
            echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    ?>
    <?php include '../includes/footer.inc'?>;
</body>