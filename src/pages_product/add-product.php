<?php include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Add New Product</h2>
    <form action="add-product.php" method="post">
        <fieldset>
            <legend>Add new grocery items</legend>
            <p>
                <label for="grocery-name">Grocery Name:</label>
                <input type="text" name="grocery-name" id="grocery-name">
            </p>
            <p>
                <label for="description">Description:</label>
                <input type="text" name="description" id="description">
            </p>
            <p>
                <label for="qty-stock">Quantity Stock:</label>
                <input type="text" name="qty-stock" id="qty-stock">
            </p>
            <p>
                <label for="price">Price:</label>
                <input type="text" name="price" id="price">
            </p>
            <p>
                <label for="category-id">Category ID:</label>
                <input type="text" name="category-id" id="category-id">
            </p>
            <p>
                <label for="supplier-id">Supplier ID:</label>
                <input type="text" name="supplier-id" id="supplier-id">
            </p>
            <p>
                <label for="date-stock-in">Last Date Restocked: </label>
                <input type="text" name="date-stock-in" id="date-stock-in" placeholder = "dd-mm-yyyy">
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

        // the cleaned – "safe" – inputs ready to be added to the database
        $c_grocery_name = mysqli_real_escape_string($conn, cleanInput($_POST['grocery-name']));
        $c_description = mysqli_real_escape_string($conn, cleanInput($_POST['description']));
        $c_qty_stock = mysqli_real_escape_string($conn, cleanInput($_POST['qty-stock']));
        $c_price = mysqli_real_escape_string($conn, cleanInput($_POST['price']));
        $c_category_id = mysqli_real_escape_string($conn, cleanInput($_POST['category-id']));
        $c_supplier_id = mysqli_real_escape_string($conn, cleanInput($_POST['supplier-id']));
        $c_date_stock_in = mysqli_real_escape_string($conn, cleanInput($_POST['date-stock-in']));

        //Add to database
        $sql = "INSERT INTO product (name,description,qty_stock,price,category_ID,supplier_ID,date_stock_in)
        VALUES ('$c_grocery_name','$c_description','$c_qty_stock','$c_price','$c_category_id','$c_supplier_id','$c_date_stock_in')";

        if (mysqli_query($conn,$sql)) {
            echo nl2br ("\r\n Added $c_grocery_name product to the database");
        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
<?php include '../includes/footer.inc'; ?>
    </body>
</html>

