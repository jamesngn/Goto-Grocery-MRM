<?php 
    session_start();
    $c_ID = $_SESSION['employee_ID'];
    include '../includes/header.inc' 
?>
<body>
    <?php include '../includes/menu.inc' ?>;
    <h2>Delete Employee Details</h2>

    
    <?php 
        include '../includes/dbAuthentication.inc';
        $conn = OpenConnection();

        $sql = "DELETE FROM employee WHERE employee_ID = '$c_ID'";

        if (mysqli_query($conn, $sql)) {
            echo nl2br("\r\n Successfully deleted the employee = $c_ID from the database");
            session_unset();
            session_destroy();
        } else {
            echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    ?>
    <?php include '../includes/footer.inc'?>;
</body>