<?php include '../includes/header.inc'; 
session_start();
?>


<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Validate grocery item ID for reading</h2>


    <form action="validate-productID-read.php" method="post">
        <fieldset>
            <legend>Enter the grocery item ID</legend>
            <p>
                <label for="id">Grocery ID: </label>
                <input type="text" name="id" id="id" value >
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

            $c_id = mysqli_real_escape_string($conn,cleanInput($_POST['id']));
            
            $sql = "SELECT * FROM product WHERE id = '$c_id'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br ("\r\n Error: Product ID $c_id is not found.");
                } else {
                    $product = mysqli_fetch_assoc($result);
                    $_SESSION["productAssoc"] = $product;
                    header("location: read-product.php");
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