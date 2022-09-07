<?php include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Add New Supplier</h2>
    <form action="add_supplier.php" method="post">
        <fieldset>
            <legend> Add new Suppliers </legend>
            <p>
                <label for="supplier_id">Supplier ID:</label>
                <input type="text" name="supplier_id" id="supplier_id">
            </p>
            <p>
                <label for="supplier_name">Supplier Name</label>
                <input type="text" name="supplier_name" id="supplier_name">
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

        $supp_id = mysqli_real_escape_string($conn, cleanInput($_POST['supplier_id']));
        $supp_name = mysqli_real_escape_string($conn, cleanInput($_POST['supplier_name']));

        //Add to database
        $sql = "INSERT INTO supplier (name,supplier_id)
        VALUES ('$supp_id','$supp_name')";

        if (mysqli_query($conn,$sql)) {
            echo nl2br ("\r\n Added $supp_name supplier to the database");
        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
<?php include '../includes/footer.inc'; ?>
    </body>
</html>