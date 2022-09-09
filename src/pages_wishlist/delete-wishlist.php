<?php 
    session_start();
    $prod_id = $_SESSION['product_id'];
    include '../includes/header.inc' 
?>
<body>
    <?php include '../includes/menu.inc' ?>;
    <h2>Delete Wishlist</h2>
    <form action="delete_wishlist.php" method="post">
        <p>
            <label for="wishlistid">Wishlist ID:</label>
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
            $wishid = mysqli_real_escape_string($conn,cleanInput($_POST['wishlistid']));

            $sql = "SELECT * FROM wishlist WHERE wishlistid = '$wishid'";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\n Error: Wishlist ID $wishid is not found.");
                } else {
                    $_SESSION['wishlistid'] = $wishid;
                    header("location: delete_wishlist.php");
                }
            } else {
                echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
            }
        }
        CloseConnection($conn);
    ?>
    <?php include '../includes/footer.inc'?>;
</body>