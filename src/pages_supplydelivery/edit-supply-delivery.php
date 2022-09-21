<?php session_start();
include '../includes/header.inc'; 
?>

<body>
    <?php include '../includes/menu.inc';?>
    <h2>Edit Supply delivery</h2>

    <form action="edit-supply-delivery.php" method="post">
        <fieldset>
            <legend>Enter the supplier ID</legend>
            <p>
                <label for="supp_id">Supplier ID</label>
                <input type="text" name="supp_id" id="supp_id">
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
            $c_id = mysqli_real_escape_string($conn, cleanInput($_POST['id']));
            //select the row from the product table to match with the input id.
            $sql = "SELECT * FROM supplydelivery WHERE id = $supp_id";
            //perform a query against the database.
            $result = mysqli_query($conn, $sql);
            //validation check
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\n Error: Supply delivery is not found.");
                } else {
                    $_SESSION['productID'] = $c_id;
                    header("location:edit-supply-delivery.php");
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