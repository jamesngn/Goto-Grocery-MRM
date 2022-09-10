<?php include '../includes/header.inc'; 
session_start();
?>

<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Validate member ID for reading purchase</h2>

    <form action="validate-memberID-read.php" method="post">
        <fieldset>
            <legend>Enter the member ID</legend>
            <p>
                <label for="memberID">Member ID: </label>
                <input type="text" name="memberID" id="memberID" >
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

            $c_memberID = mysqli_real_escape_string($conn,cleanInput($_POST['memberID']));
            
            $sql = 
            "SELECT customer_id
            FROM member
            WHERE customer_id = $c_memberID
            ";


            if (mysqli_query($conn, $sql)) {
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br ("\r\n Error: Purchase ID $c_memberID is not found.");
                } else {
                    $c_memberID = mysqli_fetch_assoc($result);
                    $_SESSION["memberID"] = $c_memberID['customer_id'];

                    header("location: read-purchase-by-memberID.php");
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