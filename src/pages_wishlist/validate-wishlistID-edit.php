<?php session_start();
include '../includes/header.inc'; 
?>

<body>
    <?php include '../includes/menu.inc';?>
    <h2>Validate Wishlist ID for editting</h2>

    <form action="validate-wishlistID-edit.php" method="post">
        <fieldset>
            <legend>Enter the Wishlist ID</legend>
            <p>
                <label for="wishlistid">wishlist ID:</label>
                <input type="text" name="wishlistid" id="wishlistid">
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
            //Connect to the database and store it in variable $conn.
            $conn = OpenConnection();
            //Clean the id value to prevent from attack.
            $wishlist_id = mysqli_real_escape_string($conn, cleanInput($_POST['wishlistid']));
            //select the row from the wishlist table to match with the input id.
            $sql = "SELECT * FROM wishlist WHERE wishlistid = $wishlist_id";
            //perform a query against the database.
            $result = mysqli_query($conn, $sql);
            //validation check
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\n Error: wishlist ID $wishlist_id is not found.");
                } else {
                    $_SESSION['wishlistid'] = $wishlist_id;
                    header("location:edit-wishlist.php");
                }
            }
            else {
                echo nl2br("\r\nSQL error: " . mysqli_error($conn));
            }
            CloseConnection($conn);
        }

    ?>

    <?php include '../includes/footer.inc';?>
</body>