<?php 
    session_start();
    $category_id = $_SESSION['categoryID'];
    include '../includes/header.inc' 
?>
<body>
    <?php include '../includes/menu.inc' ?>;
    <h2>Delete Current Category</h2>

    
    <?php 
        include '../includes/dbAuthentication.inc';
        $conn = OpenConnection();

        $sql = "DELETE FROM category 
        WHERE categoryID = '$category_id'";

        if (mysqli_query($conn, $sql)) {
            echo nl2br("\r\n Successfully deleted the category ID = $category_id from the database");
            session_unset();
            session_destroy();
        } else {
            echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    ?>
    <?php include '../includes/footer.inc'?>;
</body>