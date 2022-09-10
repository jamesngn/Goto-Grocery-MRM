<?php include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Add Wishlist</h2>

    <form method="post" action="add-wishlist.php">
        <fieldset>
            <legend>Enter new Wishlist</legend>
            <p>
                <label for="wishlistid">Wishlist ID</label>
                <input type="text" name="wishlistid" id="wishlistid" required />
            </p>
            <p>
                <label for="cust_id">Customer ID</label>
                <input type="text" name="cust_id" id="cust_id" required />
            </p>
            <p>
                <label for="product_id">Product ID:</label>
                <input type="text" name="prod_id" id="prod_id">
            </p>
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
            
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $conn = OpenConnection();

        $wish_id = mysqli_real_escape_string($conn, cleanInput($_POST['wishlistid']));
        $cust_id = mysqli_real_escape_string($conn, cleanInput($_POST['cust_id']));  
        $prod_id = mysqli_real_escape_string($conn, cleanInput($_POST['prod_id']));
        

        
        $sql = "INSERT INTO wishlist (wishlistid,cust_id,prod_id)
        VALUES ('$wish_id','$cust_id ','$prod_id')";

        if (mysqli_query($conn,$sql)) {
            echo nl2br ("\r\n Added Product ID $prod_id to the wishlist of customer $cust_id");
        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
<?php include '../includes/footer.inc'; ?>
</body>
</html>
