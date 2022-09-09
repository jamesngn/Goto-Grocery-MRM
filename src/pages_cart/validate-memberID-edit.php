<?php 
    session_start();
    // RETRIEVE CUSTOMER ID FROM MEMBER TABLE
    include '../includes/dbAuthentication.inc';
    $conn = openConnection();

    $sql = "SELECT customer_id FROM member";
    $result = mysqli_query($conn,$sql);
    if ($result) { 
        $customerIDs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo nl2br("\r\nSQL ERROR: " . mysqli_error($conn));
    }

    mysqli_free_result($result);

    
    // print_r($customerIDs);
?>

<?php include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Edit your Shopping Cart</h2>
    <form action="validate-memberID-edit.php" method="post">  
        <fieldset>
            <legend>Enter member ID to edit shopping cart</legend>
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

            $c_member_ID = mysqli_real_escape_string($conn, cleanInput($_POST['member-ID']));

            $sql2 = "SELECT customer_id,customer_firstname as fName,customer_lastname as lName FROM member WHERE customer_id = $c_member_ID";
            $result = mysqli_query($conn,$sql2);
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br ("\r\nMember ID $c_member_ID is not found.");
                } else {
                    $_SESSION["member-id"] = $c_member_ID;

                    $customerInfo = mysqli_fetch_assoc($result); 
                    $_SESSION["customer-name"] = $customerInfo['fName'] . " " . $customerInfo['lName'];

                    header("location:edit-cart.php");
                }
            } else {
                echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
            }
        }

    ?>
    </body>
</html>
