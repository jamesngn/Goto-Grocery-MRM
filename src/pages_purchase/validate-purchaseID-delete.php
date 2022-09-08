<?php 
    session_start();
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Validate purchase ID for deleting</h2>
    <form action="validate-purchaseID-delete.php" method="post">
        <p>
            <label for="id">Purchase ID:</label>
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

            $sql = "SELECT * FROM purchase WHERE purchaseID = '$c_id'";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\n Error: Purchase ID $c_id is not found.");
                } else {
                    $_SESSION['purchaseID'] = $c_id;
                    header("location: delete-purchase.php");
                }
            } else {
                echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
            }
        }
        CloseConnection($conn);
    ?>
</body>