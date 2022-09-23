<?php 
    session_start();
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Delete supply delivery</h2>
    <form action="validate-supplydelivery-delete.php" method="post">
        <p>
                <label for="supplydeliveryid">Suppydelivery ID</label>
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
            $supp_id = mysqli_real_escape_string($conn,cleanInput($_POST['supplydeliveryid']));

            $sql = "SELECT * FROM suppdelivery WHERE supplydeliveryid = '$supp_id'";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\n Error: Supply delivery is not found.");
                } else {
                    $_SESSION['supplydeliveryid'] = $supp_id;
                    header("location: validate-supplydelivery-delete.php");
                }
            } else {
                echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
            }
            CloseConnection($conn);
        }
    ?>
</body>