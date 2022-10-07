<?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET") { 

       

        $supplier_id = $_GET["supplier_id"];
        if ($supplier_id) {
            include '../includes/dbAuthentication.inc';
            $conn = OpenConnection();
    
            $sql = "SELECT * FROM supplier WHERE supplier_id = '$supplier_id'";
            $result = mysqli_query($conn,$sql);
    
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $supplier = mysqli_fetch_assoc($result);   
                               
                }
            }
            else {
                echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
            }
    
            

        }


    }
?>

<?php 
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">READ SUPPLIER</span>
        </div>

        <div class="form-container">
            <div id="addProductForm">

                <div class="backButton">
                    <a href="supplier-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Supplier Page</span>
                    </a>
                </div>
                
                
                
                <div class="text-input-container">
                   
                        <div class="form-item">
                            <label for="supplier_id">Supplier ID</label>
                            <input type="text" name="supplier_id" id="supplier_id" value="<?php echo $supplier['supplier_id'];?>" readonly>
                        </div>
                        <div class="form-item">
                            <label for="supplier_name">Supplier Name</label>
                            <input type="text" name="supplier_name" id="supplier_name" value="<?php echo $supplier['supplier_name'];?>" readonly>
                        </div>
                   

                    

                    

               
            </div>
        </div>

    </section>
    
    <script src="../js/sidebar.js"></script>    
</body>
</html>