<?php 
    session_start();
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Validate Supply Delivery for deleting</h2>
    <form action="validate-supplydelivery-delete.php" method="post">
        <p>
            <label for="supplydeliveryid">Supply Delivery ID:</label>
            <input type="text" name="supplydeliveryid" id="supplydeliveryid">
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
            $suppdel_id = mysqli_real_escape_string($conn,cleanInput($_POST['supplydeliveryid']));

            $sql = "SELECT * FROM suppdelivery WHERE supplydeliveryid = '$suppdel_id'";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\n Error: Supply Delivery ID $suppdel_id is not found.");
                } else {
                    $_SESSION['supplydeliveryid'] = $suppdel_id;
                    header("location: delete-supply-delivery.php");
                }
            } else {
                echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
            }
        }
        CloseConnection($conn);
    ?>
</body>