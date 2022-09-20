<?php include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Add New Supply Delivery</h2>
    <form action="addsupplydelivery.php" method="post">
        <fieldset>
            <legend> Add new Supply Delivery </legend>
            <p>
                <label for="prod_id">Product ID:</label>
                <input type="text" name="prod_id" id="prod_id">
            </p>
            <p>
                <label for="supp_id">Supplier ID</label>
                <input type="text" name="supp_id" id="supp_id">
            </p>
            <p>
                <label for="quantity">Quantity</label>
                <input type="text" name="quantity" id="quantity">
            </p>
            <p>
                <label for="delivery_date">Delivery Date</label>
                <input type="text" name="delivery_date" id="delivery_date">
            </p>

            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </fieldset>
    </form>
</body>
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

        $prod_id = mysqli_real_escape_string($conn, cleanInput($_POST['prod_id']));
        $supp_name = mysqli_real_escape_string($conn, cleanInput($_POST['supp_id']));
        $quantity = mysqli_real_escape_string($conn, cleanInput($_POST['quantity']));
        $ddate = mysqli_real_escape_string($conn, cleanInput($_POST['delivery_date']));


        //Add to database
        $sql = "INSERT INTO supplydelivery (prod_id,supp_id,quantity,delivery_date )
        VALUES ('$prod_id','$supp_name','$quantity','$ddate')";

        if (mysqli_query($conn,$sql)) {
            echo nl2br ("\r\n Added a delivery from a supplier");
        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
<?php include '../includes/footer.inc'; ?>
    </body>
</html>