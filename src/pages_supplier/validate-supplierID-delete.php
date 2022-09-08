<?php 
    session_start();
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Validate supplier ID for deleting</h2>
    <form action="validate-supplierID-delete.php" method="post">
        <p>
            <label for="supplier_id">Supplier ID:</label>
            <input type="text" name="supplier_id" id="supplier_id">
        </p>
        <button type="submit">Delete</button>
    </form>

    <?php
        function cleanInput($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        include '../includes/dbAuthentication.inc';

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $conn = OpenConnection();
            $supp_id = mysqli_real_escape_string($conn,cleanInput($_POST['supplier_id']));

            $sql = "SELECT * FROM supplier WHERE supplier_id = '$supp_id'";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\n Error: Supplier ID $supp_id is not found.");
                } else {
                    $_SESSION['supplier_id'] = $supp_id;
                    header("location: delete-supplier.php");
                }
            } else {
                echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
            }
        }
        CloseConnection($conn);
    ?>
</body>