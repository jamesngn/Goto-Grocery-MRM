<?php session_start();
include '../includes/header.inc'; 
?>

<body>
    <?php include '../includes/menu.inc';?>
    <h2>Validate Supplier ID for editting</h2>

    <form action="validate-supplierID-edit.php" method="post">
        <fieldset>
            <legend>Enter the Supplier ID</legend>
            <p>
                <label for="supplier_id">Supplier ID:</label>
                <input type="text" name="supplier_id" id="supplier_id">
            </p>

            <p>
                <button type="submit">Search</button>
                <button type="reset">Reset</button>
            </p>
        </fieldset>
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
            //Connect to the database and store it in variable $conn.
            $conn = OpenConnection();
            //Clean the id value to prevent from attack.
            $supp_id = mysqli_real_escape_string($conn, cleanInput($_POST['supplier_id']));
            //select the row from the supplier table to match with the input id.
            $sql = "SELECT * FROM supplier WHERE supplier_id = $supp_id";
            //perform a query against the database.
            $result = mysqli_query($conn, $sql);
            //validation check
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\n Error: supplier ID $supp_id is not found.");
                } else {
                    $_SESSION['supplier_id'] = $supp_id;
                    header("location:edit-supplier.php");
                }
            }
            else {
                echo nl2br("\r\nSQL error: " . mysqli_error($conn));
            }
            CloseConnection($conn);
        }

    ?>

    <?php include '../includes/footer.inc';?>
</body>