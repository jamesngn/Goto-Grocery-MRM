<?php 
    session_start();
?>

<?php include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Read Shopping Cart</h2>
    <form action="validate-memberID-read.php" method="post">  
        <fieldset>
            <legend>Enter member ID for reading shopping cart</legend>
            <p>
                <label for="member-ID">Member ID:</label>
                <input type="text" name="member-ID" id="member-ID">
            </p>
        </fieldset>    
        <button type="submit">Proceed</button>  
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
            include '../includes/dbAuthentication.inc';
            $conn = openConnection();

            $c_member_ID = mysqli_real_escape_string($conn, cleanInput($_POST['member-ID']));

            $sql2 = "SELECT customer_id FROM member WHERE customer_id = $c_member_ID";
            $result = mysqli_query($conn,$sql2);

            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br ("\r\nMember ID $c_member_ID is not found.");
                } 
                else {
                    $_SESSION["member-id"] = $c_member_ID;
                    header("location:read-cart.php");
                }
            } else {
                echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
            }

            mysqli_free_result($result);
            CloseConnection($conn);
        }

    ?>
    </body>
</html>
