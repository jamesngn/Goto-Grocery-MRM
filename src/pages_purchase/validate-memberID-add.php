<?php session_start(); ?>

<?php include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Enter member ID to purchase items in your shopping cart</h2>
    <form action="validate-memberID-add.php" method="post">
        <p>
            <label for="member-ID">Member ID:</label>
            <input type="text" name="member-ID" id="member-ID">
        </p>
        <button type="submit">Proceed</button>
        <button type="reset">Reset</button>
    </form>
    <?php
        function cleanInput($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include "../includes/dbAuthentication.inc";
            $conn = OpenConnection();

            $c_member_ID = mysqli_real_escape_string($conn,cleanInput($_POST['member-ID']));

            $sql = "SELECT customer_id FROM member WHERE customer_id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i",$c_member_ID);

            if ($stmt -> execute()) 
            {
                $result = $stmt->get_result();
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\nError: Customer ID is not found.");
                } else {
                    $_SESSION["member-ID"] = $c_member_ID;
                    header("location:add-purchase.php");
                }
            }
            else {
                echo nl2br("\r\nSQL error: " . mysqli_error($conn));
            }
            CloseConnection($conn);
        }
    ?>

    <?php include '../includes/footer.inc'; ?>
    <?php include '../includes/bootstrapcore.inc'; ?>
</body>
</html>