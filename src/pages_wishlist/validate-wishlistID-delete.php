<?php 
    session_start();
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Validate Wishlist ID for deleting</h2>
    <form action="validate-wishlistID-delete.php" method="post">
        <p>
            <label for="wishlistid">wishlist ID:</label>
            <input type="text" name="wishlistid" id="wishlistid">
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
            $wishlist_id = mysqli_real_escape_string($conn,cleanInput($_POST['wishlistid']));

            $sql = "SELECT * FROM wishlist WHERE wishlistid = '$wishlist_id'";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\n Error: Wishlist ID $wishlist_id is not found.");
                } else {
                    $_SESSION['wishlistid'] = $wishlist_id;
                    header("location: delete-wishlist.php");
                }
            } else {
                echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
            }
        }
        CloseConnection($conn);
    ?>
</body>