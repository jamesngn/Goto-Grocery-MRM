<?php include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Add Wishlist</h2>

    <form method="post" action="add_new_wishlist.php">
        <fieldset>
            <legend>Enter new Wishlist</legend>
            <p>
                <label for="cust_id">Customer_id</label>
                <input type="text" name="cust_id" id="cust_id" required />
            </p>
            <p>
                <label for="product_id">Product ID:</label>
                <input type="text" name="product_id" id="product_id">
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $conn = OpenConnection();

       
        $cust_id = mysqli_real_escape_string($conn, cleanInput($_POST['cust_id']));  
        $prod_id = mysqli_real_escape_string($conn, cleanInput($_POST['product_id']));
        

        
        $sql = "INSERT INTO wishlist (cust_id,product_id)
        VALUES ('$cust_id ','$prod_id')";

        if (mysqli_query($conn,$sql)) {
            echo nl2br ("\r\n Added $prod_id Product ID to the wishlist of $cust_id  customer ");
        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
<?php include '../includes/footer.inc'; ?>
</body>
</html>
