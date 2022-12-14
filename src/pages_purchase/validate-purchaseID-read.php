<?php include '../includes/header.inc'; 
session_start();
?>

<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Validate purchase ID for reading purchase</h2>

    <form action="validate-purchaseID-read.php" method="post">
        <fieldset>
            <legend>Enter the purchase ID</legend>
            <p>
                <label for="purchaseID">Purchase ID: </label>
                <input type="text" name="purchaseID" id="purchaseID" >
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
            $conn = OpenConnection();

            $c_purchaseID = mysqli_real_escape_string($conn,cleanInput($_POST['purchaseID']));
            
            $sql = 
            "SELECT purchaseID
            FROM purchase
            WHERE purchaseID = $c_purchaseID
            ";


            if (mysqli_query($conn, $sql)) {
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br ("\r\n Error: Purchase ID $c_purchaseID is not found.");
                } else {
                    $purchaseID = mysqli_fetch_assoc($result);
                    $_SESSION["purchaseID"] = $purchaseID['purchaseID'];

                    header("location: read-purchase-by-purchaseID.php");
                }
            } else {
                echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
            }
            CloseConnection($conn);
        }

    ?>


<?php include '../includes/footer.inc'; ?>
    </body>
</html>