<?php include '../includes/header.inc'; 
session_start();
?>


<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Read Supply Delivery</h2>


    <form action="read-supply-delivery.php" method="post">
        <fieldset>
            <legend>Enter the supply delivery ID</legend>
            <p>
            <label for="supplydeliveryid">Suppydelivery ID</label>
                <input type="text" name="supplydeliveryid" id="supplydeliveryid">
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

            $supp_id = mysqli_real_escape_string($conn,cleanInput($_POST['supplydeliveryid']));
            
            $sql = "SELECT * FROM suppdelivery WHERE supplydeliveryid = '$supp_id'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br ("\r\n Error: Supply delivery not found");
                } else {
                    $product = mysqli_fetch_assoc($result);
                    $_SESSION["productAssoc"] = $product;
                    header("location: read-supply-delivery.php");
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