<?php 
    session_start();
    $suppdel_id = $_SESSION['supplydeliveryid'];
    include '../includes/header.inc' 
?>
<body>
    <?php include '../includes/menu.inc' ?>;
    <h2>Delete Supply Delivery</h2>

    
    <?php 
        include '../includes/dbAuthentication.inc';
        $conn = OpenConnection();

        $sql = "DELETE FROM suppdelivery 
        WHERE supplydeliveryid = '$suppdel_id'";

        if (mysqli_query($conn, $sql)) {
            echo nl2br("\r\n Successfully deleted the supply delivery ID = $suppdel_id from the database");
            session_unset();
            session_destroy();
        } else {
            echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    ?>
    <?php include '../includes/footer.inc'?>;
</body>