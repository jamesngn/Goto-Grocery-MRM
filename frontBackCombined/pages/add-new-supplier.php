<?php 
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;
   
   
    <?php 
        include '../includes/dbAuthentication.inc';

        $conn = OpenConnection();

      
        $sql = "SELECT * FROM supplier";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $supplier = mysqli_fetch_all($result);
            }
        } else {
            echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
        }
    ?>
   
   
   
   
   
   
   
   
   
   
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">ADD NEW SUPPLIER</span>
        </div>
        <div class="supplier-container">
        <form action="add-new-supplier.php" method="post"   id="addProductForm">

<div class="backButton">
    <a href="product-table.php">
        <i class="fa-solid fa-delete-left"></i>
        <span>Supplier Page</span>
    </a>
</div>
<div class="text-input-container">
                    <div class="form-wrap">
                        <div class="form-item description">
                            <label for="supplier_id">Supplier ID</label>
                            <input type="text" name="supplier_id" id="supplier_id" >
                        </div>
                    </div>
                    <div class="form-wrap">
                        <div class="form-item description">
                            <label for="supplier_name">Supplier Name</label>
                            <input type="text" name="supplier_name" id="supplier_name" required>
                        </div>
                    </div>    
            <div class="form-wrap">
                        <button class="add" type="submit" name="submit">Add</button>
                        <button type="reset" onclick="ResetInput()">Reset</button>
                    </div>
        </div> 
</form>
       
    
    
    
    
    
    </div>

    </section>

<script src="../js/product.js"></script>       
<script src="../js/sidebar.js"></script>    
</body>
</html>
<?php 

    function cleanInput($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
         // the cleaned – "safe" – inputs ready to be added to the database
         $supplier_id= mysqli_real_escape_string($conn,cleanInput($_POST['supplier_id']));

         $supplier_name = mysqli_real_escape_string($conn,cleanInput($_POST['supplier_name']));



         //Add to database
         $sql = "INSERT INTO supplier (supplier_id,supplier_name)
         VALUES ('$supplier_id','$supplier_name')";
 
         if (mysqli_query($conn,$sql)) {
             echo '<script>window.location.href = "add-supplier-success.php"; </script>';
 
         } else {
             echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
         }
         CloseConnection($conn);
     }
 ?>
    