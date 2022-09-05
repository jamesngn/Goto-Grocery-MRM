<?php 
    session_start();
    $c_id = $_SESSION['productID'];
    include '../includes/header.inc' 
?>
<body>
    <?php include '../includes/menu.inc' ?>;
    <h2>Delete Current Product</h2>

    
    <?php 
        include '../includes/dbAuthentication.inc';
        $conn = OpenConnection();

        $sql = "DELETE FROM product WHERE id = '$c_id'";

        if (mysqli_query($conn, $sql)) {
            echo nl2br("\r\n Successfully delete the product ID = $c_id from the database");
            session_unset();
            session_destroy();
        } else {
            echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    ?>
    <?php include '../includes/footer.inc'?>;
</body>