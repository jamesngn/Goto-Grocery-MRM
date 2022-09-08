<?php 
    session_start();
    $supp_id = $_SESSION['supplier_id'];
    include '../includes/header.inc' 
?>
<body>
    <?php include '../includes/menu.inc' ?>;
    <h2>Delete Supplier</h2>

    
    <?php 
        include '../includes/dbAuthentication.inc';
        $conn = OpenConnection();

        $sql = "DELETE FROM supplier WHERE supplier_id = '$supp_id'";

        if (mysqli_query($conn, $sql)) {
            echo nl2br("\r\n Successfully deleted the supplier_id = $supp_id from the database");
            session_unset();
            session_destroy();
        } else {
            echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    ?>
    <?php include '../includes/footer.inc'?>;
</body>