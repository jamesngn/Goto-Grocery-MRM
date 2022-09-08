<?php 
    include '../includes/dbAuthentication.inc';
    session_start();

    $supp_id = $_SESSION['supplier_id'];
    $conn = OpenConnection();
    
    $sql = "SELECT * FROM supplier WHERE supplier_id = $supp_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $supplier = mysqli_fetch_assoc($result);
    }  else {
        echo "\r\nSQL error: " . mysqli_error($conn);
    }
    CloseConnection($conn);
?>




<?php
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/menu.inc'?>
    <h2>Edit Supplier Page</h2>
    <form action="edit-supplier.php" method="post">
        <fieldset>
            <legend>Edit the Supplier</legend>
            <p>
                <label for="supplier-name">Supplier Name:</label>
                <input type="text" name="supplier-name" id="supplier-name" value = "<?php echo $supplier['supplier_name'];?>">
            </p>
           
            
            <button type="submit">Edit</button>
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
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $conn = OpenConnection();

            $c_supplier_name = mysqli_real_escape_string($conn, cleanInput($_POST['supplier-name']));
            

            $sql = 
            "UPDATE supplier 
            SET 
            supplier_name = '$c_supplier_name'
                
            WHERE supplier_id = $supp_id";

            if (mysqli_query($conn, $sql)) {
                echo "\r\nRecord updated successfully";
                session_unset();
                session_destroy();
            } else {
                echo "\r\nError updating record: " . mysqli_error($conn);
            }

            CloseConnection($conn);
        }
    ?>
    
    <?php include '../includes/footer.inc'?>
</body>
</html>