<?php include '../includes/header.inc'; 
session_start();
?>

<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Validate purchase ID for reading</h2>

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
            "SELECT purchase.memberID, purchase.purchaseTime, purchaseItem.productID, purchaseItem.quantity
            FROM purchase
            LEFT JOIN purchaseItem ON purchase.purchaseID = purchaseItem.purchaseID
            WHERE purchase.purchaseID = $c_purchaseID
            ";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br ("\r\n Error: Purchase ID $c_purchaseID is not found.");
                } else {
                    $purchase = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    $_SESSION["purchase"] = $purchase;
                    header("location: read-purchase.php");
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