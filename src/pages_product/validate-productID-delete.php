<?php 
    session_start();
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Validate product ID for deleting</h2>
    <form action="validate-productID-delete.php" method="post">
        <p>
            <label for="id">Product ID:</label>
            <input type="text" name="id" id="id">
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
            $c_id = mysqli_real_escape_string($conn,cleanInput($_POST['id']));

            $sql = "SELECT * FROM product WHERE id = '$c_id'";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\n Error: Product ID $c_id is not found.");
                } else {
                    $_SESSION['productID'] = $c_id;
                    header("location: delete-product.php");
                }
            } else {
                echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
            }
        }
        CloseConnection($conn);
    ?>
</body>